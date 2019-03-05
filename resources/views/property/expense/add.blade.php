@extends('layouts.appmodel')
@push('css')
<link href="{{asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('resources/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('resources/assets/css/form.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <h3 class="caption-subject bold uppercase text-center"> <i class="fa fa-money"></i> {{$heading}}</h3>
            <br/>
        </div>

    </div>
    <div class="portlet-body">
    {!! Form::open(array('url' => $ActionURL ,'method'=>'post')) !!}
    <!-- BEGIN PORTLET-->
        <div class="form-body rentalForm">
            {{ csrf_field() }}
            <div class="col-md-2">

            </div>
            {!! Form::hidden('work_order_id',$work_order_id,array( )) !!}


        <!-- Tab panes -->
            <div class="col-md-12">

                        <div class="form-group col-md-4 col-lg-4">
                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                <label>Due Date</label>
                                {!! Form::text('entry_date',old('entry_date'),array('placeholder'=>"","class"=>"form-control",'readonly'=>'readonly' )) !!}
                                <span class="input-group-btn">
                                       <button class="btn default" type="button">
                                          <i class="fa fa-calendar"></i>
                                       </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            <div class="input-icon input-icon-lg right">
                                <label >Reference</label>
                                {!! Form::text('reference',old('reference'),array('placeholder'=>"","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            <div class="input-icon input-icon-lg right">
                                <label >Tax</label>
                                {!! Form::text('tax','',array('placeholder'=>"","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <br/>
                <div class="clearfix"></div>
                        <div class="form-group col-md-4 col-lg-4" >
                            <div class="input-icon input-icon-lg right">
                                <label >Tax 2</label>
                                {!! Form::text('tax_2','',array('placeholder'=>"","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            <div class="input-icon right">
                                <label>Payee</label>
                                {!! Form::select('payee',array(
                                            'Tenant' => 'Tenant',
                                            'Vendor' => 'Vendor',
                               ),old('payee'),array('placeholder'=> "","class"=>"form-control","id"=>"opened")) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-lg-4">
                            <div class="input-icon input-icon-lg right">
                                <label >Memo</label>
                                {!! Form::textarea('memo',old('memo'),array('placeholder'=>"","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-lg-12" >
                            <div class="input-icon input-icon-lg right">
                                <label >Description</label>
                                {!! Form::textarea('description',old('description'),array('placeholder'=>"","class"=>"form-control" )) !!}
                            </div>
                        </div>
                    </div>



            <div class="clearfix"></div>
            <div id="lightermargin" class="form-actions">
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
<script>
    $(document).ready(function(){
            //FormiCheck.init()
    })
</script>
@endpush