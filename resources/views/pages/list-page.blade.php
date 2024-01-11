{{-- layout --}}

@extends('layouts.contentLayoutMaster')



{{-- page title --}}

@section('title','Users list')



{{-- vendors styles --}}

@section('vendor-style')

<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">

<link rel="stylesheet" type="text/css"

  href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">

@endsection



{{-- page styles --}}

@section('page-style')

<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">

@endsection



{{-- page content --}}

@section('content')

<!-- users list start -->

<section class="users-list-wrapper section">

  {{-- <div class="users-list-filter">

    <div class="card-panel">

      <div class="row">

        <form> --}}

          {{-- <div class="col s12 m6 l3">

            <label for="users-list-verified">Verified</label>

            <div class="input-field">

              <select class="form-control" id="users-list-verified">

                <option value="">Any</option>

                <option value="Yes">Yes</option>

                <option value="No">No</option>

              </select>

            </div>

          </div> --}}

          {{-- <div class="col s12 m6 l5">

            <label for="users-list-role">Role</label>

            <div class="input-field">

              <select class="form-control" id="users-list-role">

                <option value="">Any</option>

                <option value="User">User</option>

                <option value="Company">Company</option>

              </select>

            </div>

          </div> --}}

          {{-- <div class="col s12 m6 l5">

            <label for="users-list-status">Status</label>

            <div class="input-field">

              <select class="form-control" id="users-list-status">

                <option value="">Any</option>

                <option value="Active">Active</option>

                <option value="Inactive">Inactive</option>

              </select>

            </div>

          </div>

          <div class="col s12 m6 l2 display-flex align-items-center show-btn">

            <button type="submit" class="btn btn-block indigo waves-effect waves-light">Show</button>

          </div> --}}

        {{-- </form>

      </div>

    </div>

  </div> --}}

  <div class="users-list-table">

    <div class="card">

      <div class="card-content">

        {{ __('locale.Dashboard') }}

        <!-- datatable start -->

        <div class="responsive-table">

          <table id="users-list-datatable" class="table">

            <thead>

              <tr>

                @if(isset($table_header) && !empty($table_header) && is_array($table_header))

                  @foreach ($table_header as $colname)

                  <th>{{ucfirst($colname)}}</th>

                  @endforeach  

                @endif

                {{-- <th>{{ __('locale.Edit') }}</th>

                <th>{{ __('locale.View') }}</th> --}}

              </tr>

            </thead>

            <tbody>

              @if(isset($resultlist) && !empty($resultlist))

                @foreach ($resultlist as $key => $value)

                  <tr>

                    <td>{{$key+1}}</td>    

                    <td>{{$value->full_name}}</td>

                    <td>{{$value->email}}</td>

                    <td>{{$value->phone}}</td>

                    {{-- <td>{{$value->location}}</td>

                    <td>{{$value->national_id}}</td> --}}

                    {{-- <td>{{(isset($value->roles[0])) ? $value->roles[0]->name : ''}}

                    @if(isset($extraurl) && !empty($extraurl) && isset($extraurl['editlink']))

                    

                    @endif</td> --}}

                    <td>

                      {{-- @if($value->active_status==1)

                      <span class="chip green lighten-5"><span class="green-text">{{ __('locale.Active') }}</span></span>

                      @else

                      <span class="chip red lighten-5"><span class="red-text">{{ __('locale.Inactive') }}</span></span>

                      @endif --}}


                      @if($value->active_status ==1)
                      <a href="{{route('users-status', ['id'=>$value->id,'active_status'=>0])}}" class="btn btn-danger">Inactive</a>
                      @elseif($value->active_status ==0)
                      <a href="{{route('users-status', ['id'=>$value->id,'active_status'=>1])}}" class="btn btn-success">Active</a>
                      @endif

                    </td>

                    <td>

                       @if($value->admin_approve ==1)
                      <a href="{{route('users-approve', ['id'=>$value->id,'admin_approve'=>0])}}" class="btn btn-danger">Unblock</a>
                      @elseif($value->admin_approve ==0)
                      <a href="{{route('users-approve', ['id'=>$value->id,'admin_approve'=>1])}}" class="btn btn-success">Block</a>
                      @endif

                      {{-- @if($value->admin_approve==1)

                      <span class="chip green lighten-5"><span class="green-text">{{ __('locale.Approve') }}</span></span>

                      @else

                      <span class="chip red lighten-5"><span class="red-text">{{ __('locale.Pending') }}</span></span>

                      @endif --}}

                    </td>
                    <td>
                      <a href="{{route('user-detail',['id'=>$value->id])}}" class="btn btn-success">View</a>
                    </td>

                    {{--

                    <td><a href="{{asset('page-users-edit')}}"><i class="material-icons">{{ __('locale.edit') }}</i></a></td>

                    <td><a href="{{asset('page-users-view')}}"><i class="material-icons">remove_red_eye</i></a></td>

                    --}}

                  </tr>

                @endforeach

              @else

              <tr>

                <td>300</td>

                <td><a href="{{asset('page-users-view')}}">dean3004</a>

                </td>

                <td>Dean Stanley</td>

                <td>30/04/2019</td>

                <td>No</td>

                <td>Staff</td>

                <td><span class="chip green lighten-5">

                    <span class="green-text">Active</span>

                  </span>

                </td>

                <td><a href="{{asset('page-users-edit')}}"><i class="material-icons">edit</i></a></td>

                <td><a href="{{asset('page-users-view')}}"><i class="material-icons">remove_red_eye</i></a></td>

              </tr>

              @endif

            </tbody>

          </table>

        </div>

        <!-- datatable ends -->

      </div>

    </div>

  </div>

</section>

<!-- users list ends -->

@endsection



{{-- vendor scripts --}}

@section('vendor-script')

<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>

@endsection



{{-- page script --}}

@section('page-script')

<script src="{{asset('js/scripts/page-users.js')}}"></script>

@endsection