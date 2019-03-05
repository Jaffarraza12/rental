@extends('layouts.appmodel')
@section('content')
        <div class="portlet-title">
            <div class="caption font-red-sunglo">
                <h3 class="caption-subject bold uppercase text-center"> <i class="fa fa-square-o"></i> {{$heading}}</h3>
            </div>

        </div>
        <div class="portlet-body">

            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <div class="form-body">
                    {!! Form::open(array('url' => $ActionURL ,'method'=>'post')) !!}
                    {{ csrf_field() }}
                    <div id="success" class="note note-success" style="display: none;">
                        <p> </p>
                    </div>
                    <div id="error"  class="alert alert-danger" style="display: none;">
                        <p></p>
                    </div>
                    <ul class="nav nav-pills">
                        <li class="nav active"><a class="tabColor" href="#main" data-toggle="tab">Main</a></li>
                        <li class="nav"><a class="tabColor" href="#amenities" data-toggle="tab">Amenities</a></li>
                    </ul>
                    <div class="tab-content attribute_per_group">
                        <div class="tab-pane fade in active" id="main">

                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <div class="input-icon right">
                                    <i class="fa fa-text-width "></i>
                                    {!! Form::text('name',old('name'),array('placeholder'=> "Unit Name","class"=>"form-control","id"=>"name")) !!}
                                </div>
                            </div>
                            <div class="form-group">
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
                            <div class="form-group">
                                <label class="control-label">Floor No</label>
                                <div class="input-icon right">
                                    <i class="fa fa-text-width"></i>
                                    {!! Form::text('floor',old('floor'),array('placeholder'=> "Floor No","class"=>"form-control","id"=>"floor" )) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Available For Rent</label>
                                <div class="input-icon right">
                                    <i class="fa fa-text-width for-select"></i>
                                    {!! Form::select('available', array(1 => 'Yes', 0 => 'No'),old('available'),array('placeholder'=> "Available For Rent","class"=>"form-control","id"=>"available")) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Allow Multi Tenants</label>
                                <div class="input-icon right">
                                    <i class="fa fa-text-width for-select"></i>
                                    {!! Form::select('multi_tenant', array(1 => 'Yes', 0 => 'No'),null,array('placeholder'=> "Allow Multi Tenant","class"=>"form-control","id"=>"multi_tenant" )) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Furnished</label>
                                <div class="input-icon right">
                                    <i class="fa fa-text-width for-select"></i>
                                    {!! Form::select('furnished', array(1 => 'Yes', 0 => 'No'),old('furnished'),array('placeholder'=> "Available For Rent","class"=>"form-control","id"=>"furnished")) !!}
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
                    <div class="form-actions">
                        <div class="btn-set">
                            <button class="btn red saveUnit"  type="submit">Save</button>
                        </div>
                    </div>
                    <!-- END FORM-->

                </div>
            </div>

        </div>

        @endsection
        @push('scripts')
        <script src="{{asset('resources/assets/global/plugins/icheck/icheck.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('resources/assets/pages/scripts/form-icheck.min.js')}}" type="text/javascript"></script>
           <script>
            $(document).ready(function(){
            })
        </script>
    @endpush