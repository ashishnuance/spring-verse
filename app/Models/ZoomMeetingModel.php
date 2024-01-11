<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomMeetingModel extends Model
{
    use HasFactory;
    protected $table="zoom_meeting";
    protected $primaryKey="id";
    protected $fillable = ['user_id','member_ids','date_time','topic','agenda','join_link','start_link','zoom_meeting_data'];

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');//->select('full_name','profile_image');
    }
}
