@extends('layouts.app')
@push('css')
<link href="{{asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('resources/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('resources/assets/css/form.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="page-container rentalForm">
        @include("common.adminsideview")
        <div class="page-content-wrapper">
            <div class="page-content">
            {{--@include("common.breadcrumb")--}}
            <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
    {!! Form::open(array('url' => $ActionURL ,'method'=>'post')) !!}
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="col">
                                {!! Form::hidden("url",URL('unit/'),array("class","url")) !!}
                                <div class="caption">
                                    <h1 >{{$heading}}</h1>
                                </div>
                                <div class="tools">
                                    <div class="dt-buttons pull-right">
                                        <div class="btn-group">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            @yield('content')
                            <div class="portlet-body flip-scroll">
    <!-- BEGIN PORTLET-->
        <div class="tab-content row rentalForm">
            <br>
            {{ csrf_field() }}
            {!! Form::hidden('building',$building_id,old('building'),array('placeholder'=> "","class"=>"form-control","id"=>"building")) !!}
            <div class="form-group col-md-4 col-lg-4">
                <div class="input-icon right ">
                    <label>Units</label>
                    {!! Form::select('unit',$units,old('unit'),array('placeholder'=> "","class"=>"form-control","id"=>"unit")) !!}
                    <span class="help-block">{{ $errors->mess->first('unit') }}</span>
                </div>
            </div>
            <div class="form-group col-md-4 col-lg-4">
                <div class="input-icon input-icon-lg right">
                    <label >Resident Name</label>
                    {!! Form::text('resident',null,array('placeholder'=>"","class"=>"form-control" )) !!}
                    <span class="help-block">{{ $errors->mess->first('resident') }}</span>

                </div>
            </div>

            <div class="form-group col-md-4 col-lg-4">
                <div class="input-icon input-icon-lg right">
                    <label >Contact Number</label>
                    {!! Form::text('contact',null,array('placeholder'=>"","class"=>"form-control" )) !!}
                </div>
            </div>
            {{--<div class="form-group col-md-12 col-lg-12">
                <div class="input-icon input-icon-lg right">
                    <label>Summary</label>
                    {!! Form::text('summary',null,array('placeholder'=>"","class"=>"form-control" )) !!}
                    <span class="help-block">{{ $errors->mess->first('summary') }}</span>
                </div>
            </div>--}}
            <div class="clearfix"></div>
            <div class="form-group col-md-4 col-lg-4">
                <div class="input-icon input-icon-lg right">
                    <label >Vendor</label>
                    {!! Form::select('vendor',$vendors,old('vendor'),array('placeholder'=> "","class"=>"form-control","id"=>"unit")) !!}
                </div>
            </div>
            <div class="form-group col-md-4 col-lg-4">
                <div class="input-icon input-icon-lg right">
                    <label >Entry Allowed</label>
                    {!! Form::select('entry',array(
                        1 => 'YES',
                        0 => 'NO'
                    ),old('entry'),array('placeholder'=> "Entry","class"=>"form-control","id"=>"unit")) !!}
                </div>
            </div>
            <div class="form-group col-md-4 col-lg-4">
                <div class="input-icon input-icon-lg right">
                    <label >Assigned To</label>
                    {!! Form::select('user',$users,old('user'),array('placeholder'=> "","class"=>"form-control","id"=>"unit")) !!}
                </div>
            </div>

            {{--<div class="form-group col-md-12 col-lg-12">
                <div class="input-icon input-icon-lg right">
                    <label>Building Address</label>
                    {!! Form::text('address',null,array('placeholder'=>"","class"=>"form-control" )) !!}
                </div>
            </div>--}}
            <div class="clearfix"></div>
            <div class="form-group col-md-4 col-lg-4">
                <div class="input-icon right">
                    <label >Work Order Type</label>
                    {!! Form::select('type',array(
                                'Repair' => 'Repair',
                                'Maintenance' => 'Maintenance',
                                'Incident' => 'Incident',
                                'Checkup' => 'Checkup',
                                'Meter Reading' => 'Meter Reading',
                                'Remove &amp; Replace' => 'Remove &amp; Replace',
                                'Violation' => 'Violation',
                                'Other' => 'Other'
                    ),old('type'),array('placeholder'=> "","class"=>"form-control","id"=>"Unit")) !!}
                </div>
            </div>
            <div class="form-group col-md-4 col-lg-4">
                <div class="input-icon right">
                    <label >Status</label>
                    {!! Form::select('status',array(
                                '0' => 'Opened',
                                '1' => 'Pending',
                                '2' => 'Closed'

                    ),old('status'),array('placeholder'=> "","class"=>"form-control","id"=>"opened")) !!}
                </div>
            </div>
            <div class="form-group col-md-4 col-lg-4">
                <div class="input-icon right">
                    <label >Priority</label>
                    {!! Form::select('priority',array(
                                'Normal' => 'Normal',
                                'Low' => 'Low',
                                'Medium' => 'Medium',
                                'High' => 'High',
                                'Urgent' => 'Urgent'
                  ),old('priority'),array('placeholder'=> "","class"=>"form-control","id"=>"priority")) !!}
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                    <div class="col-md-4 col-lg-4" style="display: none">
                        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                            <label>Date Opened</label>
                            {!! Form::text('date_opened',old('date_open'),array('placeholder'=>"","class"=>"form-control",'readonly'=>'readonly' )) !!}
                            <span class="input-group-btn">
                                   <button class="btn default" type="button">
                                      <i class="fa fa-calendar"></i>
                                   </button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-lg-4">
                        <div class="input-icon input-icon-lg right">
                            <label>Summary</label>
                            {!! Form::text('summary',null,array('placeholder'=>"","class"=>"form-control" )) !!}
                            <span class="help-block">{{ $errors->mess->first('summary') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-lg-4">
                        <div class="input-icon input-icon-lg right">
                            <label>Building Address</label>
                            {!! Form::text('address',null,array('placeholder'=>"","class"=>"form-control" )) !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">

                        <div class="input-group  date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                            <label>Due Date</label>
                            {!! Form::text('due_date',old('due_date'),array('placeholder'=>"","class"=>"form-control",'readonly'=>'readonly' )) !!}
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
            <div class="col-md-12">

                <div class="form-actions">
                    <div class="btn-set ">
                        <button class="btn greenish btn" type="submit">  SAVE</button>
                    </div>
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
    </div>
    </div>
    </div>
    </div>




@endsection
@push('scripts')
<script src="{{asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/js/work_order.js')}}" type="text/javascript"></script>
<script  type="text/javascript">
    $(document).ready(function () {
        work_order.init()
    })
</script>

@endpush