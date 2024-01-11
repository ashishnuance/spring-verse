<?php

namespace App\Http\Controllers;
use App\Models\Patner;
use App\Models\Position;
use App\Models\UserMeta;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\RequestMember;
use App\Models\ZoomauthModel;
use App\Models\ZoomMeetingModel;
use App\Models\ZoomMeetingNotificationModel;
use App\Traits\ZoommeetingTraits;
use App\Models\MatchmakingprofilestatusModel;
use App\Models\MatchmakingrecordsModels;
use stdClass;

class ZoomController extends Controller
{

    use ZoommeetingTraits;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    /**
     * generate sdk token
     */
    function generatesdk(){
        echo base64_encode('_M99tdNTISKkAKWfmob9Q: axpCnhX5ZsBbzCoaOf8SoJZXxDkMjY2A');
        $key = "PKdJZD4EBd9E7XlcXEn8zRA14Vcb0dnf6APT";
        $str = "PLCJPO2a4cJFoAKcb1PPIIp4EHs3AXLhdWGk";

        function encode($data) {
            return str_replace(['+', '/'], ['-', '_'], base64_encode($data));
        }

        function decode($data) {
            return base64_decode(str_replace(['-', '_'], ['+', '/'], $data));
        }

        $binaryKey = decode($key);

        var_dump(encode(hash_hmac("sha256", $str, $binaryKey, true)));
        /*
        $header = new \stdClass;
        $header->alg = "HS256";
        $header->typ = "JWT";
        
        $payload = new \stdClass;
        // $payload = {
        $payload->app_key = 'PKdJZD4EBd9E7XlcXEn8zRA14Vcb0dnf6APT';
        $payload->tpc = 'meeting';
        $payload->version = 1;
        $payload->role_type = 1;
        $payload->user_identity = 'PKdJZD4EBd9E7XlcXEn8zRA14Vcb0dnf6APT';
        $payload->session_key = 'SESSION_KEY';
        $payload->geo_regions = "US,AU,CA,IN,CN,BR,MX,HK,SG,JP,DE,NL";
        $payload->iat = 1646937553;
        $payload->exp = 1646944753;
        $payload->pwd = 12345;
        //   };
        HMACSHA256(
            base64UrlEncode($header) + '.' + base64UrlEncode($payload),
            'PLCJPO2a4cJFoAKcb1PPIIp4EHs3AXLhdWGk'
        );*/
    }


    /**
     * zoom api
     */
    function zoomauthtoken_generate(Request $request){
        
        $client_id      = env('ZOOM_CLIENT_ID');
        $client_secret  = env('ZOOM_SECRET_KEY');
        $account_id   = env('ACCOUNT_ID');
        
        $code = $request->code;
        // $code = 'PKdJZD4EBd9E7XlcXEn8zRA14Vcb0dnf6APT';
        // $zoom = new \MacsiDigital\Zoom\Support\Entry($apiKey, $apiSecret, $tokenLife, $maxQueries, $baseUrl);
        // print_r($zoom); exit();
        
        // echo base64_encode($client_id.':'.$client_secret);
        // $response = Http::withHeaders([
        //     'Authorization' => "Basic ". base64_encode($client_id.':'.$client_secret),
        //     'Content-Type'  => "application/x-www-form-urlencoded"
        // ])->post('https://zoom.us/oauth/token?grant_type=account_credentials&code='.$code);
        
        $response = Http::withHeaders([
            'Authorization' => "Basic ". base64_encode($client_id.':'.$client_secret),
            'Content-Type'  => "application/x-www-form-urlencoded"
        ])->post('https://zoom.us/oauth/token?grant_type=account_credentials&account_id='.$account_id);
        $token = $response->getBody()->getContents();
        $resp = json_decode($response->getBody()->getContents());
        $token_val = json_decode($token); 
        // print_r($token_val); exit();
        if(isset($token_val->access_token) && $token_val->access_token!=''){
            $rp = $this->insertOrUpdateToken($request,$token);
            return true;
        }else{
            return false;
        }
    }

    // function generate_token(){
    //     env('ZOOM_API_KEY');
    //     env('ZOOM_API_SECRET');
    //     return redirect("https://zoom.us/oauth/authorize?response_type=code&client_id=".env('ZOOM_API_KEY')."&redirect_uri=".env('ZOOM_REDIRECT_URI'));
    // }

    

    // public function testrequest(Request $request){
    //     print_r($this->insertOrUpdateToken($request)); exit();
    // }


    /**
     * create or update token
     */
    private function insertOrUpdateToken(Request $request,$token=''){
        $user_id = $request->user()->id;
        
        $checkauth_token = ZoomauthModel::where('user_id',$user_id)->where('provider','zoom');
        
        if($checkauth_token->count()>0){
            ZoomauthModel::where(['user_id'=>$user_id,'provider'=>'zoom'])->update(['provider_value'=>$token]);
        }else{
            ZoomauthModel::create(['user_id'=>$user_id,'provider'=>'zoom','provider_value'=>$token]);
        }
        return true;
    }

    function getmeetings(Request $request){
        
        $path = 'users/me/meetings';
        $user_id = $request->user()->id;
        //print_r($this->zoomRequest());
        $jwt = ZoomauthModel::where('user_id',$user_id)->first();
        $token = json_decode($jwt->provider_value);
        // echo $token->access_token;
        $response = $this->zoomGet($path,[],$token->access_token);
        
        $data = json_decode($response->body(), true);
        

        return [
            'success' => $response->ok(),
            'data' => $data,
        ];
    
    }

    function meet(){
        return view('frontend.zoom-meeting');
    }

    public function createmeeting(Request $request) {
        $this->zoomauthtoken_generate($request);
        // print_r($request->all()); exit();
        $path = 'users/me/meetings';
        $user_id = $request->user()->id;
        if($request->profile_id!=''){
            MatchmakingprofilestatusModel::updateOrCreate(['profile_id'=>$request->profile_id,'user_id'=>$request->user()->id],['profile_id'=>$request->profile_id,'user_id'=>$request->user()->id,'status'=>1]);
        }
        $jwt = ZoomauthModel::where('user_id',$user_id)->first();
        $token = json_decode($jwt->provider_value);
        $data["topic"] = $request->topicname;//"test topic";
        $data["agenda"] = $request->agendaname;//"test agenda";
        $data["start_time"] = $request->meeting_start_time;//"2020-07-31T13:00:00";
        
        // $validator = Validator::make($request->all(), [
        //     'topic' => 'required|string',
        //     'start_time' => 'required|date',
        //     'agenda' => 'string|nullable',
        // ]);
        
        // if ($validator->fails()) {
        //     return [
        //         'success' => false,
        //         'data' => $validator->errors(),
        //     ];
        // }
        // $data = $validator->validated();

        $path = 'users/me/meetings';
        $response = $this->zoomPost($path, [
            'topic' => $data['topic'],
            'type' => self::MEETING_TYPE_SCHEDULE,
            'start_time' => date('Y-m-d\TH:i:s',strtotime($data['start_time'])),
            'duration' => $request->duration,
            'timezone' =>"Asia/Kolkata",
            'agenda' => $data['agenda'],
            'settings' => [
                'host_video' => false,
                'participant_video' => false,
                'waiting_room' => true,
            ]
        ],$token->access_token);
        $insertdata['zoom_meeting_data'] = $response->body();
        $response_body = json_decode($response->body());
        $insertdata['user_id'] = $user_id;
        $insertdata['topic'] = $data['topic'];
        $insertdata['agenda'] = $data['agenda'];
        $insertdata['join_link'] = $response_body->join_url;
        $insertdata['start_link'] = $response_body->start_url;
        $insertdata['date_time'] = date('Y-m-d H:i:s',strtotime($data['start_time']));
        $insertdata['member_ids'] = implode(',',$request->member_inv);
        if(isset($insertdata) && $insertdata!=''){
        ZoomMeetingModel::create($insertdata);
        }
        $zoom_noti = [];
        for($m=0;$m<count($request->member_inv);$m++){
            // $zoom_noti[]=['user_id' => $user_id,'member_id'=>$request->member_inv[$m],'join_url'=>$response_body->join_url];
            ZoomMeetingNotificationModel::create(['user_id' => $user_id,'member_id'=>$request->member_inv[$m],'join_url'=>$response_body->join_url]);
        }
        // if(!empty($zoom_noti)){
            
        //     ZoomMeetingNotificationModel::insert($zoom_noti);
        // }
        return [
            'success' => $response->status() === 201,
            'join_url'=>$response_body->join_url,
            'start_link'=>$response_body->start_url,
            'start_time'=>date('H:i A',strtotime($data['start_time'])),
            'start_date'=>date('D j M, Y',strtotime($data['start_time'])),
            'data' => json_decode($response->body(), true),
        ];
    }
    

    function linkedin_connect(Request $request){
        print_r($request->all()); exit();
    }
    
}