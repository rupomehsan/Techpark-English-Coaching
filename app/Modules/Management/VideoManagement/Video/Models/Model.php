<?php

namespace App\Modules\Management\VideoManagement\Video\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Model extends EloquentModel
{
    use SoftDeletes;

    protected $table = 'videos';
    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($data) {
            $random_no = random_int(100, 999) . $data->id . random_int(100, 999);
            $slug = $data->title . ' ' . $random_no;
            $data->slug = Str::slug($slug);
            if (strlen($data->slug) > 80) {
                $data->slug = substr($data->slug, strlen($data->slug) - 80);
            }
            if (auth()->check()) {
                $data->creator = auth()->user()->id;
            }
            $data->save();
        });
    }

    public function scopeActive($q)    { return $q->where('status', 'active'); }
    public function scopeInactive($q)  { return $q->where('status', 'inactive'); }
    public function scopeTrased($q)    { return $q->onlyTrashed(); }

    // Extract YouTube embed ID from any YouTube URL format
    public function getEmbedIdAttribute(): ?string
    {
        $url = $this->youtube_url ?? '';
        if (preg_match('/(?:youtube\.com\/(?:embed\/|watch\?v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $m)) {
            return $m[1];
        }
        return null;
    }

    public function getEmbedUrlAttribute(): string
    {
        $id = $this->embed_id;
        return $id ? "https://www.youtube.com/embed/{$id}" : '';
    }

    public function getAutoThumbnailAttribute(): string
    {
        if ($this->thumbnail) return $this->thumbnail;
        $id = $this->embed_id;
        return $id ? "https://img.youtube.com/vi/{$id}/maxresdefault.jpg" : '';
    }
}
