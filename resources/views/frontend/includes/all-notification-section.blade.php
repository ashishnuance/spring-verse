
@if(isset($notificationlist_result) && $notificationlist_result!='')
   @foreach($notificationlist_result as $noti_val)
      @if($noti_val->type=='recommend')
      <div class="notification-box ">
      @include('frontend.includes.recommended-list-section')
      </div>
      @elseif($noti_val->type=='group')
      
      <div class="notification-box ">
      @include('frontend.includes.groupmember-notification')
      </div>
      @elseif($noti_val->type=='request')
      <div class="notificationlist">
      @include('frontend.includes.notification-list-section')
      </div>
      @elseif($noti_val->type=='meeting' || $noti_val->type=='meeting_sent')
      <div class="notification-box">
      @include('frontend.includes.recommended-list-section')
      </div>
      @elseif($noti_val->type=='zoom_meeting' || $noti_val->type=='zoom_meeting_request')
      <div class="notification-box">
      @include('frontend.includes.zoom-meeting-list-section')
      </div>
      @endif
   @endforeach
@endif
               