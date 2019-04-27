@extends('layouts.appmodel')
@section('content')
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <h3 class="caption-subject bold uppercase text-center"> <i class="fa fa-money"></i> {{$heading}}</h3>
        </div>

    </div>
    <div class="container-fluid">
        <div class="">
            <!-- BEGIN SIDEBAR CONTENT LAYOUT -->
            <div class="page-content-container">
                <div class="page-content-row">
                <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet ">

                                <div class="portlet-body flip-scroll">
                                    {!! Form::open(array('url' => $ActionURL ,'method'=>'post')) !!}
                                        <div class="container">

                                            <div class="form-group  col-md-5 col-lg-5">
                                                <label>Pay with</label>
                                                <div class="input-icon input-icon-lg">
                                                    <i class="fa fa-bank for-select"></i>
                                                    {!! Form::select('payment_mode',array(
                                                                'eCheck' => 'eCheck',
                                                                'Cheque' => 'Cheque',
                                                                'Cash' => 'Cash'
                                                                ),null,array('placeholder'=> "Pay with","id"=>"payment_mode","class"=>"form-control", "required"=>"required" ) ) !!}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-5 col-lg-5">
                                                <label>Pay this amount</label>
                                                <div class="input-icon input-icon-lg">
                                                    <i class="fa fa-money for-select"></i>
                                                    {!! Form::text('amount',null,array('placeholder'=> "Pay this amount","class"=>"form-control", "required"=>"required" ) ) !!}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-5 col-lg-5">
                                                <label>On this date</label>
                                                <div class="input-icon date-picker input-daterange input-icon-lg" data-date="10/11/2012" data-date-format="yyyy/mm/dd">
                                                    <i class="fa fa-calendar for-select"></i>
                                                    {!! Form::text('date',null,array('placeholder'=> "On this date","class"=>"form-control", "required"=>"required" ) ) !!}
                                                </div>
                                            </div>


                                            <div class="form-group col-md-5 col-lg-5">
                                                <label>Comments</label>
                                                <div class="input-icon input-icon-lg">
                                                    <i class="fa fa-comment"></i>
                                                    {!! Form::text('comment',null,array('placeholder'=> "Comments","class"=>"form-control", "required"=>"required" ) ) !!}
                                                </div>
                                            </div>

                                            <div class="form-group if_cheaque col-md-5 col-lg-5" style="">
                                                <div class="input-icon input-icon-lg">
                                                    <i class="fa fa-bank"></i>
                                                    {!! Form::text('account_no',null,array('placeholder'=>"Account No", 'id'=>'account_no',"class"=>"form-control", "required"=>"required" )) !!}
                                                </div>
                                            </div>
                                            <div class="form-group if_cheaque col-md-5 col-lg-5" id="cheque_no" style="display: none">
                                                <div class="input-icon input-icon-lg">
                                                    <i class="fa fa-bank"></i>
                                                    {!! Form::text('cheque_no',null,array('placeholder'=>"Cheque No", "id"=>"cheque_no", "class"=>"form-control" )) !!}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-10 col-lg-10">
                                               {!! Form::hidden('tenant_id',$id,array('placeholder'=>"Tanent_id", "class"=>"form-control" )) !!}
                                                <button type="submit" class="btn red btn"><i class="fa fa-money"></i> Pay </button>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
            </div>
        </div>
        <!-- END SIDEBAR CONTENT LAYOUT -->
    </div>

    </div>
    </div>



@endsection
@push('scripts')
<script src="{{asset('resources/assets/global/plugins/icheck/icheck.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/pages/scripts/form-icheck.min.js')}}" type="text/javascript"></script>

<script src="{{asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>


<script src="{{asset('resources/assets/js/payment.js')}}" type="text/javascript"></script>
<script >
    payment.init()

    $("select").on('change',function () {
        if(this.value == 'Cheque'){
            $("#cheque_no").show();
        } else {
            $("#cheque_no").hide();
        }
    })

</script>
@endpush