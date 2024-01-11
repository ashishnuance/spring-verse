

@extends('frontend.layouts.frontLayout')
@section('content')
      <!-- header -->   
      <!-- create-group -->
      <div class="create-group">
         <div class="container">
            <div class="container-fluid">
               <h1>Create Group</h1>
               <div class="row">
                  <div class="col-sm-8 col-lg-10">
                     <h3>Group Details</h3>
                     @include('frontend.includes.validation')

                     @include('frontend.includes.flashMessage')

                    <form action="{{route('group-add')}}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="">
                    
                   
                      @csrf

                     <div class="create-box">
                        <label for="">Group Name*</label>
                        <input type="text" placeholder="" class="form-control" name="grp_name" id="" value="{{old('grp_name')}}" oninput="this.value=this.value.replace(/[^a-z0-9 ]/g,'');">
                     </div>
                     <!-- create-box -->
                     <div class="create-box">
                        <label for="">What is the purpose of your group?*</label>
                        <input type="text" placeholder="" class="form-control" name="description" id="" value="{{old('description')}}">
                     </div>
                     <!-- create-box -->
                     <div class="create-box">
                        <label for="">Group Tags*</label>
                        
                        <input placeholder="Add tags to group"  id="group_tags" class="form-control" name="tag" value="" data-role="tagsinput" type="text" value="{{old('tag')}}">
                        {{-- <div class="hobbies-btn">
                           <a href="" class="btn">Swimming</a>
                           
                        </div> --}}
                     </div>
                     <div class="create-box">
                        
                        <label for="">Group Image<span class="red-text"  style="color:red"> (NOTE:Max image size 200x200)</span></label>
                        <input type="file" placeholder="" class="form-control img-Upload" name="grp_profile" id="fileUpload" accept="image/*" data-max-width="201" data-max-height="201" value="{{old('grp_profile')}}" >

                     </div>
                     <!-- create-box -->
                     <p class="create-groupbtn">
                        
                        <button class="btn"  type="submit">Create Group</button>
                     </p>
                    </form>
                  </div>

                  {{-- <div class="col-sm-4 col-lg-2">
                     <div class="change-photo">
                        <img src="{{asset('frontend/images/group-img.png')}}" alt="" name="grp_profile">
                        <p>
                           <a href="">Change Profile Photo</a>
                        </p>
                     </div>
                     <!-- change-photo -->
                  </div> --}}
               </div>
               <!-- row -->
            </div>
            <!-- container-fluid -->
         </div>
         <!-- container -->
      </div>
      <!-- create-group -->
      <!-- footer -->
      @endsection