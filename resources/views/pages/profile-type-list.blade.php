{{-- layout --}}

@extends('layouts.contentLayoutMaster')



{{-- page title --}}

@section('title',(isset($pagetitle) && $pagetitle!='') ? $pagetitle : 'Page')




{{-- vendor styles --}}

@section('vendor-style')

<link rel="stylesheet" type="text/css" href="{{url('assets/vendors/flag-icon/css/flag-icon.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('assets/vendors/data-tables/css/jquery.dataTables.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{url('assets/vendors/data-tables/css/select.dataTables.min.css')}}">

@endsection



{{-- page style --}}

@section('page-style')

<link rel="stylesheet" type="text/css" href="{{url('assets/css/pages/data-tables.css')}}">

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

                    <th>Name</th>
                  
                    <th>Created At</th>

                    <th>Status</th>

                    <th>Action</th>

                  </tr>

                </thead>

                <tbody>
                 
                  @foreach($profilelist as $k=>$list)


                  <tr>
                    <td>{{ $k+1 }}</td>

                    <td>{{$list->name}}</td>
                   
                    <td>{{$list->created_at}}</td>

                    <td>
                      @if($list->status ==1)
                      Active
                      @elseif($list->status ==0)
                      Inactive
                      @endif
                    </td>

                    <td>
                      @if($list->status ==1)
                      <a href="{{route('profile-type-status', ['id'=>$list->id,'status'=>0])}}" class="btn btn-danger">Inactive</a>
                      @elseif($list->status ==0)
                      <a href="{{route('profile-type-status', ['id'=>$list->id,'status'=>1])}}" class="btn btn-success">Active</a>
                      @endif
                      {{-- <a href="{{route('patner-delete', ['id'=>$list->id])}}" class="btn btn-Danger" onclick="return confirm('Are you sure you want to delete ?')"><i class="material-icons dp48">delete</i></a> --}}
                      <a href="{{route('profile-type.edit',[$list->id])}}" class="btn btn-success"><i class="material-icons dp48">edit</i></a>
                      {{-- {{ URL::to('sharks/' . $value->id . '/edit') }}" --}}
                    </td>

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

<script src="{{url('assets/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>

<script src="{{url('assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>

<script src="{{url('assets/vendors/data-tables/js/dataTables.select.min.js')}}"></script>

@endsection



{{-- page script --}}

@section('page-script')

<script src="{{url('assets/js/scripts/data-tables.js')}}"></script>

@endsection