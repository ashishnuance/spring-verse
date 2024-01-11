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
   </div> @include('panels.flash-message') <div class="row">
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
              <form class="formValidate0" id="formValidate0" enctype="multipart/form-data" method="post" action="{{route('patner_update')}}">
               <input type="hidden" name="id" value="{{$response->id }}">
               <input type="hidden" name="old_img" value="{{ $response->logo }}"> 
               @else 
               <form class="formValidate0" id="formValidate0" method="post" action="{{route('patner_create')}}" enctype="multipart/form-data"> 
                @endisset 
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                 <div class="row">

                   <div class="input-field col s12">
                     <label for="company_name">Company Name<span class="red-text">*</span></label>
                     <input class="validate" required id="company_name" name="company_name" type="text" value="{{ (isset($response->company_name) && $response->company_name!='' ) ? $response->company_name : old('company_name') }}"> 
                     @error('company_name') 
                     <div style="color:red">{{ $message }}</div> 
                     @enderror
                   </div>

                   <div class="input-field col s12">
                     <label for="patner_location">Patner Location<span class="red-text">*</span></label>
                     <input class="validate" required id="patner_location" name="patner_location" type="text" value="{{ (isset($response->patner_location) && $response->patner_location!='' ) ? $response->patner_location	 : old('patner_location') }}"> 
                     @error('patner_location') 
                     <div style="color:red">{{ $message }}</div> 
                     @enderror
                   </div>

                   <div class="input-field col s12">
                     <label for="contact_name">Contact Name</label>
                     <input class="validate" required id="contact_name" name="contact_name" type="text" value="{{ (isset($response->contact_name) && $response->contact_name!='' ) ? $response->contact_name	 : old('contact_name') }}"> 
                     @error('contact_name') 
                     <div style="color:red">{{ $message }}</div> 
                     @enderror
                   </div>


                   <div class="input-field col s12">
                     <select name="type" id="type">
                       <option value="Select" disabled selected>Select Type</option>

                       <option value="Gym" {{ (isset($response->type) && $response->type == "Gym") ? 'selected' : '' }}>Gym</option>
                       <option value="Party" {{ (isset($response->type) && $response->type == "Party") ? 'selected' : '' }}>Party</option>
                       <option value="Restaurant" {{ (isset($response->type) && $response->type == "Restaurant") ? 'selected' : '' }}>Restaurant</option>

                     </select> 
                        @error('type') 
                        <div style="color:red">{{ $message }}</div> 
                        @enderror
                   </div>

                   <div class="input-field col s12">
                     <label for="email">Email</label>
                     <input class="validate" required id="email" name="email" type="email" value="{{ (isset($response->email) && $response->email != '' ) ? $response->email : old('email') }}">
                     @error('email') 
                     <div style="color:red">{{ $message }}</div> 
                     @enderror
                   </div>


                   <div class="input-field col s12">
                     <label for="mobile">Mobile</label>
                     <input class="validate" required id="mobile" name="mobile" type="number" value="{{ (isset($response->mobile) && $response->mobile != '' ) ? $response->mobile : old('mobile') }}">
                     @error('mobile') 
                     <div style="color:red">{{ $message }}</div> 
                     @enderror
                   </div>

                    <div class="input-field col s12">
                     <label for="website">Website</label>
                     <input class="validate" required id="website" name="website" type="url" value="{{ (isset($response->website) && $response->website != '' ) ? $response->website : old('website') }}">
                     @error('website') 
                     <div style="color:red">{{ $message }}</div> 
                     @enderror
                   </div>

                   <div class="input-field col s12">
                     <label for="social_media">Social Media</label>
                     <input class="validate" required id="social_media" name="social_media" type="text" value="{{ (isset($response->social_media) && $response->social_media != '' ) ? $response->social_media : old('social_media') }}">
                     @error('social_media') 
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
                     <div id="file-upload" class="section">
                       <!--Default version-->
                       <div class="row ">
                         <div class="col s12">
                           <div class="col s12 m4 m12">
                             <label for="logo">logo<span class="red-text">*</span></label>
                           </div>
                           <div class="col s3">

                             @if(isset($response->logo)&& $response->logo!="")
                                <div class="form-group input-group">
                                    <img src="{{  url('/').'/assets/uploadimage/'.$response->logo }}" width="100" height="100">
                                </div>
                            @endif
                             <input type="file" id="input-file-now" name="logo" class="dropify" data-default-file="{{(isset($response->logo) && !empty($response->logo != '')) ? url('/') .'/assets/uploadimage/'.$response->logo :''}}" value="{{ isset($response->logo) ? $response->logo : ''}}" accept="image/*" />

                            
                           </div>
                         </div>
                       </div>
                     </div> 
                     @error('logo') 
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