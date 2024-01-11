<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomauthModel extends Model
{
    use HasFactory;
    protected $table="zoom_oauth";
    protected $primaryKey="id";
    protected $fillable = ['user_id','provider','provider_value'];
}
