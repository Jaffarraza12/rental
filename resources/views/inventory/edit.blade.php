@extends('layouts.appmodel')
@push('css')
<link href="{{asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('resources/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <h3 class="caption-subject bold uppercase text-center"> <i class="glyphicon glyphicon-wrench"></i> {{$heading}}</h3>
        </div>

    </div>
    <div class="portlet-body form">
    {!! Form::open(array('url' => $ActionURL ,'method'=>'post')) !!}
    <!-- BEGIN PORTLET-->
        <div class="form-body">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="input-icon input-icon-lg right">
                    <i class="fa fa-text-width"></i>
                    {!! Form::text('productName',$record->productName,array('placeholder'=>"Product Name","class"=>"form-control" )) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon right">
                    <i class="fa fa-building-o for-select"></i>
                    {!! Form::text('productDescription',$record->productDescription,array('placeholder'=>"Product Description","class"=>"form-control" )) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon right">
                    <i class="fa fa-square-o for-select"></i>
                    {!! Form::text('unitCost',$record->unitCost,array('placeholder'=> "Unit Cost","class"=>"form-control")) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon input-icon-lg right">
                    <i class="fa fa-location"></i>
                    {!! Form::text('quantity',$record->quantity,array('placeholder'=>"Quantity","class"=>"form-control" )) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon input-icon-lg right">
                    <i class="fa fa-user"></i>
                    {!! Form::text('vendor',$record->vendor,array('placeholder'=>"Vendor Name","class"=>"form-control" )) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon input-icon-lg right">
                    <i class="fa fa-phone"></i>
                    {!! Form::text('contactNumber',$record->contactNumber,array('placeholder'=>"Vendor Contact","class"=>"form-control" )) !!}
                </div>
            </div>


                <div class="col-md-6">

                    <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                        {!! Form::text('purchasingDate',date('Y-m-d',strtotime($record->due_date)),array('placeholder'=>"Purchasing Date","class"=>"form-control",'readonly'=>'readonly' )) !!}
                        <span class="input-group-btn">
                                       <button class="btn default" type="button">
                                          <i class="fa fa-calendar"></i>
                                       </button>
                                </span>
                    </div>
                </div>
                <div class="clearfix"></div>

                <!-- /input-group -->
            </div>



            <div class="clearfix"></div>

            <div class="form-actions">
                <div class="btn-set">
                    <button class="btn red btn" type="submit"><i class="fa fa-save"></i> SAVE</button>
                </div>
            </div>

            {{--<div class="form-group">
                <div class="input-icon input-icon-lg right">
                    <button class="btn red btn-block" type="submit"> SAVE</button>
                    <button class="btn btn-default btn-block" type="button"> CANCEL</button>
                </div>

        </div>--}}
            {!! Form::close() !!}
        </div>


        @endsection
        @push('scripts')
        <script src="{{asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('resources/assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('resources/assets/js/work_order.js')}}" type="text/javascript"></script>
        <script  type="text/javascript">
            $(document).ready(function () {
                inventory.init()
            })
        </script>

    @endpush