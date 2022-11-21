<?php

namespace App;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UssdMenu extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'ussd_menus';

    protected $appends = [
        'main_menu',
        'initiate_request',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ussd_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function ussd()
    {
        return $this->belongsTo(Ussd::class, 'ussd_id');
    }

    public function getMainMenuAttribute()
    {
        return $this->getMedia('main_menu')->last();
    }

    public function getInitiateRequestAttribute()
    {
        return $this->getMedia('initiate_request')->last();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
