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
                    <form class="formValidate0" id="formValidate0" enctype="multipart/form-data" method="post" action="{{route('profile-type.update',[$response->id])}}">
                      {{ method_field('PUT') }}
                    <input type="hidden" name="id" value="{{$response->id }}">
                    
                @else 
                    <form class="formValidate0" id="formValidate0" method="post" action="{{route('profile-type.store')}}" enctype="multipart/form-data"> 
                @endif

                <input type="hidden" name="_token" value="{{csrf_token()}}">
                 <div class="row">

                   <div class="input-field col s12">
                     <label for="name">Name<span class="red-text">*</span></label>
                     <input class="validate" required id="name" name="name" type="text" value="{{ (isset($response->name) && $response->name!='' ) ? $response->name : old('name') }}"> 
                     @error('name') 
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