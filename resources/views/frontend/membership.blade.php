@extends('frontend.layouts.frontLayout')
 @section('content')
      <!-- header -->
      <div class="membership-section myaction-section">
         <div class="container">
            <div class="row">
             <div class="col-lg-2 col-sm-4">
                  <div class="accountbox">
                     <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                     @include('frontend.myaccount.sidebarmenu')
                     <!-- /.navbar-collapse -->
                  </div>
                  <!-- accountbox -->
               </div>
               <div class="col-md-9">

               <div class=" col-lg-11">
                  <div class="membership-header">
                     <div>
                     
                        <h1>Choose your membership</h1>
                     </div>
                     <a href="{{route('myaccount')}}" class="btn btn-personal_continue">Back</a href="">
                     {{-- <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                           <li role="presentation" class="active"><a href="#monthly" aria-controls="monthly" role="tab" data-toggle="tab">Monthly</a></li>
                           <li role="presentation"><a href="#annually" aria-controls="annually" role="tab" data-toggle="tab">Annual</a></li>
                        </ul>
                     </div> --}}
                  </div>

                  <div class="row" style="display: flex;">
                     @if(isset($membership) && $membership!='')
                        @foreach($membership as $key=>$val)
                        <?php
                        $plan_period = (isset($val->plan_period) && $val->plan_period=='Annually') ? '+1 year' : '+1 month'; 
                        
                        ?>
                        <div class="col-md-6 col-sm-6">
                           <div class="membership-plan">
                              <h1>{{ (isset($val->title) && $val->title!='' ) ? $val->title	 :'' }} {{--<span>(Year/annually)</span>--}}</h1>
                              <h4>{{ (isset($val->plan_period) && $val->plan_period!='' ) ? membership_plan_period($val->plan_period)	 :'' }}</h4>
                              
                              <h3>{{env('CURRENCY')}}{{ (isset($val->main_price) && $val->main_price!='' ) ? $val->main_price	 :'' }}</h3>
                              <h6>
                                 {{ (isset($val->membership_type) && $val->membership_type!='' ) ? $val->membership_type	 :'' }}
                              </h6>
                           
                              <p class="description">{!! (isset($val->description) && $val->description!='' ) ? $val->description	 :'' !!}</p>

                              <h5>
                                 {{ (isset($val->additional_option) && $val->additional_option!='' ) ? $val->additional_option	 :'' }}
                              </h5>

                              
                              @if(isset($user_plan_list) && $user_plan_list->plan_id==$val->id)
                              
                              <h4> Expire on {{ date('d-m-Y',strtotime($user_plan_list->created_at.$plan_period ) )}} </h4>

                              @else

                              <a href="{{route('payment_details',[base64_encode($val->id)])}}" class="btn btn-choose" >Choose SPNY - Resident</a>
                           
                              @endif
                           </div>
                        </div>
                           @endforeach
                     @endif
                     <!-- membership-plan -->
                     <!-- col -->
                          
                  </div>
                  <!-- membership-header -->
                  <!-- Tab panes -->
                  {{-- <div class="tab-content">
                     <div role="tabpanel" class="tab-pane active" id="monthly">
                        
                        <!-- row -->     
                        
                        <!-- row -->
                     </div>
                     <!-- tab1 monthly -->
                     <div role="tabpanel" class="tab-pane" id="annually">
                        <div class="row">
                           <div class="col-md-6 col-sm-6">
                              <div class="membership-plan">
                                 <h1>SPNY - Local <span>(Annual)</span></h1>
                                 <h4>Annually</h4>
                                 <h3>$5500.00</h3>
                                 <p>
                                    Access to our New York and Beverly Hills <span class="block"></span> clubs, inclusive of 
                                 </p>
                                 <ul>
                                    <li><i class="fa-solid fa-circle-check"></i> All communal areas (including the conservatory, bar, lounge)</li>
                                    <li><i class="fa-solid fa-circle-check"></i> All shared coworking spaces, complimentary phone booths <br /> and cabinet rooms</li>
                                    <li><i class="fa-solid fa-circle-check"></i> Own dedicated desk in our resident area.</li>
                                    <li><i class="fa-solid fa-circle-check"></i> All workplace amenities, coffee, tea and snacks </li>
                                    <li><i class="fa-solid fa-circle-check"></i> All programming and entertainment </li>
                                 </ul>
                                 <h5>
                                    Additional options for conference room bookings.
                                 </h5>
                                 <p>
                                    <a href="terms_condition.html" class="btn btn-choose">Choose SPNY - Local</a>
                                 </p>
                              </div>
                              <!-- membership-plan -->
                           </div>
                           <!-- col -->
                           <div class="col-md-6 col-sm-6">
                              <div class="membership-plan">
                                 <h1>SPNY - Local <span>(Annual)</span></h1>
                                 <h4>Annually</h4>
                                 <h3>$4000.00</h3>
                                 <p>
                                    Access to our New York and Beverly Hills <span class="block"></span> clubs, inclusive of 
                                 </p>
                                 <ul>
                                    <li><i class="fa-solid fa-circle-check"></i> All communal areas (including the conservatory, bar, lounge)</li>
                                    <li><i class="fa-solid fa-circle-check"></i> All shared coworking spaces, complimentary phone booths <br /> and cabinet rooms</li>
                                    <li><i class="fa-solid fa-circle-check"></i> All workplace amenities, coffee, tea and snacks </li>
                                    <li><i class="fa-solid fa-circle-check"></i> All programming and entertainment </li>
                                    <li>&nbsp;</li>
                                 </ul>
                                 <h5>
                                    Additional options for conference room bookings.
                                 </h5>
                                 <p>
                                    <a href="terms_condition.html" class="btn btn-choose">Choose SPNY - Local, Under-30</a>
                                 </p>
                              </div>
                              <!-- membership-plan -->
                           </div>
                        </div>
                        <!-- row -->     
                     </div>
                     <!-- tab2 annually-->
                  </div> --}}
                  <!-- tab -->
               </div>
               </div>

               <!-- col-->
            </div>
            <!-- row -->
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                     <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Profile Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">×</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <div class="img-container">
                           <div class="row">
                           
                           <div class="col-lg-11">
                              <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                           </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-theme" id="crop">Crop and Save</button>
                     </div>
                     </div>
                  </div>
               </div>  
         </div>
      </div>
      <!-- membership-section -->
      <!-- footer -->
      @endsection