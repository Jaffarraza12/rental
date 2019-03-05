@extends('layouts.appmodel')
@push('css')
<link href="{{asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('resources/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="{{asset('resources/assets/css/lease.css')}}" rel="stylesheet" type="text/css" />

@endpush
@section('content')
    <div class="portlet-title LEASE_AGREEMENT">
        <div class="caption font-red-sunglo">
            <h3 class="caption-subject bold uppercase text-center"> <i class="fa fa-dollar"></i> {{$heading}}</h3>
        </div>
    </div>
    <div class="portlet-body form">
    {!! Form::open(array('url' => $ActionURL ,'method'=>'post',"class"=>"app_form")) !!}
    <!-- BEGIN PORTLET-->
        <div class="form-body">
            {{ csrf_field() }}
            <div class="form-group col-md-3 col-lg-3">
                    <div class="input-icon input-icon-lg right">
                        <i class="fa fa-building for-select"></i>
                        {!! Form::select('building_id',$buildings,null,array('placeholder'=> "Building","class"=>"form-control","id"=>"building" )) !!}
                    </div>
            </div>

            <div class="form-group col-md-3 col-lg-3">
                    <div class="input-icon input-icon-lg right">
                        <i class="fa fa-square-o for-select"></i>
                        {!! Form::hidden('unit_id',null,array('id'=>'unit_id')) !!}
                        {!! Form::text('unit',null,array('placeholder'=> "Unit Name","class"=>"form-control","id"=>"unit_show" )) !!}

                    </div>
            </div>
            <div class="form-group col-md-3 col-lg-3">
                <div class="input-icon input-icon-lg right">
                    <i class="fa fa-user for-select"></i>
                    {!! Form::select('applicant_type',array(
                            '1' => 'Select Applicant From Existing list',
                            '2' => 'Add New'
                    ),null,array('placeholder'=> "Applicant Type","class"=>"form-control","id"=>"applicant_type" )) !!}
                </div>
            </div>

            <div class="dt-buttons  col-md-3 col-lg-3 text-center">
                <div class="btn-group">
                    <a data-toggle="dropdown" href="javascript:;" class="btn btn-md  green dropdown-toggle" aria-expanded="false"> Actions
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a>
                                <button class="btn btn-sm" type="submit"><i class="fa fa-save"></i>Save</button>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

            <div class="form-group col-md-12 col-lg-12 applicant_field">
                <div class="input-icon input-icon-lg right">
                    <i class="fa fa-user "></i>
                    {!! Form::text('applicant',null,array('placeholder'=> "Applicant Name","class"=>"form-control","id"=>"applicant" )) !!}
                    {!! Form::hidden('applicant_id',null,array('placeholder'=> "Applicant Name","class"=>"form-control","id"=>"applicant_id" )) !!}
                </div>
            </div>
            <div class="clearfix"></div>
            <!--applicant form-->
              <div class="row applicant_form">
                <div class="col-md-12">
                <!-- BEGIN SAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <h4><i class="fa fa-user"></i> Applicant Detail.</h4>
                        </div>
                        <div class="tools">
                            <div class="dt-buttons pull-right">
                                <div class="btn-group">
                                    <a data-toggle="dropdown" href="javascript:;" class="btn btn-lg  green dropdown-toggle" aria-expanded="false"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a>
                                                <button class="btn save-applicant" type="button"><i class="fa fa-save do_post"></i>Save</button>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include("common.errors")
                    @yield('content')
                    <div class="portlet-body flip-scroll">
                        {!! Form::hidden("url",URL('unit/'),array("class","url")) !!}
                        <div class="tab-content ">
                            <div class="tab-pane fade in active" id="main">
                                <div class="portlet light">
                                    <div class="row">
                                        <!--Summary -->
                                        <div class="col-md-3 col-lg-3">
                                            <ul class="nav nav-pills Jtab">
                                                <li class="nav active"><a href="#general" data-toggle="tab">Personal Detail</a></li>
                                                <li class="nav"><a href="#more-detail" data-toggle="tab">More Detail</a></li>
                                                <li class="nav"><a href="#personal" data-toggle="tab">Preference</a></li>
                                                <li class="nav"><a href="#document" data-toggle="tab">Documents</a></li>
                                            </ul>

                                        </div>
                                        <!--Summary -->
                                        <!--Buidling/Property-->
                                        <div class="col-md-9 col-lg-9">
                                            <div class="tab-content">
                                                <!-- Personal -->
                                                <div class="tab-pane fade" id="personal">
                                                    <div class="form-group  col-md-6 col-lg-6">
                                                        <div class="input-icon input-icon-lg right">
                                                            <i class="fa fa-building -o for-select"></i>
                                                            {!! Form::select('prefer_building',$buildings,null,array('placeholder'=> "Prefer Building","class"=>"form-control" )) !!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group  col-md-6 col-lg-6">
                                                        <div class="input-icon input-icon-lg right">
                                                            <i class="fa fa-money for-select"></i>
                                                            {!! Form::select('lease_perfer',array(
                                                                'Weekly' => 'Weekly',
                                                                'Monthly' => 'Monthly',
                                                                'Bi-Monthly' => 'Bi-Monthly',
                                                                'Quarterly' => 'Quarterly',
                                                                'Every 6 Months' => 'Every 6 Months',
                                                                'Yearly' => 'Yearly'
                                                                ),null,array('placeholder'=> "Lease Preference","class"=>"form-control" )) !!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group  col-md-6 col-lg-6">
                                                        <div class="input-icon input-icon-lg right">
                                                            <i class="fa fa-eyedropper for-select"></i>
                                                            {!! Form::select('smoke',array(
                                                                'Yes' => 'Yes',
                                                                'No' => 'No'
                                                                ),old('smoke'),array('placeholder'=>"Somking ","class"=>"form-control icheck" )) !!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group  col-md-6 col-lg-6">
                                                        <div class="input-icon input-icon-lg right">
                                                            <i class="fa fa-clipboard for-select"></i>
                                                            {!! Form::select('profile',array(
                                                                'Single' => 'Single',
                                                                'Unmarried couple, no children' => 'Unmarried couple, no children',
                                                                'Married couple, no children' => 'Married couple, no children',
                                                                'Family with children' => 'Family with children',
                                                                'Single parent with children' => 'Single parent with children',
                                                                'Related tenants' => 'Related tenants',
                                                                'Unrelated tenants' => 'Unrelated tenants',
                                                                'Student' => 'Student',
                                                                'Retired or senior' => 'Retired or senior',
                                                                'Other' => 'Other'
                                                                ),null,array('placeholder'=> "Profile","class"=>"form-control" )) !!}
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6 col-lg-6">
                                                        <div class="input-icon right">
                                                            <i class="fa fa-square-o for-select"></i>
                                                            {!! Form::select('prefer_type', array(
                                                                    'Studio' => 'Studio',
                                                                    'Bachelor' => 'Bachelor',
                                                                    'Junior1' => 'Junior1',
                                                                    '1 Bedroom' => '1 Bedroom',
                                                                    '2 Bedroom' => '2 Bedroom',
                                                                    '3 Bedroom' => '3 Bedroom'
                                                                    ),null,array('placeholder'=> "Prefer Type","class"=>"form-control","id"=>"type" )) !!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group  col-md-6 col-lg-6">
                                                        <div class="input-icon input-icon-lg right">
                                                            <i class="fa fa-location-arrow"></i>
                                                            {!! Form::text('prefer_area',null,array('placeholder'=>"Prefer Area,","class"=>"form-control" )) !!}
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <!-- Personal-->
                                                <!-- General -->
                                                <div class="tab-pane fade  in active" id="general" >
                                                    <div class="clearfix"></div>
                                                    <div class="form-group col-md-6 col-lg-6">
                                                        <div class="input-icon input-icon-lg right">
                                                            <i class="fa fa-text-width"></i>
                                                            {!! Form::text('name',old('first_name'),array('placeholder'=>"Full Name","class"=>"form-control" )) !!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 col-lg-6">
                                                        <div class="input-icon input-icon-lg right">
                                                            <i class="fa fa-user"></i>
                                                            {!! Form::text('ssn',old('ssn'),array('placeholder'=>"Social Security Number","class"=>"form-control" )) !!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 col-lg-6">
                                                        <div class="input-icon input-icon-lg right">
                                                            <i class="fa fa-envelope-o"></i>
                                                            {!! Form::text('email',old('email'),array('placeholder'=>"Email","class"=>"form-control" )) !!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 col-lg-6">
                                                        <div class="input-icon  right">
                                                            <i class="fa fa-phone"></i>
                                                            {!! Form::text('phone',old('phone'),array('placeholder'=>"Phone","class"=>"form-control" )) !!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group  col-md-6 col-lg-6">
                                                        <div class="input-icon input-icon-lg right">
                                                            {!! Form::text('address',old('address'),array('placeholder'=>"Address","class"=>"form-control" )) !!}
                                                        </div>
                                                    </div>
                                                    <div class="form-group  col-md-6 col-lg-6">
                                                        <div class="input-icon input-icon-lg right">
                                                            <i class="fa fa-car"></i>
                                                            {!! Form::text('driving_license',old('driving_license'),array('placeholder'=>"Driving License","class"=>"form-control" )) !!}
                                                        </div>
                                                    </div>

                                                    <div class="form-group  col-md-12 col-lg-12">
                                                        <div class="input-icon input-icon-lg right">
                                                            <i class="fa fa-user"></i>
                                                            {!! Form::text('notes',null,array('placeholder'=>"More About Applicant,","class"=>"form-control" )) !!}
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <!-- Main -->
                                                <div class="tab-pane fade" id="more-detail">

                                                    <div class="portlet-title col-md-12 col-lg-12">
                                                        <div class="caption col-md-9 col-lg-9">
                                                            <h4><i class="fa fa-user"></i> Occupants </h4>
                                                        </div>
                                                        <div class="tools col-md-3 col-lg-3" style="margin-top:15px;">
                                                            <span class="pointer addOccupantHtml" ><icon class="fa fa-plus"></icon> Add Occupant</span>
                                                        </div>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                    <div class="OccupantHtml" style="border-top:1px solid #fcfcfc;">
                                                        <div class="form-group col-md-3 col-lg-3">
                                                            <div class="input-icon input-icon-lg right">
                                                                <i class="fa fa-text-width"></i>
                                                                {!! Form::text('occupant_name[]',old('occupant_name'),array('placeholder'=>"Occupant Name","class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3 col-lg-3">
                                                            <div class="input-icon input-icon-lg right">
                                                                <i class="fa fa-connectdevelop"></i>
                                                                {!! Form::text('relation[]',old('relation[]'),array('placeholder'=>"Relation ships","class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-5 col-lg-5">
                                                            <div class="input-icon input-icon-lg right">
                                                                <i class="fa fa-comment-o"></i>
                                                                {!! Form::text('comments[]',old('comments[]'),array('placeholder'=>"Summary","class"=>"form-control" )) !!}
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-1 col-lg-1">

                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="portlet-title col-md-12 col-lg-12">
                                                        <div class="caption col-md-9 col-lg-9">
                                                            <h4><i class="fa fa-car"></i> Vehicles </h4>
                                                        </div>
                                                        <div class="tools col-md-3 col-lg-3" style="margin-top:15px;">
                                                            <span class="pointer addVehicleHtml" ><icon class="fa fa-plus"></icon> Add Vehicle</span>
                                                        </div>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                    <div class="VehicleHtml" style="border-top:1px solid #fcfcfc;">
                                                        <div>
                                                            <div class="form-group col-md-3 col-lg-3">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <i class="fa fa-automobile"></i>
                                                                    {!! Form::text('make[]',old('make[]'),array('placeholder'=>"Make","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-4 col-lg-4">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <i class="fa fa-cab"></i>
                                                                    {!! Form::text('model[]',old('model[]'),array('placeholder'=>"Model","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-4 col-lg-4">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <i class="fa fa-tag"></i>
                                                                    {!! Form::text('tag[]',old('tag[]'),array('placeholder'=>"Tag","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-1 col-lg-1">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="portlet-title col-md-12 col-lg-12">
                                                        <div class="caption col-md-9 col-lg-9">
                                                            <h4><i class="fa fa-user-md"></i> Employer</h4>
                                                        </div>
                                                        <div class="tools col-md-3 col-lg-3" style="margin-top:15px;">
                                                            <span class="pointer addIncomeHtml" ><icon class="fa fa-plus"></icon> Add Employer</span>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="IncomeHtml" style="border-top:1px solid #fcfcfc;">
                                                        <div>
                                                            <div class="form-group col-md-3 col-lg-3">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <i class="fa fa-industry"></i>
                                                                    {!! Form::text('employer[]',old('employer[]'),array('placeholder'=>"Employer","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-2 col-lg-2">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <i class="fa fa-user-md"></i>
                                                                    {!! Form::text('role[]',old('role[]'),array('placeholder'=>"Role","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-2 col-lg-2">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <i class="fa fa-phone"></i>
                                                                    {!! Form::text('employer_phone[]',old('employer_phone[]'),array('placeholder'=>"Phone no","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-2 col-lg-2">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <i class="fa fa-clock-o"></i>
                                                                    {!! Form::text('duration[]',old('duration[]'),array('placeholder'=>"Duration","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-2 col-lg-2">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <i class="fa fa-money"></i>
                                                                    {!! Form::text('income[]',old('income[]'),array('placeholder'=>"Earning Amount","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-1 col-lg-1">

                                                            </div>
                                                            <div class="clearfix"></div>

                                                        </div>

                                                    </div>



                                                </div>



                                                <!-- buttons -->
                                                <div class="clearfix"></div>
                                                <!-- Documents -->
                                                <div class="tab-pane fade" id="document" style="">
                                                    <div class="portlet-title">
                                                        <div class="tools pull-right" style="margin:15px 0px;">
                                                            <span class="pointer addDocumentHtml" ><icon class="fa fa-plus"></icon> Add Document</span>
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <div class="clearfix"></div>
                                                    <div class="DocumentHtml" style="border-top:1px solid #fcfcfc;">
                                                        <div>
                                                            <div class="form-group col-md-5 col-lg-5">
                                                                <div class="input-icon input-icon-lg right">
                                                                    {!! Form::file('file[]',null,array('placeholder'=>"Employer","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6 col-lg-6">
                                                                <div class="input-icon input-icon-lg right">
                                                                    {!! Form::text('file_comment[]',null,array('placeholder'=>"Comments","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-1 col-lg-1">

                                                            </div>
                                                            <div class="clearfix"></div>

                                                        </div>
                                                        <!-- Documents-->
                                                    </div>
                                                </div>
                                            </div>



                                            <!-- General -->

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
            </div>
        </div>
            <!--applicant form-->

            <!-- LEASE FORM -->
            <div id="lease_profile" style="display: none;">
                <div class="col-md-6 col-lg-6">
                    <div class="portlet light bordered">
                        <div class="portlet-body building_detail"></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="portlet light bordered">
                        <div class="portlet-body applicant_detail"></div>
                    </div>
                </div>
            </div>
            <!-- LEASE FORM -->
            <div class="clearfix"></div>
            <div class="col-md-12 col-lg-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark bold uppercase"><icon class="fa fa-money"></icon> Lease Term & Rental Rate</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="form-group col-md-6  col-lg-6">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-money for-select"></i>
                                {!! Form::select('lease_prefer',array(
                                    'Monthly' => 'Monthly',
                                    'Bi-Monthly' => 'Bi-Monthly',
                                    'Quarterly' => 'Quarterly',
                                    'Every-6-month' => 'Every 6 Months',
                                    'Yearly' => 'Yearly'
                                    ),old('lease_perfer'),array('placeholder'=> "Payment Tem","class"=>"form-control","id"=>'lease_prefer' )) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 date_range">
                            <div class="input-group  date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                {!! Form::text('from',null,array("class"=>"form-control" )) !!}
                                <span class="input-group-addon"> to </span>
                                {!! Form::text('to',null,array("class"=>"form-control" )) !!}
                            </div>
                            <!-- /input-group -->
                        </div>

                        <div class="col-md-6 col-lg-6 single_date" style="display: none;">
                            <div class="input-group  date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                {!! Form::text('starting_date',null,array("class"=>"form-control" )) !!}
                             </div>
                            <!-- /input-group -->
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-md-4  col-lg-4">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-time for-select"></i>
                                {!! Form::select('notice_period',array(
                                    '30 days' => '30 days',
                                    '60 days' => '60 days',
                                    '90 days' => '90 days'
                                    ),old('lease_perfer'),array('placeholder'=> "Notice Period ","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-dollar"></i>
                                {!! Form::text('rate',null,array('placeholder'=> "Rent","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-summary"></i>
                                {!! Form::text('comment',null,array('placeholder'=> "Comments","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 col-lg-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark bold uppercase"><icon class="fa fa-money"></icon> Other Expenses</span>
                        </div>
                        <div class="tools pull-right" style="margin-top:15px;">
                            <span class="pointer addExpHtml" ><icon class="fa fa-plus"></icon> Add More</span>
                        </div>
                    </div>

                <div class="portlet-body AppendOtherExp">
                    <div class="form-group col-md-4 col-md-4">
                        <div class="input-icon right">
                            <i class="fa fa-money for-select"></i>
                            {!! Form::select('expense[]',array(
                                "Activity Fee"=> "Activity Fee",
                                "Administration Fee"=> "Administration Fee",
                                "Application Fee" => "Application Fee",
                                "Back Rent" => "Back Rent",
                                "Bank Charges" => "Bank Charges",
                                "Check Out Fee" => "Check Out Fee",
                                "Cleaning Fee" => "Cleaning Fee",
                                "Common Area Maint" => "Common Area Maint",
                                "Compliance Discount" => "Compliance Discount",
                                " Cosigner Fee" => "Cosigner Fee",
                                "Court Fee"=> "Court Fee",
                                "Credit Card Fee" => "Credit Card Fee",
                                "Deferral Fee" => "Deferral Fee",
                                "Deposit Fee" => "Deposit Fee",
                                "Early Termination Fee" => "Early Termination Fee",
                                "Equity Payment"=> "Equity Payment",
                                "Extension Fee"=> "Extension Fee",
                                "Exterminator Fee"=> "Exterminator Fee",
                                "Extra Person Fee"=> "Extra Person Fee",
                                "Garage Fee"=> "Garage Fee",
                                "Hazard Insurance" => "Hazard Insurance",
                                "Heat Surcharge"=> "Heat Surcharge",
                                "HOA Fee"=> "HOA Fee",
                                "HOA Violation" => "HOA Violation",
                                "Holding Fee" => "Holding Fee",
                                "Holdover Fee" => "Holdover Fee",
                                "Home Rent"=> "Home Rent",
                                "Insurance" => "Insurance",
                                "Judgement Installment" => "Judgement Installment",
                                "Key Deposit" => "Key Deposit",
                                "Key Replacement Fee" => "Key Replacement Fee",
                                "Last Months Rent" => "Last Months Rent",
                                "Late Fee, One-Time" => "Late Fee, One-Time",
                                "Lawn/Snow Maint" => "Lawn/Snow Maint",
                                "Lease Reinstatement Fee" => "Lease Reinstatement Fee",
                                "Legal Fees" => "Legal Fees",
                                "Lockout Fee" => "Lockout Fee",
                                "Maintenance Fee"=> "Maintenance Fee",
                                "Management Fee" => "Management Fee",
                                "Miscellaneous" => "Miscellaneous",
                                "Month to Month" => "Month to Month",
                                "Mortgage" => "Mortgage",
                                "Move In Fee" => "Move In Fee",
                                "NSF Fee" => "NSF Fee",
                                "Option Payment" => "Option Payment",
                                "Painting" => "Painting",
                                "Parking Fee" => "Parking Fee",
                                "Parking Fee, Electrical" => "Parking Fee, Electrical",
                                "Parking Fee, Heated" => "Parking Fee, Heated",
                                "Parking Lot" => "Parking Lot",
                                "Penalty" => "Penalty",
                                "Pest Control" => "Pest Control",
                                "Pet Deposit" => "Pet Deposit",
                                "Pet Fee" => "Pet Fee",
                                "PHA (Public Housing Auth)"=> "PHA (Public Housing Auth)",
                                "Prepaid Rent" => "Prepaid Rent",
                                "Prior Balance" => "Prior Balance",
                                "Pro Ratio Billing" => "Pro Ratio Billing",
                                 "Property Tax" => "Property Tax",
                                "Prorated Rent" => "Prorated Rent",
                                "Reimbursement" => "Reimbursement",
                                "Rent from Secondary Tenant" => "Rent from Secondary Tenant",
                                "Rent Lock Fee" => "Rent Lock Fee",
                                "Repair Fee" => "Repair Fee",
                                "Returned Check" => "Returned Check",
                                "Section 8" => "Section 8",
                                "Section-8 Portion" => "Section-8 Portion",
                                "Security Deposit" => "Security Deposit",
                                "Steam Cleaning" => "Steam Cleaning",
                                "Storage Fee" => "Storage Fee",
                                "Taxes" => "Taxes",
                                "Taxes: Gov" => "Taxes: Gov",
                                "Transfer Fee" => "Transfer Fee",
                                "Trip Charge"=> "Trip Charge",
                                "Utility" => "Utility",
                                "Utility: Air Cond" => "Utility: Air Cond",
                                "Utility: Cable" => "Utility: Cable",
                                "Utility: Deposit" => "Utility: Deposit",
                                "Utility: Electric"=> "Utility: Electric",
                                "Utility: Gas" => "Utility: Gas",
                                "Utility: General" => "Utility: General",
                                "Utility: Internet" => "Utility: Internet",
                                "Utility: Janitorial" => "Utility: Janitorial",
                                "Utility: Sewer" => "Utility: Sewer",
                                "Utility: Telephone" => "Utility: Telephone",
                                "Utility: Trash Collection" => "Utility: Trash Collection",
                                "Utility: Water" => "Utility: Water",
                                "VAT" => "VAT",
                                "Warrant Fee" => "Warrant Fee",
                                "Washer Machine Fee" => "Washer Machine Fee",
                                "Water Charge" => "Water Charge",
                                "Water Deposit" => "Water Deposit"

                            ),null,array('placeholder'=> 'Description',"class"=>"form-control" )) !!}

                        </div>
                    </div>
                    <div class="form-group col-md-2 col-md-2">
                        <div class="input-icon right">
                            <i class="fa fa-dollar"></i>
                            {!! Form::text('amount[]',null,array('placeholder'=> "Amount","class"=>"form-control" )) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-3 col-md-3">
                        <div class="input-icon right">
                            <i class="fa fa-user for-select"></i>
                            {!! Form::select('frequency[]',array(
                                 'once_start' => 'Once only, when the lease starts',
                                 'once_end' => 'Once only, when the lease ends',
                                 'monthly' => 'Monthly',
                                 'yearly' => 'Yearly' ),null,array('placeholder'=> "Due","class"=>"form-control" )) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-2 col-md-2">
                        <div class="input-icon right">
                            <i class="fa fa-user for-select"></i>
                            {!! Form::select('variable[]',array(
                                    1 => 'Yes',
                                    0 => 'No',
                                     ),null,array('placeholder'=> "Variable","class"=>"form-control" )) !!}
                        </div>
                    </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                </div>
            <div class="clearfix"></div>
            <div class="col-md-12 col-lg-12" style="display:none;">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-dark bold uppercase"><icon class="fa fa-file"></icon> Documents file</span>
                    </div>
                    <div class="tools pull-right" style="margin-top:15px;">
                        <span class="pointer addExpHtml" ><icon class="fa fa-plus"></icon> Add More</span>
                    </div>
                </div>

                <div class="portlet-body AppendOtherExp">
                    <div class="form-group col-lg-6 col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-dollar"></i>
                            {!! Form::text('document_title[]',null,array('placeholder'=> "File ","class"=>"form-control" )) !!}
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-file for-select"></i>
                            {!! Form::file('document_file[]',null,array('placeholder'=> "Amount","class"=>"form-control" )) !!}
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
            </div>
        </div>
       {!! Form::close() !!}
    </div>
    <div class="exp_html" style="display: none">
    <div>
    <div class="form-group col-md-4 col-md-4">
        <div class="input-icon right">
            <i class="fa fa-money for-select"></i>
            {!! Form::select('expense[]',array(
                "Activity Fee"=> "Activity Fee",
                "Administration Fee"=> "Administration Fee",
                "Application Fee" => "Application Fee",
                "Back Rent" => "Back Rent",
                "Bank Charges" => "Bank Charges",
                "Check Out Fee" => "Check Out Fee",
                "Cleaning Fee" => "Cleaning Fee",
                "Common Area Maint" => "Common Area Maint",
                "Compliance Discount" => "Compliance Discount",
                " Cosigner Fee" => "Cosigner Fee",
                "Court Fee"=> "Court Fee",
                "Credit Card Fee" => "Credit Card Fee",
                "Deferral Fee" => "Deferral Fee",
                "Deposit Fee" => "Deposit Fee",
                "Early Termination Fee" => "Early Termination Fee",
                "Equity Payment"=> "Equity Payment",
                "Extension Fee"=> "Extension Fee",
                "Exterminator Fee"=> "Exterminator Fee",
                "Extra Person Fee"=> "Extra Person Fee",
                "Garage Fee"=> "Garage Fee",
                "Hazard Insurance" => "Hazard Insurance",
                    "Heat Surcharge"=> "Heat Surcharge",
                "HOA Fee"=> "HOA Fee",
                "HOA Violation" => "HOA Violation",
                "Holding Fee" => "Holding Fee",
                "Holdover Fee" => "Holdover Fee",
                "Home Rent"=> "Home Rent",
                "Insurance" => "Insurance",
                "Judgement Installment" => "Judgement Installment",
                "Key Deposit" => "Key Deposit",
                "Key Replacement Fee" => "Key Replacement Fee",
                "Last Months Rent" => "Last Months Rent",
                "Late Fee, One-Time" => "Late Fee, One-Time",
                "Lawn/Snow Maint" => "Lawn/Snow Maint",
                "Lease Reinstatement Fee" => "Lease Reinstatement Fee",
                "Legal Fees" => "Legal Fees",
                "Lockout Fee" => "Lockout Fee",
                "Maintenance Fee"=> "Maintenance Fee",
                "Management Fee" => "Management Fee",
                "Miscellaneous" => "Miscellaneous",
                "Month to Month" => "Month to Month",
                "Mortgage" => "Mortgage",
                "Move In Fee" => "Move In Fee",
                "NSF Fee" => "NSF Fee",
                "Option Payment" => "Option Payment",
                "Painting" => "Painting",
                "Parking Fee" => "Parking Fee",
                "Parking Fee, Electrical" => "Parking Fee, Electrical",
                "Parking Fee, Heated" => "Parking Fee, Heated",
                "Parking Lot" => "Parking Lot",
                "Penalty" => "Penalty",
                "Pest Control" => "Pest Control",
                "Pet Deposit" => "Pet Deposit",
                "Pet Fee" => "Pet Fee",
                "PHA (Public Housing Auth)"=> "PHA (Public Housing Auth)",
                "Prepaid Rent" => "Prepaid Rent",
                "Prior Balance" => "Prior Balance",
                "Pro Ratio Billing" => "Pro Ratio Billing",
                 "Property Tax" => "Property Tax",
                "Prorated Rent" => "Prorated Rent",
                "Reimbursement" => "Reimbursement",
                "Rent from Secondary Tenant" => "Rent from Secondary Tenant",
                "Rent Lock Fee" => "Rent Lock Fee",
                "Repair Fee" => "Repair Fee",
                "Returned Check" => "Returned Check",
                "Section 8" => "Section 8",
                "Section-8 Portion" => "Section-8 Portion",
                "Security Deposit" => "Security Deposit",
                "Steam Cleaning" => "Steam Cleaning",
                "Storage Fee" => "Storage Fee",
                "Taxes" => "Taxes",
                "Taxes: Gov" => "Taxes: Gov",
                "Transfer Fee" => "Transfer Fee",
                "Trip Charge"=> "Trip Charge",
                "Utility" => "Utility",
                "Utility: Air Cond" => "Utility: Air Cond",
                "Utility: Cable" => "Utility: Cable",
                "Utility: Deposit" => "Utility: Deposit",
                "Utility: Electric"=> "Utility: Electric",
                "Utility: Gas" => "Utility: Gas",
                "Utility: General" => "Utility: General",
                "Utility: Internet" => "Utility: Internet",
                "Utility: Janitorial" => "Utility: Janitorial",
                "Utility: Sewer" => "Utility: Sewer",
                "Utility: Telephone" => "Utility: Telephone",
                "Utility: Trash Collection" => "Utili ty: Trash Collection",
                "Utility: Water" => "Utility: Water",
                "VAT" => "VAT",
                "Warrant Fee" => "Warrant Fee",
                "Washer Machine Fee" => "Washer Machine Fee",
                "Water Charge" => "Water Charge",
                "Water Deposit" => "Water Deposit"

            ),null,array('placeholder'=> 'Description',"class"=>"form-control" )) !!}

        </div>
    </div>
    <div class="form-group col-md-2 col-md-2">
        <div class="input-icon right">
            <i class="fa fa-dollar"></i>
            {!! Form::text('amount[]',null,array('placeholder'=> "Amount","class"=>"form-control" )) !!}
        </div>
    </div>
    <div class="form-group col-md-3 col-md-3">
        <div class="input-icon right">
            <i class="fa fa-user for-select"></i>
            {!! Form::select('frequency[]',array(
                    'once_start' => 'Once only, when the lease starts',
                    'once_end' => 'Once only, when the lease ends',
                    'monthly' => 'Monthly',
                    'yearly' => 'Yearly' ),null,array('placeholder'=> "Due","class"=>"form-control" )) !!}
        </div>
    </div>
    <div class="form-group col-md-2 col-md-2">
        <div class="input-icon right">
            <i class="fa fa-user for-select"></i>
            {!! Form::select('variable[]',array(
                        1 => 'Yes',
                        0 => 'No',
                     ),null,array('placeholder'=> "Variable","class"=>"form-control" )) !!}
        </div>
    </div>
    <div class="col-md-1 col-lg-1"><icon class="fa fa-remove pointer removeExp" ></icon></div>
    <div class="clearfix"></div>
    </div>
</div>



@endsection
@push('scripts')

<script src="{{asset('resources/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/js/tenant.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/js/lease.js')}}" type="text/javascript"></script>

<script src="{{asset('resources/assets/js/jquery-ui.min.js')}}" type="text/javascript" ></script>

    <script>
    $(document).ready(function(){

            tenant.init()
            lease.init()


    })</script>
<script>

    $(function() {
        $( "#unit_show" ).autocomplete({
            source: app.baseUrl()+"/unit/get/"+$("#building").val()
        ,select:function( event, ui ) {

                $("#unit_show").val(ui.item.label)
                $("#unit_id").val(ui.item.value)
                return false;
                if($("applicant_id").val()){
                    $("#lease_profile").fadeIn()
                }
            }

        });

        $( "#applicant" ).autocomplete({
            source: <?php echo $applicantsDataSet ?>
            ,select:function( event, ui ) {
                tenant.getApplicant(ui.item.value)
                $("#applicant").val(ui.item.label)
                $("#applicant_id").val(ui.item.value)
                if($("#unit_id").val()){
                    $("#lease_profile").fadeIn()
                }
                parent.resizeIframe();
                return false;
            }
        });
    });


</script>
@endpush