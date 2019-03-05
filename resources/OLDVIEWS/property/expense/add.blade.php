@extends('layouts.appmodel')
@push('css')
<link href="{{asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('resources/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <h3 class="caption-subject bold uppercase text-center"> <i class="fa fa-money"></i> {{$heading}}</h3>
        </div>

    </div>
    <div class="portlet-body form">
    {!! Form::open(array('url' => $ActionURL ,'method'=>'post')) !!}
    <!-- BEGIN PORTLET-->
        <div class="form-body">
            {{ csrf_field() }}
            <div class="col-md-2">

            </div>
            {!! Form::hidden('work_order_id',$work_order_id,array( )) !!}


        <!-- Tab panes -->
            <div class="col-md-10">

                        <div class="form-group">
                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                {!! Form::text('entry_date',old('entry_date'),array('placeholder'=>"Due Date","class"=>"form-control",'readonly'=>'readonly' )) !!}
                                <span class="input-group-btn">
                                       <button class="btn default" type="button">
                                          <i class="fa fa-calendar"></i>
                                       </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-text-width"></i>
                                {!! Form::text('reference',old('reference'),array('placeholder'=>"Reference","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-sort-numeric-asc"></i>
                                {!! Form::text('amount','',array('placeholder'=>"amount","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-sort-numeric-asc"></i>
                                {!! Form::text('tax','',array('placeholder'=>"Tax","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-sort-numeric-asc"></i>
                                {!! Form::text('tax_2','',array('placeholder'=>"Tax 2","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon right">
                                <i class="fa fa-square-o for-select"></i>
                                {!! Form::select('payee',array(
                                            'Tenant' => 'Tenant',
                                            'Vendor' => 'Vendor',
                               ),old('payee'),array('placeholder'=> "Payee","class"=>"form-control","id"=>"opened")) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="icon-speech"></i>
                                {!! Form::textarea('memo',old('memo'),array('placeholder'=>"Memo","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="icon-speech"></i>
                                {!! Form::textarea('description',old('description'),array('placeholder'=>"Description","class"=>"form-control" )) !!}
                            </div>
                        </div>
                    </div>



            <div class="clearfix"></div>
            <div class="form-group">
                <div class="input-icon input-icon-lg right">
                    <button class="btn red btn-block" type="submit"> SAVE</button>
                    <button class="btn btn-default btn-block" type="button"> CANCEL</button>
                </div>
            </div>

        {!! Form::close() !!}
    </div>


@endsection
@push('scripts')
<script src="{{asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function(){
            //FormiCheck.init()
    })
</script>
@endpush