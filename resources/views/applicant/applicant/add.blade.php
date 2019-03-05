@extends('layouts.app')
@push('css')
<link href="{{asset('resources/assets/global/plugins/icheck/skins/flat/_all.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="page-container">
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
                                <div class="portlet-title">
                                    {!! Form::hidden("url",URL('unit/'),array("class","url")) !!}
                                    <div class="caption">
                                        <h4><i class="fa fa-user"></i>  Applicant Detail.</h4>
                                    </div>
                                    <div class="tools">
                                        <div class="dt-buttons pull-right">
                                            <div class="btn-group">
                                                <button type="submit" class="btn red btn" ><i class="fa fa-save"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @include("common.errors")
                                @yield('content')
                                <div class="portlet-body flip-scroll">

                                    {{ csrf_field() }}
                                    <div class="tab-content ">
                                        <div class="tab-pane fade in active" id="main">
                                            <div class="portlet light">
                                                <div class="row">
                                                    <!--Summary -->
                                                    <div class="col-md-2 col-lg-2">
                                                        <ul class="nav nav-pills Jtab">
                                                            <li class="nav active"><a href="#personal" data-toggle="tab">Preference</a></li>
                                                            <li class="nav"><a href="#general" data-toggle="tab">Personal Detail</a></li>
                                                            <li style="display: none;" class="nav"><a href="#document" data-toggle="tab">Documents</a></li>
                                                        </ul>

                                                    </div>
                                                    <!--Summary -->
                                                    <!--Buidling/Property-->
                                                    <div class="col-md-10 col-lg-10">
                                                        <div class="tab-content">
                                                            <!-- Personal -->
                                                            <div class="tab-pane fade in active" id="personal">
                                                                <div class="form-group  col-md-6 col-lg-6">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <i class="fa fa-building -o for-select"></i>
                                                                        {!! Form::select('prefer_building',$buildings,null,array('placeholder'=> "Prefer Building","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group  col-md-6 col-lg-6">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <i class="fa fa-money for-select"></i>
                                                                        {!! Form::select('lease_perfer',array(
                                                                            'Weekly' => 'Weekly',
                                                                            'Monthly' => 'Monthly',
                                                                            'Bi-Monthly' => 'Bi-Monthly',
                                                                            'Quarterly' => 'Quarterly',
                                                                            'Every 6 Months' => 'Every 6 Months',
                                                                            'Yearly' => 'Yearly'
                                                                            ),null,array('placeholder'=> "Lease Preference","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group  col-md-6 col-lg-6">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <i class="fa fa-eyedropper for-select"></i>
                                                                        {!! Form::select('smoke',array(
                                                                            'Yes' => 'Yes',
                                                                            'No' => 'No'
                                                                            ),old('smoke'),array('placeholder'=>"Somking ","class"=>"form-control icheck" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group  col-md-6 col-lg-6">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <i class="fa fa-clipboard for-select"></i>
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
                                                                            ),null,array('placeholder'=> "Profile","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-6 col-lg-6">
                                                                    <div class="input-icon right">
                                                                        <i class="fa fa-square-o for-select"></i>
                                                                        {!! Form::select('prefer_type', array(
                                                                                'Studio' => 'Studio',
                                                                                'Bachelor' => 'Bachelor',
                                                                                'Junior1' => 'Junior1',
                                                                                '1 Bedroom' => '1 Bedroom',
                                                                                '2 Bedroom' => '2 Bedroom',
                                                                                '3 Bedroom' => '3 Bedroom'
                                                                                ),null,array('placeholder'=> "Prefer Type","class"=>"form-control","id"=>"type" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group  col-md-6 col-lg-6">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <i class="fa fa-location-arrow"></i>
                                                                        {!! Form::text('prefer_area',null,array('placeholder'=>"Prefer Area,","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <!-- Personal-->
                                                            <!-- General -->
                                                            <div class="tab-pane fade" id="general" >
                                                                <div class="clearfix"></div>
                                                                <div class="form-group col-md-6 col-lg-6">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <i class="fa fa-text-width"></i>
                                                                        {!! Form::text('name',old('first_name'),array('placeholder'=>"Full Name","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6 col-lg-6">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <i class="fa fa-user"></i>
                                                                        {!! Form::text('ssn',old('ssn'),array('placeholder'=>"Social Security Number","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6 col-lg-6">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <i class="fa fa-envelope-o"></i>
                                                                        {!! Form::text('email',old('email'),array('placeholder'=>"Email","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6 col-lg-6">
                                                                    <div class="input-icon  right">
                                                                        <i class="fa fa-phone"></i>
                                                                        {!! Form::text('phone',old('phone'),array('placeholder'=>"Phone","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group  col-md-6 col-lg-6">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        {!! Form::text('address',old('address'),array('placeholder'=>"Address","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group  col-md-6 col-lg-6">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <i class="fa fa-car"></i>
                                                                        {!! Form::text('driving_license',old('driving_license'),array('placeholder'=>"Driving License","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group  col-md-12 col-lg-12">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <i class="fa fa-user"></i>
                                                                        {!! Form::text('notes',null,array('placeholder'=>"More About Applicant,","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>

                                                                <div class="portlet-title col-md-12 col-lg-12">
                                                                    <div class="caption col-md-10 col-lg-10">
                                                                        <h4><i class="fa fa-user"></i> Occupants </h4>
                                                                    </div>
                                                                    <div class="tools col-md-2 col-lg-2" style="margin-top:15px;">
                                                                        <span class="pointer addOccupantHtml" ><icon class="fa fa-plus"></icon> Add Occupant</span>
                                                                    </div>
                                                                </div>

                                                                <div class="clearfix"></div>
                                                                <div class="OccupantHtml" style="border-top:1px solid #fcfcfc;">
                                                                    <div class="form-group col-md-3 col-lg-3">
                                                                        <div class="input-icon input-icon-lg right">
                                                                            <i class="fa fa-text-width"></i>
                                                                            {!! Form::text('occupant_name[]',old('occupant_name'),array('placeholder'=>"Occupant Name","class"=>"form-control" )) !!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-3 col-lg-3">
                                                                        <div class="input-icon input-icon-lg right">
                                                                            <i class="fa fa-connectdevelop"></i>
                                                                            {!! Form::text('relation[]',old('relation[]'),array('placeholder'=>"Relation ships","class"=>"form-control" )) !!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-5 col-lg-5">
                                                                        <div class="input-icon input-icon-lg right">
                                                                            <i class="fa fa-comment-o"></i>
                                                                            {!! Form::text('comments[]',old('comments[]'),array('placeholder'=>"Summary","class"=>"form-control" )) !!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-md-1 col-lg-1">

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <div class="portlet-title col-md-12 col-lg-12">
                                                                    <div class="caption col-md-10 col-lg-10">
                                                                        <h4><i class="fa fa-car"></i> Vehicles </h4>
                                                                    </div>
                                                                    <div class="tools col-md-2 col-lg-2" style="margin-top:15px;">
                                                                        <span class="pointer addVehicleHtml" ><icon class="fa fa-plus"></icon> Add Vehicle</span>
                                                                    </div>
                                                                </div>

                                                                <div class="clearfix"></div>
                                                                <div class="VehicleHtml" style="border-top:1px solid #fcfcfc;">
                                                                    <div>
                                                                        <div class="form-group col-md-3 col-lg-3">
                                                                            <div class="input-icon input-icon-lg right">
                                                                                <i class="fa fa-automobile"></i>
                                                                                {!! Form::text('make[]',old('make[]'),array('placeholder'=>"Make","class"=>"form-control" )) !!}
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-4 col-lg-4">
                                                                            <div class="input-icon input-icon-lg right">
                                                                                <i class="fa fa-cab"></i>
                                                                                {!! Form::text('model[]',old('model[]'),array('placeholder'=>"Model","class"=>"form-control" )) !!}
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-4 col-lg-4">
                                                                            <div class="input-icon input-icon-lg right">
                                                                                <i class="fa fa-tag"></i>
                                                                                {!! Form::text('tag[]',old('tag[]'),array('placeholder'=>"Tag","class"=>"form-control" )) !!}
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group col-md-1 col-lg-1">

                                                                        </div>
                                                                        </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <div class="portlet-title col-md-12 col-lg-12">
                                                                    <div class="caption col-md-10 col-lg-10">
                                                                       <h4><i class="fa fa-user-md"></i> Employer</h4>
                                                                    </div>
                                                                    <div class="tools col-md-2 col-lg-2" style="margin-top:15px;">
                                                                       <span class="pointer addIncomeHtml" ><icon class="fa fa-plus"></icon> Add Employer</span>
                                                                    </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="IncomeHtml" style="border-top:1px solid #fcfcfc;">
                                                                       <div>
                                                                          <div class="form-group col-md-3 col-lg-3">
                                                                            <div class="input-icon input-icon-lg right">
                                                                               <i class="fa fa-industry"></i>
                                                                               {!! Form::text('employer[]',old('employer[]'),array('placeholder'=>"Employer","class"=>"form-control" )) !!}
                                                                            </div>
                                                                          </div>
                                                                          <div class="form-group col-md-2 col-lg-2">
                                                                              <div class="input-icon input-icon-lg right">
                                                                                <i class="fa fa-user-md"></i>
                                                                                {!! Form::text('role[]',old('role[]'),array('placeholder'=>"Role","class"=>"form-control" )) !!}
                                                                              </div>
                                                                          </div>
                                                                          <div class="form-group col-md-2 col-lg-2">
                                                                                <div class="input-icon input-icon-lg right">
                                                                                <i class="fa fa-phone"></i>
                                                                                {!! Form::text('employer_phone[]',old('employer_phone[]'),array('placeholder'=>"Phone no","class"=>"form-control" )) !!}
                                                                                </div>
                                                                          </div>
                                                                          <div class="form-group col-md-2 col-lg-2">
                                                                            <div class="input-icon input-icon-lg right">
                                                                            <i class="fa fa-clock-o"></i>
                                                                            {!! Form::text('duration[]',old('duration[]'),array('placeholder'=>"Duration","class"=>"form-control" )) !!}
                                                                          </div>
                                                                          </div>
                                                                                <div class="form-group col-md-2 col-lg-2">
                                                                                    <div class="input-icon input-icon-lg right">
                                                                                        <i class="fa fa-money"></i>
                                                                                        {!! Form::text('income[]',old('income[]'),array('placeholder'=>"Earning Amount","class"=>"form-control" )) !!}
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group col-md-1 col-lg-1">

                                                                                </div>
                                                                                <div class="clearfix"></div>

                                                                            </div>

                                                                </div>


                                                            </div>
                                                            <!-- Main -->



                                                    <!-- buttons -->
                                                    <div class="clearfix"></div>
                                                            <!-- Documents -->
                                                            <div class="tab-pane fade" id="document">
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
                                                                                {!! Form::file('file[]',null,array('placeholder'=>"Employer","class"=>"form-control" )) !!}
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-6 col-lg-6">
                                                                            <div class="input-icon input-icon-lg right">
                                                                                {!! Form::text('file_comment[]',null,array('placeholder'=>"Comments","class"=>"form-control" )) !!}
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
                                    {!! Form::close() !!}
                                </div>

                    </div>
         </div>
        <!-- END SIDEBAR CONTENT LAYOUT -->
    </div>

    </div>
    </div>



    <!-- END CONTAINER -->
@endsection
@push('scripts')
<script src="{{asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/js/tenant.js')}}" type="text/javascript"></script>
<script  type="text/javascript">
    $(document).ready(function () {
        tenant.init()
        $('#attributeNO').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! URL('/expense/data/') !!}',
            columns: [
                { data: 'expense_id', name: 'expense_id' },
                { data: 'entry_date', name: 'entry_date' },
                { data: 'amount', name: 'amount' },
                { data: 'tax', name: 'tax' },
                { data: 'tax_2', name: 'tax_2' },
                { data: 'payee', name: 'payee' },
                { data: 'operations', name: 'operations' }
            ],"initComplete": function(settings, json){

            }
        });
        $("body").on("click",".pop",function () {
            url= $(this).data("url")
            app.popUp(url,$('#attribute').DataTable( ));
        })

        $("body").on("click",".remove",function () {

            var sure = confirm("Are you sure you want to delete!");
            if(sure) {
                url = $(this).data("url")
                app.postWithCallback(url, {
                    'id': $(this).data("id"),
                    '_token': $("[name='_token']").val()
                }, function () {
                    $('#attribute').DataTable().ajax.reload()
                })
            }

        })
    })
</script>


@endpush