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
                  {!! Form::text('name',$record->name,array('placeholder'=>"Name","class"=>"form-control" )) !!}
              </div>
            </div>
            <div class="form-group">
                <div class="input-icon right">
                    <i class="fa fa-building-o for-select"></i>
                    {!! Form::select('building',$buildings,$record->building_id,array('placeholder'=> "Buildings","class"=>"form-control","id"=>"building")) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon right">
                    <i class="fa fa-square-o for-select"></i>
                    {!! Form::select('unit',$units,$record->unit_id,array('placeholder'=> "Units","class"=>"form-control","id"=>"unit")) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon input-icon-lg right">
                    <i class="fa fa-user"></i>
                    {!! Form::text('resident',$record->name,array('placeholder'=>"Resident Name","class"=>"form-control" )) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon input-icon-lg right">
                    <i class="fa fa-phone"></i>
                    {!! Form::text('contact',$record->contact,array('placeholder'=>"Contact Number","class"=>"form-control" )) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon input-icon-lg right">
                    <i class="fa fa-location"></i>
                    {!! Form::text('address',$record->address,array('placeholder'=>"Building Address","class"=>"form-control" )) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon right">
                    <i class="fa fa-square-o for-select"></i>
                    {!! Form::select('type',array(
                                'Repair' => 'Repair',
                                'Maintenance' => 'Maintenance',
                                'Incident' => 'Incident',
                                'Checkup' => 'Checkup',
                                'Meter Reading' => 'Meter Reading',
                                'Remove &amp; Replace' => 'Remove &amp; Replace',
                                'Violation' => 'Violation',
                                'Other' => 'Other'
                    ),$record->type,array('placeholder'=> "Work Order Type","class"=>"form-control","id"=>"Unit")) !!}
                </div>
            </div>
            <div class="form-group">
                    <div class="col-md-6">
                        <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                            {!! Form::text('date_open',date('Y-m-d',strtotime($record->date_open)),array('placeholder'=>"Date Opened","class"=>"form-control",'readonly'=>'readonly' )) !!}
                            <span class="input-group-btn">
                                   <button class="btn default" type="button">
                                      <i class="fa fa-calendar"></i>
                                   </button>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                            {!! Form::text('due_date',date('Y-m-d',strtotime($record->due_date)),array('placeholder'=>"Due Date","class"=>"form-control",'readonly'=>'readonly' )) !!}
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
            <div class="form-group">
                <div class="input-icon right">
                    <i class="fa fa-square-o for-select"></i>
                    {!! Form::select('status',array(
                                '0' => 'Opened',
                                '1' => 'Pending',
                                '2' => 'Closed'

                    ),$record->status,array('placeholder'=> "Status","class"=>"form-control","id"=>"opened")) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon right">
                    <i class="fa fa-square-o for-select"></i>
                    {!! Form::select('priority',array(
                                'Normal' => 'Normal',
                                'Low' => 'Low',
                                'Medium' => 'Medium',
                                'High' => 'High',
                                'Urgent' => 'Urgent'
                  ),$record->priority,array('placeholder'=> "Priority","class"=>"form-control","id"=>"priority")) !!}
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
<script src="{{asset('resources/assets/js/work_order.js')}}" type="text/javascript"></script>
<script  type="text/javascript">
    $(document).ready(function () {
        work_order.init()
    })
</script>

@endpush