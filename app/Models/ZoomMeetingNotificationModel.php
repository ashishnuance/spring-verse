<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomMeetingNotificationModel extends Model
{
    use HasFactory;
    protected $table="zoom_meting_notification";
    protected $primaryKey="id";
    protected $fillable = ['user_id','member_id','join_url','read_status'];


    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');//->select('full_name','profile_image');
    }

    public function user_request_touser(){
        return $this->hasOne('App\Models\User','id','member_id');  //->select(['id', 'first_name','last_name','bio']);
    }
}
