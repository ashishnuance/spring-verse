<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchmakingprofilestatusModel extends Model
{
    use HasFactory;
    protected $table="matchmaking_profilestatus";
    protected $primaryKey="id";
    protected $fillable = ['user_id','profile_id','status'];


}