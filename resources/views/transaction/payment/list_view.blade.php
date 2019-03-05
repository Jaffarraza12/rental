@extends('layouts.app')
@push('css')
<link href="{{asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('resources/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<style>
    .dataTables_length{
        top:-185px !important;
    }
</style>
@endpush
@section('content')
    <div class="page-container">
        @include("common.adminsideview")

        <div class="page-content-wrapper">
            <div class="page-content">
            {{--@include("common.breadcrumb")--}}
            <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    <div  style="position: relative; display: none">
                        <div>
                            <span style="float: right;margin:0 33px 23px ;"> <a class="btn btn-redish pop" data-url="{{URL('/payment/add/')}}" ><small><icon class="fa fa-plus"></icon><span>  ADD PAYMENT</span></small></a></span>
                        </div>
                    </div>
                    <div class="col-md-12">


                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">

                            <div class="col">
                                <div class="caption"><h1>{{$heading. ' ' }}</h1>

                                    <span> </span>    </div>
                                <div class="tools">
                                    <a style="display:none;" href="javascript:;" class="collapse"> </a>
                                    <a style="display:none;" href="javascript:;" class="reload"> </a>
                                    <a style="display:none;" href="javascript:;" class="remove"> </a>
                                    <div class="dt-buttons">
                                    </div>
                                </div>


                            </div>

                            <div class="portlet-title" style="">
                                <div class="clearfix"></div>
                                <div class="row" style="margin-top:10px;">
                                    {!! Form::hidden('building_id',\Illuminate\Support\Facades\Session::get('defaultBuilding'),array('placeholder'=> "Buildings","class"=>"form-control filter","id"=>"building")) !!}
                                <div class="form-group col-md-4 col-lg-4">
                                    <div class="input-icon right ">
                                        <i class="fa fa-square-o for-select"></i>
                                        {!! Form::select('unit',$units,null,array('placeholder'=> "Units","class"=>"form-control filter","id"=>"unit")) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-lg-4">
                                    <div class="input-icon input-icon-lg right">
                                        <i class="fa fa-user for-select"></i>
                                        {!! Form::select('tenant_id',$tenant,null,array('placeholder'=> "Tenants","class"=>"form-control filter","id"=>"tenant_id")) !!}
                                    </div>
                                </div>

                                <div class="form-group col-md-4 col-lg-4">
                                    <div class="input-icon input-icon-lg right">
                                        <i class="fa fa-money for-select"></i>
                                        {!! Form::select('payment_method',array(
                                            'auto_payment' => 'Automated Payment',
                                            'cash' => 'Cash',
                                            'cheaque' => 'Cheaque'
                                        ),null,array('placeholder'=>"Payment Method","class"=>"form-control filter",'id'=>'payment_method' )) !!}
                                    </div>
                                </div> <div class="clearfix"></div>
                                <div class="form-group col-md-6 col-lg-6">
                                    <div class="input-icon input-icon-lg right">
                                        <i class="fa fa-money for-select"></i>
                                        {!! Form::select('payment_type',array(
                                                "012"=> "Rent Payment",
                                                "Activity Fee"=> "Activity Fee",
                                                "Administration Fee"=> "Administration Fee",
                                                "Application Fee" => "Application Fee",
                                                "Back Rent" => "Back Rent",
                                                "Bank Charges" => "Bank Charges",
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

                                          ),null,array('placeholder'=>"Payment Type","class"=>"form-control filter",'id'=>'payment_type' )) !!}
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 date_range">
                                    <div class="input-group  date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
                                        {!! Form::text('from',null,array("class"=>"form-control filter",'id'=>'from' )) !!}
                                        <span class="input-group-addon"> to </span>
                                        {!! Form::text('to',null,array("class"=>"form-control filter",'id'=>'to' )) !!}
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <div class="clearfix"></div>
                                </div>


                            </div>
                            {{ csrf_field() }}
                            <div class="portlet-body flip-scroll">
                                <table id="attribute" class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline collapsed">
                                    <thead class="flip-content">
                                    <tr>
                                        <th>Payment Type</th>
                                        <th>Building/Apartment Name</th>
                                        <th>Unit No</th>
                                        <th>Amount</th>
                                        <th>Payment Recieved</th>
                                        <th>Due Date</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tfoot>

                                    </tfoot>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END SIDEBAR CONTENT LAYOUT -->
    </div>

    </div>
    </div>



    <!-- END CONTAINER -->
@endsection
@push('scripts')
<script src="{{asset('resources/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/js/work_order.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/js/payment.js')}}" type="text/javascript"></script>
<script  type="text/javascript">
    $(document).ready(function(){

        payment.init()
        work_order.init();


        $("body").on("click",".pop",function () {
            url= $(this).data("url")
            app.popUp(url,$('#attribute').DataTable( ));
        })

        var table = $('#attribute').DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            bJQueryUI: false,
            ajax:  {
                url: '{!! URL('/payment/data/') !!}',
                dataType: 'json',
                type: 'GET',
                data: function ( d ) {
                    d.building_id = $("#building").val(),
                        d.unit_id = $("#unit").val(),
                        d.tenant_id= $("#tenant_id").val(),
                        d.payment_type= $("#payment_type").val(),
                        d.from= $("#from").val(),
                        d.to= $("#to").val()               }
            },
            columns: [
                { data: 'description', name: 'description' , bSortable: false },
                { data: 'name', name: 'name' , bSortable: false },
                { data: 'Unitname', name: 'Unitname' , bSortable: false },
                { data: 'amount', name: 'amount' , bSortable: false },
                { data: 'payment', name: 'payment' , bSortable: false },
                { data: 'due_date', name: 'due_date' , bSortable: false },
                { data: 'actions', name: 'actions' , bSortable: false },
            ]

        });

        $(".filter").change(function() {
            $('#attribute').DataTable().ajax.reload()
        })




    });
</script>
@endpush