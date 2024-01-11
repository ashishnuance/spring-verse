@if(isset($grp_list['grp_list']) && !empty($grp_list['grp_list']))

@foreach($grp_list['grp_list'] as $k => $frnd_val)

<li class="left clearfix chat_member" data-chatroomid="{{(isset($frnd_val['firestore_grp_id']) && $frnd_val['firestore_grp_id']!='') ? $frnd_val['firestore_grp_id'] : ''}}" data-memberid="{{$frnd_val['id']}}">
    <a href="{{route('messages')}}?gmid={{$frnd_val['id']}}">
    <span class="chat-img pull-left">
        @if(isset($frnd_val['grp_profile']) && $frnd_val['grp_profile']!='' && $frnd_val['grp_profile']!='' && $frnd_val['grp_profile']!='')
            <img src="{{ $frnd_val['grp_profile'] }}" alt="..." onerror="this.onerror=null;this.src='{{default_image()}}';" class="img-circle"/>
            
        @else
        <img src="{{ (isset($frnd_val['grp_profile'])) ? default_image($frnd_val['grp_profile']) : default_image()}}" alt="..." class="img-circle"/>
        @endif
    
    </span>
    <div class="chat-body clearfix">
    <div class="header_sec">
        <strong class="primary-font">{{(isset($frnd_val['grp_name'])) ? ucwords($frnd_val['grp_name']) : '' }}
        </strong> 
        <span class="unread-count hide">0</span>
        <span class="chat-time lastmsgtime"></span>
    </div>
     <div class="contact_sec">
       <span class="primary-font">{{(isset($frnd_val['member_count'])) ? ($frnd_val['member_count']+1) : '' }} Members</span>  
    </div>
    </div>
    <p class="lastmesg"></p>
    </a>
</li>
@endforeach
@endif