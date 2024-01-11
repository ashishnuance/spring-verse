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

                    <th>Title</th>
                    <th>Plan Period</th>
                    <th>Main Price</th>
                    <th>Offer Price</th>
                    <th>Membership Type</th>
                    <th>Image</th>
                    {{-- <th>Description</th> --}}
                    <th>Created At</th>

                    <th>Status</th>

                    <th>Action</th>

                  </tr>

                </thead>

                <tbody>
                 
                  @foreach($membership_list as $k=>$list)


                  <tr>
                    <td>{{ $k+1 }}</td>
                    <td>{{$list->title}}</td>

                    <td>{{$list->plan_period}}</td>
                    <td>{{$list->main_price}}</td>

                    <td>{{$list->offer_price}}</td>

                    <td>{{$list->membership_type}}</td>

                    <td>
                    
                    {{-- <img src="{{  url('/').'/assets/membership/'.$list->image }}" class="responsive-img" alt=""> --}}
                    
                      @if($list->image!='')
                      <img src="{{  url('/').'/assets/membership/'.$list->image }}" alt="" class="responsive-img" width="100" height="100">
                      @endif

                    </td>
                    {{-- <td>{!! $list->description !!}</td> --}}

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
                      <a href="{{route('membership-type-status', ['id'=>$list->id,'status'=>0])}}" class="btn btn-danger">Inactive</a>
                      @elseif($list->status ==0)
                      <a href="{{route('membership-type-status', ['id'=>$list->id,'status'=>1])}}" class="btn btn-success">Active</a>
                      @endif


                      {{-- <form class="formValidate0" id="formValidate0" enctype="multipart/form-data" method="post" action="{{route('membership-type.destroy',[$list->id])}}">
                      @csrf
                      {{ method_field('DELETE') }}
                    <input type="hidden" name="id" value="{{$list->id }}">
                     <button class="btn waves-effect waves-light right" type="submit">Delete <i class="material-icons dp48">send</i> --}}

                    <a href="{{route('membership-delete', [$list->id])}}" class="btn btn-Danger" onclick="return confirm('Are you sure you want to delete ?')"><i class="material-icons dp48">delete</i></a>
                      {{-- <a href="{{route('membership-delete', [$list->id])}}" class="btn btn-Danger" onclick="return confirm('Are you sure you want to delete ?')"><i class="material-icons dp48">delete</i></a>
                      </form> --}}
                      <a href="{{route('membership-type.edit',[$list->id])}}" class="btn btn-success"><i class="material-icons dp48">edit</i></a>
                      
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