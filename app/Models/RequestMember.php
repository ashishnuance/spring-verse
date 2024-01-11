<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class RequestMember extends Model
{
    use HasFactory;
    protected $table="member_request";
    protected $primaryKey="id";
    protected $fillable = ['user_id','from_member','to_member','accept','reject','created_at','updated_at'];


    public function users_meta(){
        return $this->hasOne('App\Models\UserMeta','user_id','user_id');  //->select(['id', 'first_name','last_name','bio']);
    }

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');  //->select(['id', 'first_name','last_name','bio']);
    }

    public function users_meta_requestuser(){
        return $this->hasOne('App\Models\UserMeta','user_id','to_member');//->select(['id', 'first_name','last_name','bio']);
    }

    public function user_requestuser(){
        return $this->hasOne('App\Models\User','id','to_member');  //->select(['id', 'first_name','last_name','bio']);
    }
}
