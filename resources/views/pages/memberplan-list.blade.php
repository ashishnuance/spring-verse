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
                    <th>Member Id</th>
                    <th>Billing Name</th>
                    <th>Billing Email</th>
                    <th>Billing Address</th>
                    <th>Plan Id</th>
                    <th>Plan Price</th>
                    <th>Paid Amount</th>
                    <th>Discount Value</th> 
                    <th>Card Type</th>
                    <th>Transaction Id</th>
                    <th>Payment Status</th>

                  </tr>

                </thead>

                <tbody>
                  
                @foreach($member_plan_list as $k=>$list)
              
                <tr>
                  
                  <td>{{$k+1}}</td>
                  <td>{{$list->member_id	}}</td>
                  <td>{{$list->billing_name	}}</td>
                  <td>{{$list->billing_email}}</td>
                  <td>{{$list->billing_address}},{{$list->billing_city}},{{$list->billing_state}},{{$list->billing_country}},{{$list->billing_zipcode}}</td>
                  <td>{{plan_name($list->plan_id)}}</td>
                  <td>{{$list->plan_price}}</td>
                  <td>{{$list->paid_amount}}</td>
                  <td>{{$list->discount_value}}</td>
                  <td>{{$list->card_type}}</td>
                  <td>{{$list->txn_id}}</td>
                  <td>{{$list->payment_status}}</td>
                  
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