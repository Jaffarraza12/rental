@extends('layouts.app')
@push('css')
<link href="{{asset('resources/assets/global/plugins/icheck/skins/flat/_all.css')}}" rel="stylesheet" type="text/css" />


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

            <ul class="nav nav-pills" >
                <li class="nav active"><a class="tabColor" href="#main" data-toggle="tab">Main</a></li>
                <li class="nav"><a class="tabColor" href="#history" data-toggle="tab">History</a></li>
                <li class="nav"><a class="tabColor" href="#amenitites" data-toggle="tab">Common Amenities</a></li>
                <li class="nav"><a class="tabColor" href="#location" data-toggle="tab">Location</a></li>
            </ul>
            {{--<br/>--}}


            <!-- Tab panes -->
            {{--<div class="col-md-10">--}}


            <div class="tab-content row">
                <br>
                <div class="tab-pane fade in active" id="main">
                    <div class="form-group  col-md-6 col-lg-6">
                        <div class="input-icon input-icon-lg right">
                            <label>Building  Name <span class="required">*</span></label>
                            {!! Form::text('name',old('name'),array("class"=>"form-control" )) !!}
                            <span class="help-block">{{ $errors->mess->first('name') }}</span>
                        </div>
                    </div>


                    <div class="form-group  col-md-6 col-lg-6">
                        <div class="input-icon input-icon-lg">
                            <label >Building Type  <span class="required">*</span></label>
                            {!! Form::select('building_type',array(
                                'Apartments' => 'Apartments',
                                'Duplex' => 'Duplex',
                                'Multiplex' => 'Multiplex',
                                'Town House' => 'Town House',
                                'Indiviual House' => 'Indiviual House',
                            ),null,array('placeholder'=>"","class"=>"form-control",'id'=>'building_type' )) !!}
                            <span class="help-block">{{ $errors->mess->first('type') }}</span>
                        </div>
                    </div>



                    <div class="clearfix"></div>
                    <div class="form-group building_type_unit  col-md-6 col-lg-6" style="display: none">
                        <div class="input-icon input-icon-lg right">
                            <label >Unit Type</label>
                            {!! Form::select('building_type_units',array(
                                'Shared Tenant' => 'Shared Tenant',
                                'Single Tenant' => 'Single Tenant',
                            ),old('building_type_units'),array('placeholder'=>"Unit","class"=>"form-control",'id'=>'building_type_unit' )) !!}
                        </div>
                        {!! Form::hidden('units',null,array('placeholder'=>"No Of Units","class"=>"form-control",'id'=>'unit' )) !!}
                    </div>
                    <div class="form-group unit_no col-md-3 col-lg-3" >
                        <div class="input-icon input-icon-lg right">
                            <label >No. Of Units</label>
                            {!! Form::text('units',old('units'),array('placeholder'=>"","class"=>"form-control",)) !!}
                            <span class="help-message">Ex:50</span>
                        </div>
                    </div>


                    <div class="form-group col-md-3 col-lg-3">
                        <div class="input-icon input-icon-lg right">
                            <label >No Of Floors</label>
                            {!! Form::text('num_floors',old('num_floors'),array('placeholder'=>"","class"=>"form-control" )) !!}
                            <span class="help-message">Ex:50</span>
                        </div>
                    </div>

                    <div class="form-group col-md-6 col-lg-6">
                        <div class="input-icon input-icon-lg right">
                            <label >Description</label>
                            {!! Form::text('description',old('description'),array('placeholder'=>"","class"=>"form-control" )) !!}
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="loadMore">
                       <div class="dns">
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-icon  right">

                                        <label >Contact Person</label>
                                        <input type="text" name="contact_person[]" value="{{ old('contact_person.0')  }}" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-icon  right">
                                        <label >Designation</label>
                                        <input type="text" name="contact_designation[]" value="{{ old('contact_designation.0')  }}" placeholder="" class="form-control" />
                                        <span class="help-message">Ex:Manager</span>
                                    </div>
                                </div>
                            </div>
                           <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-icon  right">
                                        <label >Email</label>
                                        <input type="email" name="contact_email[]" value="{{ old('contact_email.0')  }}" placeholder="" class="form-control" />
                                        <span class="help-message">Ex:adam@example.com</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-icon  right">
                                        <label >Phone</label>
                                        <input type="phone" name="contact_phone[]" value="{{ old('contact_phone.0')  }}" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>
                           <div class="clearfix"></div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-icon  right">
                                        <label >Phone 2 </label>
                                        <input type="phone" name="phone2[]" value="" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>
                           <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-icon  right">
                                        <label >Cell </label>
                                        <input type="cell" name="phone2[]" value="" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>
                           <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <div class="input-icon  right">
                                        <label >FAX </label>
                                        <input type="cell" name="contact_cell[]" value="" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>
                           <div class="clearfix"></div>
                            <div class="col-lg-1 col-md-1">
                        </div>
                       </div>
                       <div class="clearfix"></div>
                    </div>
                    <h5 id="lightermargin"><a class="addContact"><i class="fa fa-plus"></i> Add Another Contact</a></h5>




                </div>
                <div class="tab-pane fade" id="history">
                    <div class="form-group col-md-6 col-lg-6">
                        <div class="input-icon input-icon-lg right">
                            <label >Brief</label>
                            <textarea name="history" placeholder="" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-lg-6">
                        <div class="input-icon input-icon-lg right">
                            <label >Mission</label>
                            {!! Form::textarea('mission',null,array('placeholder'=>"","class"=>"form-control" )) !!}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-3 col-lg-3">
                        <div class="input-icon input-icon-lg right">
                            <label >Year of Construction</label>
                            {!! Form::text('year_of_construction',null,array('placeholder'=>"","class"=>"form-control" )) !!}
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
                                              false ,
                                                array('data-checkbox'=> 'icheckbox_flat-grey','class' => 'icheck','style'=>'position: absolute; opacity: 0;' ) ) !!}
                                            </div> {{$amenity->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-lg-12 col-md-12">
                        <div class="input-icon input-icon-lg right">
                            <i class="fa fa-text-width"></i>
                            {!! Form::text('more_amenities',old('more_amenities'),array('placeholder'=>"Add More Amenities separated by ,","class"=>"form-control" )) !!}
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="location">
                    <div class="form-group col-md-6 col-lg-6">
                        <div class="input-icon input-icon-lg right">
                            <label >Street Address</label>
                            {!! Form::text('street_address',null,array('placeholder'=>"","class"=>"form-control" )) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-2 col-lg-2">
                        <div class="input-icon input-icon-lg right">
                            <label >Zip Code</label>
                            {!! Form::text('zip_code',null,array('placeholder'=>"","class"=>"form-control" )) !!}
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-2"></div>
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
                            </div>
                            <!-- END SIDEBAR CONTENT LAYOUT -->
                        </div>

                    </div>
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