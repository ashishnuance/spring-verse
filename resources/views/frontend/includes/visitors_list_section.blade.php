@if(isset($all_visitors_list) && $all_visitors_list!='')
@foreach($all_visitors_list as $visitors_list)
 

{{-- @php echo '<pre>'; print_r($visitors_list);  die; @endphp --}}
<div class="notification-box ">
<div class="row ">
   <div class="col-sm-6 col-lg-6">
      <div class="media">
         <div class="media-left">
      
            <a href="{{ (isset($visitors_list->visit->username)) ? route('profile',$visitors_list->visit->username) : 'javascript:void();'}}">
            <img class="media-object" src="{{ ($visitors_list->profile_image!='') ? default_image($visitors_list->profile_image) : ''}}" alt="..." onerror="this.onerror=null;this.src='{{default_image()}}';">
            </a>
         </div>
         <div class="media-body">
            
          <h4><a href="{{ (isset($visitors_list->visit->username)) ? route('profile',$visitors_list->visit->username) : 'javascript:void();'}}"> {{ (isset($visitors_list->visit->full_name) && $visitors_list->visit->full_name!='') ? ucwords($visitors_list->visit->full_name) :  '' }}</a></h4>
          <p>Last Visited Date: {{date('D j-M-Y',strtotime($visitors_list->date))}}</p>
       
         </div>
      </div>
      <!-- media -->
   </div>
  
  {{-- @php echo '<pre>'; print_r($visitors_list->member_request_status->to_member); die; @endphp --}}

    <div class="col-sm-6 col-lg-6">
    <div class="notification-btns" style="margin-top:7px;">
      {{-- @if(isset($visitors_list->member_request_status) && $visitors_list->member_request_status->status==0 && $visitors_list->member_request_status->to_member==auth()->user()->id)
      {{-- reject appcet --}}

         {{-- <a href="{{route('update-request-status', ['id'=>$visitors_list->member_request_status->id,'status'=>2])}}" class="btn btn-notify2 acceptrequest" data-reqid="{{$visitors_list->member_request_status->status}}"> <i class="fa fa-user-plus"></i> Reject Request</a> --}}

         {{--<a href="{{route('update-request-status', ['id'=>$visitors_list->member_request_status->id,'status'=>1])}}" class="btn btn-notify1 acceptrequest" data-reqid="{{$visitors_list->member_request_status->status}}"> <i class="fa fa-user-plus"></i> Accept Request</a> --}}

      @if(isset($visitors_list->member_request_status) && $visitors_list->member_request_status->status==0)

         <div class="sendRequest-btn" style="{{($visitors_list->member_request_status) ? 'display:block' : 'display:none' }}" name="saved{{$visitors_list->user_id}}">
            <a href="javascript:void();" class="btn btn-notify pointer-events" id="buttonid" role="button"><i class="fa-solid fa-user-group"></i>Sent</a>
         </div>
      @elseif(!isset($visitors_list->member_request_status)) 

         <div class="sendRequest-btn" style="{{($visitors_list->member_request_status) ? 'display:none' : 'display:block' }}" name="unsave{{$visitors_list->user_id}}">
         <a href="javascript:void();" data-tomember="{{$visitors_list->user_id}}"  class="btn btn-notify2 sent-req pointer-events" role="button"><i class="fa-solid fa-user-group"></i>Send Request</a>
         </div>
      @elseif(isset($visitors_list->member_request_status) && $visitors_list->member_request_status->status==1)
           <div class="sendRequest-btn" style="{{($visitors_list->member_request_status) ? 'display:block' : 'display:none' }}" name="saved{{$visitors_list->user_id}}">
            <a href="javascript:void();" class="btn sent-req btn-notify2 pointer-events" id="buttonid" role="button"><i class="fa-solid fa-user-group"></i>Accepted</a>
         </div>
         @elseif(isset($visitors_list->member_request_status) && $visitors_list->member_request_status->status==2)
           <div class="sendRequest-btn" style="{{($visitors_list->member_request_status) ? 'display:block' : 'display:none' }}" name="saved{{$visitors_list->user_id}}">
            <a href="javascript:void();" class="btn sent-req btn-notify2 pointer-events" id="buttonid" role="button"><i class="fa-solid fa-user-group"></i>Rejected</a>
         </div>
      @endif
    </div>
    </div>

   {{-- <div class="col-sm-6 col-lg-6">

      <div class="notification-btns">
        {{ (isset($visitors_list[0]->date) && $visitors_list[0]->date!='') ? date('Y-m-d',strtotime($visitors_list[0]->date)) :  '' }}
      </div>
      <!-- notification-btns -->
   </div> --}}
</div>
</div>
@endforeach
@endif
