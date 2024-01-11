<?php

namespace App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $table="users_roles";
    protected $primaryKey="id";
    protected $fillable = ['user_id','role_id'];
}
