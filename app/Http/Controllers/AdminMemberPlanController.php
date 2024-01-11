<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentsModel;
use App\Models\MemberShip;
use App\Models\User;
use App\Models\GroupModel;
use App\Models\ProfilegroupModel;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;




class AdminMemberPlanController extends Controller

{
    public function index()
    {
        $this->data['member_plan_list'] = PaymentsModel::all();
        $this->data['plan_name']= MemberShip::select('title')->get();

        $this->data['pagetitle'] = 'Member Plan';

        return view('pages.memberplan-list',$this->data);
    }
    public function group_list()
    {
        $profile_group_list = []; 

        //$this->data['profile_group_list'] = ProfilegroupModel::select('users.full_name','muser.full_name as group_member_name')->join('users','members_group.user_id','=','users.id')->join('users as muser','members_group.member_id','=','muser.id')->toSql();
        //print_r($this->data['profile_group_list']); exit();
        // $this->data['profile_group_list'] = ProfilegroupModel::select(DB::raw('group_concat(sv_members_group.member_id) as gmid'))->join('users','members_group.user_id','=','users.id')->join('users as muser','members_group.member_id','=','muser.id')->groupBy('group_member_name')->get();
        /**/

        $profile_group_list = [];
        $group_list = GroupModel::with('users_admin')->select(['id','grp_name as group_name','user_id','description','slug'])->where('trash',0);
        if($group_list->count()>0){
            // echo '<pre>';print_r($group_list->get()); exit();
            foreach($group_list->get() as $gk => $g_val){
                $profile_group_list[$gk] = $g_val;
                $profile_group_list[$gk]->full_name = $g_val->users_admin->full_name;
                
                $group_member_result = ProfilegroupModel::with('users')->where('group_id',$g_val->id);
                if($group_member_result->count()>0){
                    $group_member = [];
                    foreach($group_member_result->get() as $gm_val){
                        $group_member[] = $gm_val->users->full_name;
                    }
                    $profile_group_list[$gk]->group_member_name = implode(',',$group_member);
                }
                
            }
        }
        // echo '<pre>';print_r($profile_group_list); exit();
        $this->data['profile_group_list']=$profile_group_list;
        /**/
        // echo '<pre>'; print_r($this->data); die; 


         $this->data['pagetitle'] = 'Group List';
         
        return view('pages.group-list',$this->data);
    }
}
