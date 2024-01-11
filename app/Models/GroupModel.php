<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupModel extends Model
{
    use HasFactory;
    protected $table="groups";
    protected $primaryKey="id";
    protected $fillable = ['user_id','grp_name','description','tag','grp_profile','slug','firestore_grp_id'];


    function membercount(){
        return $this->hasMany('App\Models\ProfilegroupModel','group_id','id');
    }
   
    function users_admin(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function user_meta_admin(){
        return $this->hasOne('App\Models\UserMeta','user_id','user_id');

    }

  
}
