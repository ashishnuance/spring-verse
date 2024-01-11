<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchmakingrecordsModels extends Model
{
    use HasFactory;
    protected $table="matchmaking_records";
    protected $primaryKey="id";
    protected $fillable = ['match_id','user_id','date'];


}