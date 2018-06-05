<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Gbrock\Table\Traits\Sortable;

class Item extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    use Sortable;

    /**
     * The attributes which may be used for sorting dynamically.
     *
     * @var array
     */
    protected $sortable = ['email'];

    protected function getRenderedImageAttribute()
    {
        return '<img src="'.$this->image_path.'" width="200" height="200">';
    }

    protected function getRenderedDetailAttribute()
    {
        // We access the following diff string with "$model->rendered_created_at"
        // return $this->created_at->diffForHumans();
        return $this->name;
    }
}
