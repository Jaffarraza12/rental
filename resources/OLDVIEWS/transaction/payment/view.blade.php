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
                        {!! Form::open(array('url' => $ActionURL ,'method'=>'post')) !!}
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-money"></i> Payments
                                    </div>
                                    <div class="tools">
                                        <a style="display:none;" href="javascript:;" class="collapse"> </a>
                                        <a style="display:none;" href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a style="display:none;" href="javascript:;" class="reload"> </a>
                                        <a style="display:none;" href="javascript:;" class="remove"> </a>
                                        <button type="submit" class="btn btn-primary payment_button" href="javascript:;"  disabled="disabled"> Pay </button>
                                    </div>
                                </div>
                                {{ csrf_field() }}
                                <div class="portlet-body flip-scroll">



                                    <table id="attribute" class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline collapsed">
                                        <thead class="flip-content">
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>Payment Type</th>
                                            <th>Building/Apartment Name</th>
                                            <th>Unit No</th>
                                            <th>Amount</th>
                                            <th>Payment Recieved</th>
                                            <th>Due Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($payments as $payment)
                                            <tr>
                                                <td>{!! Form::checkbox('payment[]',$payment->payment_id,false,array('data-checkbox'=> 'icheckbox_flat-grey','class' => 'payment' ) ) !!}</td>
                                                <td> {{($payment->description) ?  $payment->description : 'Rent Payment'}}</td>
                                                <td>{{$payment->name}}</td>
                                                <td>{{$payment->Unitname }}</td>
                                                <td>     {!! Form::text('year_of_construction',$payment->amount,array('placeholder'=>"Payment",'size'=>'5',"disabled" => "disabled","class"=>"form-control" )) !!}</td>
                                                <td>@if($payment->payment == 0)
                                                        {{'Not Received '}}
                                                    @elseif($payment->payment == 1)
                                                        {{ 'Processing' }}
                                                    @elseif($payment->payment == 2)
                                                        {{ 'Payment Received' }}
                                                    @endif

                                                </td>





                                                <td>{{$payment->due_date}}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {!! Form::close() !!}
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



    <!-- END CONTAINER -->
    @include("common.adminsideview")
@endsection
@push('scripts')
<script src="{{asset('resources/assets/global/plugins/icheck/icheck.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/pages/scripts/form-icheck.min.js')}}" type="text/javascript"></script>

<script src="{{asset('resources/assets/js/payment.js')}}" type="text/javascript"></script>
<script >
    payment.init()
</script>

@endpush