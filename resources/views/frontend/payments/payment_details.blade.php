@extends('frontend.layouts.frontLayout')
@section('content')
<!-- header -->
<div class="personal_detail">
   <div class="container">
      <div class="row">
       
         @include('frontend.includes.flashMessage')
         <form action="{{route('payment_save')}}" method="post" id="payment_save" />
         <input type="hidden" name="_token" value="{{csrf_token()}}"/>
         <input type="hidden" name="plan_id" value="{{(isset($plan_detail) && $plan_detail->id!='') ? $plan_detail->id : ''}}"/>
         <div class="col-lg-offset-2 col-lg-6">
                  <h2>Your Payment Details</h2>
                  <h3>Pay by Credit/Debit Card</h3>
                  <h5>Amount to Pay: {{(isset($plan_detail) && $plan_detail->offer_price!='') ? $plan_detail->offer_price : 1}}</h5>
                  <h5>Your card details</h5>
                  <div class="form-group form-group-default">
                     <label class="control-label">Full Name</label>
                     <input type="text" placeholder="Your Name" name="fullName" value="{{(isset($user_info->first_name) && $user_info->first_name!='') ? $user_info->first_name : ''}}" class="form-control" required="">
                  </div>
                  
                  <!--inner row-->
                  <div class="">
                     <div class="form-group form-group-default">
                        <label class="control-label">Address</label>
                        <input type="text" placeholder="Address" name="address" value="{{(isset($user_info->address) && $user_info->address!='') ? $user_info->address : ''}}" class="form-control" required="">
                     </div>
                     <div class="form-group form-group-default">
                        <label class="control-label">Country</label>
                        <input type="text" placeholder="Country" name="country" value="{{(isset($user_info->country) && $user_info->country!='') ? $user_info->country : ''}}" class="form-control" required="">
                     </div>
                     <div class="row">
                        <div class="col-sm-4 col-md-4">
                           <div class="form-group form-group-default">
                              <label class="control-label">Town / City</label>
                              <input type="text" placeholder="City" name="city" value="{{(isset($user_info->city) && $user_info->city!='') ? $user_info->city : ''}}" class="form-control" required="">
                           </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                           <div class="form-group form-group-default">
                              <label class="control-label">State / Province</label>
                              <input type="text" placeholder="State" name="state" value="{{(isset($user_info->state) && $user_info->state!='') ? $user_info->state : ''}}" class="form-control" required="">
                           </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                           <form action="" class="needs-validation">
                           <div class="form-group form-group-default required">
                              <label class="control-label">Zip / Postcode</label>
                              <input type="text" placeholder="Zip code" name="pincode" value="{{(isset($user_info->postal_code) && $user_info->postal_code!='') ? $user_info->postal_code : ''}}" class="form-control" required="">
                           </div>
                        </div>
                     </div>
                  </div>
                  </form>
                  
                  <div class="p-btn-group">
                     <a href="{{route('membership-plan')}}" class="btn btn-personal_continue">Back</a href="">
                        <form action="{{route('payment_savstrip')}}" method="POST" id="payment_savstrip">
                           <input type="hidden" name="billing_detail" id="billing_detail"/>
                           <input type="hidden" name="currency" value="usd"/>
                           <input type="hidden" name="plan_id" value="{{(isset($plan_detail) && $plan_detail->id!='') ? $plan_detail->id : ''}}"/>
                           <input type="hidden" name="amount" value="{{(isset($plan_detail) && $plan_detail->offer_price!='') ? $plan_detail->offer_price*100 : 100}}"/>
                           {{ csrf_field() }}
                           <script
                                   src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                   data-key="pk_live_jU8iKscpyZ0NiIjRTpjFDWqJ"
                                   data-amount="{{(isset($plan_detail) && $plan_detail->offer_price!='') ? $plan_detail->offer_price*100 : 100}}"
                                   data-name="Stripe"
                                   data-description="Online course about integrating Stripe"
                                   data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                   data-locale="auto"
                                   data-currency="usd">
                           </script>
                       </form>
                     {{-- <button class="btn btn-personal_continue" type="submit">Pay Now</button> --}}
                     
                  </div>
               </div>
               
               <!-- main offst col  -->
            </div>
            <!-- mainrow -->
         </div>
         <!-- container -->
      </div>
      <!-- personal detals -->
      <!-- footer -->
@endsection

