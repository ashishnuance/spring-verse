
@extends('frontend.layouts.frontLayout')
@section('content')
      <!-- header -->
      <div class="terms_condition">
         <div class="container">
            <div class="row">
               <div class="col-lg-offset-1 col-lg-10">
                  <h1>Payment Successful</h1>
                  <h3>Your payment of ${{session()->get('paid_amount')}} has been successful</h3>
                  <div><a href="{{route('home')}}" class="btn btn-terms btn-md">Go to home</a></div>
               </div>
            </div>
         </div>
      </div>
      <!-- terms_condition -->
      <!-- footer -->
@endsection
 