@if(isset($meeting_list_result) && $meeting_list_result!='')
@foreach($meeting_list_result as $meeting_list)

<div class="notification-box">
  <div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="media">
          <div class="media-left">
            <a href="javascript:void();">
            <img class="media-object" src="{{default_image()}}" alt="..." onerror="this.onerror=null;this.src='{{default_image()}}';"  width="100px">
            </a>
          </div>

          <div class="media-body">
            <h4>
              <a href="javascript:void();">{{ (isset($meeting_list->topic)) ? ucwords($meeting_list->topic) : '' }}</a>
              <span class="date-time">{{differenceInHours($meeting_list->created_at)}} ago</span>
            </h4>
            <div class="topi-agenda">
            <p><strong>Agenda</strong> : {{$meeting_list->agenda}}</p>
            <p><strong>Schedule Time</strong> : {{date('Y-m-d H:i A',strtotime($meeting_list->date_time))}}</p>
            
            </div>
            @if($meeting_list->user_id==auth()->user()->id)
            <p><strong>Start Link</strong> : <a href="{{(isset($meeting_list->start_link)) ? $meeting_list->start_link : 'javascript:void();'}}">{{$meeting_list->start_link}}</a>
            </p>
            @elseif(in_array(auth()->user()->id,explode(',',$meeting_list->member_ids)))
            <p><strong>Join Link</strong>: <a href="{{(isset($meeting_list->join_link) && $meeting_list->join_link!='') ? $meeting_list->join_link : 'javascript:void();'}}">{{(isset($meeting_list->join_link) && $meeting_list->join_link!='') ? $meeting_list->join_link : 'javascript:void();'}}</a>
            @endif
            </p>
          </div>
            
        </div>
        <!-- media -->
    </div>
  </div>
</div>
@endforeach
@endif 