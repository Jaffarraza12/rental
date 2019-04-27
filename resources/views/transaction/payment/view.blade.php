@extends('layouts.appmodel')
@section('content')

    <div class="portlet-title">

        <div class="caption font-red-sunglo">

            <h3 class="caption-subject bold uppercase text-center"> <i class="fa fa-money"></i> {{$heading}}<div class="abc">Account Balance is  ${{$total}}</div></h3>

    </div>
    <div class="container-fluid">
        <div class="">
            <!-- BEGIN SIDEBAR CONTENT LAYOUT -->
            <div class="page-content-container">
                <div class="page-content-row">
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        {!! Form::open(array('url' => $ActionURL ,'method'=>'post')) !!}
                        <div class="col-md-11">

                            <div class="form-group">

                                    {!! Form::hidden('tenant_id',$tenantID->tenant_id,array('placeholder'=>"Payment",'size'=>'5',"class"=>"form-control" )) !!}
                                    {!! Form::hidden('lease_id',$tenantID->lease_id,array('placeholder'=>"Payment",'size'=>'5',"class"=>"form-control" )) !!}


                            </div>

                            <div class="portlet  ">
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
                                            <th>Operations</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                                        @foreach($payments as $payment)

                                            <tr>
                                                {!! Form::hidden('description',($payment->description) ?  $payment->description : 'Rent Payment',array('placeholder'=>"Payment",'size'=>'5',"class"=>"form-control" )) !!}
                                                {!! Form::hidden('payments',$payment->payment_id,array('placeholder'=>"Payment",'size'=>'5',"class"=>"form-control" )) !!}
                                                <td>{!! Form::checkbox('payment[]',$payment->payment_id,false,array('data-checkbox'=> 'icheckbox_flat-grey','class' => 'payment dues' ,'data-amount' => $payment->amount ) ) !!}</td>
                                                <td> {{($payment->description) ?  $payment->description : 'Rent Payment'}}</td>
                                                <td>{{$payment->name}}</td>
                                                <td>{{$payment->Unitname }}</td>
                                                <td>     {!! Form::text('amount',$payment->amount,array('placeholder'=>"Payment",'size'=>'5',"disabled" => "disabled","class"=>"form-control" )) !!}</td>
                                                <td>@if($payment->payment == 0)
                                                        {{'Not Received '}}
                                                    @elseif($payment->payment == 1)
                                                        {{ 'Processing' }}
                                                    @elseif($payment->payment == 2)
                                                        {{ 'Payment Received' }}
                                                    @endif

                                                </td>
                                                <td>{{$payment->due_date}}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                        {{--  <td colspan="8" align="right">{{$payments->render()}}</td>--}}{{--
                                        </tr>
                                        </tbody>--}}
                                    </table>
                                </div>
                            </div>
                            <div class="container">
                                <div class="form-group  col-md-11 col-lg-11">
                                    <div class="input-icon input-icon-lg">
                                        <i class="fa fa-money"></i>
                                        {!! Form::text('payment',0,array('placeholder'=>"amount", 'id'=>'amount',"class"=>"form-control" )) !!}
                                    </div>
                                </div>


                                <div class="form-group  col-md-11 col-lg-11">
                                    <div class="form-actions">
                                        <div class="btn-set">
                                            <button type="submit" class="btn red btn" href="javascript:;" ><i class="fa fa-money"></i> Pay </button>
                                        </div>
                                    </div>
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
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <h3 class="caption-subject bold uppercase text-center"> <i class="fa fa-money"></i> {{$heading1}}

            </h3>





        </div>
        <div class="container-fluid">
            <div class="">
                <!-- BEGIN SIDEBAR CONTENT LAYOUT -->
                <div class="page-content-container">
                    <div class="page-content-row">
                        <!-- BEGIN PAGE BASE CONTENT -->
                        <div class="row">
                            {!! Form::open(array('url' => $ActionURL ,'method'=>'post')) !!}
                            <div class="col-md-11">
                                <!-- BEGIN SAMPLE TABLE PORTLET-->
                                {{-- <div class="form-groupsh" >
                                     <div class="input-icon input-icon-lg">
                                         <i class="fa fa-money"></i>
                                       --}}{{--  {!! Form::text('payment',$amount,array('placeholder'=>"amount", 'id'=>'amount',"class"=>"form-control","disable")) !!}--}}{{--
                                     </div>
                                 </div>--}}
                                <div class="form-group">

                                    {!! Form::hidden('tenant_id',$tenantID->tenant_id,array('placeholder'=>"Payment",'size'=>'5',"class"=>"form-control" )) !!}
                                    {!! Form::hidden('lease_id',$tenantID->lease_id,array('placeholder'=>"Payment",'size'=>'5',"class"=>"form-control" )) !!}

                                </div>

                                <div class="portlet  ">
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
                                                <th>Operations</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($paymenta as $payment)
                                                <tr>

                                                    <td>{!! Form::checkbox('payment[]',$payment->payment_id,false,array('data-checkbox'=> 'icheckbox_flat-grey','class' => 'payment dues' ,'data-amount' => $payment->amount ) ) !!}</td>
                                                    <td> {{($payment->description) ?  $payment->description : 'Rent Payment'}}</td>
                                                    <td>{{$payment->name}}</td>
                                                    <td>{{$payment->Unitname }}</td>
                                                    <td>     {!! Form::text('amount',$payment->amount,array('placeholder'=>"Payment",'size'=>'5',"disabled" => "disabled","class"=>"form-control" )) !!}</td>
                                                    <td>@if($payment->payment == 0)
                                                            {{'Not Received '}}
                                                        @elseif($payment->payment == 1)
                                                            {{ 'Processing' }}
                                                        @elseif($payment->payment == 2)
                                                            {{ 'Payment Received' }}
                                                        @endif

                                                    </td>
                                                    <td>{{$payment->due_date}}</td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                            {{--  <td colspan="8" align="right">{{$payments->render()}}</td>--}}{{--
                                            </tr>
                                            </tbody>--}}
                                        </table>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="form-group  col-md-11 col-lg-11">

                                    </div>


                                    <div class="form-group  col-md-11 col-lg-11">

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



@endsection
@push('scripts')
<script src="{{asset('resources/assets/global/plugins/icheck/icheck.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/pages/scripts/form-icheck.min.js')}}" type="text/javascript"></script>

<script src="{{asset('resources/assets/js/payment.js')}}" type="text/javascript"></script>
<script >
    payment.init()

    $('.dues').click(function() {
        if(this.checked) {
            amount = parseInt($(this).data('amount')) + eval($("#amount").val())
           $("#amount").val(amount)

        } else {
            amount = eval($("#amount").val()) - parseInt($(this).data('amount'))
            if(amount < 0 ){
                $("#amount").val("0")
            } else {
                $("#amount").val(amount)
            }
        }
    });
</script>
@endpush