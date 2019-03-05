@extends('layouts.app')
@push('css')
<link href="{{asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('resources/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="{{asset('resources/assets/css/lease.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('resources/assets/css/form.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="page-container rentalForm">
        @include("common.adminsideview")
        <div class="page-content-wrapper">
            <div class="page-content">
            @include("common.breadcrumb")
            <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
    {!! Form::open(array('url' => $ActionURL ,'method'=>'post',"class"=>"app_form")) !!}
    <!-- BEGIN PORTLET-->
        <div class="form-body rentalForm">
            {{ csrf_field() }}
            {!! Form::hidden('building_id',$building_id,null,array('placeholder'=> "Building","class"=>"form-control","id"=>"building" )) !!}
            <div class="col-md-12 col-lg-12">
            <div class="portlet light bordered ">
                <div class="forcm-group col-md-6 col-lg-6">
                    <div class="input-icon input-icon-lg right">
                        <label >Unit Name</label>
                        {!! Form::hidden('unit_id',null,array('id'=>'unit_id')) !!}
                        {!! Form::text('unit',old('unit'),array('placeholder'=> "","class"=>"form-control","id"=>"unit_show" )) !!}
                        <span class="help-block">{{ $errors->mess->first('unit_id') }}</span>

                    </div>
                </div>
                <div class="form-group col-md-6 col-lg-6">
                    <div class="input-icon input-icon-lg right">
                        <label >Applicant Type</label>
                        {!! Form::select('applicant_type',array(
                                '1' => 'Select Applicant From Existing list',
                                '2' => 'Add New'
                        ),null,array('placeholder'=> "","class"=>"form-control","id"=>"applicant_type" )) !!}
                        <span class="help-block">{{ $errors->mess->first('applicant_id') }}</span>
                    </div>
                </div>

                    <div class="clearfix"></div>

                <div class="clearfix"></div>
                <div class="form-group col-md-12 col-lg-12 applicant_field">
                    <div class="input-icon input-icon-lg right">
                        <label>Applicant Name</label>
                        {!! Form::text('applicant',old('applicant'),array('placeholder'=> "","class"=>"form-control","id"=>"applicant" )) !!}
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
                                    <h2>Applicant Detail.</h2>
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
                                {{--@include('applicant.prospect.form')--}}
                            </div>
                            <!-- END PAGE BASE CONTENT -->
                        </div>
                    </div>
                </div>
                <!--applicant form-->

            </div>
            </div>

            <div style="display: none" class="dt-buttons  col-md-3 col-lg-3 text-center">
                <div class="btn-group">
                    <button class="btn red btn" type="submit"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>

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
        <div class="col-md-12 col-lg-12 rentalForm">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-dark bold uppercase"> Lease Term & Rental Rate</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="form-group col-md-4  col-lg-4">
                        <div class="input-icon input-icon-lg right">
                            <label >Payment Term</label>
                            {!! Form::select('lease_prefer',array(
                                'Monthly' => 'Monthly',
                                'Bi-Monthly' => 'Bi-Monthly',
                                'Quarterly' => 'Quarterly',
                                'Every-6-month' => 'Every 6 Months',
                                'Yearly' => 'Yearly'
                                ),old('lease_perfer'),array('placeholder'=> "","class"=>"form-control","id"=>'lease_prefer' )) !!}
                            <span class="help-block">{{ $errors->mess->first('lease_prefer') }}</span>
                        </div>
                    </div>



                    <div class="col-md-8 col-lg-8 date_range" >
                        <label>Starting and Ending Date</label>
                        <div class="input-group  date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                            {!! Form::text('start',null,array("class"=>"form-control" )) !!}
                            <span class="input-group-addon"> to </span>
                            {!! Form::text('end',null,array("class"=>"form-control" )) !!}
                        </div>
                        <span class="help-block">{{ $errors->mess->first('start') }}</span>
                        <span class="help-block">{{ $errors->mess->first('end') }}</span>
                        <!-- /input-group -->
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-md-4 col-lg-4" >
                        <div class="input-group  date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                            <div class="input-icon input-icon-lg right">
                                <label >Lease Type</label>
                                {!! Form::select('rent_type',array(
                                    'Fixed' => 'Fixed',
                                    'Month To Month' => 'Month To Month',
                                    'Flexible' => 'Flexible'
                                    ),old('lease_perfer'),array('placeholder'=> " ","class"=>"form-control" )) !!}
                                <span class="help-block">{{ $errors->mess->first('rent_type') }}</span>
                            </div>

                        </div>
                        <!-- /input-group -->
                    </div>



                    <div class="form-group col-md-4  col-lg-4">
                        <div class="input-group  date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                            <div class="input-icon input-icon-lg right">
                                <label >Notice Period</label>
                        {!! Form::select('notice_period',array(
                                                     '12' => '12 Months',
                                                     '8' => '8 Months',
                                                     '6' => '6 Months',
                                                     '4' => '4 Months',
                                                     ),'12',array('placeholder'=> "","class"=>"form-control","id"=>'lease_prefer' )) !!}
                            </div>

                        </div>
                    </div>
                    <div class="form-group col-md-4 col-md-4">
                        <div class="input-icon right">
                            <label >Amount</label>
                            {!! Form::text('rate',null,array('placeholder'=> "","class"=>"form-control" )) !!}
                            <span class="help-block">{{ $errors->mess->first('rate') }}</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-12 col-md-12">
                        <div class="input-icon right">
                            <label >Comments</label>
                            {!! Form::text('comment',null,array('placeholder'=> "","class"=>"form-control" )) !!}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 col-lg-12">
            <div class="portlet light bordered">
                <div class="portlet-title ">
                    <div class="caption">
                        <span class="caption-subject font-dark bold uppercase"> Other Expenses</span>
                    </div>

                </div>
                <div class="portlet-body AppendOtherExp rentalForm">
                    <div class="form-group col-md-4 col-md-4">
                        <div class="input-icon right">
                            <label >Description</label>
                            {!! Form::select('expense[0]',array(
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

                            ),null,array('placeholder'=> '',"class"=>"form-control" )) !!}

                        </div>
                    </div>
                    <div class="form-group col-md-2 col-md-2">
                        <div class="input-icon right">
                            <label >Amount</label>
                            {!! Form::text('amount[0]',null,array('placeholder'=> "","class"=>"form-control" )) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-3 col-md-3">
                        <div class="input-icon right">
                            <label >Due</label>
                            {!! Form::select('frequency[0]',array(
                                 'once_start' => 'Once only, when the lease starts',
                                 'once_end' => 'Once only, when the lease ends',
                                 'monthly' => 'Monthly',
                                 'yearly' => 'Yearly' ),null,array('placeholder'=> "","class"=>"form-control" )) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-2 col-md-2">
                        <div class="input-icon right">
                            <label >Variable</label>
                            {!! Form::select('variable[0]',array(
                                    1 => 'Yes',
                                    0 => 'No',
                                     ),null,array('placeholder'=> "","class"=>"form-control" )) !!}
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="tools pull-right" style="margin-top:15px;">
                    <span class="pointer addExpHtml" ><icon class="fa fa-plus"></icon> Add More</span>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-2"></div>
                <div class="col-md-12">

                    <div class="form-actions">
                        <div class="btn-set ">
                            <button class="btn greenish btn" type="submit"> SAVE</button>
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
                    <label >Description</label>
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

                    ),null,array('placeholder'=> '',"class"=>"form-control" )) !!}

                </div>
            </div>
            <div class="form-group col-md-2 col-md-2">
                <div class="input-icon right">
                    <label >Amount</label>
                    {!! Form::text('amount[]',null,array('placeholder'=> "","class"=>"form-control" )) !!}
                </div>
            </div>
            <div class="form-group col-md-3 col-md-3">
                <div class="input-icon right">
                    <label >Due</label>
                    {!! Form::select('frequency[]',array(
                            'once_start' => 'Once only, when the lease starts',
                            'once_end' => 'Once only, when the lease ends',
                            'monthly' => 'Monthly',
                            'yearly' => 'Yearly' ),null,array('placeholder'=> "","class"=>"form-control" )) !!}
                </div>
            </div>
            <div class="form-group col-md-2 col-md-2">
                <div class="input-icon right">
                    <label >Variable</label>
                    {!! Form::select('variable[]',array(
                                1 => 'Yes',
                                0 => 'No',
                             ),null,array('placeholder'=> "","class"=>"form-control" )) !!}
                </div>
            </div>
            <div class="col-md-1 col-lg-1"><icon class="fa fa-remove pointer removeExp" ></icon></div>
            <div class="clearfix"></div>
          div>
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
                // parent.resizeIframe();
                return false;
            }
        });
    });


</script>




    @endpush