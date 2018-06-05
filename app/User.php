<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Gbrock\Table\Traits\Sortable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'username', 'email', 'phone_number', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function isSuperAdmin() {
        return $this->position === "Administrator";
    }

    public function items() {
        return $this->hasMany('App\Item');
    }

    public function setting_item() {
        return $this->hasOne('App\Setting_item');
    }

    use Sortable;

    /**
     * The attributes which may be used for sorting dynamically.
     *
     * @var array
     */
    protected $sortable = ['email'];

    protected function getRenderedDetailAttribute() {
        return $this->email." <b>Hello</b>";
    }

    protected function getRenderedCreatedAtAttribute()
    {
        // We access the following diff string with "$model->rendered_created_at"
        return $this->created_at->diffForHumans();
    }
}
