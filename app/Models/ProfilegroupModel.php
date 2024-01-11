<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilegroupModel extends Model
{
    use HasFactory;
    protected $table="members_group";
    protected $primaryKey="id";
    protected $fillable = ['group_id','member_id','user_id'];



    function users(){
        return $this->hasOne('App\Models\User','id','member_id');
    }

    function groupusers(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
    public function groupuser_meta(){
        return $this->hasOne('App\Models\UserMeta','user_id','user_id');

    }

    function group_member(){
        return $this->hasMany('App\Models\User','id','mid');
    }

    
    function grp_users(){
        return $this->hasMany('App\Models\GroupModel','id','user_id');
    }
    
    public function user_meta(){
        return $this->hasOne('App\Models\UserMeta','user_id','member_id');

    }

    public function group_detail(){
        return $this->hasOne('App\Models\GroupModel','id','group_id');

    }
    function users_admin(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function user_meta_admin(){
        return $this->hasOne('App\Models\UserMeta','user_id','user_id');

    }
}
