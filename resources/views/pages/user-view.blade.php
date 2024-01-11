{{-- layout --}}

@extends('layouts.contentLayoutMaster')




{{-- page title --}}

@section('title','User View')



{{-- page style --}}

@section('vendor-style')

<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"
  href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
  
@endsection

@section('page-style')

<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">

@endsection


{{-- page content  --}}

@section('content')

<!-- users view start -->
{{-- <section>
<div class="section users-view"> --}}
  <section class="users-list-wrapper section">

    {{-- for the page title start --}}

    <div class="card">
        
        <div class="card-content">
            
            {{'User View'}}
        </div>
        
    </div>
    
    {{-- for the page title end --}}
 

  <!-- users view card details start -->

  <div class="card">

    <div class="card-content">

      {{-- echo '<pre>'; print_r($usr_list); die; ?>  --}}

      <div class="row">

        <div class="col s12">

          <table class="striped">

            <tbody>
      
              {{--  echo '<pre>'; print($usr_meta_list); die; ?> --}}
                  <tr>
                    <td>
                        @foreach ($usr_list as $item=>$data)
                            {{-- {{$item}}{{$data}} --}}

                          <tr>
                            @if($item=='gender')
                            <td>{{ ucwords(str_Replace('_',' ',$item)) }}:</td>
                            <td>{{ ($data==1) ? 'Male' : 'Female'; }}</td>
                            @elseif($item=='profile_purpose')
                            <td>{{ ucwords(str_Replace('_',' ',$item)) }}:</td>
                            <td>{{ ($data==1) ? 'Business' : (($data==2) ? 'Personal' : 'Business and Personal') ; }}</td>

                            @elseif($item=='profile_image')      
                            <td>{{ ucwords(str_Replace('_',' ',$item)) }}:</td>

                            <td>      
                              <div>
                                 <img class="" src="{{($data) ? url('/').'/public/uploads/profile/'.$data :''}}" width="100" />
                              </div>
                            </td>   
                            @else
                            <td>{{ ucwords(str_Replace('_',' ',$item)) }}:</td>
                            <td>{{$data}}</td>
                            @endif
                            {{-- @if($item=='profile_image')      
                            <td>                       
                              <div>
                                 <img class="w-100 h-100 d-block" src="{{($data['profile_image']) ? url('/').'/public/images/user/'.$data['profile_image'] :''}}" width="50" />
                              </div>
                            </td>   
                            @endif --}}
                          </tr>

                          @endforeach
                    </td>
                    </tr>

            </tbody>
            <tbody>
              <tr>
                <td>
                  
                          @if(isset($usr_meta_list) && !empty($usr_meta_list))
                            @foreach ($usr_meta_list as $int=>$meta_list)
                            @if(isset($meta_list['profile_type']) && $meta_list['profile_type']!='' )
                            {{-- {{$item}}{{$data}} --}}
                            <tr>
                              <td>{{ ucwords(str_Replace('_',' ',$int)) }}:</td>
                              
                           
                                  <td>{{$meta_list}}</td>
                                </tr>
                                @endif
                            @endforeach
                            @endif
                          </td>
                        </tr>
    
             </tbody>
             </table>

        </div>

      </div>

      <!-- </div> -->

    </div>

  </div>

  <!-- users view card details ends -->




</section>
<!-- users view ends -->

@endsection


@section('vendor-script')

<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>

@endsection

{{-- page script --}}

@section('page-script')

<script src="{{asset('js/scripts/page-users.js')}}"></script>

@endsection