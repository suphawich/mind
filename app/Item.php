<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Gbrock\Table\Traits\Sortable;


class Item extends Model
{
    public function item_option_checks() {
        return $this->hasMany('App\Items_option_check');
    }

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
        $detail = '<div class="row">'
                    .'<h5>'.$this->name.'</h5>'
                 .'</div>'
                 .'<div class="d-flex flex-column pl-4 description">'
                    .'<div class="row">'
                        .'<label class="mr-2">Description:</label>'
                        .'<label>'.$this->description.'</label>'
                    .'</div>'
                    .'<div class="row">'
                        .'<label class="mr-2">Size:</label>'
                        .'<label>'.$this->toStringSize($this->width, $this->length, $this->height).'</label>'
                    .'</div>'
                    .'<div class="row">'
                        .$this->toStringOptions()
                    .'</div>'
                 .'</div>';
        return $detail;
    }

    private function toStringSize($width, $length, $height) {
        $user = $this->user()->first();
        $setting_item = $user->setting_item()->first();
        $str = number_format($width, 2)
                .' x '
                .number_format($length, 2)
                .' x '
                .number_format($height, 2)
                .' '.$setting_item->unit;
        return $str;
    }

    private function toStringOptions() {
        $iocs = $this->item_option_checks()->get();
        $str = '';
        foreach ($iocs as $ioc) {
            $sioc = $ioc->setting_item_option_check()->first();
            if ($sioc->status) {
                $check = "<a href='/items_option_check/".$ioc->id."/checked' class='btn btn-light btn-sub'><i class='fa fa-check'></i></a>";
                $uncheck = "<a href='/items_option_check/".$ioc->id."/unchecked' class='btn btn-light btn-sub-times'><i class='fa fa-times'></i></a>";
                if ($ioc->status) {
                    $status = "<i class='fa fa-check-circle'></i>";
                } else {
                    $status = "<i class='fa fa-info-circle'></i>";
                }
                $str .= '<span tabindex="0" class="badge badge-pill badge-primary" data-toggle="popover" data-placement="bottom" data-trigger="focus" data-html="true" data-content="'.$check.$uncheck.'">'
                            .$status.' '.$sioc->name
                        .'</span>';
            }
        }
        return $str;
    }
}
