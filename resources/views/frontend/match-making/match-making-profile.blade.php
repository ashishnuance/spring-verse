@extends('frontend.layouts.frontLayout')


@section('content')

<style>
    a {
        text-decoration: none !important;
    }
    .swiper {
      width: 350px;
      height: 480px;
    }

    .swiper-slide {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      flex-direction: column;
      border-radius: 20px;
      font-size: 22px;
      font-weight: bold;
      color: #000;
      background-color: #fff;
      padding: 15px;
    } 

    .ProfileNotFound {
        /* width: 350px;
    height: 480px; */
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    border-radius: 20px;
    font-weight: 500;
    color: #000;
    background-color: #fff;
    padding: 15px;
    text-align: center;
    font-size: 18px;
    line-height: 30px;
    }
    .matchingprofile {
        padding: 100px 0;
        position: relative;
    }
    .profileimg img {
    width: 100%;
    overflow: hidden;
    border-radius: 20px;
    height: 100%;
    aspect-ratio: 1 / 1;
    object-fit: cover;
    object-position: top;
}
.profileimg {
    width: 100%;
    height: 250px;
    position: relative;
    overflow: hidden;
    border-radius: 20px;
    box-shadow: 0px 6px 8px #ddd;
}
.UserName h4 {
    margin: 0;
}
.UserName {
    /*position: absolute;
    bottom: 0;
    width: 100%;
    background: #9f9f9f;
    text-align: center;*/
    padding-bottom: 10px;
}
.ProfileDescription {
    padding: 15px 0px;
}
.ProfileDescription p {
    font-size: 12px;
    color: #777;
    font-weight: 400;
    font-family: sans-serif;
    margin: 0;
}
.AccessProfileBtn {
    display: flex;
    align-items: center;
    gap: 20px;
    position: absolute;
    top: 10px;
    right: 10px;
}
.AccessProfileBtn a {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 100%;
    text-decoration: none;
    color: #fff;
}
.Accept {
    background: #7a438e;
}
.Reject {
    background: #ff4e4e;
}
.ScheduleMeet {
    background: #009688;
}
.Navigation ul {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin: 0;
    padding: 0;
}

.Navigation .Dots {
    width: 15px;
    height: 15px;
    background: #333;
    display: block;
    border-radius: 30px;
}

.Navigation .Active {
    background: #7a438e;
}
.Navigation li {
    list-style: none;
}

.Navigation {
    position: absolute;
    bottom: 20px;
    left: 0;
    right: 0;
    width: 100%;
    padding: 0px 30px;
}
.BtnSkip {
    position: absolute;
    bottom: 30px;
    right: 30px;
}
.BtnSkip a {
    width: 150px;
    display: flex;
    user-select: none;
    margin: 0px auto;
    max-width: 100%;
    padding: 0px 16px;
    background-color: #ffffff;
    color: rgb(38 7 48);
    border-radius: 10px;
    border: none;
    height: 44px;
    font-size: 20px;
    cursor: pointer;
    transition: all 0.2s ease 0s;
    text-transform: uppercase;
    align-items: center;
    justify-content: center;
    gap: 10px;
}
.BtnBack a {
    width: 150px;
    display: flex;
    user-select: none;
    margin: 0px auto;
    max-width: 100%;
    padding: 0px 16px;
    background-color: #ffffff;
    color: rgb(38 7 48);
    border-radius: 10px;
    border: none;
    height: 44px;
    font-size: 20px;
    cursor: pointer;
    transition: all 0.2s ease 0s;
    text-transform: uppercase;
    align-items: center;
    justify-content: center;
    gap: 10px;
}
.BtnBack {
    position: absolute;
    bottom: 30px;
    left: 30px;
}
.profile-acceptreject-btn {
    position: absolute;
    bottom: 0;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
}
.profile-acceptreject-btn a {
    color: #fff;
    font-size: 14px;
    padding: 6px 25px;
    border-radius: 10px;
    font-weight: 300;
    font-family: sans-serif;
    letter-spacing: 0.9px;
}
.RejectBtn {
    background: #ff4242;
}
.AcceptBtn {
    background: #04b404;
}
  </style>

<section class="matchingprofile" style="background: url({{ asset('/frontend/match-making/pexels-pixabay-531880.jpg') }}); background-size: cover;background-position: center;">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
                <?php //echo '<pre>'; print_r($profile_result); die; ?>  

            

                @if(isset($profile_result) && !empty($profile_result))
                    @foreach($profile_result as $profile_val)

                    
                    <div class="swiper-slide" id="swiper-slider-{{$profile_val->id}}">
                        <div class="profileimg">
                         
                            
                            <img src="{{(isset($profile_val->profile_image) && $profile_val->profile_image!='') ? url('/public/uploads/profile/').'/'.$profile_val->profile_image : default_image() }}" alt="" onerror="this.onerror=null;this.src='{{asset('/frontend/match-making/Professional-Profile-Picture.jpg')}}';" width="50px;">
                            <!-- <div class="AccessProfileBtn">
                                <a href="#" class="Accept"><i class="fa-solid fa-heart"></i></a>
                            </div> -->
                          {{--@else
                             <img class="media-object" src="{{ (isset($profile_val->profile_image)) ? default_image($profile_val->profile_image) : default_image()}}" alt="...">--}}
                          
                        </div>
                        <div class="ProfileDescription">
                            <div class="UserName">
                                <h4>How well do you know {{(isset($profile_val->full_name) ? ucfirst($profile_val->full_name) : '' )}} from {{(isset($profile_val->city) ? ucwords($profile_val->city) : '' )}} ?</h4>
                            </div>
                            <p>{{(isset($profile_val->introduction) ? $profile_val->introduction : '' )}}</p>
                        </div>
                        <div class="profile-acceptreject-btn">
                            <a href="{{route('match-making-profile-reject',[$profile_val->id])}}/" class="RejectBtn" title="Don't show me this person" onclick="reject_profile(this,'{{$profile_val->id}}')">Reject</button>
                            <a href="{{route('profile',[$profile_val->username,$profile_val->id])}}" class="AcceptBtn" title="schedule a meeting">Accept</a>
                        </div>
                    </div>
              
                    @endforeach
                @endif
                @if(isset($profile_not_found_msg) && $profile_not_found_msg!='')
               <div class="ProfileNotFound"> {{$profile_not_found_msg}} </div>
                @endif
                
            <!--             
            <div class="swiper-slide">Slide 3</div>
            <div class="swiper-slide">Slide 4</div>
            <div class="swiper-slide">Slide 5</div>
            <div class="swiper-slide">Slide 6</div>
            <div class="swiper-slide">Slide 7</div>
            <div class="swiper-slide">Slide 8</div>
            <div class="swiper-slide">Slide 9</div> -->
        </div>
    </div>

    <div class="BtnBack">
        <a href="{{route('home')}}"><i class="fa-solid fa-backward"></i> Back</a>
    </div>

    <div class="BtnSkip">
    <a href="{{route('home')}}">Skip <i class="fa-solid fa-forward"></i></a>
    </div>
</section>



@endsection
