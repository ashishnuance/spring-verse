<?php


namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Foundation\Bus\DispatchesJobs;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\UserMeta;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RequestMember;
use App\Models\GroupModel;
use App\Models\ProfilegroupModel;

use Illuminate\Routing\Controller as BaseController;
use DB;

use Alert;



class Controller extends BaseController

{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $default_profile_image_path="frontend/images/profile-pic.png"; 
    public $profile_image_path ="uploads/profile";
    public $front_default_path = '/member1.png';
    
    public $data = [];
    function __construct(){
        
        $this->data['profile_image'] = (Auth::check()) ? asset($this->profile_image_path.'/'.Auth::user()) : asset($this->default_profile_image_path);
        $this->data['front_default_path'] = $this->front_default_path;
        return $this->data;

    }

    function allfriends(Request $request){
        $user_id = $request->user()->id;
        $user_friends = [];
        try {
            //echo "SELECT to_member as mmid FROM `sv_member_request` where user_id = $user_id and `status` = 1 UNION ALL (SELECT user_id as mmid FROM `sv_member_request` where to_member = $user_id and `status` = 1)"; exit();
            $all_friends = DB::select("SELECT to_member as mmid FROM `sv_member_request` where user_id = $user_id and `status` = 1 UNION ALL (SELECT user_id as mmid FROM `sv_member_request` where to_member = $user_id and `status` = 1)");
            // $all_friends = RequestMember::select('user_id','to_member','status')->distinct(DB::raw('greatest(user_id, to_member) as FirstColumn'))->where('status',1)->where(function($q) use ($user_id){
            //     return $q->where('user_id',$user_id)->orWhere('to_member',$user_id);
            // });
            // print_r($all_friends); exit();
            $user_friends['total_friends_count'] = count($all_friends);
            // $all_friends->orderBy('id', 'DESC');
            $select = ['id as mmid','full_name','profile_image','email','username','provider_id','social_login'];
            $result=[];
            if($user_friends['total_friends_count']>0){
                $result = $all_friends;
                $results=[];
                foreach($result as $fr_val){
                    $results[$fr_val->mmid] = $fr_val->mmid; 
                }
                $k=0;
                foreach($results as $fv){
                    $results1[$k]['mmid']=$fv;
                    $k++;
                }
                $results1 = json_decode(json_encode($results1));
                //echo '<pre>';print_r($results1); exit();
                foreach($results1 as $fr_val){
                    $mmid = $fr_val->mmid;//($user_id==$fr_val->to_member) ? $fr_val->user_id : $fr_val->to_member;
                    $fr_val->member_data = User::select($select)->where('id',$mmid)->first();
                }
            }else{
                $results1 = [];
            }
            // echo '<pre>';print_r($result); exit();
            $user_friends['all_records'] = $results1;
            return $user_friends;
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error',$e->getMessage());
        }
        
    }

    function getGroupMemberList(Request $request){
        $grp_list = $group_ids = $allgroup_ids =  [];
        $group_id = $allgroup_id ='';
        $user_id = $request->user()->id;
        try {

            $grp_member_list = GroupModel::select(['id','grp_name','grp_profile','slug','user_id','firestore_grp_id'])->where('user_id',$user_id)->where('trash',0);
            if($grp_member_list->count()>0){
                $grp_list = $grp_member_list->get()->toArray();
                foreach($grp_list as $ki => $grp_val){
                    $grp_list[$ki]['member_count'] = ProfilegroupModel::where(['group_id'=>$grp_val['id']])->count();
                    $allgroup_ids[] = $grp_val['id'];
                }
            }
            $grp_list2 = [];
            $group_mem_check = ProfilegroupModel::select(DB::raw('group_concat(group_id) as group_id'))->where('member_id',$user_id);
            if($group_mem_check->count()>0){
                $group_id = $group_mem_check->first()->group_id;
                
                $group_ids = ($group_id!='') ? explode(',',$group_id) : [];
                $grp_member_list2 = GroupModel::select(['id','grp_name','grp_profile','slug','user_id','firestore_grp_id'])->whereIn('id',$group_ids)->where('trash',0);
                if($grp_member_list2->count()>0){
                    $grp_list2 = $grp_member_list2->get()->toArray();
                    foreach($grp_list2 as $k => $grp_val){
                        $grp_list2[$k]['member_count'] = ProfilegroupModel::where(['group_id'=>$grp_val['id']])->count();
                        $allgroup_ids[] = $grp_val['id'];
                    }
                }
            }

            // all groups
            $grp_list = array_merge($grp_list,$grp_list2);
            return array('grp_list'=>$grp_list,'allgroup_ids'=>$allgroup_ids);
        } catch (\Throwable $th) {
            return false;
        }
    }

    function group_chat_list(Request $request){

        $user_id = Auth::user()->id;
        $to_member_id = [];
        if(isset($_GET['mmid']) && $_GET['mmid']!='' && $_GET['mmid']>0){
            $to_member_id = $_GET['mmid'];
         }

        $grp_chat_list =[];
        $grp_chat_list_resp = GroupModel::with('users_admin')->select(['id','grp_name', 'user_id','slug','grp_profile'])->where(['user_id'=> $user_id , 'slug'=>$to_member_id ]);
        
        if($grp_chat_list_resp->count()>0){
            $grp_chat_list =  $grp_chat_list_resp->first();
        }
        return array('grp_chat_list'=>$grp_chat_list);
     

    }
}