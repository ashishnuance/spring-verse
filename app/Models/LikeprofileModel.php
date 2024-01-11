<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeprofileModel extends Model
{
    use HasFactory;
    protected $table="like_profile";
    protected $primaryKey="id";
    protected $fillable = ['user_id','member_id'];

    public function likes()
    {
    return $this->belongsToMany('App\Models\LikeprofileModel', 'user_id','id');
    }

   
}
