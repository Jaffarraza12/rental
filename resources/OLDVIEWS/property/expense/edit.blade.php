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
                    <li class="nav"><a href="#contact" data-toggle="tab">Contact Information</a></li>
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
                                {!! Form::text('name',$record->name,array('placeholder'=>"Name","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-sort-numeric-asc"></i>
                                {!! Form::text('units',$record->units,array('placeholder'=>"No Of Units","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-sort-numeric-asc"></i>
                                {!! Form::text('num_floors',$record->num_floors ,array('placeholder'=>"No Of Floors","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="icon-speech"></i>
                                {!! Form::textarea('description',$record->description,array('placeholder'=>"Description","class"=>"form-control" )) !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="history">
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-text-width"></i>
                                {!! Form::text('year_of_construction',$record->year_of_construction,array('placeholder'=>"Year of Construction","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="icon-speech"></i>
                                {!! Form::textarea('history',$record->history,array('placeholder'=>"history","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="icon-speech"></i>
                                {!! Form::textarea('mission',$record->mission,array('placeholder'=>"Mission","class"=>"form-control" )) !!}
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
                            <div class="row">
                            <h4>Additional Amenities</h4>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="icheck-inline">
                                    @foreach(json_decode($record->common_amenities) as $key => $val)
                                        <div class="col-xs-6 col-md-3">
                                            <label class="">
                                                <div class="icheckbox_flat" style="position: relative;">
                                                    {!! Form::checkbox('old_amenities[]',$key,
                                                    (($val)) ? true : false ,
                                                    array('data-checkbox'=> 'icheckbox_flat-grey','class' => 'icheck','style'=>'position: absolute; opacity: 0;' ) ) !!}
                                                </div> {{$key}}</label>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                             </div>
                             </div>
                        @endif
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-text-width"></i>
                                {!! Form::text('more_amenities',old('more_amenities'),array('placeholder'=>"Add More Amenities separated by ,","class"=>"form-control" )) !!}
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="contact">
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-text-width"></i>
                                {!! Form::text('manager',$record->manager,array('placeholder'=>"Manager Name","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-phone"></i>
                                {!! Form::text('phone',$record->phone,array('placeholder'=>"Phone Nos","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-phone"></i>
                                {!! Form::text('phone_2',$record->phone_2,array('placeholder'=>"Phone No 2","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-phone"></i>
                                {!! Form::text('website',$record->website,array('placeholder'=>"Website","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-phone"></i>
                                {!! Form::textarea('operation_hours',$record->operation_hours,array('placeholder'=>"Operating Hours","class"=>"form-control" )) !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="location">
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-text-width"></i>
                                {!! Form::text('zip_code',$record->zip_code,array('placeholder'=>"Zip Code","class"=>"form-control" )) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon input-icon-lg right">
                                <i class="fa fa-text-width"></i>
                                {!! Form::textarea('street_address',$record->street_address,array('placeholder'=>"Street Address","class"=>"form-control" )) !!}
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
                        <button class="btn red btn-block" type="submit"> SAVE</button>
                        <button class="btn btn-default btn-block" type="button"> CANCEL</button>
                    </div>
                </div>

            </div>
            {!! Form::close() !!}
        </div>


        @endsection
        @push('scripts')
        <script src="{{asset('resources/assets/global/plugins/icheck/icheck.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('resources/assets/pages/scripts/form-icheck.min.js')}}" type="text/javascript"></script>
        <script>
            $(document).ready(function(){
                //FormiCheck.init()
            })
        </script>
    @endpush