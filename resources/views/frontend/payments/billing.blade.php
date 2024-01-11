@extends('frontend.layouts.frontLayout')
@section('content')

<div class="notificaton-section  myaction-section">
    <div class="container business-thumbprofile">
        <div class="row">
            <div class="col-lg-2 col-sm-4">
                <div class="accountbox">
                    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                    @include('frontend.myaccount.sidebarmenu')
                    <!-- /.navbar-collapse -->
                </div>
                <!-- accountbox -->
            </div>

            <div class="col-md-10">
                <h3>Billing</h3>
                <div>
                    <table class="table">
                        <thead>


                            <tr>
                                <th></th>
                                <th>Plan Name</th>
                                <th>Mamber Name</th>
                                <th>Plan Price</th>
                                <th>Purchase date</th>
                                <th>Expiry date</th>
                            </tr>
                        </thead>
                        <tbody>


                            @if(isset($user_billing_list) && !empty($user_billing_list))


                            <tr>
                                <td>Active Plan</td>
                                <td>{{$user_billing_list->member->title}}</td>
                                <td>{{$user_billing_list->billing_name}}</td>
                                <td>${{$user_billing_list->plan_price}}</td>
                                <td>{{ date('d-m-Y',strtotime( $user_billing_list->created_at ) ) }}</td>

                                <?php 
                                    $plan_period = (isset($user_billing_list->member->plan_period) && $user_billing_list->member->plan_period=='Annually') ? '+1 year' : '+1 month'; 

                                $date =date('d-m-Y', strtotime($user_billing_list->created_at . $plan_period) );
                              

                            ?>

                                <td>{{ date('d-m-Y',strtotime( $date ) ) }}</td>
                            </tr>

                            @endif

                            @if(isset($user_billing_listall) && !empty($user_billing_listall))
                            @foreach($user_billing_listall as $pk => $plan_val)
                            @if($pk>0)
                            <tr>
                                <td></td>
                                <td>{{$plan_val->member->title}}</td>
                                <td>{{$plan_val->billing_name}}</td>
                                <td>${{$plan_val->plan_price}}</td>
                                <td>{{ date('d-m-Y',strtotime( $plan_val->created_at ) ) }}</td>

                                <?php 
                                //$date =date('d-m-Y', strtotime($plan_val->created_at . " +1 year") );
                              

                            ?>

                                <td>Expired</td>
                            </tr>
                            @endif
                            @endforeach

                            @endif

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

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
</div>


@endsection