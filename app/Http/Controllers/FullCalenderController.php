<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\ZoomMeetingModel;
use App\Models\User;
use DB;

class FullCalenderController extends Controller
{
    public function index(Request $request)
    {
		$user_id = $request->user()->id;
        if($request->ajax())
    	{	
			
			$data = DB::select("SELECT sv_zoom_meeting.id as id,sv_zoom_meeting.member_ids as member_id,sv_zoom_meeting.user_id as user_id,sv_zoom_meeting.date_time as date_time,'zoom' as type FROM `sv_zoom_meeting` where date_time between '".$request->start." 00:00:00' and '".$request->end." 23:59:59' and (user_id = $user_id OR FIND_IN_SET('$user_id', member_ids)) UNION ALL  (SELECT sv_person_meeting.id as id,sv_person_meeting.member_id as member_id,sv_person_meeting.user_id as user_id,sv_person_meeting.date_time as date_time,'person' as type FROM sv_person_meeting where date_time between '".$request->start." 00:00:00' and '".$request->end." 23:59:59' and (user_id = $user_id OR FIND_IN_SET('$user_id', member_id))) order by type asc");
			$meeting_arr = [];
			foreach($data as $event_val){
				$date_time = date('Y-m-d',strtotime($event_val->date_time));
				$meeting_arr[$date_time][] = $event_val;
				
			}
			$data_arr = [];
			$k = 0;
			
			foreach($meeting_arr as $m_key => $m_value){
				
				$eventid = date('Ymd',strtotime($m_key));
				$meeting_type = 'Meetings';
				$data_arr[$k]['id'] = $eventid;
									
				$data_arr[$k]['start'] = $m_key;// date('Y-m-d H:i:s',strtotime($m_value[0]->date_time));
				$data_arr[$k]['end'] = $m_key;//date('Y-m-d H:i:s',strtotime($m_value[(count($m_value)-1)]->date_time));
				
				$data_arr[$k]['color'] = '#7B408F';
				// $data_arr[$k]['backgroundColor'] = '#EFE7F1 !important';
				// $data_arr[$k]['rendering'] = 'background';
				$data_arr[$k]['z-index']='-99';
				// $data_arr[$k]['overlap'] = true;
				$data_arr[$k]['textColor'] = '#FFF';
				$data_arr[$k]['button'] = '<button class="popper-button" data-id="'.$eventid.'" id="popper-button'.$eventid.'">'.$meeting_type.'</button>';
				$meeting_html_data = '<section id="popper-section'.$eventid.'">
				Meeting<div id="popper-popup'.$eventid.'" class="popover-content popper-popup"><div class="meeting-details">
				<div class="TopRows"><span class="fa fa-angle-left"></span><span class="MainTitle"> Meetup Details </span><button class="btn closebtn"><i class="fa fa-times" aria-hidden="true"></i></button></div>';
				
				foreach($m_value as $mv){
					
					// echo $m_key.'<br><h1>zoom_data</h1>=='.$mv->type.'<br>';
					if($mv->type=='zoom'){
						$zoom_data = ZoomMeetingModel::select(['id', 'user_id', 'date_time', 'member_ids','topic as title','topic','agenda','join_link','start_link'])->where('id',$mv->id)->first();
						// print_r($zoom_data);
						$meeting_html_data .='<div class="row media">
							<div class="col-sm-9 col-md-9 col-xs-9">
								
								<div class="media-left">
									<a href="#">
									<img class="media-object" src="'.env('ASSET_URL').'/frontend/images/icon-link.png" alt="...">
									</a>
								</div>
								<div class="media-body">
									<h6 class="media-heading">Virtual Meeting</h6>
									<p>Topic :- '.$zoom_data->title.'</p>
									<p>Agenda :- '.$zoom_data->agenda.'</p>
									<p>Time :- '.date('H:i A',strtotime($zoom_data->date_time)).'</p>';
									if(date('Y-m-d',strtotime($mv->date_time))>=date('Y-m-d')){
										if($zoom_data->user_id==$user_id){
										$meeting_html_data .='<a href="'.$zoom_data->start_link.'" target="_blank"> Click to Start</a>';
										}else{
										$meeting_html_data .='<a href="'.$zoom_data->join_link.'" target="_blank"> Click to Join</a>';
										}
									}
									// <p>Join Link :- '.$zoom_data->join_link.'</p>
									$meeting_html_data .='</div>
								</div>
							</div>
							<!--row-->
						</div>';
					}else{
						$member_name = User::select(['full_name'])->where('id',$mv->member_id)->first();
						$meeting_html_data .='<div class="row media">
						<div class="col-sm-9 col-md-9 col-xs-9">
						   <div class="media-left">
							  <a href="#">
							  <img class="media-object" src="'.env('ASSET_URL').'/frontend/images/icon-user.png" alt="...">
							  </a>
						   </div>
						   <div class="media-body">
							  <h6 class="media-heading">Personal Meeting</h6>
							  <p>Member Name: '.ucfirst($member_name->full_name).'</p>
							  <p>Date: '.date('Y-m-d',strtotime($mv->date_time)).' at '.date('H:i A',strtotime($mv->date_time)).'</p>
						   </div>
						</div>
					 </div>';
					}
				}
				$meeting_html_data .='<div id="popper-arrow'.$eventid.'" class="popper-arrow"></div>
				</div>';
				$data_arr[$k]['html'] = $meeting_html_data;
				// }
				// foreach($data as $event_val){
				$k++;
			}
			
			// print_r($data_arr);exit();
            return response()->json($data_arr);
    	}
    	return view('frontend.full-calender');
    }

    public function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = Event::create([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = Event::find($request->id)->update([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = Event::find($request->id)->delete();

    			return response()->json($event);
    		}
    	}
    }
}

