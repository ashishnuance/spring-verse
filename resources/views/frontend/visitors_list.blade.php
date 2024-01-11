 @extends('frontend.layouts.frontLayout')
 @section('content')

<!-- notificaton-section -->
      <div class="notificaton-section">
         <div class="container business-thumbprofile">
            <div class="container-fluid">
               <h3>Visitors</h3>
               
               <div class="loading-notification">
               @include('frontend.includes.visitors_list_section')
               </div>
                 
                 

               @if(isset($visitors_list_count) && $visitors_list_count > 0 )
                    @if( $visitors_list_count > 10)

                  <div><a href="javascript:void(0);" class="btn btn-load_search loading_image loadmore-notification" data-limit="10">Load More Member<i class="fa-solid fa-caret-down"></i></a></div>
                   @endif
               @else
               
               <div class="row ten-columns">
                  <div class="col-lg-12">
                     <div class="NoUserFound">
                     <h2>No Result Found</h2>
                     </div>
                  </div>
               </div>
               @endif
            </div>
            <!-- container-fluid-->
         </div>
         <!-- container -->
      </div>
      <!-- notificaton-section -->
@endsection