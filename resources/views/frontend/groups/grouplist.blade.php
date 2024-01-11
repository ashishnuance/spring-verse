@extends('frontend.layouts.frontLayout')
 @section('content')

<div class="notificaton-section">
         <div class="container business-thumbprofile">
            <div class="container-fluid">
                <div class="grp-list-heading">
                    <h3>Group List</h3>
                    <a href="javascript:void:;" data-toggle="modal" class="create_group btn btn-personal_continue" data-target="#create_group">Create Group</a>
                </div>
                    <table class="table">
                        <thead>
                            <tr>
                            {{-- <th>S.NO.</th> --}}
                            <th>Group Name</th>
                            <th>Group Members Name</th>
                            <th>User</th>
                            </tr>
                        </thead>
                        <tbody>

                        @if(isset($group_list) && !empty($group_list))
                            @foreach($group_list as $group_val)
                      
                          <tr>
                            {{-- <td>{{ $k+1 }}</td> --}}
                            <td>{{ucwords($group_val->group_name)}}</td>
                            <td>{{$group_val->group_members_name}}</td>
                            <td>Group Created by <b>{{$group_val->user_name}}<b></td>
                            
                          </tr>
                          @endforeach
                        @endif

                        </tbody>
                      </table>
               
              </div>
           </div>
       </div>
   </div>


  @endsection