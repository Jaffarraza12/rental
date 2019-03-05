@extends('layouts.app')
@push('css')
<link href="{{asset('resources/assets/global/plugins/icheck/skins/flat/_all.css')}}" rel="stylesheet" type="text/css" />
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
                    {!! Form::open(array('url' => $ActionURL ,'method'=>'post', 'files' => true)) !!}
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="caption">
                                <h1 style="margin-left:2px">{{$heading}}</h1>
                            </div>
                            <div class="tools">
                                <div class="dt-buttons pull-right">
                                    <div class="btn-group">

                                    </div>
                                </div>
                            </div>
                            <div class="portlet-title">
                                {!! Form::hidden("url",URL('unit/'),array("class","url")) !!}

                            </div>
                            @include("common.errors")
                            @yield('content')
                            <div class="portlet-body flip-scroll">

                                {{ csrf_field() }}

                                <ul class="nav nav-pills">
                                    <li class="nav active"><a class="tabColor" href="#main" data-toggle="tab">Main</a></li>
                                    <li class="nav"><a class="tabColor" href="#bul" data-toggle="tab">Buildings</a></li>

                                </ul>
                                {{--<br/>--}}


                                <!-- Tab panes -->
                                {{--<div class="col-md-10">--}}
                                <div class="tab-content row">
                                    <br>
                                    <div class="tab-pane fade in active" id="main">
                                        <div class="form-group col-md-6 col-lg-6">
                                            <div class="input-icon input-icon-lg right">
                                                <label >Name</label>
                                                {!! Form::text('name',old('name'),array('placeholder'=>" ","class"=>"form-control" )) !!}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <div class="input-icon input-icon-lg right">
                                                <label >Email</label>
                                                {!! Form::email('email',old('email'),array('placeholder'=> "","class"=>"form-control")) !!}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <div class="input-icon input-icon-lg right">
                                                <label >Password</label>
                                                {{ Form::password('password', array('placeholder'=> "",'class' => 'form-control')) }}
                                                {{--                            {!! Form::password('password',old('password'),array('placeholder'=> "Password","class"=>"form-control")) !!}--}}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <div class="input-icon input-icon-lg right">
                                                <label >Contact Number</label>
                                                {!! Form::text('contact',old('contact'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12">
                                            <div class="input-icon input-icon-lg right">
                                                <label >Address</label>
                                                {!! Form::textarea('address',old('address'),array('placeholder'=>"","class"=>"form-control" )) !!}
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
                                                                    {!! Form::checkbox('building[]',$building->building_id,false,array('data-checkbox'=> 'icheckbox_flat-grey','class' => 'icheck','style'=>'position: absolute; opacity: 0;' ) ) !!}
                                                                </div> {{$building->name}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>


                                    {!! Form::close() !!}

                                    <div class="col-md-12">

                                        <div class="form-actions row">
                                            <div class="btn-set ">
                                                <button class="btn greenish btn" type="submit"> SAVE</button>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                {{--</div>--}}
                                <div class="clearfix"></div>
                                <div class="col-md-2"></div>

                                <div class="clearfix"></div>
                            </div>
                            <!-- END SIDEBAR CONTENT LAYOUT -->
                        </div>

                    </div>
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