<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting_item_option_check extends Model
{
    public function setting_item() {
        return $this->belongsTo('App\Setting_item');
    }

    public function item_option_checks() {
        return $this->hasOne('App\Items_option_check');
    }

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
