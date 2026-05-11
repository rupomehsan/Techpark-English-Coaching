<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Modules\Management\SettingManagement\WebsiteSettings\Models\Model as SettingTitleValue;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        // WarehouseProductOut::observe(WarehouseProductOutObserver::class);

        View::composer('*', function ($view) {
            $app_settings = SettingTitleValue::with([
                'setting_values' => function ($query) {
                    $query->select('id', 'title', 'value', 'setting_title_id');
                }
            ])
                ->select('id', 'title')
                ->get()->toArray();
                // dd($app_settings);

            $GLOBALS['app_settings'] = $app_settings;

            $view->with([
                'app_settings' => $app_settings,
            ]);
        });


        // Load SMTP config from email_configures (UI-managed), fallback to con_setting_title_values
        try {
            $emailConfig = DB::table('email_configures')->whereNull('deleted_at')->latest('updated_at')->first();

            if ($emailConfig && $emailConfig->host) {
                Config::set('mail.mailers.smtp.host',       $emailConfig->host);
                Config::set('mail.mailers.smtp.port',       (int) $emailConfig->port);
                Config::set('mail.mailers.smtp.username',   $emailConfig->username);
                Config::set('mail.mailers.smtp.password',   $emailConfig->password);
                Config::set('mail.mailers.smtp.encryption', $emailConfig->encryption ?? 'tls');
                Config::set('mail.from.address',            $emailConfig->mail_from_email);
                Config::set('mail.from.name',               $emailConfig->mail_from_name);
                Config::set('mail.default', 'smtp');
            } else {
                $smtpSettings = DB::table('con_setting_title_values')
                    ->whereIn('title', ['mail_host','mail_port','mail_username','mail_password','mail_encryption','mail_from_address','mail_from_name'])
                    ->pluck('value', 'title');

                if ($smtpSettings->isNotEmpty()) {
                    if ($smtpSettings->get('mail_host'))         Config::set('mail.mailers.smtp.host',       $smtpSettings->get('mail_host'));
                    if ($smtpSettings->get('mail_port'))         Config::set('mail.mailers.smtp.port',       (int) $smtpSettings->get('mail_port'));
                    if ($smtpSettings->get('mail_username'))     Config::set('mail.mailers.smtp.username',   $smtpSettings->get('mail_username'));
                    if ($smtpSettings->get('mail_password'))     Config::set('mail.mailers.smtp.password',   $smtpSettings->get('mail_password'));
                    if ($smtpSettings->get('mail_encryption'))   Config::set('mail.mailers.smtp.encryption', $smtpSettings->get('mail_encryption'));
                    if ($smtpSettings->get('mail_from_address')) Config::set('mail.from.address',            $smtpSettings->get('mail_from_address'));
                    if ($smtpSettings->get('mail_from_name'))    Config::set('mail.from.name',               $smtpSettings->get('mail_from_name'));
                    Config::set('mail.default', 'smtp');
                }
            }
        } catch (\Exception $e) {
            // DB not ready yet — skip mail config
        }
    }
}
