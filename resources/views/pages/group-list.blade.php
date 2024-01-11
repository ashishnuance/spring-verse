{{-- layout --}}

@extends('layouts.contentLayoutMaster')

{{-- page title --}}

@section('title',(isset($pagetitle) && $pagetitle!='') ? $pagetitle : 'Page')

{{-- vendor styles --}}

@section('vendor-style')

<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">

<link rel="stylesheet" type="text/css"

  href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/select.dataTables.min.css')}}">

@endsection



{{-- page style --}}

@section('page-style')

<link rel="stylesheet" type="text/css" href="{{asset('css/pages/data-tables.css')}}">

@endsection



{{-- page content --}}

@section('content')

<div class="section section-data-tables">

  <div class="card">

    <div class="card-content">

      {{(isset($pagetitle) && $pagetitle!='') ? $pagetitle : 'Page'}}

    </div>

  </div>

  <!-- DataTables example -->
  @include('panels.flash-message')

  
{{-- for the product expport --}}



    {{-- product export end --}}

  <!-- Page Length Options -->

  <div class="row">

    <div class="col s12">

      <div class="card">

        <div class="card-content">

          <h4 class="card-title">Page Length Options</h4>

          <div class="row">
              
            <div class="col s12">

              <table id="page-length-option" class="display">

                <thead>

                  <tr>
                    
                    <th>S.NO.</th>
                    <th>Group Name</th>
                    <th>Group Members Name</th>
                    <th>User</th>
                  
                  </tr>

                </thead>

                <tbody>
                  {{--  echo '<pre>'; print_r($profile_group_list); die; ?> --}}
                @foreach($profile_group_list as $k=>$list)
              
                <tr>
                  
                  <td>{{$k+1}}</td>
                  <td>{{$list->group_name	}}</td>
                  <td>{{$list->group_member_name}}</td>
                  <td>{{$list->full_name}}</td>

                </tr>
                @endforeach


                 

              </table>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

@endsection



{{-- vendor scripts --}}

@section('vendor-script')

<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>

<script src="{{asset('vendors/data-tables/js/dataTables.select.min.js')}}"></script>

@endsection



{{-- page script --}}

@section('page-script')

<script src="{{asset('js/scripts/data-tables.js')}}"></script>

@endsection