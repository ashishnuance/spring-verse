@extends('frontend.layouts.calendarlayout')

@section('content')
<div class="container">
   <div class="container-fluid">
      <div class="notification-bar">
         <h1>My Calendar</h1>
      </div>
      <div class="calendar-box">
         {{--
         <section id="popper-section">
            <button id="popper-button">Toggle Popover</button>
            <div id="popper-popup" class="popover-content">
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

               <div id="popper-arrow"></div>
            </div>
         </section>
--}}
         <div id="calendar"></div>
      </div>
   </div>
</div>


<!-- Modal -->
<div id="createEventModal" class="modal fade" role="dialog">
   <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Event</h4>
         </div>
         <div class="modal-body">
            <div class="control-group">
               <label class="control-label" for="inputPatient">Event:</label>
               <div class="field desc">
                  <input class="form-control" id="title" name="title" placeholder="Event" type="text" value="">
               </div>
            </div><br>
            <div class="control-group">
               <label class="control-label" for="inputPatient">Color:</label>
               <div class="field desc">
                  <select class="form-control" id="color" name="color" placeholder="Color" type="text" value="">
                     <option value="#FF0000">Red</option>
                     <option value="#800000">Maroon</option>
                     <option value="#FFFF00">Yellow</option>
                     <option value="#008000">Green</option>
                     <option value="#00FF00">Light Green</option>
                     <option value="#00FFFF">Aqua</option>
                     <option value="#0000FF">Blue</option>
                     <option value="#000080">Navy</option>
                     <option value="#FF00FF">Fuchsia</option>
                     <option value="#800080">Purple</option>
                  </select>
               </div>
            </div>

            <input type="hidden" id="startTime" />
            <input type="hidden" id="endTime" />

            <div class="control-group" style="display:none;">
               <label class="control-label" for="when">When:</label>
               <div class="controls controls-row" id="when" style="margin-top:5px;">
               </div>
            </div>

         </div>
         <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
         </div>
      </div>

   </div>
</div>


<div id="calendarModal" class="modal fade">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Event Details</h4>
         </div>
         <div id="modalBody" class="modal-body">
            <h4 id="title" class="modal-title"></h4>
            <div id="modalWhen" style="margin-top:5px;"></div>
         </div>
         <input id="eventID" />
         <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
         </div>
      </div>
   </div>
</div>
@endsection
