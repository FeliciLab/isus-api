<?php

namespace App\Model\Esp;

use Illuminate\Database\Eloquent\Model;

class EspUserInfo extends Model
{
    protected $table = 'esp_user_infos';

    protected $fillable = [
        'user_id',
        'area_esp',
        'area_outros',
    ];
}
