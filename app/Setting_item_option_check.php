<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting_item_option_check extends Model
{
    public function setting_item() {
        return $this->belongsTo('App\Setting_item');
    }
}
