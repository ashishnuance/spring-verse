<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    use HasFactory;
    protected $table="user_meta";
    protected $primaryKey="id";
    protected $fillable = ['first_name','last_name','user_id','website','address','country','city','home_location','state','postal_code','bio','term_condition','member_role','industry'];


    
    public function user()
    {
        return $this->belongsTo('User'); // links this->id to events.course_id
    }

    public function user_position(){
        return $this->hasOne('App\Models\Position','id','member_role');

    }
}
