@extends('layouts.appmodel')
@push('css')
<link href="{{asset('resources/assets/css/form.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <h3 class="caption-subject bold uppercase text-center"> <i class="fa fa-building-o"></i> {{$heading}}</h3>
        </div>

    </div>
    <div class="portlet-body lighterPadding">
    {!! Form::open(array('url' => $ActionURL ,'method'=>'post')) !!}
    <!-- BEGIN PORTLET-->
        <div class="form-body rentalForm">
            {{ csrf_field() }}

            <ul class="nav nav-pills" style="margin-left: 23px;">
                <li class="nav active"><a class="tabColor" href="#main" data-toggle="tab">Main</a></li>
                <li class="nav"><a class="tabColor" href="#history" data-toggle="tab">History</a></li>
                <li class="nav"><a class="tabColor" href="#amenitites" data-toggle="tab">Common Amenities</a></li>
                <li class="nav"><a class="tabColor" href="#location" data-toggle="tab">Location</a></li>
            </ul>


            <!-- Tab panes -->
            {{--<div class="col-md-10">--}}
                <div class="tab-content attribute_per_group">
                    <div class="tab-pane fade in active" id="main">
                        <div class="form-group  col-md-6 col-lg-6">
                            <div class="input-icon input-icon-lg right">
                                <label>Building  Name</label>
                                {!! Form::text('name',$record->name,array("class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group  col-md-6 col-lg-6">
                            <div class="input-icon input-icon-lg">
                                <label >Building Type</label>
                                {!! Form::select('building_type',array(
                                    'Apartments' => 'Apartments',
                                    'Duplex' => 'Duplex',
                                    'Multiplex' => 'Multiplex',
                                    'Town House' => 'Town House',
                                    'Indiviual House' => 'Indiviual House',
                                ),$record->building_type,array('placeholder'=>"","class"=>"form-control",'id'=>'building_type' )) !!}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group building_type_unit  col-md-6 col-lg-6" style="display: none">
                            <div class="input-icon input-icon-lg right">
                                <label >Unit Type</label>
                                {!! Form::select('building_type_units',array(
                                    'Shared Tenant' => 'Shared Tenant',
                                    'Single Tenant' => 'Single Tenant',
                                ),$record->building_type_units,array('placeholder'=>"Unit","class"=>"form-control",'id'=>'building_type_unit' )) !!}
                            </div>
                            {!! Form::hidden('units',$record->units,array('placeholder'=>"No Of Units","class"=>"form-control",'id'=>'unit' )) !!}
                        </div>
                        <div class="form-group unit_no col-md-6 col-lg-6" >
                            <div class="input-icon input-icon-lg right">
                                <label >No Of Units</label>
                                {!! Form::text('units',$record->units,array('placeholder'=>"No Of Units","class"=>"form-control",)) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-lg-6">
                            <div class="input-icon input-icon-lg right">
                                <label >No Of Floors</label>
                                {!! Form::text('num_floors',$record->num_floors ,array('placeholder'=>"","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="loadMore">

                            @foreach($BuildingContact as $buildingContact)
                                <div id="contact_{{$buildingContact->building_contact_id}}">
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group">
                                            <div class="input-icon  right">
                                                <i class="fa fa-text-width"></i>
                                                {!! Form::text('contact_person_old[]',$buildingContact->contact_person,array('placeholder'=>"Contact Person","class"=>"form-control" )) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group">
                                            <div class="input-icon  right">
                                                <i class="fa fa-user"></i>
                                                {!! Form::text('designation_old[]',$buildingContact->designation,array('placeholder'=>"Designation","class"=>"form-control" )) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group">
                                            <div class="input-icon  right">
                                                <i class="fa fa-envelope-o"></i>
                                                {!! Form::text('website_old[]',$buildingContact->phone,array('placeholder'=>"contact number","class"=>"form-control" )) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <div class="form-group">
                                            <div class="input-icon  right">
                                                <i class="fa fa-phone"></i>
                                                {!! Form::text('phone_old[]',$buildingContact->phone_2,array('placeholder'=>"contact number 2","class"=>"form-control" )) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1">
                                        <a class="removeContact" data-id="{{$buildingContact->building_contact_id}}"><icon class="fa fa-remove"></icon></a>
                                    </div>{!! Form::hidden('building_contact_id[]',$buildingContact->building_contact_id,array()) !!}
                                    <div class="clearfix"></div>
                                </div>

                            @endforeach
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <div class="input-icon  right">
                                            <label >Contact Person</label>
                                            {!! Form::text('contact_person[]',null,array('placeholder'=>"","class"=>"form-control" )) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <div class="input-icon  right">
                                            <label class="fa fa-user">Designation</label>
                                            {!! Form::text('designation[]',null,array('placeholder'=>"","class"=>"form-control" )) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <div class="input-icon  right">
                                            <label >Website</label>
                                            {!! Form::text('website[]',null,array('placeholder'=>"","class"=>"form-control" )) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                        <div class="input-icon  right">
                                            <label >contact number </label>
                                            {!! Form::text('phone[]',null,array('placeholder'=>"","class"=>"form-control" )) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-1">
                                </div>
                                <div class="clearfix"></div>
                        </div>
                        <h5 id="lightermargin"><a class="addContact"><i class="fa fa-plus"></i> Add More</a></h5>
                        <div class="form-group col-md-12 col-lg-12">
                            <div class="input-icon input-icon-lg right">
                                <label >Description</label>
                                {!! Form::textarea('description',$record->description,array('placeholder'=>"","class"=>"form-control" )) !!}
                            </div>
                        </div>


                    </div>
                    <div class="tab-pane fade" id="history">
                        <div class="form-group col-md-3 col-lg-3">
                            <div class="input-icon input-icon-lg right">
                                <label >Year of Construction</label>
                                {!! Form::text('year_of_construction',$record->year_of_construction,array('placeholder'=>"","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-md-12 col-lg-12">
                            <div class="input-icon input-icon-lg right">
                                <label >history</label>
                                {!! Form::textarea('history',$record->history,array('placeholder'=>"","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-lg-12">
                            <div class="input-icon input-icon-lg right">
                                <label >Mission</label>
                                {!! Form::textarea('mission',$record->mission,array('placeholder'=>"","class"=>"form-control" )) !!}
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
                                                    {!! Form::checkbox('amenities[]',$amenity->common_amenity_id,
                                                    (in_array($amenity->common_amenity_id,$building_amenities)) ? true : false ,
                                                    array('data-checkbox'=> 'icheckbox_flat-grey','class' => 'icheck','style'=>'position: absolute; opacity: 0;' ) ) !!}
                                                </div> {{$amenity->name}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if($record->common_amenities != '')
                            <div class="row" style="margin-left: 15px;">
                            <h4>Additional Amenities:</h4>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="icheck-inline">
                                    @foreach(json_decode($record->common_amenities) as $key => $val)
                                        <div class="col-xs-6 col-md-4">
                                            <label class="">
                                                <div class="icheckbox_flat" style="position: relative;">
                                                    {!! Form::checkbox('old_amenities[]',$key,
                                                    (($val)) ? true : false ,
                                                    array('data-checkbox'=> 'icheckbox_flat-grey','class' => 'icheck','style'=>' opacity: 0;' ) ) !!}
                                                </div> {{$key}}</label>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                             </div>
                             </div>
                        @endif
                        <div class="form-group col-lg-12 col-md-12">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-text-width"></i>
                                {!! Form::text('more_amenities',old('more_amenities'),array('placeholder'=>"Add More Amenities separated by ,","class"=>"form-control" )) !!}
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="location">
                        <div class="form-group col-md-12 col-lg-12">
                            <div class="input-icon input-icon-lg right">
                                <label >Zip Code</label>
                                {!! Form::text('zip_code',$record->zip_code,array('placeholder'=>"","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-lg-12">
                            <div class="input-icon input-icon-lg right">
                                <label >Street Address</label>
                                {!! Form::textarea('street_address',$record->street_address,array('placeholder'=>"","class"=>"form-control" )) !!}
                            </div>
                        </div>
                    </div>

                </div>
            {{--</div>--}}
            <div class="clearfix"></div>
            <div class="col-md-2"></div>
            <div class="col-md-12">

                <div  id="lightermargin"   class="form-actions">
                    <div class="btn-set">
                        <button class="btn red btn" type="submit"><i class="fa fa-save"></i> SAVE</button>
                    </div>
                </div>

                {{--<div class="form-group">
                    <div class="input-icon input-icon-lg right">
                        <button class="btn red btn" type="submit"><i class="fa fa-save"></i> SAVE</button>
                        <button class="btn btn-default btn-block" type="button"><i class="fa fa-times"></i> CANCEL</button>
                    </div>
                </div>--}}

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