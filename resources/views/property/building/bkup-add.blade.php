@extends('layouts.appmodel')
@section('content')
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <h3 class="caption-subject bold uppercase text-center"> <i class="fa fa-building-o"></i> {{$heading}}</h3>
        </div>

    </div>
    <div class="portlet-body form">
    {!! Form::open(array('url' => $ActionURL ,'method'=>'post')) !!}
    <!-- BEGIN PORTLET-->
        <div class="form-body">
            {{ csrf_field() }}
            <div class="col-md-2">
                <ul class="nav nav-pills Jtab">
                    <li class="nav active"><a href="#main" data-toggle="tab">Main</a></li>
                    <li class="nav"><a href="#history" data-toggle="tab">History</a></li>
                    <li class="nav"><a href="#amenitites" data-toggle="tab">Common Amenities</a></li>
                    <li class="nav"><a href="#location" data-toggle="tab">Location</a></li>
                </ul>
            </div>

            <!-- Tab panes -->
            <div class="col-md-10">
                <div class="tab-content attribute_per_group">
                    <div class="tab-pane fade in active" id="main">
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-text-width"></i>
                                {!! Form::text('name','',array('placeholder'=>"Name","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-sort-numeric-asc for-select"></i>
                                {!! Form::select('building_type',array(
                                    'Apartments' => 'Apartments',
                                    'Duplex' => 'Duplex',
                                    'Multiplex' => 'Multiplex',
                                    'Town House' => 'Town House',
                                    'Indiviual House' => 'Indiviual House',
                                ),null,array('placeholder'=>"Building Type","class"=>"form-control",'id'=>'building_type' )) !!}
                            </div>
                        </div>
                        <div class="form-group building_type_unit" style="display: none">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-sort-numeric-asc for-select"></i>
                                {!! Form::select('building_type_units',array(
                                    'Shared Tenant' => 'Shared Tenant',
                                    'Single Tenant' => 'Single Tenant',
                                ),null,array('placeholder'=>"Unit","class"=>"form-control",'id'=>'building_type_unit' )) !!}
                            </div>
                            {!! Form::hidden('units',1,array('placeholder'=>"No Of Units","class"=>"form-control",'id'=>'unit' )) !!}
                        </div>
                        <div class="form-group unit_no" >
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-sort-numeric-asc"></i>
                                {!! Form::text('units','',array('placeholder'=>"No Of Units","class"=>"form-control",)) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-sort-numeric-asc"></i>
                                {!! Form::text('num_floors',old('num_floors') ,array('placeholder'=>"No Of Floors","class"=>"form-control" )) !!}
                            </div>
                        </div>

                        <div class="loadMore">
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-icon  right">
                                        <i class="fa fa-text-width"></i>
                                        {!! Form::text('contact_person[]',null,array('placeholder'=>"Contact Person","class"=>"form-control" )) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-icon  right">
                                        <i class="fa fa-user"></i>
                                        {!! Form::text('designation[]',null,array('placeholder'=>"Designation","class"=>"form-control" )) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-icon  right">
                                        <i class="fa fa-envelope-o"></i>
                                        {!! Form::text('website[]',null,array('placeholder'=>"Website","class"=>"form-control" )) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <div class="input-icon  right">
                                        <i class="fa fa-phone"></i>
                                        {!! Form::text('phone[]',null,array('placeholder'=>"contact number 2","class"=>"form-control" )) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <h5><a class="addContact"><icon class="fa fa-plus"></icon> Add More</a></h5>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="icon-speech"></i>
                                {!! Form::textarea('description',old('description'),array('placeholder'=>"Description","class"=>"form-control" )) !!}
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="history">
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-text-width"></i>
                                {!! Form::text('year_of_construction',old('year_of_construction'),array('placeholder'=>"Year of Construction","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="icon-speech"></i>
                                {!! Form::textarea('history',old('history'),array('placeholder'=>"history","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="icon-speech"></i>
                                {!! Form::textarea('mission',old('mission'),array('placeholder'=>"Mission","class"=>"form-control" )) !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="amenitites">
                        <div class="form-group">
                           <div class="input-group">
                                    <div class="icheck-inline">
                                        @foreach($CommonAmenities as $amenity)
                                            <div class="col-xs-6 col-md-3">
                                                 <label class="">
                                                <div class="icheckbox_flat" style="position: relative;">
                                                 {!! Form::checkbox('amenities[]',$amenity->common_amenity_id,false,array('data-checkbox'=> 'icheckbox_flat-grey','class' => 'icheck','style'=>'position: absolute; opacity: 0;' ) ) !!}
                                                </div> {{$amenity->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                           </div>
                        </div>

                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-text-width "></i>
                                {!! Form::text('more_amenities',old('more_amenities'),array('placeholder'=>"Add More Amenities separated by ,","class"=>"form-control" )) !!}
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="location">
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-text-width"></i>
                                {!! Form::text('zip_code',old('zip_code'),array('placeholder'=>"Zip Code","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-text-width"></i>
                                {!! Form::textarea('street_address',old('street_address'),array('placeholder'=>"Street Address","class"=>"form-control" )) !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-2"></div>
            <div class="col-md-10">
            <div class="form-group">
                <div class="input-icon input-icon-lg right">
                    <button class="btn red btn" type="submit"><i class="fa fa-save "></i> SAVE</button>
                    {{--<button class="btn btn-default btn-" type="button"><i class="fa fa-times "></i> CANCEL</button>--}}
                </div>
            </div>

        </div>
        {!! Form::close() !!}
    </div>


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