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
            @include("common.breadcrumb")
            <!-- BEGIN PAGE BASE CONTENT -->
                @if(isset($building_selected))
                    <div class="row">
                    {!! Form::open(array('url' => $ActionURL ,'method'=>'post', 'files' => true)) !!}
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="col">
                                {!! Form::hidden("url",URL('unit/'),array("class","url")) !!}
                                <div class="caption">
                                    <h1 style="margin-left:2px">{{$heading}}</h1>
                                </div>
                                <div class="tools">
                                    <div class="dt-buttons pull-right">
                                        <div class="btn-group">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include("common.errors")
                            @yield('content')
                            <div class="portlet-body flip-scroll">

                                {{ csrf_field() }}
                                <ul class="nav nav-pills">
                                    <li class="nav active"><a class="tabColor" href="#main" data-toggle="tab">Main</a></li>
                                    <li class="nav"><a class="tabColor" href="#amenities" data-toggle="tab">Amenities</a></li>
                                </ul>
                                   <br/>
                                <div class="tab-content row">
                                    <div class="tab-pane fade in active" id="main">

                                        <div class="form-group col-md-4 col-lg-4">
                                            <div class="input-icon right">
                                                <label>Unit Name</label>
                                                {!! Form::text('name',old('name'),array('placeholder'=> "","class"=>"form-control","id"=>"name")) !!}
                                                <span class="help-block">{{ $errors->mess->first('name') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group  col-md-4 col-lg-4">
                                            <label class="control-label">Unit Type</label>
                                            <div class="input-icon right">
                                                <i class="fa fa-text-width for-select"></i>
                                                {!! Form::select('type', array(
                                                        'Studio' => 'Studio',
                                                        'Bachelor' => 'Bachelor',
                                                        'Junior1' => 'Junior1',
                                                        '1 Bedroom' => '1 Bedroom',
                                                        '2 Bedroom' => '2 Bedroom',
                                                        '3 Bedroom' => '3 Bedroom'
                                                        ),old('type'),array('placeholder'=> "Unit Type","class"=>"form-control","id"=>"type" )) !!}
                                            </div>
                                        </div>
                                        <div class="form-group  col-md-4 col-lg-4">
                                            <div class="input-icon right">
                                                <label>Floor No</label>
                                                {!! Form::text('floor',old('floor'),array('placeholder'=> "","class"=>"form-control","id"=>"floor" )) !!}
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <div class="input-icon right">
                                                <label >Available For Rent</label>
                                                {!! Form::select('available', array(1 => 'Yes', 0 => 'No'),old('available'),array('placeholder'=> "","class"=>"form-control","id"=>"available")) !!}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <div class="input-icon right">
                                                <label >Allow Multi Tenant</label>
                                                {!! Form::select('multi_tenant', array(1 => 'Yes', 0 => 'No'),null,array('placeholder'=> "","class"=>"form-control","id"=>"multi_tenant" )) !!}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4 col-lg-4">
                                            <div class="input-icon right">
                                                <label >Available For Rent</label>
                                                {!! Form::select('furnished', array(1 => 'Yes', 0 => 'No'),old('furnished'),array('placeholder'=> "","class"=>"form-control","id"=>"furnished")) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="amenities">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="icheck-inline">
                                                    @foreach($private_amenities as $amenity)
                                                        <div class="col-xs-6 col-md-3">
                                                            <label class="">
                                                                <div class="icheckbox_flat" style="position: relative;">
                                                                    {!! Form::checkbox('amenities[]',$amenity->private_amenity_id,
                                                                    false ,
                                                                    array('data-checkbox'=> 'icheckbox_flat-grey','class' => 'icheck','style'=>'position: absolute; opacity: 0;','id' => 'amenities') ) !!}
                                                                </div> {{$amenity->name}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="clearfix"></div>
                                <div class="col-md-2"></div>
                                <div class="col-md-12">

                                    <div class="form-actions row">
                                        <div class="btn-set ">
                                            <button class="btn greenish btn" type="submit"><i class="fa fa-save "></i> SAVE</button>
                                        </div>
                                    </div>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- END SIDEBAR CONTENT LAYOUT -->
                        </div>

                    </div>
                </div>
                @else
                    @include('errors.builing_not_selected')
                @endif

                <!-- END CONTAINER -->
                @endsection
                @push('scripts')
                <script src="{{asset('resources/assets/global/plugins/icheck/icheck.min.js')}}" type="text/javascript"></script>
                <script src="{{asset('resources/assets/pages/scripts/form-icheck.min.js')}}" type="text/javascript"></script>
                <script src="{{asset('resources/assets/js/building.js')}}" type="text/javascript"></script>
                <script>
                    $(document).ready(function(){
                        building.init()
                    })
                </script>
    @endpush