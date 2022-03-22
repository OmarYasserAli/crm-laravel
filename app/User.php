<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function assigned_cutomers() {
        return $this->belongsToMany(User::class,'user_customer', 'user_id', 'customer_id');
        //
    }
    public function customers_employees() {
        return $this->belongsToMany(User::class,'user_customer',  'customer_id', 'user_id');
        //
    }
    public function actions() {
        return $this->hasMany(Action::class,  'customer_id');
        //
    }
    public function isCustomer() {
        return $this->hasRole('customer');
        //
    }
}
