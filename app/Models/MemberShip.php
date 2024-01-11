<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberShip extends Model
{
    use HasFactory;
    protected $table="membership";
    protected $primaryKey="id";
    protected $fillable = ['title','plan_period','main_price','offer_price','membership_type','description','additional_option','image','trash','status','created_at','updated_at'];

   
}

