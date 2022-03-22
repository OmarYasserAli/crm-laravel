<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Action_type;
class Action extends Model
{
    protected $fillable = [
        'name' ,'customer_id','employee_id' ,'type_id'
    ];

    public function maker(){
    	return $this->belongsTo(User::class,'employee_id');

    }

    public function Action_type(){
    	return $this->belongsTo(Action_type::class,'type_id');
    }
}
