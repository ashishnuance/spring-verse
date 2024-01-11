<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentsModel extends Model
{
    use HasFactory;
    protected $table="payments";
    protected $primaryKey="id";
    protected $fillable = ['member_id','billing_name','billing_email','billing_address','billing_country','billing_city','billing_state','billing_zipcode','plan_id','plan_price','paid_amount','discount_value','txn_id','payment_status','payment_json','card_type'];

    public function member(){
        return $this->hasOne('App\Models\MemberShip','id','plan_id');
    
    }
}
