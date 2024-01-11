<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\MemberShip;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\UserMeta;
use App\Models\User;
use App\Models\Position;
use App\Models\Industry;
use App\Models\RequestMember;
use App\Models\PaymentsModel;
use App\Models\LikeprofileModel;
use App\Models\RecommendedModel;
use DB;

use Illuminate\Support\Facades\Validator;

class MembershipController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $this->data['membership_list'] = MemberShip::select('id','title','plan_period','main_price','offer_price','membership_type','description','additional_option','image','status','created_at')->get();
        $this->data['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "MemberShip"], ['name' => "MemberShip List"]
        ];
        //Pageheader set true for breadcrumbs
        $this->data['pageConfigs'] = ['pageHeader' => true, 'isFabButton' => true];
        $this->data['pagetitle'] = 'MemberShip List';


        return view('pages.membership-list', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "MemberShip"], ['name' => "MemberShip Create"]
        ];
        //Pageheader set true for breadcrumbs
        $this->data['pageConfigs'] = ['pageHeader' => true, 'isFabButton' => true];
        $this->data['pagetitle'] = "MemberShip Create";
        return view('pages.membership', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($request->all())) {
  
           
            
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                    'main_price' =>'required',                   
                    'offer_price' => 'required',
                    'description' => 'required',

                ],
                
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors());
            }

            if ($request->has('image')) {
                $validator = Validator::make(
                    $request->file(),
                    [
                        'image' => 'image|mimes:jpeg,png,jpg,PNG,JPEG,JPG',
                    ],
                    [
                        'image.mimes:jpeg,png,jpg,PNG,JPEG,JPG' => 'Image Must be in format of jpeg,png,jpg,PNG,JPEG,JPG'
                    ]
                );
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator->errors());
                }
            }

            $postdata = $request->all();
            unset($postdata['_token']);
            unset($postdata['submit']);
           
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = rand(10000, 99999) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = base_path() . '/assets/membership/';
                $image->move($destinationPath, $name);
                $postdata['image'] = $name;
              
            }
            $red = MemberShip::create($postdata);

            if ($red) {
                return redirect()->intended(route('membership-type.index'))->withFlashSuccess('Membership Created Successfully!');

            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // echo($id); die;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id != '') {

            $membershiptype = MemberShip::where(['id' => $id]);

            if ($membershiptype->count() > 0) {
                $this->data['response'] = $membershiptype->first();

            }
         
            $this->data['breadcrumbs'] = [
                ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "MemberShip Type"], ['name' => "MemberShip  Edit"]
            ];
            //Pageheader set true for breadcrumbs
            $this->data['pageConfigs'] = ['pageHeader' => true, 'isFabButton' => true];
            $this->data['pagetitle'] = "MemberShip  Edit";
        }
        return view('pages.membership', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!empty($request->all())) {

           
            $updatedata = $request->all();
            unset($updatedata["_token"]);
            unset($updatedata['submit']);
            unset($updatedata['_method']);

            unset($updatedata['id']);


            // if (!isset($updatedata['image']) && !isset($updatedata['old_img'])) {

            //     return redirect()->back()->withErrors(['image' => 'Image is required']);
            // } elseif (!isset($updatedata['image']) && $updatedata['old_img'] != '') {

            //     $updatedata['image'] = $updatedata['old_img'];
            // }

            // unset($updatedata['old_img']);
      
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = rand(10000, 99999) . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = base_path() . '/assets/membership/';
                $image->move($destinationPath, $name);
                $updatedata['image'] = $name;
              
            }
   
            $res = MemberShip::where(['id' => $request->input('id')])->update($updatedata);

            if ($res) {

                return redirect()->intended(route('membership-type.index'))->withFlashSuccess('MemberShip Updated Successfully!');
            } else {

                return redirect()->intended(route('membership-type.index'))->with('error', 'MemberShip Not Updated');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id= 0)
    {
       
        if ($id != 0) {

            $trash_update = MemberShip::where(['id' => $id])->update(['trash' => 1]);
            // echo"<pre>"; print_r($trash_update); die;
            // $trash_update['submit'];
            if ($trash_update) {
                return redirect()->back()->with(['success' => 'Data Delete Successfully']);
            } else {
                return redirect()->back()->with(['error' => "Something Went Wrong"]);
            }
        }
    }

    public function update_status($id = 0, $status = 1)
    {

        if ($id != 0 && $status != '') {
            $update = MemberShip::where(['id' => $id])->update(['status' => $status]);
            // echo"<pre>"; print_r($update); die;
            if ($update) {
                return redirect()->back()->with(['success' => 'Status Change Successfully']);
            } else {
                return redirect()->back()->with(['error' => "Something Went Wrong"]);
            }
        }
    }

    public function delete_membership($id = 0)
    {

        if ($id != 0) {

            $trash_update = MemberShip::where(['id' => $id])->update(['trash' => 1]);
            // echo"<pre>"; print_r($trash_update); die;
            // $trash_update['submit'];
            if ($trash_update) {
                return redirect()->back()->with(['success' => 'Data Delete Successfully']);
            } else {
                return redirect()->back()->with(['error' => "Something Went Wrong"]);
            }
        }
    }

    public function index_front()
    {
    
        $this->data['membership'] = MemberShip::select('id','plan_period','title','main_price','membership_type','description','additional_option')->where(['status'=>1,'trash'=>0])->get();


        // $notification_list = Requestmember::with('users_meta','user')->where(['to_member'=>$request->user()->id, 'user_id'=>$user_detail->id ])->first();
      

        $user_id = Auth::user()->id;
        $user_billing_list =[];
        
        $user_plan = PaymentsModel::with('member')->select(['id','member_id','billing_name','plan_id','plan_price','created_at','updated_at'])->where(['member_id'=>$user_id ])->orderBy('updated_at','Desc');




        if($user_plan->count()>0){
            $this->data ['user_plan_list'] =  $user_plan->first();
        }
        // echo"<pre>"; print_r($this->data ['user_plan_list']); die;

        return view('frontend.membership', $this->data);
    }

    public function all_members(Request $request)
    {
        
        /**
         * 
         */
        $position = Position::select(['id','name'])->where(['status'=>1]);
        if($position->count()>0){
            $this->data['position_result']= $position->get();
        }

        /**
         * 
         */
        $industry = Industry::select(['id','name'])->where(['status'=>1]);
        if($industry->count()>0){
        $this->data['industry_result'] = $industry->get();
        }



        $user_id = Auth::user()->id;
        $user_detail = $personal_user =[];

        /**
         * business and personal type profile
         */
        $businessdetail_total = User::with('get_user_role', 'user_meta')->whereHas('get_user_role', function($query) {
            $query->where('role_id', 2);})->where('id', '!=',$user_id)->where(['active_status'=>1])->whereIn('profile_purpose',[1])
            ->when($request->query('ind_id'), function ($query, $ind_id) {
            $query->whereHas('user_meta', function ($query) use ($ind_id) {
            $query->where('user_meta.industry', $ind_id);
            });
        })
        ->when($request->query('role_id'), function ($query, $role_id) {
            $query->whereHas('user_meta', function ($query) use ($role_id) {
            $query->where('user_meta.member_role', $role_id);
            });
        })
        ->when($request->has("keyword"), function ($q) use ($request) {
            return $q->where("full_name", "like", "%" . $request->get("keyword") . "%");
        })
        ->when($request->query('location'), function ($query, $location) {
            $query->whereHas('user_meta', function ($query) use ($location) {
                $query->where('user_meta.home_location', $location)->orWhere("user_meta.city", "like", "%" . $location . "%")
                ->orWhere("user_meta.country", "like", "%" . $location . "%")
                ->orWhere("user_meta.state", "like", "%" . $location . "%")->orWhere("user_meta.address", "like", "%" . $location . "%");
            });
        })

        ->when($request->query('hobbies'), function ($query, $hobbies) {
            $query->whereHas('user_meta', function ($query) use ($hobbies) {
                $query->whereRaw('FIND_IN_SET("'.$hobbies.'", hobbies)');
                // $query->where('user_meta.hobbies', $hobbies);
            });

            // ->when($request->query('interest'), function ($query, $interest) {
            //     $query->whereHas('user_meta', function ($query) use ($interest) {
            //         $query->where('user_meta.hobbies', $interest);
            //     });

        });

        // echo"<pre>";  print_r($businessdetail_total->toSql());die;
        
        $this->data['business_total_count'] = $businessdetail_total->count();
        $hobbies_sec='';
        $hobbies = UserMeta::select('id', 'hobbies')->where(['status'=>1]);

        
        if($hobbies->count()>0){
        $hobbies_int = $hobbies->get();
        }

        
        foreach($hobbies_int as $key=> $val_hobby){
            
            $hobbies_sec .= ','.$val_hobby->hobbies;//(isset($val_hobby->user_meta->hobbies) && $val_hobby->user_meta->hobbies!='') ? explode(',',$val_hobby->user_meta->hobbies) : array();
        }
        // echo"<pre>";  print_r($hobbies_sec);die;
        $this->data['my_hobbies'] =  array_unique(array_filter(explode(',', $hobbies_sec)));
        
        $businessdetail = $businessdetail_total->limit(5)->orderBy('id', 'DESC')->get(); 


        if($businessdetail->count()>0){
            foreach($businessdetail as $valu){
                // echo auth()->user()->id;print_r($valu);exit();
                $member_request_status = RequestMember::where(['user_id'=>$user_id,'to_member'=>$valu->id]);
                $valu->member_request_status = $member_request_status->count();
                if($member_request_status->count()>0){
                $valu->member_requestdata = $member_request_status->first();
                }
                
                $member_req_pending = RequestMember::where(['to_member'=>$user_id,'user_id'=>$valu->id]);
                $valu->member_req_pending = $member_req_pending->count();
                if($member_req_pending->count()>0){
                    $valu->member_req_pending_data = $member_req_pending->first(); 
                }

                $member_friendslist = RequestMember::select(DB::raw('group_concat(user_id) as uids'),DB::raw('group_concat(to_member) as mids'))->where(['status'=>1])
                ->where(['status'=>1])->where(
                    function($wh) use ($user_id){
                    return $wh->where('to_member',$user_id)->orWhere('user_id',$user_id);
                  });
                //   ->where('to_member',$user_id)->orWhere('user_id',$user_id);
                
                $valu->member_friendslist = $member_friendslist->count();
                if($member_friendslist->count()>0){
                    $valu->member_friendslist = $member_friendslist->first(); 
                }
                $valu->like_status = LikeprofileModel::where(['user_id'=>$user_id,'member_id'=>$valu->id])->count();
            }
            //echo '<pre>';print_r($businessdetail);
            $this->data['user_business_detail'] = $businessdetail; 
        }

        /**
         * personal profile
         */

        $personaldetail_total = User::with('get_user_role', 'user_meta')->whereHas('get_user_role', function($query) {
        $query->where('role_id', 2);})->where('id', '!=',$user_id)->where(['active_status'=>1])->whereIn('profile_purpose',[2])
        ->when($request->query('ind_id'), function ($query, $ind_id) {
            $query->whereHas('user_meta', function ($query) use ($ind_id) {
            $query->where('user_meta.industry', $ind_id);
            });
        })
        ->when($request->query('role_id'), function ($query, $role_id) {
            $query->whereHas('user_meta', function ($query) use ($role_id) {
            $query->where('user_meta.member_role', $role_id);
            });
        })
        ->when($request->has("keyword"), function ($q) use ($request) {
            return $q->where("full_name", "like", "%" . $request->get("keyword") . "%");
        })->when($request->query('location'), function ($query, $location) {
            $query->whereHas('user_meta', function ($query) use ($location) {
                $query->where("user_meta.country", "like", "%" . $location . "%")->orWhere("user_meta.city", "like", "%" . $location . "%")
                ->orWhere("user_meta.country", "like", "%" . $location . "%")
                ->orWhere("user_meta.state", "like", "%" . $location . "%")->orWhere("user_meta.address", "like", "%" . $location . "%");
            });
        }) ->when($request->query('hobbies'), function ($query, $hobbies) {
                $query->whereHas('user_meta', function ($query) use ($hobbies) {
                $query->whereRaw('FIND_IN_SET("'.$hobbies.'", hobbies)');
                // $query->where('user_meta.hobbies', $hobbies);
            });
        
        // ->when($request->query('interest'), function ($query, $interest) {
        //     $query->whereHas('user_meta', function ($query) use ($interest) {
        //         $query->where('user_meta.hobbies',"like", "%" . $interest. "%");
        //     });
        });
        $this->data['pesonal_total_count'] = $personaldetail_total->count();
        
            $personaldetail = $personaldetail_total->limit(5)->orderBy('id', 'DESC')->get(); 
        
        if($personaldetail->count()>0){
            foreach($personaldetail as $valu){
                $member_request_status = RequestMember::where(['user_id'=>$user_id,'to_member'=>$valu->id]);
                $valu->member_request_status = $member_request_status->count();
                if($member_request_status->count()>0){
                $valu->member_requestdata = $member_request_status->first();
                }
                
                $member_req_pending = RequestMember::where(['to_member'=>$user_id,'user_id'=>$valu->id]);
                $valu->member_req_pending = $member_req_pending->count();
                if($member_req_pending->count()>0){
                    $valu->member_req_pending_data = $member_req_pending->first(); 
                }

                $member_friendslist = RequestMember::select(DB::raw('group_concat(user_id) as uids'),DB::raw('group_concat(to_member) as mids'))->where(['status'=>1])
                ->where(['status'=>1])->where(
                    function($wh) use ($user_id){
                    return $wh->where('to_member',$user_id)->orWhere('user_id',$user_id);
                  });
                //   ->where('to_member',$user_id)->orWhere('user_id',$user_id);
                
                $valu->member_friendslist = $member_friendslist->count();
                if($member_friendslist->count()>0){
                    $valu->member_friendslist = $member_friendslist->first(); 
                }
                //$valu->member_request_status = RequestMember::where(['user_id'=>$user_id,'to_member'=>$valu->id])->count();
                $valu->like_status = LikeprofileModel::where(['user_id'=>$user_id,'member_id'=>$valu->id])->count();
            }
            $this->data['user_personal_detail'] = $personaldetail; 
            $this->data['user_personal_nextcount'] = 5;//$request['limit']+$user_personal_detail->count();
        }
        
        $this->data['total_user_count'] =  $this->data['business_total_count']+$this->data['pesonal_total_count'];

    //     $mydetail = $request->user()->getusermeta();
    //   echo"<pre>";  print_r($businessdetail_total->get()); exit();

        // $myhobbies = (isset($businessdetail_total->hobbies) && $businessdetail_total->hobbies!='') ? explode(',',$businessdetail_total->hobbies) : array();
        // $this->data['myhobbies']=$myhobbies;

        
        return view('frontend.all-members',$this->data);
    }


    function loadmore_business(Request $request){

        $user_id = Auth::user()->id;
        $user_detail = $personal_user =[];
        $personaldetail_total = User::with('get_user_role', 'user_meta')->whereHas('get_user_role', function($query) {
        $query->where('role_id', 2);})->where('id', '!=',$user_id)->where(['active_status'=>1])->whereIn('profile_purpose',[1])
        ->when($request->query('ind_id'), function ($query, $ind_id) {
            $query->whereHas('user_meta', function ($query) use ($ind_id) {
            $query->where('user_meta.industry', $ind_id);
            });
        })
        ->when($request->query('role_id'), function ($query, $role_id) {
            $query->whereHas('user_meta', function ($query) use ($role_id) {
            $query->where('user_meta.member_role', $role_id);
            });
        });
        $this->data['pesonal_total_count'] = $personaldetail_total->count();
        if($request->ajax()){
            
            $user_business_detail = $personaldetail_total->offset($request['limit'])->limit(5)->orderBy('id', 'DESC'); 
            $this->data['user_personal_nextcount'] = ($request['limit']+count($user_business_detail->get()));
            $this->data['user_business_detail'] = $user_business_detail->get();
            foreach($this->data['user_business_detail'] as $valu){
                $valu->member_request_status = RequestMember::where(['user_id'=>$user_id,'to_member'=>$valu->id])->count();
            }
        }
        $loadmore_btn = true;
        if($this->data['user_personal_nextcount'] >= $this->data['pesonal_total_count']){
        $loadmore_btn = false;
        }
        // print_r($this->data); exit();
        $return = view('frontend.includes.members-list',$this->data)->render();
        return response()->json(['data'=>$return,'limit_value'=>$this->data['user_personal_nextcount'],'loadmore_btn'=>$loadmore_btn,'tt'=>[$this->data['user_personal_nextcount'],$this->data['pesonal_total_count']]]);
     

    }

    function loadmore_personal(Request $request){
        $user_id = Auth::user()->id;
        $user_detail = $personal_user =[];
        $personaldetail_total = User::with('get_user_role', 'user_meta')->whereHas('get_user_role', function($query) {
        $query->where('role_id', 2);})->where('id', '!=',$user_id)->where(['active_status'=>1])->whereIn('profile_purpose',[2])
        ->when($request->query('ind_id'), function ($query, $ind_id) {
            $query->whereHas('user_meta', function ($query) use ($ind_id) {
            $query->where('user_meta.industry', $ind_id);
            });
        })
        ->when($request->query('role_id'), function ($query, $role_id) {
            $query->whereHas('user_meta', function ($query) use ($role_id) {
            $query->where('user_meta.member_role', $role_id);
            });
        });
        $this->data['pesonal_total_count'] = $personaldetail_total->count();
        if($request->ajax()){
            
            $user_personal_detail = $personaldetail_total->offset($request['limit'])->limit(5)->orderBy('id', 'DESC'); 
            $this->data['user_personal_nextcount'] = ($request['limit']+count($user_personal_detail->get()));
            $this->data['user_personal_detail'] = $user_personal_detail->get();
            foreach($this->data['user_personal_detail'] as $valu){
                $valu->member_request_status = RequestMember::where(['user_id'=>$user_id,'to_member'=>$valu->id])->count();
            }
        }
        $loadmore_btn = true;
        if($this->data['user_personal_nextcount'] >= $this->data['pesonal_total_count']){
        $loadmore_btn = false;
        }
        // print_r($this->data); exit();
        $return = view('frontend.includes.personal-member-list',$this->data)->render();
        return response()->json(['data'=>$return,'limit_value'=>$this->data['user_personal_nextcount'],'loadmore_btn'=>$loadmore_btn,'tt'=>[$this->data['user_personal_nextcount'],$this->data['pesonal_total_count']]]);
     
    }

    function get_request_members_list(Request $request){

        $user_id = Auth::user()->id;
        $user_list =[];
        $user_list_resp = User::with('get_user_role')->select(['id','full_name'])->where('full_name','like','%'.$request->q.'%')->where('id','!=',$user_id)->whereHas('get_user_role', function($query) {
            $query->where('role_id', 2);})->orderBy('full_name','asc')->limit(10);
        
        if($user_list_resp->count()>0){
            $user_list =  $user_list_resp->get();
        }
        return response()->json(['items'=>$user_list]);
     

    }

    
    
}   
