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
                            <div class="portlet light bordered">
                                {{ csrf_field() }}
                                <div class="portlet-body flip-scroll">
                                    {!! Form::open(array('url' => $ActionURL ,'method'=>'post')) !!}
                                        <div class="container">

                                            <div class="form-group  col-md-12 col-lg-12">
                                                <div class="input-icon input-icon-lg right">
                                                    <i class="fa fa-paypal for-select"></i>
                                                    {!! Form::select('Payment Mode',array(
                                                                ),null,array('placeholder'=> "Building","class"=>"form-control" ) ) !!}
                                                </div>
                                            </div>

                                            <div class="form-group  col-md-12 col-lg-12">
                                                <div class="input-icon input-icon-lg right">
                                                    <i class="fa fa-paypal for-select"></i>
                                                    {!! Form::select('Payment Mode',array(
                                                                'cash' => 'Cash',
                                                                'Post Dated Cheaque' => 'Post Dated Cheaque',
                                                                'Cheaque Payment' => 'Cheaque Payment'
                                                                ),null,array('placeholder'=> "Unit_no","class"=>"form-control" ) ) !!}
                                                </div>
                                            </div>

                                            <div class="form-group  col-md-12 col-lg-12">
                                                <div class="input-icon input-icon-lg right">
                                                    <i class="fa fa-paypal for-select"></i>
                                                    {!! Form::select('payment',$payments,null,array('placeholder'=> "Payments","class"=>"form-control" ) ) !!}
                                                </div>
                                            </div>
                                            <div class="form-group  col-md-12 col-lg-12">
                                                <div class="input-icon input-icon-lg right">
                                                    <i class="fa fa-paypal for-select"></i>
                                                    {!! Form::select('Payment Mode',array(
                                                                'cash' => 'Cash',
                                                                'Post Dated Cheaque' => 'Post Dated Cheaque',
                                                                'Cheaque Payment' => 'Cheaque Payment'
                                                                ),null,array('placeholder'=> "Profile","class"=>"form-control" ) ) !!}
                                                </div>
                                            </div>
                                            <div class="form-group if_cheaque  col-md-12 col-lg-12" style="">
                                                <div class="input-icon input-icon-lg right">
                                                    <i class="fa fa-money"></i>
                                                    {!! Form::text('cheaque_no',0,array('placeholder'=>"Cheaque No", 'id'=>'amount',"class"=>"form-control" )) !!}
                                                </div>
                                            </div>
                                            <div class="form-group  col-md-12 col-lg-12">
                                                <button type="submit" class="btn btn-primary payment_button" href="javascript:;"  disabled="disabled"> Pay </button>
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

<script src="{{asset('resources/assets/js/payment.js')}}" type="text/javascript"></script>
<script >
    payment.init()

</script>
@endpush