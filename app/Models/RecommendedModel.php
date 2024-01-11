<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserMeta;


class RecommendedModel extends Model
{
    use HasFactory;
    protected $table="recommended_users";
    protected $primaryKey="id";
    protected $fillable = ['user_id','to_member_id','from_member_id'];

    

    public function users_meta(){
        return $this->hasOne('App\Models\UserMeta','user_id','user_id');//->select('first_name','last_name','bio');
    }

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');//->select('full_name','profile_image');
    }

    public function users_meta_requestuser(){
        return $this->hasOne('App\Models\UserMeta','user_id','from_member_id');//->select(['id', 'first_name','last_name','bio']);
    }

    public function user_requestuser(){
        return $this->hasOne('App\Models\User','id','from_member_id');  //->select(['id', 'first_name','last_name','bio']);
    }
}
