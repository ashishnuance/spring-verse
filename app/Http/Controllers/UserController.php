<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auth\User\User;
use App\Models\UserMeta;
use App\Models\Profiletype;
use App\Models\Industry;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {

    }

    private $member_select_col = ['id','full_name','email','phone','active_status','admin_approve'];

    public function usersList()
    {
        $userlist = [];
        $userlist = User::select($this->member_select_col)->with('roles')->whereHas('roles',function($q){
            $q->whereIn('role_id',[2,3]);
        });
        if(!empty($userlist) && $userlist->count()>0){
            $userlist = $userlist->get();
        }

        $extraurl=[];
        $extraurl['editlink'] = 'edit-user';
        $extraurl['deletelink'] = 'delete-user';
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users List"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        // return view('pages.page-users-list', 
        $table_header = ['S.No','name','email','phone','status','admin Approve','action'];
        return view('pages.list-page', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs,'resultlist'=>$userlist,'table_header'=>$table_header,'extraurl'=>$extraurl]);
    }
    public function usersView()
    {
        $breadcrumbs = [

            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users View"]];

        //Pageheader set true for breadcrumbs

        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.page-users-view', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);

    }
    public function user_view($id='')
    {
        
        $this->data['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Profile Type"], ['name' => "Profile Type Edit"]
        ];
       if ($id != '') {
        // $this->data['response'] = User::select([])->leftJoin('user_meta', 'user_meta.user_id', '=', 'users.id')
        // ->where(['users.id' => $id])
        // ->first()->toArray();
        $this->data['table_header'] = ['fullname','member id','email','username','profile image','phone','mobile','gender','profile purpose','dob'];

        $this->data['usr_list'] = User::select(['users.full_name','users.member_id','users.email','users.profile_image','users.phone','users.mobile','users.gender','users.profile_purpose','users.dob'])->where(['id'=> $id])->first()->toArray();

        $this->data['table_header1'] = ['userId','address','firstname','lastname','member role','industry','bio','hobbies','instagram','twitter','facebook','snapchat','linkedin','homelocation','country','city','state','postalcode','website','profiletype'];  
        
        $usr_meta_list=UserMeta::select(['user_meta.address','user_meta.industry','user_meta.bio','user_meta.hobbies','user_meta.instagram','user_meta.twitter','user_meta.facebook','user_meta.snapchat','user_meta.linkedin','user_meta.home_location','user_meta.country','user_meta.city','user_meta.state','user_meta.postal_code','user_meta.website','user_meta.profile_type'])->where(['user_id'=>$id]);  
        
        if(isset($usr_meta_list) && !empty($usr_meta_list) && $usr_meta_list->count() > 0){
            $this->data['usr_meta_list'] = $usr_meta_list->first()->toArray();

            if($this->data['usr_meta_list']['profile_type'] > 0){
                $this->data['usr_meta_list']['profile_type'] = Profiletype::select(['name'])->where('id',$this->data['usr_meta_list']['profile_type'])->first()->name;
            }
            
            if($this->data['usr_meta_list']['industry'] > 0){

            $this->data['usr_meta_list']['industry'] = Industry::select(['name'])->where('id',$this->data['usr_meta_list']['industry'])->first()->name;
            }
        }
        
     }
        return view('pages.user-view',$this->data);
    }

    public function usersEdit()

    {

        $breadcrumbs = [

            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users Edit"]];

        //Pageheader set true for breadcrumbs

        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.page-users-edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);

    }

    public function terms_condition(){
        
        
        return view('frontend.terms-condition');
    }

    /**
     * accept term condition by user and then redirect to personal detail page
     */
    public function terms_condition_accept(){
        $where['user_id'] = Auth()->user()->id;
        $postdata['term_condition'] = 1;
        
        UserMeta::updateOrCreate($where, $postdata); 
       

        return redirect()->route('personal-detail',[1]);
    }

    public function update_status($id = 0, $active_status = 1)
    {

        if ($id != 0 && $active_status != '') {
            $update = User::where(['id' => $id])->update(['active_status' => $active_status]);
            if ($update) {
                return redirect()->back()->with(['success' => 'Status Change Successfully']);
            } else {
                return redirect()->back()->with(['error' => "Something Went Wrong"]);
            }
        }
    }

    public function update_approve($id = 0, $admin_approve = 1)
    {

        if ($id != 0 && $admin_approve != '') {
            $update_approved = User::where(['id' => $id])->update(['admin_approve' => $admin_approve]);
            // echo"<pre>"; print_r($update_approved); die;

            if ($update_approved) {
                return redirect()->back()->with(['success' => 'Approved  Successfully']);
            } else {
                return redirect()->back()->with(['error' => "Something Went Wrong"]);
            }
        }
    }

}

