@extends('layouts.contentLayoutMaster')
  {{-- page title --}} 
  @section('title',(isset($pagetitle) && $pagetitle!='') ? $pagetitle : 'Page') 
  {{-- vendor style --}} 
  @section('vendor-style')
 <link rel="stylesheet" type="text/css" href="{{url('assets/vendors/flag-icon/css/flag-icon.min.css')}}">
 <link rel="stylesheet" type="text/css" href="{{url('assets/vendors/dropify/css/dropify.min.css')}}"> 
 @endsection 
 {{-- page content --}} 
 @section('content') 
 <div class="section">
   <div class="card">
     <div class="card-content">
       {{(isset($pagetitle) && $pagetitle!='') ? $pagetitle : 'Page'}}
     </div>
   </div> 
   
   @include('panels.flash-message')
   
    <div class="row">
     <div class="col s12">
       <div id="html-validations" class="card card-tabs">
         <div class="card-content">
           <div class="card-title">
             <div class="row">
               <div class="col s12 m6 l10">
                 <h4 class="card-title">{{(isset($pagetitle) && $pagetitle!='') ? $pagetitle : 'Page'}}</h4>
               </div>
               <div class="col s12 m6 l2"></div>
             </div>
           </div>
           <div id="html-view-validations">
             {{-- <form class="formValidate0" id="formValidate0" method="post" action="{{route('patner-create')}}" enctype="multipart/form-data"> --}} 

                @if(isset($response->id)) 
                    <form class="formValidate0" id="formValidate0" enctype="multipart/form-data" method="post" action="{{route('membership-type.update',[$response->id])}}">
                      {{ method_field('PUT') }}
                    <input type="hidden" name="id" value="{{$response->id }}">
                    
                @else
                <form class="formValidate0" id="formValidate0" method="post" action="{{route('membership-type.store')}}" enctype="multipart/form-data"> 
               
                @endif

                <input type="hidden" name="_token" value="{{csrf_token()}}">
                 <div class="row">

                   <div class="input-field col s12">
                     <label for="title">Title<span class="red-text">*</span></label>
                     <input class="validate" required id="title" name="title" type="text" value="{{ (isset($response->title) && $response->title!='' ) ? $response->title : old('title') }}"> 
                     @error('title') 
                     <div style="color:red">{{ $message }}</div> 
                     @enderror
                   </div>

                 
                    <div class="input-field col m6 s12">

                        <?php
                    
                        if (isset($response->plan_period) && $response->plan_period != '') {
                            $plan_period_arr = $response->plan_period;
                        }
                        
                        // $pay_option = ['Annually', 'Monthly'];
                        $pay_option = membership_plan_period();//['Annually'=>'Annually fee', 'Monthly'=>'Springverse fee'];
                        ?>

                        <p> <label>Plan Period</label></p>
                        @foreach ($pay_option as $plan_k => $val)

                        <p>
                            <label>
                                <input type="radio" name="plan_period" value="{{$plan_k}}" {{ (!empty($plan_period_arr) && $plan_k == $plan_period_arr )  ? 'checked' : ''}}>
                                <span>{{ ucfirst($val) }}</span>
                                @error('plan_period')
                                <div class="alert-danger">{{$message}}</div>
                                @enderror
                            </label>
                        </p>
                        @endforeach
                    </div>

                    <div class="input-field col s12">
                     <label for="main_price">Main Price<span class="red-text">*</span></label>
                     <input class="validate" required id="main_price" name="main_price" type="text" value="{{ (isset($response->main_price) && $response->main_price!='' ) ? $response->main_price : old('main_price') }}"> 
                     @error('main_price') 
                     <div style="color:red">{{ $message }}</div> 
                     @enderror
                   </div>

                   <div class="input-field col s12">
                     <label for="offer_price">Offer Price<span class="red-text">*</span></label>
                     <input class="validate" required id="offer_price" name="offer_price" type="text" value="{{ (isset($response->offer_price) && $response->offer_price!='' ) ? $response->offer_price : old('offer_price') }}"> 
                     @error('offer_price') 
                     <div style="color:red">{{ $message }}</div> 
                     @enderror
                   </div>

                   <div class="input-field col s12">
                     <label for="membership_type">Membership Type</label>
                     <input class="validate" required id="membership_type" name="membership_type" type="text" value="{{ (isset($response->membership_type) && $response->membership_type!='' ) ? $response->membership_type : old('membership_type') }}"> 
                     @error('membership_type') 
                     <div style="color:red">{{ $message }}</div> 
                     @enderror
                   </div>

                   <div class="input-field col s12">
                     <label for="description">Description<span class="red-text">*</span></label>
                     <textarea name="description" id="description" rows="4" class="materialize-textarea" required>{{ (isset($response->description) && $response->description != '' ) ? $response->description : old('description') }}</textarea>
                     @error('description') 
                     <div style="color:red">{{ $message }}</div> 
                     @enderror
                   </div>
                   
                   <div class="input-field col s12">
                       <label for="additional_option">Aditional Option</label>
                   <textarea id="additional_option" class="materialize-textarea" name="additional_option">{{ (isset($response->additional_option) && $response->additional_option!='' ) ? $response->additional_option : old('additional_option') }}</textarea>
                     @error('additional_option') 
                     <div style="color:red">{{ $message }}</div> 
                     @enderror
                   </div>


                   
                   <div class="input-field col s12">
                     <div id="file-upload" class="section">
                       <!--Default version-->
                       <div class="row ">
                         <div class="col s12">
                           <div class="col s12 m4 m12">
                             <label for="logo">Image</label>
                           </div>
                           <div class="col s3">

                             @if(isset($response->image)&& $response->image!="")
                                <div class="form-group input-group">
                                    <img src="{{  url('/').'/assets/membership/'.$response->image }}" width="100" height="100">
                                </div>
                            @endif
                             <input type="file" id="input-file-now" name="image" class="dropify" data-default-file="{{(isset($response->image) && !empty($response->image != '')) ? url('/') .'/assets/membership/'.$response->image :''}}" value="{{ isset($response->image) ? $response->image : ''}}" accept="image/*" />

                            
                           </div>
                         </div>
                       </div>
                     </div> 
                     @error('image') 
                     <div style="color:red">{{ $message }}</div> 
                     @enderror
                   </div>
                   

                  
                   <div class="input-field col s12">
                     <button class="btn waves-effect waves-light right" type="submit">Submit <i class="material-icons right">send</i>
                     </button>
                   </div>
                 </div>
               </form>
           </div>
         </div>
       </div>
     </div>
   </div> 
   @endsection @section('vendor-script') 
   <script src="{{url('assets/vendors/materialize-stepper/materialize-stepper.min.js')}}"></script>
   <script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
   <script src="{{url('assets/vendors/dropify/js/dropify.min.js')}}"></script> 
   @endsection 
   {{-- page script --}} 
   @section('page-script') 
   <script src="{{asset('js/scripts/form-validation.js')}}"></script>
   <script src="{{url('assets/js/scripts/form-file-uploads.js')}}"></script> 
   @endsection