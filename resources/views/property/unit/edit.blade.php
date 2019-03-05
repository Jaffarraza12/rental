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

                                        <div class="form-group col-md-4 col-lg-4 ">
                                            <label class="control-label">Name</label>
                                            <div class="input-icon right">
                                                {!! Form::text('name',$unit->name,array('placeholder'=> "Unit Name","class"=>"form-control","id"=>"name_".$unit->unit_id )) !!}
                                                <span class="help-block">{{ $errors->mess->first('name') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <label class="control-label">Unit Type</label>
                                            <div class="input-icon right">
                                                {!! Form::select('type', array(
                                                        'Studio' => 'Studio',
                                                        'Bachelor' => 'Bachelor',
                                                        'Junior1' => 'Junior1',
                                                        '1 Bedroom' => '1 Bedroom',
                                                        '2 Bedroom' => '2 Bedroom',
                                                        '3 Bedroom' => '3 Bedroom'
                                                        ),$unit->type,array('placeholder'=> "Unit Type","class"=>"form-control","id"=>"type_".$unit->unit_id )) !!}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <label class="control-label">Floor No</label>
                                            <div class="input-icon right">
                                                <i class="fa fa-text-width"></i>
                                                {!! Form::text('floor',$unit->floor,array('placeholder'=> "Floor No","class"=>"form-control","id"=>"floor_".$unit->unit_id )) !!}
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-4 col-lg-4" >
                                            <label class="control-label">Available For Rent</label>
                                            <div class="input-icon right">
                                                <i class="fa fa-text-width for-select"></i>
                                                {!! Form::select('available', array(1 => 'Yes', 0 => 'No'),$unit->available,array('placeholder'=> "Available For Rent","class"=>"form-control","id"=>"available_".$unit->unit_id )) !!}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <label class="control-label">Allow Multi Tenants</label>
                                            <div class="input-icon right">
                                                <i class="fa fa-text-width for-select"></i>
                                                {!! Form::select('multi_tenant', array(1 => 'Yes', 0 => 'No'),$unit->multi_tenant,array('placeholder'=> "Allow Multi Tenant","class"=>"form-control","id"=>"multi_tenant_".$unit->unit_id )) !!}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-lg-4">
                                            <label class="control-label">Furnished</label>
                                            <div class="input-icon right">
                                                <i class="fa fa-text-width for-select"></i>
                                                {!! Form::select('furnished', array(1 => 'Yes', 0 => 'No'),$unit->furnished,array('placeholder'=> "Available For Rent","class"=>"form-control","id"=>"furnished_".$unit->unit_id )) !!}
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
                                                                    (in_array($amenity->private_amenity_id,$unit_amenities)) ? true : false ,
                                                                    array('data-checkbox'=> 'icheckbox_flat-grey','class' => 'icheck','style'=>'position: absolute; opacity: 0;','id' => 'amenities_'.$unit->unit_id ) ) !!}

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