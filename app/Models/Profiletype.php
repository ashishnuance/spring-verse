<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiletype extends Model
{
    use HasFactory;
    protected $table="profile_type";
    protected $primaryKey="id";
    protected $fillable = ['name'];
}