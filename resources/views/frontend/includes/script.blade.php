<script>
/*
$(document).ready(function() {
    var myDate = new Date(2000,11,31);
    $('#myCalendar').datepicker({
        autoclose: true, 
        todayHighlight: false,
         
    });
    $('#myCalendar').datepicker('minDate', myDate);
});*/
// $('body').on('click','#profile-stepBtn1',function(e){
//    e.preventDefault();
//    return true;
// })
// function reject_profile(element,profile_id){
//   $.ajax({
//       type: "get",
//       url: "{{route('match-making-profile-reject') }}/"+profile_id,
//       success: function(data) {
//           console.log(data);
//           // modalimage.modal('hide');
//           if (data.status == true) {
            
//             $(element).parents('#swiper-slider-'+profile_id).remove();
//           //     $('.profileimage img').attr('src', data.image_url)
//           //     Swal.fire({
//           //         title: '<span style="color:green">Success</span>',
//           //         text: "Your profile image has been updated",
//           //         imageUrl: '{{asset('frontend/images/spring-verse-logo.png')}}',
//           //         imageAlt: 'spring-verse',
//           //         // icon: 'success',
//           //         showConfirmButton: false,
//           //         timer: 2000,
//           //     });
//           }
//       }
//   });
// }
    $(function () {

        $("#myCalendar").datepicker({
            dateFormat: "dd-mm-yy", 
            autoclose: true, 
            todayHighlight: true,
            minDate: 0,
            onSelect: function(dateText) {
                console.log(dateText)
                $('input[name=person_meetingdate_date]').val(dateText);
                /*
                $sD = new Date(dateText);
                $("input#DateTo").datepicker('option', 'minDate', min);
                */
            }
        })

        
    });

   
      function edit_profile(element, name) {
         if (name == 'hobbies') {
            $('.hobbies').show();
            $('.hobbies-btn').hide();
         } else {
            $('*[name=' + name + ']').show();
            $('.' + name).hide();
         }
      }
      /*
      $(function() {
         $('#cities').tagsinput();
      });
*/
   
   $(document).ready(function(){
      setTimeout(() => {
         
         $('#payment_savstrip').find('button[type=submit]').css('disabled',true);
      }, 2000);
      $('body').on('click','.stripe-button-el',function(e){
         e.preventDefault();
         console.log('asdasdasd',$('#payment_save').serialize());
         $('#billing_detail').val($('#payment_save').serialize());
         return false;
      })
   })
   
      $(document).ready(function(){
         $('.addmembers_group').click(function(){
            var gid = $(this).data('id');
            $('#addmembers_group').find('input[name=group_id]').val(gid)

         })

         $('.frommemberid').click(function(){
            $('#from_member_id').val($(this).data('frommemberid'));
         })

         $('.meetingid').click(function(){
            console.log($(this).data('meetingid'))
            $('#from_meeting_id').val($(this).data('meetingid'));
            $('#person-meeting-form').find('.profile-name').text($(this).data('profilename'));
            var time_meet = ($('*[name=person_meetingdate_time]').val()!='') ? $('*[name=person_meetingdate_time]').val() : '12:00 PM';
            var date_meet = ($('*[name=person_meetingdate_date]').val()!='') ? $('*[name=person_meetingdate_date]').val() : '{{date("d-m-Y")}}';
            $('#person-meeting-form').find('.meeting-datetime').text('Date Time:'+date_meet+' '+time_meet);
            $('#person_meetingdate_time').val($('*[name=person_meetingdate_time]').val());
            $('#person-meeting-form').find('#person_meetingdate_date').val(date_meet+' '+time_meet);
         })
         $('#profile-stepBtn2').click(function(){
            // console.log($(this).data('meetingid'))
            // $('#from_meeting_id').val($(this).data('meetingid'));
            // $('#person-meeting-form').find('.profile-name').text($(this).data('profilename'));
            var time_meet = ($('*[name=person_meetingdate_time]').val()!='') ? $('*[name=person_meetingdate_time]').val() : '12:00 PM';
            var date_meet = ($('*[name=person_meetingdate_date]').val()!='') ? $('*[name=person_meetingdate_date]').val() : '{{date("d-m-Y")}}';
            
            $('.zoom_meeting_date').text('Date: '+date_meet);
            $('input[name=meeting_start_time]').val(date_meet+' '+time_meet);
            $('.zoom_meeting_time').html('<li><a href="javascript:void(0);" class="active">'+$('*[name=person_meetingdate_time]').val()+'</a></li>');
            // $('#person-meeting-form').find('#person_meetingdate_date').val(date_meet+' '+time_meet);

         })

         $('.schedule-back').click(function(){
            $('#profile-step2').toggle();
            $('#profile-step1').toggle();
         })
         $('.meeting-back').click(function(){
            $('#profile-step3').toggle();
            $('#profile-step2').toggle();
         })
         $('.profile-step4').click(function(){
            $('#profile-step4').toggle();
            $('#profile-step3').toggle();
         })
         $('.profile-step5').click(function(){
            $('#profile-step5').toggle();
            $('#profile-step4').toggle();
         })

      })

      $(document).ready(function(){
      var modalimage = $('#modal');
      var image = document.getElementById('image');
      console.log(image);
      var cropper;
      $("body").on("change", ".image", function(e) {
         var files = e.target.files;
         var done = function(url) {
            console.log(url)
            image.src = url;
            modalimage.modal('show');
         };
         var reader;
         var file;
         var url;
         if (files && files.length > 0) {
            file = files[0];
            if (URL) {
               setTimeout(() => {
                  done(URL.createObjectURL(file));
                  
               }, 1000);
            } else if (FileReader) {
               reader = new FileReader();
               reader.onload = function(e) {
                  done(reader.result);
               };
               reader.readAsDataURL(file);
            }
         }
      });
      modalimage.on('shown.bs.modal', function() {
         cropper = new Cropper(image, {
            aspectRatio: 1 / 1,
            viewMode: 3,
            preview: '.preview',
         });
      }).on('hidden.bs.modal', function() {
         cropper.destroy();
         cropper = null;
      });
      $("#crop").click(function() {
         canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
         });
         canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
               var base64data = reader.result;
               $.ajax({
                  type: "POST",
                  dataType: "json",
                  url: "{{route('myaccount-profile-image') }}",
                  data: {
                     '_token': '{{csrf_token()}}',
                     'image': base64data
                  },
                  success: function(data) {
                     console.log(data);
                     modalimage.modal('hide');
                     if (data.status == true) {
                        $('.profileimage img').attr('src', data.image_url)

                        Swal.fire({
                  
                        title: '<span style="color:green">Success</span>',
                        text: "Your profile image has been updated",
                        imageUrl: '{{asset('frontend/images/spring-verse-logo.png')}}',
                        imageAlt: 'spring-verse',
                        // icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,
         
                        });
                     }
                  }
               });
            }
         });
      });
   })
   

   //question image for match making


   $(document).ready(function(){
      var modalimage = $('#modalim');
      var image = document.getElementById('image');
      console.log(image);
      var cropper_making;
      $("body").on("change", ".image-making", function(e) {
         var files = e.target.files;
         var done = function(url) {
            console.log(url)
            image.src = url;
            modalimage.modal('show');
         };
         var reader;
         var file;
         var url;
         if (files && files.length > 0) {
            file = files[0];
            if (URL) {
               setTimeout(() => {
                  done(URL.createObjectURL(file));
                  
               }, 1000);
            } else if (FileReader) {
               reader = new FileReader();
               reader.onload = function(e) {
                  done(reader.result);
               };
               reader.readAsDataURL(file);
            }
         }
      });
      modalimage.on('shown.bs.modal', function() {
         cropper_making = new Cropper(image, {
            aspectRatio: 1 / 1,
            viewMode: 3,
            preview: '.preview',
         });
      }).on('hidden.bs.modal', function() {
         cropper_making.destroy();
         cropper_making = null;
      });
      $("#cropsave").click(function() {
         canvas = cropper_making.getCroppedCanvas({
            width: 160,
            height: 160,
         });
         canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
               var base64data = reader.result;
               $.ajax({
                  type: "POST",
                  dataType: "json",
                  url: "{{route('question-image') }}",
                  data: {
                     '_token': '{{csrf_token()}}',
                     'image': base64data
                  },
                  success: function(data) {
                     console.log(data);
                     modalimage.modal('hide');
                     if (data.status == true) {
                        $('.questionimage img').attr('src', data.image_url)
                        $('#member_making_profile').val(data.image_name);
                      
                     }
                  }
               });
            }
         });
      });
   })
   


      //    
      $("#signupForm").submit(function() {
         $('#tandc').parent().find('span.error').remove();
         if ($('#tandc').is(':checked')) {
            return true;
         } else {
            $('#tandc').parent().append('<span class="error">Please accept our terms and conditions</span>')
            return false
         }
      })
      /**
       * check form validation
       **/
      $("#signupForm").validate({

         rules: {
            first_name: {
               required: true
            },
            last_name: {
               required: true
            },
            password: {
               required: true,
               minlength: 8,
               checkpassword: ["password"]
            },
            email: {
               required: true,
               email: true,
               checkemailid: ["email"]
            },
            username: {
               required: true,
               maxlength: 15,
               alphanumeric: true,
               checkusername: ["username"]
            },
            tandc: {
               'tandc': {
                  required: true,
                  maxlength: 1
               }
            },
         },
         messages: {
            first_name: {
               required: "Please enter your first name"
            },
            last_name: {
               required: "Please enter your last name"
            },
            password: {
               required: "Please provide a password",
               minlength: "Your password must be at least 8 characters"
            },
         }
      });

      /**
       * check username alphanumeric
       **/
      jQuery.validator.addMethod("alphanumeric", function(value, element) {
         return this.optional(element) || /^[\w.]+$/i.test(value);
      }, "Letters, numbers, and underscores only please");

      /**
       * check password strong
       **/
      
      jQuery.validator.addMethod("checkpassword", function(value, element) {
         // allow any non-whitespace characters as the host part
          return this.optional(element) || /^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/.test(value); 
       
         return this.optional(element) ||  /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/.test(value); 


      }, 'Please enter a valid and strong password.');

      /**
       * check email id unique
       **/
      jQuery.validator.addMethod("checkemailid",
         function(value) {
            console.log(value);
            var isUnique = false;
            if (value == '')
               return isUnique;
            $.ajax({
               url: "{{route('emailcheck')}}?email=" + value,
               type: 'GET',
               async: false,
               dataType: 'json',
               cache: true,
               success: function(data) {
                  isUnique = data;
                  console.log(data);
               }
            });
            return isUnique;
         },
         jQuery.validator.format("Email Address already exits")
      );

      /**
       * check username unique
       **/
      jQuery.validator.addMethod("checkusername",
         function(value) {
            console.log(value);
            var isUnique = false;
            if (value == '')
               return isUnique;
            $.ajax({
               url: "{{route('usernamecheck')}}?username=" + value,
               type: 'GET',
               async: false,
               dataType: 'json',
               cache: true,
               success: function(data) {
                  isUnique = data;
                  console.log(data);
               }
            });
            return isUnique;
         },
         jQuery.validator.format("Username already exits")
      );



      $("#passwordForm").validate({
         errorElement: 'div',
         errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
         },
         rules: {
            password: {
               required: true,
               minlength: 8,
               checkpassword: ["password"]
            },
         },
         messages: {
            password: {
               required: "Please provide a password",
               minlength: "Your password must be at least 8 characters"
            },
         }
      });



      /**
       * check password strong
       **/
      /*
      jQuery.validator.addMethod("checkpassword", function(value, element) {
         // allow any non-whitespace characters as the host part
         return this.optional(element) || /^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/.test(value);
      }, 'Please enter a valid and strong password.');

*/
/*
      $("#forgotForm").validate({
         errorElement: 'div',
         errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
         },
         rules: {
            email: {
               required: true,
               email: true,
               checkemailid: ["email"]
            }
         }

      });

      */
   
      function profilelocationsearch(element){
         var location = $(element).find('*[name=location]').val();
         var currentUrl_param = "{{Request::getRequestUri()}}";
         var ind_url = position_url = location_keyword = '';
         var currentUrl = "{{route('all-members')}}";

         if(currentUrl_param.includes('?') && location!=''){
            currentUrl_param = currentUrl_param.split('?');
            if(currentUrl_param[1].includes('location=')){
               var location_arr = currentUrl_param[1].split('location')
               currentUrl_param[1] = location_arr[0].replace('&amp;','')
               currentUrl_param[1] = currentUrl_param[1].slice(0, -1);
            }
            position_url += '?'+currentUrl_param[1].replace('&amp;','&')+'&location='+location;
         }else{
            position_url += '?location='+location;
         }
           console.log('currentUrl',currentUrl+position_url); 
           window.location.href = currentUrl+position_url;
           return false;
      }

      function profileinterestsearch(element){
         var location = $(element).find('*[name=interest]').val();
         var currentUrl_param = "{{Request::getRequestUri()}}";
         var ind_url = position_url = location_keyword = '';
         var currentUrl = "{{route('all-members')}}";

         if(currentUrl_param.includes('?') && location!=''){
            currentUrl_param = currentUrl_param.split('?');
            if(currentUrl_param[1].includes('interest=')){
               var location_arr = currentUrl_param[1].split('interest')
               currentUrl_param[1] = location_arr[0].replace('&amp;','&')
               currentUrl_param[1] = currentUrl_param[1].slice(0, -1);
            }
            position_url += '?'+currentUrl_param[1].replace('&amp;','&')+'&interest='+location;
         }else{
            position_url += '?interest='+location;
         }
           console.log('currentUrl',currentUrl+position_url); 
           window.location.href = currentUrl+position_url;
           return false;
      }

      $(document).ready(function() {
         var currentDate = new Date('2000-02-01');
         $('#datepicker').datepicker({
            dateFormat: "dd-mm-yy",
            autoclose: true,
            endDate: "currentDate",
            minDate: currentDate
         }).on('changeDate', function(ev) {
            $(this).datepicker('hide');
         });
         /*$('#datepicker').keyup(function() {
            if (this.value.match(/[^0-9]/g)) {
               this.value = this.value.replace(/[^0-9^-]/g, '');
            }
         });*/


      });
   
      $(document).ready(function() {

         // $('.create_group').click(function(){
         //    return false;
         // })

         $('.industry-list li').click(function() {
            const industry_text = $(this).attr('data-text');
            const industry_id = $(this).attr('data-id');
            var domain_name = 'https://devfolio.co.in';
            console.log($(this).attr('data-text'));
            var currentUrl_param = "{{Request::getRequestUri()}}";
            
            var currentUrl = '';
            console.log(currentUrl_param,'curr  ',currentUrl_param.includes('?'));
            var ind_url = position_url = hobbies_url= '';
            if(currentUrl_param.includes('?')){
               console.log(currentUrl_param,"currentUrl_param")
               var splitUrl = currentUrl_param.split('?');
               var split_url2 = splitUrl[1].split('&');
               console.log('split_url2',split_url2);
               for (let index = 0; index < split_url2.length; index++) {
                  const element = split_url2[index];
                  if(split_url2[index].includes('ind=')){
                     ind_url += 'ind='+industry_text
                     ind_url += '&ind_id='+industry_id
                  }
                  console.log(!hobbies_url.includes('hobbies_id='));
                  if(split_url2[index].includes('role=') && !position_url.includes('role=')){
                     position_url +=split_url2[index].replace('amp;','&')
                  }
                  if(split_url2[index].includes('role_id') && !position_url.includes('role_id=')){
                     position_url +=split_url2[index].replace('amp;','&')
                  }
                  if(split_url2[index].includes('hobbies=') && !hobbies_url.includes('hobbies=')){
                     hobbies_url +=split_url2[index].replace('amp;','&')
                  }
                  if(split_url2[index].includes('hobbies_id=') && !hobbies_url.includes('hobbies_id=')){
                     hobbies_url +=split_url2[index].replace('amp;','&')
                  }
               }
               if(ind_url==''){
                  ind_url += 'ind=' + industry_text + '&ind_id=' + industry_id;
                  position_url = (position_url!='') ? '&'+position_url : position_url;
                  hobbies_url = (hobbies_url != '') ? '&'+hobbies_url : hobbies_url;
               }
               console.log('if',ind_url,position_url);
               currentUrl = "{{route('all-members')}}"+'?'+ind_url+position_url+hobbies_url;
            }else{
               currentUrl = "{{route('all-members')}}"+'?ind=' + industry_text + '&ind_id=' + industry_id;
            }
            console.log(currentUrl);
            window.location.href = currentUrl
            return false;
         })
      })

      

      $(document).ready(function() {
         $('.position-list li').click(function() {
            const position_text = $(this).attr('data-text');
            const position_id = $(this).attr('data-id');
            var ind_url = position_url = hobbies_url= '';
            console.log($(this).attr('data-text'));
            var currentUrl_param = "{{Request::getRequestUri()}}";
            var join_simbol = '?';
            if(currentUrl_param.includes('?')){
               var splitUrl = currentUrl_param.split('?');
               var split_url2 = splitUrl[1].split('&');
               console.log('split_url2',split_url2);
               for (let index = 0; index < split_url2.length; index++) {
                  const element = split_url2[index];
                  if(split_url2[index].includes('role=')){
                     position_url +='role=' + position_text;
                     position_url +='&role_id=' + position_id;
                  }
                  if(split_url2[index].includes('ind=') && !ind_url.includes('ind=')){
                     ind_url +=split_url2[index].replace('amp;','&')
                  }
                  if(split_url2[index].includes('ind_id') && !ind_url.includes('ind_id=')){
                     ind_url +=split_url2[index].replace('amp;','&')
                  }
                  if(split_url2[index].includes('hobbies=') && !hobbies_url.includes('hobbies=')){
                     hobbies_url +=split_url2[index].replace('amp;','&')
                  }
                  if(split_url2[index].includes('hobbies=') && !hobbies_url.includes('hobbies_id=')){
                     hobbies_url +=split_url2[index].replace('amp;','&')
                  }
               }
               if(position_url==''){
                  position_url += 'role=' + position_text + '&role_id=' + position_id;
                  ind_url = (ind_url!='') ? '&'+ind_url : ind_url;
                  hobbies_url = (hobbies_url != '') ? '&'+hobbies_url : hobbies_url;
               }
               console.log('if',ind_url,position_url);
               currentUrl = "{{route('all-members')}}"+'?'+position_url+ind_url+hobbies_url;
            }else{
               
               currentUrl = "{{route('all-members')}}"+'?role=' + position_text + '&role_id=' + position_id;
            }

            console.log(currentUrl);
            window.location.href = currentUrl;// + join_simbol+'role=' + position_text + '&role_id=' + position_id;
            return false;
         })


         
      })
 //for hobbies
      $(document).ready(function() {

      $('.hobbies-list li').click(function() {
            const hobbies_text = $(this).attr('data-text');
            const hobbies_id = $(this).attr('data-id');
            var ind_url = position_url = hobbies_url = '';
            console.log($(this).attr('data-text'));
            var currentUrl_param = "{{Request::getRequestUri()}}";
            var join_simbol = '?';
            if(currentUrl_param.includes('?')){
               var splitUrl = currentUrl_param.split('?');

               var split_url2 = splitUrl[1].split('&');
               console.log('split_url2',split_url2);
               for (let index = 0; index < split_url2.length; index++) {
                  const element = split_url2[index];

                  if(split_url2[index].includes('hobbies=')){
                     hobbies_url +='hobbies=' + hobbies_text;
                     hobbies_url +='&hobbies_id=' + hobbies_id;
                  }
                  if(split_url2[index].includes('ind=') && !ind_url.includes('ind=')){
                     ind_url +=split_url2[index].replace('amp;','&')
                  }
                  if(split_url2[index].includes('ind_id') && !ind_url.includes('ind_id=')){
                     ind_url +=split_url2[index].replace('amp;','&')
                  }
                  if(split_url2[index].includes('role=') && !position_url.includes('role=')){
                     position_url +=split_url2[index].replace('amp;','&')
                  }

                  if(split_url2[index].includes('role_id=') && !position_url.includes('role_id=')){
                     position_url +=split_url2[index].replace('amp;','&')
                  }
                  
               }
               if(hobbies_url==''){
                  hobbies_url += 'hobbies=' + hobbies_text + '&hobbies_id=' + hobbies_id;
                  ind_url = (ind_url!='') ? '&'+ind_url : ind_url;
                  position_url = (position_url!='') ? '&'+position_url : position_url;
               }
               currentUrl = "{{route('all-members')}}"+'?'+hobbies_url+ind_url+position_url;
            }else{
               
               currentUrl = "{{route('all-members')}}"+'?hobbies=' + hobbies_text + '&hobbies_id=' + hobbies_id;
            }

            console.log(currentUrl);
            window.location.href = currentUrl; // + join_simbol+'hobbies=' + position_text + '&hobbies_id=' + position_id;
            return false;
         })
      })

      $('.radiogroup').change(function(e) {

         if ($(this).is(':checked')) {

            var oldurl = '{{route("signup")}}';
            $('#signup_tag').attr('href', oldurl + '/' + $(this).val());
         }

      });


      $('.signup_box').click(function() {
         $('.signup_box').removeClass('activeBox');
         $(this).addClass('activeBox');

      });
   
      $('.loadmore-requestlist').click(function() {
         //  const count_thumbnail = $('.personal-thumbprofile .thumbnail').length;
         const offset_value = $('.loadmore-requestlist').attr('data-limit');
         console.log(offset_value);
         $.ajax({
            url: "{{route('requestlist')}}",
            type: 'GET',
            dataType: 'json',
            data: {
               'limit': offset_value
            },
            success: function(data) {
               $('.loading_image').show();
               console.log(data.limit_value);
               $('.request-list-section').append(data.data);
               $('.loadmore-requestlist').attr('data-limit', data.limit_value);
               if (data.loadmore_btn == false) {
                  $('.loadmore-requestlist').hide();
               }
            }
         });
      });

      $('.loadmore-notification').click(function() {
         //  const count_thumbnail = $('.personal-thumbprofile .thumbnail').length;
         const offset_value = $('.loadmore-notification').attr('data-limit');
         console.log(offset_value);
         $.ajax({
            url: "{{route('notifications')}}",
            type: 'GET',
            dataType: 'json',
            data: {
               'limit': offset_value
            },
            success: function(data) {
               $('.loading_image').show();
              off = $('.loading-notification').append(data.data);
               console.log(off);
               $('.loadmore-notification').attr('data-limit', data.limit_value);
               if (data.loadmore_btn == false) {
                  $('.loadmore-notification').hide();
               }
            }
         });
      });


      $('.loadmore-personalprofile').click(function() {
         //  const count_thumbnail = $('.personal-thumbprofile .thumbnail').length;
         const offset_value = $('.loadmore-personalprofile').attr('data-limit');
         $.ajax({
            url: "{{route('loadmore-personal')}}",
            type: 'GET',
            dataType: 'json',
            data: {
               'limit': offset_value
            },
            success: function(data) {
               $('.loading_image').show();
               console.log(data.limit_value);
               $('.personal-thumbprofile').append(data.data);
               $('.loadmore-personalprofile').attr('data-limit', data.limit_value);
               if (data.loadmore_btn == false) {
                  $('.loadmore-personalprofile').hide();
               }
            }
         });
      });

      $('.loadmore-businessprofile').click(function() {
         //  const count_thumbnail = $('.personal-thumbprofile .thumbnail').length;
         const offset_value = $('.loadmore-businessprofile').attr('data-limit');
         $.ajax({
            url: "{{route('loadmore-business')}}",
            type: 'GET',
            dataType: 'json',
            data: {
               'limit': offset_value
            },
            success: function(data) {
               $('.loading_image').show();
               console.log(data.limit_value);
               $('.business-thumbprofile').append(data.data);
               $('.loadmore-businessprofile').attr('data-limit', data.limit_value);
               if (data.loadmore_btn == false) {
                  $('.loadmore-businessprofile').hide();
               }
            }
         });
      });

      $('.loadmore-likeprofile').click(function() {
         //  const count_thumbnail = $('.personal-thumbprofile .thumbnail').length;
         const offset_value = $('.loadmore-likeprofile').attr('data-limit');
         $.ajax({
            url: "{{route('loadmore-likeprofile')}}",
            type: 'GET',
            dataType: 'json',
            data: {
               'limit': offset_value
            },
            success: function(data) {
               $('.loading_image').show();
               console.log(data.limit_value);
               $('.likeprofile-thumbprofile').append(data.data);
               $('.loadmore-likeprofile').attr('data-limit', data.limit_value);
               if (data.loadmore_btn == false) {
                  $('.loadmore-likeprofile').hide();
               }
            }
         });
      });



      

   $('body').on('click','.sent-req',function(e) {
   
      e.preventDefault();
      var to_member = $(this).data('tomember');
         $.ajax({
            url: '{{route("sent-request")}}',
            type: 'POST',
            data: {
                  'to_member' : to_member,
                  '_token' :'{{ csrf_token() }}', 
            },
            success: function(data){
               if(data.success==true){

                  $('*[name=unsave'+to_member+']').hide();
                  $('*[name=saved'+to_member+']').show();
                  Swal.fire({
                     
                  title: '<span style="color:green">Success</span>',
                  text: "Request sent successfully",
                  imageUrl: '{{asset('frontend/images/spring-verse-logo.png')}}',
                  imageAlt: 'spring-verse',
                  // icon: 'success',
                  showConfirmButton: false,
                  timer: 2000,
   
                  });
               }
            }    
         })
   });

   /* like profile start */
   $('body').on('click','.like_profile_btn',function(e) {
      e.preventDefault();
      var profile_id = $(this).data('profileid');
      var profile_url = $(this).data('url');
      var this_section = $(this);
      console.log('profile_url',profile_url)
      $.ajax({
         url: '{{route("like-profile")}}',
         type: 'POST',
         data: {
               'profile_id' : profile_id,
               '_token' :'{{ csrf_token() }}', 
         },
         success: function(data){
            console.log(data)
            if(data.success==true){
               this_section.html(data.data);
            }
            if(profile_url && profile_url!=''){
               location.reload()
            }
         }    
       })
   });
   /* like profile start */

   $(document).ready(function(){
   $("#comment").hide();
      $("#accept").click(function(){
      $("#reject").attr('disabled','disabled');
      $("#accept").removeAttr('disabled');
      });
      $("#reject").click(function(){
         $("#accept").attr('disabled','disabled')
         $("#reject").removeAttr('disabled');
         $("#comment").show();
      });
   });


   $(document).ready(function() {
      $("select.select2").select2({
         ajax: {
            url: "{{route('recommend-friend-list')}}",
            type:"post",
            dataType: 'json',
            data: (params) => {
               return {
                  q: params.term,
                  _token: "{{csrf_token()}}",
                  username:"{{(isset($username) && $username!='') ? $username : ''}}"
               }
            },
            processResults: (data, params) => {
               console.log('data',data)
               const results = data.items.map(item => {
                  return {
                     id: item.id,
                     text: item.full_name || item.name,
                  };
               });
               return {
                  results: results,
               }
            },
         },
      });

      $("select.select3").select2({
         
         ajax: {
            url: "{{route('friend-list')}}",
            type:"post",
            dataType: 'json',
            data: (params) => {
               return {
                  q: params.term,
                  'gpid': params.term,
                  _token: "{{csrf_token()}}",
               }
            },
            processResults: (data, params) => {
               console.log('data',data,params)
               const results = data.items.map(item => {
                  return {
                     id: item.id,
                     text: item.full_name || item.name,
                  };
               });
               return {
                  results: results,
               }
            },
         },
      });
   })



   @if (session()->get('success'))

   Swal.fire({
      title: '<span style="color:green">Success</span>',
      text: "{!! session()->get('success') !!}",
   imageUrl: '{{asset('frontend/images/spring-verse-logo.png')}}',
   imageAlt: 'spring-verse',

   //   icon: 'success',
   showConfirmButton: false,
      timer: 2000,
   
   
   });
   @elseif (session()->get('error'))
   Swal.fire({
      title: '<span style="color:red">Error</span>',
   text: "{!! session()->get('error') !!}",
   imageUrl: '{{asset('frontend/images/spring-verse-logo.png')}}',
   imageAlt: 'spring-verse',
   //   icon: 'error',
   showConfirmButton: false,
   timer: 2000,
   
   });
   
@endif
/*
 $('.show-alert-delete-box').click(function(event){
       
        event.preventDefault();
        swal.fire({
            title: "Are you sure you want to delete this record?",
            text: "{!! session()->get('warning') !!}",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                  Swal.fire(
                     'Deleted!',
                     'Your file has been deleted.',
                     'warning'
                  )
            }
        });
    });
    */

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-primnary btn-theme mr-2 text-white',
    cancelButton: 'btn btn-default'
  },
  buttonsStyling: false
})

   $('.show-alert-delete-box').click(function(event){
      var deletegroup = $(this).find('a').attr('href');
      event.preventDefault();
      
      swalWithBootstrapButtons.fire({
         title: 'Are you sure?',
         text: "If you delete this, it will be gone forever.",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#9150a7',
         cancelButtonColor: '#fff',
         confirmButtonText: 'Yes, delete it!',
         closeOnConfirm: false
      }).then((result) => {
         if (result.isConfirmed) {
            console.log(deletegroup);
            
            window.location = deletegroup;
         }
      });
   });

   $('.remove-member').click(function(event){
      var deletegroup = $(this).attr('href');
      event.preventDefault();
      
      swalWithBootstrapButtons.fire({
         title: 'Are you sure?',
         text: "You want to remove this member",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#9150a7',
         cancelButtonColor: '#fff',
         confirmButtonText: 'Yes, remove it!',
         closeOnConfirm: false
      }).then((result) => {
         if (result.isConfirmed) {
            console.log(deletegroup);
            
            window.location = deletegroup;
         }
      });
   });


/*
 


   Swal.fire({
   title: 'Are you sure?',
   text: "{!! session()->get('warning') !!}",
   icon: 'warning',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Yes, delete it!',
   closeOnConfirm: false, 
      });


   
  */
   $('.img-Upload').on('change', function() {
      $(this).parent().find('.error').remove();
         const size = 
            (this.files[0].size / 1024).toFixed(2);
      console.log(size);
         if ( size > 1024) {
         $(this).parent().append('<span class="error">File size less than 1 MB</span>')
            //alert("File must be between the size of 2-4 MB");
         } 
   });  

   $("#profile-stepBtn4, #profile-stepBtn5").click(function(){
   
      $(this).attr('disabled',true);
      var member_inv = [];
      $('input[type=checkbox].member_invitation:checked').each((ind,ele) => {
         console.log(ind,ele);
         // if(elem.checked){
         member_inv.push(ele.value)
         // }
         });
      var urlpath = '{{route("createmeeting")}}';
      var topicname = $('input[name=topic]');
      var agendaname = $('input[name=agenda]');
      var duration = $('select[name=duration]');
      var meeting_start_time = $('input[name=meeting_start_time]');
      console.log(member_inv,urlpath,'{{csrf_token()}}',duration.val());
      $.ajax({
         url:urlpath,
         type:'post',
         data:{
         agendaname:agendaname.val(),
         duration:duration.val(),
         member_inv:member_inv,
         topicname:topicname.val(),
         profile_id:'{{(isset($matchprofile_flag)) ? $matchprofile_flag : ""}}',
         meeting_start_time:meeting_start_time.val(),
         _token:'{{csrf_token()}}',
         },
         success:function(res){
            console.log(res);
            $('.meeting_tt').text(res.start_time);
            $('.meeting_dt').text(res.start_date);
            $('.meetingjoinlink').text(res.join_url);
            $('#profile-stepBtn5').attr('href',res.start_link);
            $("#profile-step4").hide();
            $("#profile-step5").fadeIn();

            // Reload the page after a short delay (e.g., 1 second)
            setTimeout(function() {
               location.reload();
            }, 3000);

         }

      })

   });

   function copyToClipboard(element) {
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val($(element).text()).select();
      document.execCommand("copy");
      var tooltip = document.getElementById("myTooltip");
      tooltip.innerHTML = "Copied!";
      $temp.remove();
   }

function outFunc() {
  var tooltip = document.getElementById("myTooltip");
  /*tooltip.innerHTML = "Copy";*/
  var copu=  setTimeout( () => tooltip.innerHTML = "", 2000 );
  console.log(copu)
}

@if(!Auth()->check())

$('.logged-in-message').click(function(){

   Swal.fire({
      title: '<span style="color:red">Error</span>',
      text: "Please login to access spring verse features.",
   imageUrl: '{{asset('frontend/images/spring-verse-logo.png')}}',
   imageAlt: 'spring-verse',

   //   icon: 'success',
   showConfirmButton: false,
      timer: 2000,
});
   
});
@endif


/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction_dropdown() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}


var swiper = new Swiper(".mySwiper", {
      effect: "cards",
      grabCursor: false,
      pagination: {
       el: '.swiper-pagination',
       type: 'bullets',
     },
    });

</script>