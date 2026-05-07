<?php

function setting($key, $multiple = false)
{
    try {
        $appSettings = $GLOBALS['app_settings'] ?? [];

        // DB fallback: view composer hasn't run (e.g. controller redirect context)
        if (empty($appSettings)) {
            if ($multiple) {
                return [];
            }
            return \DB::table('con_setting_title as p')
                ->join('con_setting_title_values as v', 'p.id', '=', 'v.setting_title_id')
                ->where('p.title', $key)
                ->whereNull('p.deleted_at')
                ->whereNull('v.deleted_at')
                ->value('v.value') ?? '';
        }

        // normalize collection to array
        if ($appSettings instanceof \Illuminate\Support\Collection) {
            $appSettings = $appSettings->toArray();
        }

        if (!$multiple) {
            foreach ($appSettings as $item) {
                if (!isset($item['title'])) {
                    continue;
                }
                if ($item['title'] == $key) {
                    // prefer direct 'value' if present
                    if (isset($item['value'])) {
                        return $item['value'];
                    }

                    // otherwise, check nested setting_values and return first value
                    if (!empty($item['setting_values']) && is_array($item['setting_values'])) {
                        $first = $item['setting_values'][0];
                        return $first['value'] ?? '';
                    }

                    return '';
                }
            }

            return '';
        } else {
            $matches = [];
            foreach ($appSettings as $item) {
                if (isset($item['title']) && $item['title'] == $key) {
                    $matches[] = $item;
                }
            }
            return $matches;
        }
    } catch (\Throwable $th) {
        // swallow errors and return empty string or array depending on $multiple
        return $multiple ? [] : '';
    }
}
