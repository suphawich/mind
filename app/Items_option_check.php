<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Items_option_check extends Model
{
    public function item() {
        return $this->belongsTo('App\Item');
    }

    public function setting_item_option_check() {
        return $this->belongsTo('App\Setting_item_option_check');
    }

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
