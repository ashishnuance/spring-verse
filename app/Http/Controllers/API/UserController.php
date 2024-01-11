<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth\User\User;


class UserController extends Controller
{
    public function companylist(Request $request){
        
        $where = [];
        $whererole = 2;
        $searchfield = ['name','email','phone'];

        $company_sql = User::select(['id','name','email','phone','latitude','longitude','location','commercial_registration','nation_id','about_me'])->where($where)->whereHas('roles',function($q)use($whererole){
                $q->whereIn('role_id',[$whererole]);            
        });

        /*if(!empty($request->getContent())){
            $requestPost = json_decode($request->getContent()); 
            if(isset($requestPost->searchkeyword) && $requestPost->searchkeyword!=''){
                // where(function ($query) use ($a,$b) {
                //     $query->where('a', '=', $a)
                //           ->orWhere('b', '=', $b);
                // })
                // foreach($searchfield as $searchcol){
                    $company_sql->where(function($likequery) use ($requestPost->searchkeyword){
                        $likequery->where('name','like','%'.$requestPost->searchkeyword.'%')
                        ->orWhere('email','like','%'.$requestPost->searchkeyword.'%');
                    });//,'like','%'.$requestPost->searchkeyword.'%');
                // }
            }

            if(isset($requestPost->location) && $requestPost->location!=''){
                
                $company_sql->where('location','like','%'.$requestPost->location.'%');
            }
        }*/
        //echo $company_sql->toSql();exit();
        
        if($company_sql->count()>0){        
            return response()->json(['status'=>200,'message'=>'Found Successfully','data'=>$company_sql->get()],200);
        }else{
            return response()->json(['status'=>404,'message'=>'No Result Found'],404);
        }
    }
}
