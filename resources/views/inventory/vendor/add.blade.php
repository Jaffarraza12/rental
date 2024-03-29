@extends('layouts.app')
@push('css')
<link href="{{asset('resources/assets/global/plugins/icheck/skins/flat/_all.css')}}" rel="stylesheet" type="text/css" />


@endpush
@section('content')
    <div class="page-container rentalForm">
        @include("common.adminsideview")
        <div class="page-content-wrapper">
            <div class="page-content">
            {{--@include("common.breadcrumb")--}}
            <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    {!! Form::open(array('url' => $ActionURL ,'method'=>'post', 'files' => true)) !!}
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="col">
                                {!! Form::hidden("url",URL('unit/'),array("class","url")) !!}
                                <div class="caption">
                                    <h1 style="margin-left:2px">{{$heading}}</h1>
                                </div>
                                <div class="tools">
                                    <div class="dt-buttons pull-right">
                                        <div class="btn-group">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            @yield('content')
                            <div class="portlet-body flip-scroll">

                                {{ csrf_field() }}
                                {{--<div class="tab-content ">--}}
                                <div class="">
                                    <div  id="main">
                                        {{--<div class="portlet light lighterPadding">--}}
                                        <div class="">
                                            <div class="row">
                                                <!--Buidling/Property-->
                                                <div class="">
                                                    <div class="tab-content">
                                                        <br>
                                                        <!-- General -->
                                                        <div id="general" ></div>
                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>Full Name</label>
                                                                {!! Form::text('name',old('name'),array("class"=>"form-control" )) !!}
                                                                <span class="help-block">{{ $errors->mess->first('name') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>Company Name</label>
                                                                {!! Form::text('company_name',old('email'),array("class"=>"form-control" )) !!}
                                                                <span class="help-block">{{ $errors->mess->first('email') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>

                                                        <div class="form-group col-md-4 col-lg-4">
                                                            <div class="input-icon  right">
                                                                <label>Category</label>
                                                                {!! Form::select('category_vendor_id',$categories,null,array('placeholder'=>"","class"=>"form-control",'id'=>'building_type' )) !!}
                                                                <span class="help-block">{{ $errors->mess->first('category') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4 col-lg-4">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>Expense Acccount</label>
                                                                {!! Form::select('expense_account',$expense_account_type,null,array('placeholder'=>"","class"=>"form-control",'id'=>'building_type' )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4 col-lg-4">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>Account No</label>
                                                                {!! Form::text('account_number',old('email'),array("class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <h3 class="col-md-12 col-lg-12 padding_below" style="color: #4b646f;">Contact Information</h3>
                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>Email</label>
                                                                {!! Form::text('contact_email',old('contact_email'),array("class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>Alternative Email</label>
                                                                {!! Form::text('contact_alernative_email',old('contact_alernative_email'),array("class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4 col-lg-4">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>Mobile</label>
                                                                {!! Form::text('phone_mobile',old('phone_email'),array("class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4 col-lg-4">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>home</label>
                                                                {!! Form::text('phone_home',old('phone_home'),array("class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4 col-lg-4">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>Office</label>
                                                                {!! Form::text('phone_office',old('phone_office'),array("class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <h3 class="col-md-12 col-lg-12 padding_below" style="color: #4b646f;">Contact Address</h3>
                                                        <div class="form-group col-md-12 col-lg-12">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>Street Address</label>
                                                                {!! Form::text('street_address',old('street_address'),array("class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4 col-lg-4">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>City</label>
                                                                {!! Form::text('city',old('city'),array("class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4 col-lg-4">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>State</label>
                                                                {!! Form::text('postal_code',old('province'),array("class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4 col-lg-4">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>Postal Code</label>
                                                                {!! Form::text('postal_code',old('postal_code'),array("class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>Website</label>
                                                                {!! Form::text('website',old('website'),array("class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>Country</label>
                                                                {!! Form::select('country',array(),null,array('placeholder'=>"","class"=>"form-control", )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12 col-lg-12">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>Comments</label>
                                                                {!! Form::text('comment',old('comment'),array("class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <h3 class="col-md-12 col-lg-12 padding_below" style="color: #4b646f;">Insurance Provider</h3>
                                                        <div class="form-group col-md-4 col-lg-4">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>Provider</label>
                                                                {!! Form::text('provider',old('provider'),array("class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4 col-lg-4">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>Policy Number</label>
                                                                {!! Form::text('policy_number',old('policy_number'),array("class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4 col-lg-4">
                                                            <div class="input-icon input-icon-lg right">
                                                                <label>Expiration Number</label>
                                                                {!! Form::text('expiration_date',old('expiration_date'),array("class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>



                                                        <!-- Main -->
                                                        <div class="form-group row">
                                                        <div  class="form-group col-md-12 col-lg-12" style="px;margin-top: 10px;">
                                                            {!! Form::submit( 'Save', ['class' => 'btn greenish btn', 'name' => 'save', 'value' => 'email'])!!}
                                                        </div>
                                                        </div>


                                                    </div>
                                                    <!-- General -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>

                            </div>
                        </div>
                        <!-- END SIDEBAR CONTENT LAYOUT -->
                    </div>

                </div>
            </div>



            <!-- END CONTAINER -->
            @endsection
            @push('scripts')
            <script src="{{asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('resources/assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('resources/assets/js/tenant.js')}}" type="text/javascript"></script>
            <script  type="text/javascript">
                $(document).ready(function () {
                    tenant.init()
                    $('#attributeNO').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! URL('/expense/data/') !!}',
                        columns: [
                            { data: 'expense_id', name: 'expense_id' },
                            { data: 'entry_date', name: 'entry_date' },
                            { data: 'amount', name: 'amount' },
                            { data: 'tax', name: 'tax' },
                            { data: 'tax_2', name: 'tax_2' },
                            { data: 'payee', name: 'payee' },
                            { data: 'operations', name: 'operations' }
                        ],"initComplete": function(settings, json){

                        }
                    });
                    $("body").on("click",".pop",function () {
                        url= $(this).data("url")
                        app.popUp(url,$('#attribute').DataTable( ));
                    })

                    $("body").on("click",".remove",function () {

                        var sure = confirm("Are you sure you want to delete!");
                        if(sure) {
                            url = $(this).data("url")
                            app.postWithCallback(url, {
                                'id': $(this).data("id"),
                                '_token': $("[name='_token']").val()
                            }, function () {
                                $('#attribute').DataTable().ajax.reload()
                            })
                        }

                    })
                })
            </script>


    @endpush