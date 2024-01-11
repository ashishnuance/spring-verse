@extends('frontend.layouts.frontLayout')

@section('content')
      <!-- header -->
      <div class="terms_condition">
         <div class="container">
            <div class="row">
               <div class="col-lg-offset-1 col-lg-10">
                  <h1>Review terms and conditions</h1>
                  <h3>Terms and Conditions for SPNY - Resident (Monthly)</h3>
                  <p>Our club rules as well as terms and conditions are part of your membership agreement and can be found in the latest <br> version under</p>
                  <p class="termscondition-links"> 
                     <a href="" class="">https://www.springplace.com/club-rules</a>
                     <a href="" class="">https://www.springplace.com/terms-and-conditions</a>
                  </p>
                  <div>
                     <a href="{{route('terms-condition-accept')}}" class="btn btn-terms">Agree and Continue</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- terms_condition -->
      <!-- footer -->
@endsection
  