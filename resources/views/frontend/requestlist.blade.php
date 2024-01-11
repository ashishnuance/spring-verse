@extends('frontend.layouts.frontLayout')
@section('content')

<!-- notificaton-section -->
<div class="notificaton-section myaction-section">
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
                <h3>Request List</h3>
                <!-- notification-bar-->
    
                {{-- @php $dategroup = ''; @endphp  --}}
    
                <div class=" request-list-section">
                    @include('frontend.includes.request-list-section')
                </div>
    
                @if(isset($requestlist_total_count) && $requestlist_total_count > 0 )
                @if( $requestlist_total_count >5)
                <div> <a href="javascript:void(0);" class="btn btn-load_search loading_image loadmore-requestlist"
                        data-limit="10">Load More Member<i class="fa-solid fa-caret-down"></i></a></div>
                @endif
    
                @else
                <div class="row ten-columns">
                    <div class="col-lg-12">
                        <div class="NoUserFound">
                            <h2>No User Found</h2>
                        </div>
                    </div>
                </div>
                @endif
    
                <!-- row -->
    
                <!-- notification-box -->
    
    
                {{-- @if(isset($requestlist_total_count) && $requestlist_total_count>0)
                  @if( $requestlist_total_count >10)
    
                     <div class="loading-btn"> <a href="javascript:void(0);" class="btn btn-loadmore">Load More <i class="fa-solid fa-caret-down"></i></a></div>
                  
                  @endif
               @else
               <div class="row ten-columns">
                  <div class="col-lg-12">
                        <div class="NoUserFound">
                     <h2>No User Found</h2>
                  </div>
               </div>
               </div>
            @endif --}}
            </div>
        </div>

        <!-- container-fluid-->
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
    <!-- container -->
</div>
<!-- notificaton-section -->

@endsection