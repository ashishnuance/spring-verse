<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GroupModel;
use App\Models\Position;
use App\Models\ProfilegroupModel;
use Illuminate\Support\Facades\Validator;
use DB;


use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $allgroup_list= [];
        $user_id = $request->user()->id;
        $grp_list = $this->getGroupMemberList($request);
        
        if(isset($grp_list['allgroup_ids']) && !empty($grp_list['allgroup_ids'])){
            $allgroup_list = GroupModel::select(['id','grp_name','grp_profile','slug','user_id','description'])->where('user_id','!=',$user_id)->where('trash',0)->whereNotIn('id',$grp_list['allgroup_ids'])->get();
        }
        $this->data['grp_member_count'] = $grp_list['grp_list'];
        $this->data['allgroup_list'] = $allgroup_list;
        return view('frontend.groups.group-list', $this->data);
    }

    public function create()
    {
        
        return view('frontend.groups.group');
    }

    public function store(Request $request) {
        
        // print_r($request->all()); exit();
        $validate = Validator::make($request->all(), [
            'grp_name' => 'required|unique:groups',
            'tag'=> 'required'
        ]);

        if ( $validate->fails() ) {
            $error_all = json_decode($validate->errors());
            $error_html = []; 
            foreach ($error_all as $error)
            {
                $error_html[] = $error[0];
            }
            
            // ->with('error', 'Something went wrong')->
            return response()->json(['error'=>$error_html, 'message'=>'The Group name has already been taken','status'=>200], 200);
            // return redirect()->back()->with('error',implode(', ',$error_html))->withInput();
        }

        if ($request->has('grp_profile')) {
            $validator = Validator::make(
                $request->file(),
                [
                    'grp_profile' => 'image|mimes:jpeg,png,jpg,PNG,JPEG,JPG',
                ],
                [
                    'grp_profile.mimes:jpeg,png,jpg,PNG,JPEG,JPG' => 'Image Must be in format of jpeg,png,jpg,PNG,JPEG,JPG'
                ]
            );
            if ($validator->fails()) {
            //   echo"<pre>";  print_r($validator->errors()); die;
                return response()->json(['error'=>$validator->errors(),'message'=>'The Group Profile must be a file of type: jpeg, png, jpg, PNG, JPEG, JPG','status'=>200], 200);
                // return redirect()->back()->withErrors($validator->errors());
            }
        }
        $user_slug = str_replace(' ','-',$request->grp_name);
        $userdata['slug'] = $user_slug;//preg_replace('/[^A-Za-z0-9\-]/', '', $user_slug);
        $userdata['grp_name'] = $request->grp_name;
        $userdata['description'] = $request->description;
        $userdata['tag'] = $request->tag;
        $userdata['user_id'] = $request->user()->id;
        $userdata['firestore_grp_id'] = 'groupchat@'.$request->user()->id.'@'.$user_slug;

        unset($userdata['_token']);
        unset($userdata['submit']);
       
        if ($request->hasFile('grp_profile')) {
            $grp_profile = $request->file('grp_profile');
            $name = rand(10000, 99999) . time() . '.' . $grp_profile->getClientOriginalExtension();
            $dirpath = 'uploads/group/';
            $path = public_path($dirpath);
            $grp_profile->move($path, $name);
            $userdata['grp_profile'] = $name;
            
        }
        
        $red = GroupModel::create($userdata);
        
        $user_name_chat = User::select('full_name','profile_image')->where(['id'=>$request->user()->id])->first();
        $user_name_chat['profile_image'] = (isset($user_name_chat['profile_image']) && $user_name_chat['profile_image']!='') ? url('public/uploads/profile/').'/'.$user_name_chat['profile_image'] : '';
        // echo"<pre>"; print_r($user_name_chat['profile_image']); die;
        
        if ($red) {
            $userdata['grp_profile'] = (isset($userdata['grp_profile']) && $userdata['grp_profile']!='') ? url('public/uploads/group/').'/'.$userdata['grp_profile'] : '';
            return response()->json(['message'=>'Group Created Successfully','data'=>$userdata,'user_name'=>$user_name_chat,'status'=>200, 'status_msg'=>'success'], 200);
            // return redirect()->route('group-list')->with('success', 'Group Created Successfully');
            
        } elseif(isset($userdata['grp_name']) && count($userdata['grp_name'])>0){
            

            return response()->json(['data'=>$userdata,'user_name'=>$user_name_chat,'message'=>'The Group name has already been taken','status'=>200],200);
      
        }
           
            return response()->json(['data'=>$userdata,'user_name'=>$user_name_chat, 'message'=>'success','status'=>200], 200);

            // return redirect()->back()->with('error', 'Something went wrong')->withinput();

 
    }


    public function group_detail(Request $request,$slug='')
    {
        $grp_detail = $group_member_list = $position_result = $grp_members_grpadmin = $grp_members_grpadmin_arr = [];
        $grp_member_count = 0;
        $user_id = $request->user()->id;
        if ($slug != '') {

            $grp_member_detail = GroupModel::select(['id','user_id','description','tag','grp_name','grp_profile','slug'])->where(['slug'=>$slug]);

            if($grp_member_detail->count()>0){

                $grp_detail = $grp_member_detail->first();


                $system_groups_members = ProfilegroupModel::with('users', 'user_meta')->where(['group_id'=>$grp_detail->id])->where(function($q) use($user_id){
                    $q->where('user_id',$user_id)->orWhere('member_id',$user_id);
                })->count();
                
                $grp_members = ProfilegroupModel::with('users', 'user_meta')->where(['group_id'=>$grp_detail->id]);
                $grp_members_grpadmin = GroupModel::with('users_admin','user_meta_admin')->where(['id'=>$grp_detail->id]);
                
                if($grp_members->count()>0){
                    $grp_member_count = $grp_members->count();
                    $group_member_list = $grp_members->get();
                    
                }
                $grp_members_grpadmin_arr = $grp_members_grpadmin->first();
                
                // echo"<pre>"; print_r($grp_members_grpadmin_arr); die;
            }else{
                return redirect()->route('group-list');
            }
            
            
            $position = Position::select(['id','name'])->where(['status'=>1]);
            if($position->count()>0){
                $position_result= $position->get();
            }     
            
        }else{
            return redirect()->route('group');
        }
        
        return view('frontend.groups.group-detail',compact('grp_detail','grp_member_count','group_member_list','position_result','grp_members_grpadmin_arr','system_groups_members'));
    }

    function group_delete($group_id=''){
        if($group_id!=''){
            $group = GroupModel::find($group_id);
            $group->trash = 1;
            $group->save();
            return redirect()->back()->with('success','Group Deleted');

        }
        return redirect()->back();
    }

    function group_edit($group_id=''){
        if($group_id!=''){
            $group_id = base64_decode($group_id);
            $group_response = GroupModel::find($group_id);
        }
        
        return view('frontend.groups.group',compact('group_response'));
    }

    function group_member_remove($member_id='',$group_id){
        if($member_id!='' && $group_id!=''){
            $member_id = base64_decode($member_id);
            $group_id = base64_decode($group_id);
            ProfilegroupModel::where(['member_id'=>$member_id,'group_id'=>$group_id])->delete();
            return redirect()->back()->with('success','Member removed successfully');
        }
        return redirect()->route('group');
    }
    
}