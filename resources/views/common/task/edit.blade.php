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
            @include("common.breadcrumb")
            <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    {!! Form::open(array('url' => $ActionURL ,'method'=>'put')) !!}
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
                                <div class="row rentalForm">
                                    {{ csrf_field() }}
                                    {!! Form::hidden('type',$type,array('placeholder'=>"","class"=>"form-control" )) !!}
                                    @if($type == 'tenant')
                                        <div class="form-group col-md-4 col-lg-4">
                                            <div class="input-icon input-icon-lg right">
                                                <label >Tenant</label>
                                                {!! Form::select('tenant_id',$tenants,$record->tenant_id,array('placeholder'=> "","class"=>"form-control","id"=>"tenant")) !!}
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    @endif
                                    <div class="form-group col-md-12 col-lg-12">
                                        <div class="input-icon right ">
                                            <label>Summmary</label>
                                            {!! Form::text('summary',$record->name,array('placeholder'=>"","class"=>"form-control" )) !!}
                                            <span class="help-block">{{ $errors->mess->first('summary') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 col-lg-12">
                                        <div class="input-icon input-icon-lg right">
                                            <label >Description</label>
                                            {!! Form::textarea('description',$record->description,array('placeholder'=>"","class"=>"form-control" )) !!}
                                            <span class="help-block">{{ $errors->mess->first('description') }}</span>

                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4">
                                        <div class="input-icon right">
                                            <label >Category</label>
                                            {!! Form::select('category',array(
                                                        'Contribution request' => 'Contribution request',
                                                        'Complaint' => 'Complaint',
                                                        'Feedback/Suggestion' => 'Feedback/Suggestion',
                                                        'General Inquiry' => 'General Inquiry',
                                                        'Maintenance Request' => 'Maintenance Request',
                                                        'Other' => 'Other',
                                          ),$record->category,array('placeholder'=> "","class"=>"form-control","id"=>"priority")) !!}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <div class="input-icon input-icon-lg right">
                                            <label >Assigned To</label>
                                            {!! Form::select('user',$users,$record->user_id,array('placeholder'=> "","class"=>"form-control","id"=>"unit")) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">

                                        <div class="input-group  date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                            <label>Due Date</label>
                                            {!! Form::text('due',$record->due,array('placeholder'=>"","class"=>"form-control",'readonly'=>'readonly' )) !!}
                                            <span class="input-group-btn">
                                       <button class="btn default" type="button">
                                          <i class="fa fa-calendar"></i>
                                       </button>
                                </span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>


                                    <div class="form-group col-md-4 col-lg-4">
                                        <div class="input-icon right">
                                            <label >Status</label>
                                            {!! Form::select('status',array(
                                                        '0' => 'Opened',
                                                        '1' => 'Pending',
                                                        '2' => 'Closed'

                                            ),$record->status,array('placeholder'=> "","class"=>"form-control","id"=>"opened")) !!}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4">
                                        <div class="input-icon right">
                                            <label >Priority</label>
                                            {!! Form::select('priorty',array(
                                                        '0' => 'Low',
                                                        '1' => 'Medium',
                                                        '2' => 'High',
                                          ),$record->priorty,array('placeholder'=> "","class"=>"form-control","id"=>"priority")) !!}
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