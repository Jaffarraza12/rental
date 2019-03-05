<div class="tab-content ">
    <div class="tab-pane fade in active" id="main">
        <div class="portlet light">
            <div class="row">
                <!--Summary -->
                <div class="col-md-3 col-lg-3">
                    <ul class="nav nav-pills Jtab">
                        <li class="nav active"><a href="#general" data-toggle="tab">Personal Detail</a></li>
                        <li class="nav"><a href="#more-detail" data-toggle="tab">More Detail</a></li>
                        <li class="nav"><a href="#personal" data-toggle="tab">Preference</a></li>
                        <li class="nav"><a href="#document" data-toggle="tab">Documents</a></li>
                    </ul>

                </div>
                <!--Summary -->
                <!--Buidling/Property-->
                <div class="col-md-9 col-lg-9">
                    <div class="tab-content">
                        <!-- Personal -->
                        <div class="tab-pane fade" id="personal">
                            <div class="form-group  col-md-6 col-lg-6">
                                <div class="input-icon input-icon-lg right">
                                    <label >Prefer Building</label>
                                    {!! Form::select('prefer_building',$buildings,null,array('placeholder'=> "","class"=>"form-control" )) !!}
                                </div>
                            </div>
                            <div class="form-group  col-md-6 col-lg-6">
                                <div class="input-icon input-icon-lg right">
                                    <label >Lease Preference</label>
                                    {!! Form::select('lease_perfer',array(
                                        'Weekly' => 'Weekly',
                                        'Monthly' => 'Monthly',
                                        'Bi-Monthly' => 'Bi-Monthly',
                                        'Quarterly' => 'Quarterly',
                                        'Every 6 Months' => 'Every 6 Months',
                                        'Yearly' => 'Yearly'
                                        ),null,array('placeholder'=> "","class"=>"form-control" )) !!}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group  col-md-6 col-lg-6">
                                <div class="input-icon input-icon-lg right">
                                    <label >Somking</label>
                                    {!! Form::select('smoke',array(
                                        'Yes' => 'Yes',
                                        'No' => 'No'
                                        ),old('smoke'),array('placeholder'=>" ","class"=>"form-control icheck" )) !!}
                                </div>
                            </div>

                            <div class="form-group  col-md-6 col-lg-6">
                                <div class="input-icon input-icon-lg right">
                                    <label >Profile</label>
                                    {!! Form::select('profile',array(
                                        'Single' => 'Single',
                                        'Unmarried couple, no children' => 'Unmarried couple, no children',
                                        'Married couple, no children' => 'Married couple, no children',
                                        'Family with children' => 'Family with children',
                                        'Single parent with children' => 'Single parent with children',
                                        'Related tenants' => 'Related tenants',
                                        'Unrelated tenants' => 'Unrelated tenants',
                                        'Student' => 'Student',
                                        'Retired or senior' => 'Retired or senior',
                                        'Other' => 'Other'
                                        ),null,array('placeholder'=> "","class"=>"form-control" )) !!}
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="form-group col-md-6 col-lg-6">
                                <div class="input-icon right">
                                    <label >Prefer Type</label>
                                    {!! Form::select('prefer_type', array(
                                            'Studio' => 'Studio',
                                            'Bachelor' => 'Bachelor',
                                            'Junior1' => 'Junior1',
                                            '1 Bedroom' => '1 Bedroom',
                                            '2 Bedroom' => '2 Bedroom',
                                            '3 Bedroom' => '3 Bedroom'
                                            ),null,array('placeholder'=> "","class"=>"form-control","id"=>"type" )) !!}
                                </div>
                            </div>
                            <div class="form-group  col-md-6 col-lg-6">
                                <div class="input-icon input-icon-lg right">
                                    <label >Prefer Area</label>
                                    {!! Form::text('prefer_area',null,array('placeholder'=>"","class"=>"form-control" )) !!}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- Personal-->
                        <!-- General -->
                        <div class="tab-pane fade  in active" id="general" >
                            <div class="clearfix"></div>
                            <div class="form-group col-md-6 col-lg-6">
                                <div class="input-icon input-icon-lg right">
                                    <label>Full Name</label>
                                    {!! Form::text('name',old('first_name'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-lg-6">
                                <div class="input-icon input-icon-lg right">
                                    <label >Social Security Number</label>
                                    {!! Form::text('ssn',old('ssn'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-lg-4">
                                <div class="input-icon input-icon-lg right">
                                    <label >Email</label>
                                    {!! Form::text('email',old('email'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-lg-4">
                                <div class="input-icon  right">
                                    <label >Phone</label>
                                    {!! Form::text('phone',old('phone'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                </div>
                            </div>
                            <div class="form-group  col-md-4 col-lg-4">
                                <div class="input-icon input-icon-lg right">
                                    <label >Driving</label>
                                    {!! Form::text('driving_license',old('driving_license'),array('placeholder'=>" ","class"=>"form-control" )) !!}
                                </div>
                            </div>
                            <div class="form-group  col-md-12 col-lg-12">
                                <div class="input-icon input-icon-lg right">
                                    <label>Address</label>
                                    {!! Form::text('address',old('address'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                </div>
                            </div>


                            <div class="form-group  col-md-12 col-lg-12">
                                <div class="input-icon input-icon-lg right">
                                    <label >More About Applicant</label>
                                    {!! Form::text('notes',null,array('placeholder'=>",","class"=>"form-control" )) !!}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- Main -->
                        <div class="tab-pane fade" id="more-detail">

                            <div class="portlet-title col-md-12 col-lg-12">
                                <div class="caption col-md-9 col-lg-9">
                                    <h4><i class="fa fa-user"></i> Occupants </h4>
                                </div>
                                <div class="tools col-md-3 col-lg-3" style="margin-top:15px;">
                                    <span class="pointer addOccupantHtml" ><icon class="fa fa-plus"></icon> Add Occupant</span>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="OccupantHtml" style="border-top:1px solid #fcfcfc;">
                                <div class="form-group col-md-6 col-lg-6">
                                    <div class="input-icon input-icon-lg right">
                                        <label >Occupant Name</label>
                                        {!! Form::text('occupant_name[]',old('occupant_name'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-lg-6">
                                    <div class="input-icon input-icon-lg right">
                                        <label >Relation ships</label>
                                        {!! Form::text('relation[]',old('relation[]'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-12 col-lg-12">
                                    <div class="input-icon input-icon-lg right">
                                        <label >Summary</label>
                                        {!! Form::textarea('comments[]',old('comments[]'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                    </div>
                                </div>
                                <div class="form-group col-md-1 col-lg-1">

                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="portlet-title col-md-12 col-lg-12">
                                <div class="caption col-md-9 col-lg-9">
                                    <h4><i class="fa fa-car"></i> Vehicles </h4>
                                </div>
                                <div class="tools col-md-3 col-lg-3" style="margin-top:15px;">
                                    <span class="pointer addVehicleHtml" ><icon class="fa fa-plus"></icon> Add Vehicle</span>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="VehicleHtml" style="border-top:1px solid #fcfcfc;">
                                <div>
                                    <div class="form-group col-md-3 col-lg-3">
                                        <div class="input-icon input-icon-lg right">
                                            <label >Make</label>
                                            {!! Form::text('make[]',old('make[]'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <div class="input-icon input-icon-lg right">
                                            <label >Model</label>
                                            {!! Form::text('model[]',old('model[]'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4">
                                        <div class="input-icon input-icon-lg right">
                                            <label >Tag</label>
                                            {!! Form::text('tag[]',old('tag[]'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-1 col-lg-1">

                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="portlet-title col-md-12 col-lg-12">
                                <div class="caption col-md-9 col-lg-9">
                                    <h4><i class="fa fa-user-md"></i> Employer</h4>
                                </div>
                                <div class="tools col-md-3 col-lg-3" style="margin-top:15px;">
                                    <span class="pointer addIncomeHtml" ><icon class="fa fa-plus"></icon> Add Employer</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="IncomeHtml" style="border-top:1px solid #fcfcfc;">
                                <div>
                                    <div class="form-group col-md-3 col-lg-3">
                                        <div class="input-icon input-icon-lg right">
                                            <label >Employer</label>
                                            {!! Form::text('employer[]',old('employer[]'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 col-lg-2">
                                        <div class="input-icon input-icon-lg right">
                                            <label>Role</label>
                                            {!! Form::text('role[]',old('role[]'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 col-lg-2">
                                        <div class="input-icon input-icon-lg right">
                                            <label >Phone no</label>
                                            {!! Form::text('employer_phone[]',old('employer_phone[]'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 col-lg-2">
                                        <div class="input-icon input-icon-lg right">
                                            <label >Duration</label>
                                            {!! Form::text('duration[]',old('duration[]'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 col-lg-2">
                                        <div class="input-icon input-icon-lg right">
                                            <label >Earning</label>
                                            {!! Form::text('income[]',old('income[]'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-1 col-lg-1">

                                    </div>
                                    <div class="clearfix"></div>

                                </div>

                            </div>



                        </div>



                        <!-- buttons -->
                        <div class="clearfix"></div>
                        <!-- Documents -->
                        <div class="tab-pane fade" id="document" style="">
                            <div class="portlet-title">
                                <div class="tools pull-right" style="margin:15px 0px;">
                                    <span class="pointer addDocumentHtml" ><icon class="fa fa-plus"></icon> Add Document</span>
                                </div>
                            </div>
                            <br/>
                            <div class="clearfix"></div>
                            <div class="DocumentHtml" style="border-top:1px solid #fcfcfc;">
                                <div>
                                    <div class="form-group col-md-5 col-lg-5">
                                        <div class="input-icon input-icon-lg right">
                                            <label>Employer</label>
                                            {!! Form::file('file[]',null,array('placeholder'=>"","class"=>"form-control" )) !!}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <div class="input-icon input-icon-lg right">
                                            <label>Comments</label>
                                            {!! Form::text('file_comment[]',null,array('placeholder'=>"","class"=>"form-control" )) !!}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-1 col-lg-1">

                                    </div>
                                    <div class="clearfix"></div>

                                </div>
                                <!-- Documents-->
                            </div>
                        </div>
                    </div>



                    <!-- General -->

                </div>
            </div>
        </div>
    </div>

</div>