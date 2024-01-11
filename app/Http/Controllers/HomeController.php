<?php

namespace App\Http\Controllers;
use App\Models\Patner;
use App\Models\Position;
use App\Models\UserMeta;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RequestMember;

class HomeController extends Controller
{
    function landing_page(){
        if(Auth::check()){
            return redirect()->route('home'); 
        }else{ 
        return view('frontend.landing-page');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->data['patner'] = Patner::select('logo','company_name','patner_location','type')->where(['trash'=>0,'status'=>1])->get();

        $position = Position::select(['id','name'])->where(['status'=>1]);
        if($position->count()>0){
            $this->data['position_result']= $position->get();
        }

        $user_id = Auth::user()->id;
       
        $user_detail = [];

        
        
        /**
         * business and personal type profile
         */
       $user =  $businessdetail_total = User::with('get_user_role', 'user_meta')->whereHas('get_user_role', function($query) {
        $query->where('role_id', 2);})->where('id', '!=',$user_id)->where(['active_status'=>1])

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
        });

        
        $this->data['business_total_count'] = $businessdetail_total->count();
        $businessdetail = $businessdetail_total->limit(5)->orderBy('id', 'ASC')->get(); 

        if($businessdetail->count()>0){
            foreach($businessdetail as $valu){
                $valu->member_request_status = RequestMember::where(['user_id'=>$user_id,'to_member'=>$valu->id])->count();
            }
            $this->data['user_business_detail'] = $businessdetail; 
        }

        /**recent join member */

        // $this->data['recent_business_total_count'] = $businessdetail_total->count();

        $user_recent = User::with('get_user_role', 'user_meta')->whereHas('get_user_role', function($query) {
            $query->where('role_id', 2);})->where('id', '!=',$user_id)->where(['active_status'=>1]);

        $recent_businessdetail = $user_recent->limit(5)->orderBy('id', 'DESC')->get(); 
        // echo"<pre>"; print_r($recent_businessdetail); die;

        if($recent_businessdetail->count()>0){
            foreach($recent_businessdetail as $valu){
                $valu->member_request_status = RequestMember::where(['user_id'=>$user_id,'to_member'=>$valu->id])->count();
            }
            $this->data['recent_user_business_detail'] = $recent_businessdetail; 
        }

      
        $this->data['connected_members'] = RequestMember::where(['status'=>1])->where(function($q) use($user_id){
            return $q->where('user_id',$user_id)->orWhere('to_member',$user_id);
        })->count();

        
        // $this->data['recent_user_detail'] = $this->recent_join();
        // echo"<pre>"; print_r($this->data['recent_user_business_detail']); die;

        return view('frontend.homepage', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->to('login');
    }

    
    function termscondition(){
        return view('frontend.policy-pages.termscondition');
    }

    function testchat(){
        return view('frontend.messages.testchat');
    }

}
