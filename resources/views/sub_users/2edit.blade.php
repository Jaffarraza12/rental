@extends('layouts.appmodel')
@push('css')

<link href="{{asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('resources/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <h3 class="caption-subject bold uppercase text-center"> <i class="icon-users"></i> {{$heading}}</h3>
        </div>

    </div>
    <div class="portlet-body form">
    {!! Form::open(array('url' => $ActionURL ,'method'=>'post')) !!}
    <!-- BEGIN PORTLET-->
        <div class="form-body">
            <ul class="nav nav-pills">
                <li class="nav active"><a class="tabColor" href="#main" data-toggle="tab">Main</a></li>
                <li class="nav"><a class="tabColor" href="#bul" data-toggle="tab">Buildings</a></li>

            </ul>
            {{ csrf_field() }}
            <div class="tab-content attribute_per_group">
                <div class="tab-pane fade in active" id="main">
                    <div class="form-group col-md-12 col-lg-12">
                        <div class="input-icon input-icon-lg right">
                            <i class="fa fa-text-width"></i>
                            {!! Form::text('name',$record->name,array('placeholder'=>" Name","class"=>"form-control" )) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-lg-12">
                        <div class="input-icon input-icon-lg right">
                            <i class="fa fa-envelope"></i>
                            {!! Form::text('email',$record->email,array('placeholder'=> "Email","class"=>"form-control")) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-lg-12">
                        <div class="input-icon input-icon-lg right">
                            <i class="fa fa-eye-slash"></i>
                            {!! Form::text('password',$record->password,array('placeholder'=> "Password","class"=>"form-control")) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-lg-12">
                        <div class="input-icon input-icon-lg right">
                            <i class="fa  fa-phone"></i>
                            {!! Form::text('contact',$record->contact,array('placeholder'=>"Contact Number","class"=>"form-control" )) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-lg-12">
                        <div class="input-icon input-icon-lg right">
                            <i class="fa fa-location-arrow"></i>
                            {!! Form::text('address',$record->address,array('placeholder'=>"Address","class"=>"form-control" )) !!}
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="form-group">
                    </div>
                </div>
                <div class="tab-pane fade" id="bul">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="icheck-inline">
                                {{--{!! print_r($Building);  !!}--}}
                                @foreach($Building as $building)
                                    <div class="col-xs-6 col-md-3">
                                        <label class="">
                                            <div class="icheckbox_flat" style="position: relative;">
                                                {!! Form::checkbox('building[]',$building->building_id,
                                                (in_array($building->building_id,$building_names)) ? true : false ,
                                                array('data-checkbox'=> 'icheckbox_flat-grey','class' => 'icheck','style'=>'position: absolute; opacity: 0;' ) ) !!}
                                            </div> {{$building->name}}</label>
                                    </div>
                                @endforeach

                            </div>

                        </div>
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
            <script src="{{asset('resources/assets/global/plugins/icheck/icheck.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('resources/assets/pages/scripts/form-icheck.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('resources/assets/js/sub_users.js')}}" type="text/javascript"></script>
            <script  type="text/javascript">
                $(document).ready(function () {
                    sub_users.init();
                })
            </script>

    @endpush