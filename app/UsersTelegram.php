<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersTelegram extends Model
{
    protected $guarded = [];
    protected $table = 'tu_user';
    protected $primaryKey = 'UserID';
}
