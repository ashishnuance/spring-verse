<!DOCTYPE html>
<html>
<head>
    <title>{{ isset($pageTitle) ? $pageTitle : 'Spring Verse' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}" />
    <!-- <link rel="stylesheet" type="text/css" href="css/font-awesome.css" /> -->
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome_v6.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/animate.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/hover.css')}}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

    <style>
        .error {
            color: #f00 !important;
        }
        .NoUserFound{
            background: #fff;
            padding: 10px;
            border: 1px dashed;
        }
        .NoUserFound h2{
            margin-top:10px;
        }
    </style>
    <style>
    .tooltip {
    position: relative;
    display: inline-block;
    }

    .tooltip .tooltiptext {
    visibility: hidden;
    width: 140px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    bottom: 150%;
    left: 50%;
    margin-left: -75px;
    opacity: 0;
    transition: opacity 0.3s;
    }

    .tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
    }

    .tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
    }
    h2#swal2-title span {
        font-size: 18px;
    }
    </style>
    

<body>
   <div class="LoaderhideAndShow" style="display: none;">
      <div class="Loader">
         <div class="spinner-square">
               <div class="square-1 square"></div>
               <div class="square-2 square"></div>
               <div class="square-3 square"></div>
         </div>
      </div>
   </div>
    <!-- header -->
    @include('frontend.includes.headerNavigation')
    <!-- header -->
    @yield('content')
    <!-- footer -->
    @include('frontend.includes.footerNavigation')


    <script type="text/javascript" src="{{asset('frontend/js/jquery.js')}}"></script>
    <!-- calendar links and script -->
        {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <!-- calendar links and script end -->

    <script type="text/javascript" src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/index.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/wow.js')}}"></script>
    <script src="{{asset('frontend/js/calendar.js')}}"></script>

    
    <!-- jQuery -->
    
    <!-- tags hobbies -->
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />
    <!-- tags hobbies end -->
    <!--- validation library-->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- image crop -->
   {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <!-- image crop end -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script> --}}
    {{-- 
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script> --}}
        
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <!-- sweet alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet"/> --}}



    @include('frontend.includes.script')
<!-- calendar script --> 

{{--
<div id="popper-popup54" class="popover-content popper-popup">
    <div class="meeting-details">
       <h4><span class="fa fa-angle-left"></span> Meetup Details</h4>

       <div class="row media">
          <div class="col-sm-9 col-md-9 col-xs-9">
             <div class="media-left">
                <a href="#">
                <img class="media-object" src="./images/icon-user.png" alt="...">
                </a>
             </div>
             <div class="media-body">
                <h6 class="media-heading">Participant List</h6>
                <p>Savannah N., Albert F., Floyd M.</p>
             </div>
          </div>
          <!--col-->
          <div class="col-sm-3 col-md-3 col-xs-3">
             <div class="meeting-icons">
                <a href=""><img src="images/pencilIcon.png" alt=""></a>
             </div>
          </div>
       </div>
       
       <!--row-->
       <div class="row media">
          <div class="col-sm-9 col-md-9 col-xs-9">
             <div class="media-left">
                <a href="#">
                <img class="media-object" src="./images/icon-link.png" alt="...">
                </a>
             </div>
             <div class="media-body">
                <h6 class="media-heading">Meeting Location</h6>
                <p>Equinox Newy York</p>
             </div>
          </div>
          <!--col-->
          <div class="col-sm-3 col-md-3 col-xs-3">
             <div class="meeting-icons">
                <a href=""><img src="images/icon-copy.png" alt=""></a>
             </div>
          </div>
       </div>
       <!--row-->
    </div>

    <div id="popper-arrow54" class="popper-arrow"></div>
 </div>
--}}

<script src="https://unpkg.com/@popperjs/core@2"></script>
<script>

let popperButton;
let popperSection;
let popperPopup='';
let popperArrow;
// $(document).ready(function(){
//     $('body').on('click','.popper-button',function(){
//         const popper_id = $(this).data('id');
//         popperButton = document.querySelector("#popper-button"+popper_id);
//         popperPopup = document.querySelector("#popper-popup"+popper_id);
//         popperSection = document.querySelector("#popper-section"+popper_id);
//         popperArrow = document.querySelector("#popper-arrow"+popper_id);
//         console.log(popper_id,popperPopup);
//         // togglePopper(popper_id);
//     })
// })
// const popperButton = document.querySelector("#popper-button");
// const popperPopup = document.querySelector("#popper-popup");
// const popperSection = document.querySelector("#popper-section");
// const popperArrow = document.querySelector("#popper-arrow");

let popperInstance = null;

//create popper instance
function createInstance() {
  popperInstance = Popper.createPopper(popperButton, popperPopup, {
    placement: "auto", //preferred placement of popper
    modifiers: [
    {
        name: "offset", //offsets popper from the reference/button
        options: {
          offset: [0, 8]
        }
    },
    //   {
    //     name: "flip", //flips popper with allowed placements
    //     options: {
    //       allowedAutoPlacements: ["right", "left", "top", "bottom"],
    //       rootBoundary: "viewport"
    //     }
    //   }
    ]
  });
}

//destroy popper instance
function destroyInstance() {
  if (popperInstance) {
    popperInstance.destroy();
    popperInstance = null;
  }
}

//show and create popper
function showPopper() {
  popperPopup.setAttribute("show-popper", "");
  popperArrow.setAttribute("data-popper-arrow", "");
  createInstance();
}

//hide and destroy popper instance
function hidePopper() {
  popperPopup.removeAttribute("show-popper");
  popperArrow.removeAttribute("data-popper-arrow");
  destroyInstance();
}

//toggle show-popper attribute on popper to hide or show it with CSS
function togglePopper(isEvent) {
    console.log(isEvent);
    // popperPopup = document.querySelector("#popper-popup"+popper_id);
    // console.log('togglepopper',popperPopup);
    // $('.popper-popup').removeAttr('show-popper')
    if(isEvent){
        if (popperPopup.hasAttribute("show-popper")) {
            hidePopper();
        } else {
            showPopper();
        }
    }
}
//execute togglePopper function when clicking the popper reference/button
// popperButton.addEventListener("click", function (e) {
//   e.preventDefault();
//   togglePopper();
// });

</script>


<script>

function removepop(id, isEvent) {
    console.log('hererterte',id, isEvent);
    let str_id = JSON.stringify(id);
    popperButton = document.querySelector("#popper-button"+str_id);
    popperPopup = document.getElementById("popper-popup"+str_id);
    popperSection = document.querySelector("#popper-section"+str_id);
    popperArrow = document.getElementById("popper-arrow"+str_id);
    // popperPopup.hide()
    console.log(popperPopup)
    popperPopup.removeAttribute("show-popper");
  popperArrow.removeAttribute("data-popper-arrow");
//     if (popperPopup.hasAttribute("show-popper")) {
//        // hidePopper();
//         popperPopup.removeAttribute("show-popper");
//   popperArrow.removeAttribute("data-popper-arrow");
//     } else {
//         popperPopup.addAttribute("show-popper");
//   popperArrow.addAttribute("data-popper-arrow");
//     }
    // togglePopper(isEvent);
}

$(document).ready(function () {
function getDateWithoutTime(dt)
{
  dt.setHours(0,0,0,0);
  return dt;
}
    
    

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({

        editable:true,
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        events:'{{route("full-calendar")}}',
        selectable:true,
        selectHelper: true,
        selectAllow: function (info) {
      return (info.start >= getDateWithoutTime(new Date()));
    },
        select:function(start, end, allDay)
        {   console.log(start, end)
            /*var title = prompt('Event Title:');

            if(title)
            {
                var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                $.ajax({
                    url:"/full-calender/action",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        type: 'add'
                    },
                    success:function(data)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Created Successfully");
                    }
                })
            }*/
        },
        editable:true,
        // eventDidMount: function(info) {
        //     console.log(info.event.html);
        //     return info.event.html;
        //     // {description: "Lecture", department: "BioChemistry"}
        // },
        eventContent: function( info ) {
            console.log(info, '370')
            return {html: info.event.html};
        },
        eventRender: function(event, element) {
        //    console.log(event, element, '373')
        //    let datetime = new Date(event.start._i);
        //    var datetimeyear = datetime.getFullYear();
        //     var datetimemonth = String(datetime.getMonth() + 1).padStart(2, '0');
        //     var datetimedate = String(datetime.getDate()).padStart(2, '0')
        //    datetime = datetimeyear+'-'+datetimemonth+'-'+datetimedate;
        //    console.log(datetime);
            element.find('.fc-title').html(event.html);
            let arr = document.querySelectorAll('[data-date="'+event.start._i+'"]')
            // console.log(arr)
            for(i=0; i<arr.length; i++) {
                //console.log(arr[i].className)
                if(arr[i].className.includes("fc-widget-content")) {
                    //document.getElementById(arr[i])
                    
                    arr[i].className = arr[i].className+" dummy"
                    console.log(arr[i].style.background)
                }
            }
           // console.log(event.start._i, document.querySelectorAll('[data-date="'+event.start._i+'"]'))
        },
        
        dayClick:  function(data, event, view) {
            let eventdate = new Date(data._d);
            var eventyear = eventdate.getFullYear();
            var eventmonth = String(eventdate.getMonth() + 1).padStart(2, '0');
            var date = String(eventdate.getDate()).padStart(2, '0')
            // console.log('sss', eventyear, eventmonth, date);
            
            data.id = eventyear+eventmonth+date;
            popperButton = document.querySelector("#popper-button"+data.id);
            popperPopup = document.querySelector("#popper-popup"+data.id);
            popperSection = document.querySelector("#popper-section"+data.id);
            popperArrow = document.querySelector("#popper-arrow"+data.id);
            if (document.getElementsByClassName('popper-popup').length) {
                console.log(document.getElementsByClassName('popper-popup'))
                let arr = document.getElementsByClassName('popper-popup')
                // $('.popper-popup').removeAttr('show-popper')
                let found = 0;
                for (var i = 0; i < document.getElementsByClassName('popper-popup').length; i++ ) {
                    // console.log(document.getElementById(arr[i].id).hasAttribute('show-popper') && arr[i].id === "popper-popup"+data.id)
                    // console.log(document.getElementById(arr[i].id).hasAttribute('show-popper') && arr[i].id !== "popper-popup"+data.id)
                    if (document.getElementById(arr[i].id).hasAttribute('show-popper') && arr[i].id !== "popper-popup"+data.id) {
                        found=1
                        document.getElementById(arr[i].id).removeAttribute('show-popper')
                    }else{
                        found=0
                    }
                    if(document.getElementById(arr[i].id).hasAttribute('show-popper') && arr[i].id === "popper-popup"+data.id) {
                        found=1
                        document.getElementById(arr[i].id).removeAttribute('show-popper')
                    }else{
                        found=0
                    }
                }
                if(found === 0) {
                 togglePopper(true);
                }
            }
           
            
            //$('#popper-button').trigger('click');
            
            //  $('#modalBody > #title').text('arg.event.title');
            //  $('#modalWhen').text('arg.event.start');
            //  $('.modal-content > #eventID').val('arg.event._def.defId');
            //  $('#calendarModal').modal();
         },
         eventClick:  function(data, event, view) {
     
            popperButton = document.querySelector("#popper-button"+data.id);
            popperPopup = document.querySelector("#popper-popup"+data.id);
            popperSection = document.querySelector("#popper-section"+data.id);
            popperArrow = document.querySelector("#popper-arrow"+data.id);
            if (document.getElementsByClassName('popper-popup').length) {
                console.log(document.getElementsByClassName('popper-popup'))
                let arr = document.getElementsByClassName('popper-popup')
                // $('.popper-popup').removeAttr('show-popper')
                let found = 0;
                for (var i = 0; i < document.getElementsByClassName('popper-popup').length; i++ ) {
                    console.log(document.getElementById(arr[i].id).hasAttribute('show-popper') && arr[i].id === "popper-popup"+data.id)
                    console.log(document.getElementById(arr[i].id).hasAttribute('show-popper') && arr[i].id !== "popper-popup"+data.id)
                    if (document.getElementById(arr[i].id).hasAttribute('show-popper') && arr[i].id !== "popper-popup"+data.id) {
                        found=1
                        document.getElementById(arr[i].id).removeAttribute('show-popper')
                    }else{
                        // found=0
                    }
                    if(document.getElementById(arr[i].id).hasAttribute('show-popper') && arr[i].id === "popper-popup"+data.id) {
                        found=1
                        document.getElementById(arr[i].id).removeAttribute('show-popper')
                    }else{
                        // found=0
                    }
                }

                if(found === 0) {
                    console.log('found',found);
                 togglePopper(true);
                }
            }
           
            
            //$('#popper-button').trigger('click');
            
            //  $('#modalBody > #title').text('arg.event.title');
            //  $('#modalWhen').text('arg.event.start');
            //  $('.modal-content > #eventID').val('arg.event._def.defId');
            //  $('#calendarModal').modal();
         },
        /*eventResize: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"{{route('full-calender-update')}}",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update',
                    _token:'{{csrf_token()}}',
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    Swal.fire({
                        title: '<span style="color:green">Event Updated Successfully</span>',
                        text: "{!! session()->get('success') !!}",
                        imageUrl: '{{asset('frontend/images/spring-verse-logo.png')}}',
                        imageAlt: 'spring-verse',
                        //   icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    //alert("Event Updated Successfully");
                }
            })
        },
        eventDrop: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"/full-calender/action",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    //alert("Event Updated Successfully");
                }
            })
        },

        eventClick:function(event)
        {
            if(confirm("Are you sure you want to remove it?"))
            {
                var id = event.id;
                $.ajax({
                    url:"/full-calender/action",
                    type:"POST",
                    data:{
                        id:id,
                        type:"delete"
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Deleted Successfully");
                    }
                })
            }
        }*/
    });
    
});
  
</script>
<!-- calendar script end -->
</body>
</html>