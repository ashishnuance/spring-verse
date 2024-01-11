<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Industry;
use App\Models\MatchmakingModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserMeta;
use App\Models\MatchmakingprofilestatusModel;
// use App\Models\Auth\User\User;
use App\Models\User;

use App\Models\MatchmakingrecordsModels;
use DB;

// use App\Http\Controllers\Builder;
use Illuminate\Database\Query\Builder;
class MatchmakingProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $this->data['usermeta'] = UserMeta::where('user_id',$user_id)->first();
        return view('frontend.match-making.question-form', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $result =  $request->all(); 
        $result['member_id'] = $request->user()->id;
        unset($result['image']);
        // $result['image'] = (isset($result->images) && $result->images!='') ? $result->images : '';
        // echo '<pre>';print_r($result); exit();
        //unset($result['images']);
        
        $matchmaking_data = MatchmakingModel::updateOrCreate(['member_id'=>$result['member_id']],$result);
       if ($matchmaking_data) {
            return redirect()->route('match-making-profile')->with(['success' => 'Match Making Inserted Successfully']);
        } else {
            return redirect()->back()->with(['error' => "Something Went Wrong"]);
        }
        


        $matchmaking_data = MatchmakingModel::updateOrCreate(['member_id' => $result['member_id']], $result);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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

    public function update_status($id = 0, $status = 1)
    {

    }

    function profile_reject(Request $request,$profile_id=''){
        $result = MatchmakingprofilestatusModel::updateOrCreate(['profile_id'=>$profile_id,'user_id'=>$request->user()->id],['profile_id'=>$profile_id,'user_id'=>$request->user()->id,'status'=>2]);
        return redirect()->back();
        // if($result){
        //     // return response()->json(['status'=>true,'messsage'=>'Updated successfully']);
        // }else{
        //     return response()->json(['status'=>false,'messsage'=>'Something went wrong']);
        // }
    }

    public function questionCropImage(Request $request)
    {
        $user_id = $request->user()->id;
  
        $image = $request->image;
        $dirpath = 'uploads/profile/';
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name= time().'.png';
        
        $path = public_path($dirpath.$image_name);
        if(file_put_contents($path, $image)){
            // if(File::exists($imagePath)){
            //     unlink($imagePath);
            // }
            User::where(['id'=>$user_id])->update(['profile_image'=>$image_name]);
            // MatchmakingModel::where(['id'=>$request->id])->create(['image'=>$image_name]);

           
            return response()->json(['status'=>true,'image_url'=>url('/public/').'/'.$dirpath.$image_name,'image_name'=>$image_name]);
           
            // return response()->json(['status'=>true,'image_url'=>url('/public/').'/'.$dirpath.$image_name]);

        }else{
            return response()->json(['status'=>false]);
        }
    }

    public function match_profile(Request $request){
        $currect_date = date('Y-m-d');
        $user_id = $request->user()->id;
        $matchmaking_profile = MatchmakingModel::select(['member_id','first_name','last_name','city','brainstorm_with_peers','grow_your_team','start_a_company','business_development','invest','explore_new_projects','mentor_others','organize_events','raise_funding','find_a_cofounder','meet_interesting_people','explore_new_projects','explore_new_perspectives','find_a_job','entrepreneurship','sales','consulting','e_commerce','retail','real_estate','angel_investing','crypto','quant_finance','investment_banking','investing','travel','fitness','food','gaming','writing','reading','dinner_parties','poker','chess','cooking','wellness','parenting','ai','biohacking','machine_learning','product_design','programming_languages','vr_ar','product_management','robotics','fintech','data_science','life_sciences','visual_design','social_impact','diversity_and_inclusion','education','sustainability','volunteering','philanthropy','human_rights','photography','music','sports','film','entertainment','media','electronic_music','cinematography','fishing','skiing','fashion','running'])->with('user')->where('member_id',$user_id);
        // echo $user_id;
        if($matchmaking_profile->count()>0){
            
            $making_data = $matchmaking_profile->first()->toArray();
            // echo '<pre>';print_r($making_data); exit();
            $where = $sum_col = '';
            foreach($making_data as $key => $data_value){
                if(!in_array($key,['member_id','first_name','last_name','city','user'])){
                    if($data_value>0){
                        if($where!=''){
                            $where .=' or ';
                        }
                        if($sum_col!=''){
                            $sum_col .='+';
                        }
                        $sum_col .= $key; 
                        $where .= $key.'='.$data_value;
                        // echo $key.'='.$data_value;
                        // echo '<br>';
                    }
                }
            }
            $profile_result = $profile_id_status = [];
            
            $profile_status_result = MatchmakingprofilestatusModel::where('user_id',$user_id)->get('profile_id');
            foreach($profile_status_result as $pro_val){
                $profile_id_status[] = $pro_val->profile_id;
            }
            $profile_result=[];
            $profile_not_found_msg = '';
            $today_matching_records = MatchmakingrecordsModels::select(DB::raw('group_concat(match_id) as profile_ids'))->where(['user_id'=>$user_id,'date'=>$currect_date])->whereNotIn('match_id',$profile_id_status);
            
            if($today_matching_records->count()>0){
                //echo $today_matching_records->first()->profile_ids; exit();
                $where_profile_id_status = (isset($today_matching_records->first()->profile_ids) && $today_matching_records->first()->profile_ids!='') ? ' and sv_matchmaking.id in ('.$today_matching_records->first()->profile_ids.')' : '';
                
                $match_profile_sql = 'select sv_matchmaking.*,sv_users.username,sv_users.full_name,sv_users.profile_image,sum('.$sum_col.') as match_field_count from sv_matchmaking join sv_users on sv_matchmaking.member_id=sv_users.id where sv_matchmaking.member_id !='.$user_id.' and ('.$where.') '.$where_profile_id_status.' group by member_id order by match_field_count desc limit 3'; 
                
                // exit('if');
                $profile_result = DB::select($match_profile_sql);
                if(empty($profile_result)){
                    $profile_not_found_msg = 'You have checked all the profiles for today, Kindly visit tomorrow for more matching profiles';
                }
                
            }else{
                $where_profile_id_status = (isset($profile_id_status) && !empty($profile_id_status) ? ' and sv_matchmaking.id not in ('.implode(',',$profile_id_status).')' : '');
                
                $match_profile_sql_count = 'select sv_matchmaking.*,sv_users.username,sum('.$sum_col.') as match_field_count from sv_matchmaking join sv_users on sv_matchmaking.member_id=sv_users.id where sv_matchmaking.member_id !='.$user_id.' and ('.$where.') '.$where_profile_id_status.' group by member_id order by match_field_count desc';
                // exit();
                $profile_result_count = DB::select($match_profile_sql_count);
                
                if(MatchmakingrecordsModels::where(['date'=>$currect_date,'user_id'=>$user_id])->count()==0){;
                    
                    $match_profile_sql = 'select sv_matchmaking.*,sv_users.username,sum('.$sum_col.') as match_field_count from sv_matchmaking join sv_users on sv_matchmaking.member_id=sv_users.id where sv_matchmaking.member_id !='.$user_id.' and ('.$where.') '.$where_profile_id_status.' group by member_id order by match_field_count desc limit 3'; 
                    
                    
                    $profile_result = DB::select($match_profile_sql);
                    
                    if(!empty($profile_result)){
                        foreach($profile_result as $profile_val){
                            MatchmakingrecordsModels::updateOrCreate(['match_id'=>$profile_val->id,'user_id'=>$user_id],['date'=>$currect_date,'match_id'=>$profile_val->id,'user_id'=>$user_id]);
                        }
                    }
                }
                if(empty($profile_result)){
                    $profile_not_found_msg = 'You have checked all the profiles for today, Kindly visit tomorrow for more matching profiles';
                    
                }elseif(count($profile_result_count)==0){
                    $profile_not_found_msg = 'You have checked all the profiles, we will share more profiles with as soon as we have someone matching your set'; 
                }
                // today_matching_records
            }
            // echo '<pre>';print_r($profile_result); exit();
            // echo $where;
            // echo '<pre>';print_r($making_data);
            // exit();
            /*$match =  DB::table('matchmaking')
            ->select('id')
            ->where(function(Builder $builder) {
                $builder
                    ->where('city', 'Greater Los Angeles');
            })
            ->orWhere(function(Builder $builder) {
                $builder
                    ->where('brainstorm_with_peers', 1)
                    ->where('grow_your_team', 1)

                    ->where('start_a_company', 1)

                    ->where('business_development', 1)

                    ->where('invest', 1)

                    ->where('explore_new_projects', 1)

                    ->where('invest', 1)

                    ->where('organize_events', 1)
                    ->where('raise_funding', 1)

                    ->where('find_a_cofounder', 1)
                    ->where('meet_interesting_people', 1)
                    ->where('explore_new_perspectives', 1)
                    ->where('find_a_job', 1);
                
            })->toSql();

            echo"<pre>"; print_r($match); die;
            */
            return view("frontend.match-making.match-making-profile",compact('profile_result','profile_not_found_msg'));
        }else{
            return redirect()->route('match-making');
        }
    }
}
