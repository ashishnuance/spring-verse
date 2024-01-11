@if(isset($allfriends_list['all_records']) && !empty($allfriends_list['all_records']))

@foreach($allfriends_list['all_records'] as $k => $frnd_val)

<li class="left clearfix chat_member" id="{{(isset($frnd_val->chatroomid) && $frnd_val->chatroomid!='') ? $frnd_val->chatroomid : ''}}" data-chatroomids="{{(isset($frnd_val->chatroomid) && $frnd_val->chatroomid!='') ? $frnd_val->chatroomid : ''}}" data-memberids="{{$frnd_val->mmid}}">
    <a href="{{route('messages')}}?mmid={{$frnd_val->mmid}}">
    <span class="chat-img pull-left">
        @if(isset($frnd_val->member_data->provider_id) && $frnd_val->member_data->provider_id!='' && $frnd_val->member_data->social_login!='' && $frnd_val->member_data->profile_image!='')
            <img src="{{ $frnd_val->member_data->profile_image }}" alt="..." onerror="this.onerror=null;this.src='{{default_image()}}';" class="img-circle"/>
            
        @else
        <img src="{{ (isset($frnd_val->member_data->profile_image)) ? default_image($frnd_val->member_data->profile_image) : default_image()}}" alt="..." class="img-circle"/>
        @endif
    {{-- <img src="{{default_image()}}" alt="" class="img-circle"> --}}
    </span>
    <div class="chat-body clearfix">
    <div class="header_sec">
        <strong class="primary-font">{{(isset($frnd_val->member_data->full_name)) ? ucwords($frnd_val->member_data->full_name) : '' }}
        </strong> 
        <span class="unread-count hide">0</span>
        <span class="chat-time lastmsgtime"></span>
    </div>
     {{-- <div class="contact_sec">
       <span class="primary-font">678 Members</span>  
    </div> --}}
    </div>
    <p class="lastmesg"></p>
    </a>
</li>
@endforeach
@endif