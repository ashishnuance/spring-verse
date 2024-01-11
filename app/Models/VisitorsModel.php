<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class VisitorsModel extends Model
{
    use HasFactory;
    protected $table="visitors";
    protected $primaryKey="id";
    protected $fillable = ['user_id','member_id','date','created_at','updated_at'];


    public function visit()
    {
    return $this->hasOne('App\Models\User','id','user_id');
    }
}