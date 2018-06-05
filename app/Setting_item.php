<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting_item extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function item_option_checks() {
        return $this->hasMany('App\Setting_item_option_check');
    }
}
