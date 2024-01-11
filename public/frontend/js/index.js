



$(document).ready(function(){


    $("#profile-stepBtn1").click(function(e){
     /* e.preventDefault();*/
     $('#time').parent().find('span.error').remove();

      var time = $('input[name=person_meetingdate_time]').val();


      
      if(time!=''){

      $("#profile-step1").hide();

      $("#profile-step2").fadeIn();
      }else{
         
  
      $('#time').parent().append('<span class="error" style=" width: 100%; display: block;">This Feild is required.</span>')

            return false
      }

    });



    $("#profile-stepBtn2").click(function(){

        $("#profile-step2").hide();

        $("#profile-step3").fadeIn();

      });



      $("#profile-stepBtn3").click(function(){

        $("#profile-step3").hide();

        $("#profile-step4").fadeIn();

      });



      $("#profile-stepBtn4").click(function(){

        $("#profile-step4").hide();

        $("#profile-step5").fadeIn();

      });







      $("#group-stepBtn1").click(function(){

        $("#group-step1").hide();

        $("#group-step2").fadeIn();

      });

  

      $("#group-stepBtn2").click(function(){

          $("#group-step2").hide();

          $("#group-step3").fadeIn();

        });

  

        $("#group-stepBtn3").click(function(){

          $("#group-step3").hide();

          $("#group-step4").fadeIn();

        });

  

        $("#group-stepBtn4").click(function(){

          $("#group-step4").hide();

          $("#group-step5").fadeIn();

        });



        $("#group-stepBtn5").click(function(){

          $("#group-step5").hide();

          $("#group-step6").fadeIn();

        });

  





        // $(function () {

        //   $('[data-toggle="calendar"] > .row > .calendar-day > .events > .event').popover({

        //     container: 'body',

        //     content: 'Hello World',

        //     html: true,

        //     placement: 'bottom',

        //     template: '<div class="popover calendar-event-popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'

        //   });

        

        //   $('[data-toggle="calendar"] > .row > .calendar-day > .events > .event').on('show.bs.popover', function () {

        //     var attending = parseInt($(this).find('div.progress>.progress-bar').attr('aria-valuenow')),

        //       total = parseInt($(this).find('div.progress>.progress-bar').attr('aria-valuemax')),

        //       remaining = total - attending,

        //       displayAttending = attending - $(this).find('div.attending').children().length,

        //       html = [

        //         '<button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>',

        //         '<h4>'+$(this).find('h4').text()+'</h4>',

        //         '<div class="desc">'+$(this).find('div.desc').html()+'</div>',

        //         '<div class="location">'+$(this).find('div.location').html()+'</div>',

        //         '<div class="datetime">'+$(this).find('div.datetime').html()+'</div>',

        //         '<div class="space">Attending <span class="pull-right">Available spots</span></div>',

        //         '<div class="attending">',

        //           $(this).find('div.attending').html(),

        //           '<span class="attending-overflow">+'+displayAttending+'</span>', 

        //           '<span class="pull-right">'+remaining+'</span>',

        //         '</div>',

        //         '<a href="#signup" class="btn btn-success" role="button">Sign up</a>'

        //       ].join('\n');

        

        //     $(this).attr('title', $(this).find('h4').text());

        //     $(this).attr('data-content', html);

        //   });

        

        //   $('[data-toggle="calendar"] > .row > .calendar-day > .events > .event').on('shown.bs.popover', function () {

        //     var $popup = $(this);

        //     $('.popover:last-child').find('.close').on('click', function(event) {

        //       $popup.popover('hide');

        //     });

        //   });

        // });



        $("[data-toggle=popover]").each(function(i, obj) {



          $(this).popover({

            html: true,

            content: function() {

              var id = $(this).attr('id')

              return $('#popover-content-' + id).html();

            }

          });

          

          });



      

  });