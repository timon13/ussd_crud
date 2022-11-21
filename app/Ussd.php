<?php

namespace App;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ussd extends Model
{
    use HasFactory;

    public $table = 'ussds';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ussd_code',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function ussdUssdMenus()
    {
        return $this->hasMany(UssdMenu::class, 'ussd_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
