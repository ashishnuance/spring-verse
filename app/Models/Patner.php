<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patner extends Model
{
    use HasFactory;
    protected $table="patners";
    protected $primaryKey="id";
    protected $fillable = ['company_name','contact_name','email','mobile','website','social_media','type','logo','description','trash','patner_location','status','created_at','updated_at'];
}
