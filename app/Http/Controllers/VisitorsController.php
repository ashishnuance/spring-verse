<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RequestMember;
use App\Models\VisitorsModel;

use Illuminate\Support\Facades\Auth;

class VisitorsController extends Controller
{
   public function visitors(Request $request)
   {

      $user_id = $request->user()->id;
      $all_visitors =  VisitorsModel::with('visit')->where(['member_id'=>$user_id])->get();
    
    $this->data['visitors_list_count'] = count($all_visitors);
    
    if($all_visitors->count() > 0){
       foreach($all_visitors as $valu){
         $valu_user_id = $valu->user_id;
         $valu->member_request_status = RequestMember::where(function($q) use($user_id){
            return $q->where('user_id',$user_id)->orWhere('to_member',$user_id);
          })->where(function($q1) use($valu_user_id){
            return $q1->where('user_id',$valu_user_id)->orWhere('to_member',$valu_user_id);
          })->first();
         //  print_r($valu->member_request_status); exit();
         //  $valu->member_request_status = RequestMember::where(['user_id'=>$user_id,'to_member'=>$valu->user_id])->first();
         }
         // echo '<pre>'; print_r($all_visitors); die;
         // $this->data['member_request_status'] = $all_visitors; 
         $this->data['all_visitors_list'] = $all_visitors;

      }
    return view('frontend.visitors_list',$this->data);

   }
}