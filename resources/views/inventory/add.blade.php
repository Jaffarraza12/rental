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
            <div class="form-group col-md-4 col-lg-4">
              <div class="input-icon input-icon-lg right">
                  <i class="fa fa-text-width"></i>
                  {!! Form::text('productName',null,array('placeholder'=>"Product Name","class"=>"form-control" )) !!}
              </div>
            </div>
            <div class="form-group col-md-4 col-lg-4">
                <div class="input-icon input-icon-lg right">
                    <i class="fa fa-text-width"></i>
                    {!! Form::text('productDescription',null,array('placeholder'=> "Product Description","class"=>"form-control")) !!}
                </div>
            </div>
            <div class="form-group col-md-4 col-lg-4">
                <div class="input-icon input-icon-lg right">
                    <i class="fa fa-money"></i>
                    {!! Form::text('unitCost',null,array('placeholder'=> "Unit Cost","class"=>"form-control","id"=>"unit")) !!}
                </div>
            </div>
            <div class="form-group col-md-4 col-lg-4">
                <div class="input-icon input-icon-lg right">
                    <i class="fa fa-caret-down"></i>
                    {!! Form::number('quantity',null,array('placeholder'=>"Quantity","class"=>"form-control" )) !!}
                </div>
            </div>
            <div class="form-group col-md-4 col-lg-4">
                <div class="input-icon input-icon-lg right">
                    <i class="fa fa-user"></i>
                    {!! Form::text('vendor',null,array('placeholder'=>"Vendor","class"=>"form-control" )) !!}
                </div>
            </div>

            <div class="form-group col-md-4 col-lg-4">
                <div class="input-icon input-icon-lg right">
                    <i class="fa fa-phone"></i>
                    {!! Form::text('contactNumber',null,array('placeholder'=>"Contact Number","class"=>"form-control" )) !!}
                </div>
            </div>



            <div class="clearfix"></div>
            <div class="form-group">
                    <div class="col-md-6">
                        <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                            {!! Form::text('purchasingDate',null,array('placeholder'=>"Purchasing Date","class"=>"form-control",'readonly'=>'readonly' )) !!}
                            <span class="input-group-btn">
                                   <button class="btn default" type="button">
                                      <i class="fa fa-calendar"></i>
                                   </button>
                            </span>
                        </div>
                    </div>



            <div class="clearfix"></div>
            <div class="form-actions">
                <div class="btn-set">
                    <button class="btn red btn" type="submit"><i class="fa fa-save "></i> SAVE</button>
                </div>
            </div>
                <div class="container">
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">{{Session::get(flash_message)}}}</div>
                    @endif

                </div>

        {!! Form::close() !!}
    </div>




@endsection
@push('scripts')
<script src="{{asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/js/inventory.js')}}" type="text/javascript"></script>
<script  type="text/javascript">
    $(document).ready(function () {
        inventory.init()
    })
</script>

@endpush