@extends('layouts.contentLayoutMaster')
{{-- page title --}} 
@section('title','social link') 
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

                  @if(isset($response->id)) 
                  <form class="formValidate0" id="formValidate0" enctype="multipart/form-data" method="post" action="{{route('social.update',[$response->id])}}">
                    {{ method_field('PUT') }}
                  <input type="hidden" name="id" value="{{$response->id }}">
                  
                  @else 
                  <form class="formValidate0" id="formValidate0" method="post" action="{{route('social.store')}}"> 
                  @endif
                  <input type="hidden" name="_token" value="{{csrf_token()}}">

               <div class="row">

                 <div class="input-field col s12">
                   <label for="name">Facebook<span class="red-text">*</span></label>
                   <input class="" id="facebook" name="facebook" type="url" value="{{(isset($response->facebook) && $response!='') ? $response->facebook : old('facebook')}}" required> 
                   @error('facebook') 
                   <div style="color:red">{{ $message }}</div> 
                   @enderror
                 </div>
                 <div class="input-field col s12">
                  <label for="">Twitter<span class="red-text">*</span></label>
                  <input class="" id="twitter" name="twitter" type="url" value="{{(isset($response->twitter) && $response!='') ? $response->twitter : old('twitter')}}" required> 
                  @error('twitter') 
                  <div style="color:red">{{ $message }}</div> 
                  @enderror
                </div>  
                <div class="input-field col s12">
                  <label for="">Youtube<span class="red-text">*</span></label>
                  <input class="" id="youtube" name="youtube" type="url" value="{{(isset($response->youtube) && $response!='') ? $response->youtube : old('youtube')}}" required> 
                  @error('youtube') 
                  <div style="color:red">{{ $message }}</div> 
                  @enderror
                </div>  
                <div class="input-field col s12">
                  <label for="">Snapchat<span class="red-text">*</span></label>
                  <input class="" id="snapchat" name="snapchat" type="url" value="{{(isset($response->snapchat) && $response!='') ? $response->snapchat : old('snapchat')}}" required> 
                  @error('snapchat') 
                  <div style="color:red">{{ $message }}</div> 
                  @enderror
                </div>
                <div class="input-field col s12">
                  <label for="">Instagram<span class="red-text">*</span></label>
                  <input class="" id="instagram" name="instagram" type="url" value="{{(isset($response->instagram) && $response!='') ? $response->instagram : old('instagram')}}" required> 
                  @error('instagram') 
                  <div style="color:red">{{ $message }}</div> 
                  @enderror
                </div>
              </div>  

                 <div class="input-field col s12">
                   <button class="btn waves-effect waves-light right" type="submit">Submit
                   </button>
                 </div>
               </div>
             </form>
         </div>
       </div>
     </div>
   </div>
 </div> 
 @endsection 
 @section('vendor-script') 
 <script src="{{url('assets/vendors/materialize-stepper/materialize-stepper.min.js')}}"></script>
 <script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
 <script src="{{url('assets/vendors/dropify/js/dropify.min.js')}}"></script> 
 @endsection 
 {{-- page script --}} 
 @section('page-script') 
 <script src="{{asset('js/scripts/form-validation.js')}}"></script>
 <script src="{{url('assets/js/scripts/form-file-uploads.js')}}"></script> 
 @endsection