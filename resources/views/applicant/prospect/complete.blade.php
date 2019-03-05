@extends('layouts.app')
@push('css')
<link href="{{asset('resources/assets/global/plugins/icheck/skins/flat/_all.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('resources/assets/css/form.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="page-container">
        @include("common.adminsideview")
        <div class="page-content-wrapper">
            <div class="page-content rentalForm ">
            {{--@include("common.breadcrumb")--}}
            <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    {!! Form::open(array('url' => $ActionURL ,'method'=>'PUT', 'files' => true)) !!}
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="col">
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
                                <div class="tab-content ">
                                    <div  id="main">
                                        <div class="">
                                            <div class="row">

                                                <!--Buidling/Property-->
                                                <div >
                                                    <div class="tab-content">
                                                        <br>
                                                        <!-- General -->
                                                        <div id="general"  >
                                                            <div class="clearfix"></div>
                                                            <div class="form-group col-md-6 col-lg-6">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <label>Full Name</label>
                                                                    {!! Form::text('name',$applicant->name,array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                    {!! Form::hidden("applicant_id",$applicant->applicant_id,array("class","url")) !!}
                                                                    {!! Form::hidden("status",5,array("class","")) !!}

                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6 col-lg-6">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <label >Email</label>
                                                                    {!! Form::text('email',$applicant->email,array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6 col-lg-6">
                                                                <div class="input-icon  right">
                                                                    <label >Phone</label>
                                                                    {!! Form::text('phone',$applicant->phone,array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6 col-lg-6">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <label >Mobile</label>
                                                                    {!! Form::text('mobile',$applicant->mobile,array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-12 col-lg-12">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <label >Address</label>
                                                                    {!! Form::text('address',$applicant->address,array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6 col-lg-6">
                                                                <div class="input-icon right">
                                                                    <label >Units Type</label>
                                                                    {!! Form::select('unit_prefer', array(
                                                                            'Studio' => 'Studio',
                                                                            'Bachelor' => 'Bachelor',
                                                                            'Junior1' => 'Junior1',
                                                                            '1 Bedroom' => '1 Bedroom',
                                                                            '2 Bedroom' => '2 Bedroom',
                                                                            '3 Bedroom' => '3 Bedroom'
                                                                            ),$applicant->prefer_type,array('placeholder'=> "","class"=>"form-control","id"=>"type" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6 col-lg-6">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <label >Unit No (Optional)</label>
                                                                    {!! Form::text('unit_id',$applicant->unit_id,array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <!-- ouccupant -->
                                                        <div class="col-md-12 col-lg-12">
                                                            <div class="">
                                                                <div class="caption col-md-10 col-lg-10">
                                                                    <h3 class="col-md-12 col-lg-12 padding_below" style="color: #4b646f;margin-left:-15px">Occupants </h3>
                                                                </div>
                                                                <div class="tools col-md-2 col-lg-2" style="margin-top:15px;">
                                                                    <span class="pointer addOccupantHtml" ><icon class="fa fa-plus"></icon> Add Occupant</span>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="OccupantHtml" >
                                                                <div class="form-group col-md-3 col-lg-3">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <label >Occupant Name</label>
                                                                        {!! Form::text('occupant_name[]',old('occupant_name'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-3 col-lg-3">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <label >Relation ships</label>
                                                                        {!! Form::text('relation[]',old('relation[]'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-5 col-lg-5">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <label >Summary</label>
                                                                        {!! Form::text('comments[]',old('comments[]'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-1 col-lg-1">

                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>

                                                        </div>
                                                        <!-- ouccupant -->

                                                        <!-- vehicle -->
                                                        <div class="col-md-12 col-lg-12">
                                                            <div class="">
                                                                <div class="caption col-md-10 col-lg-10">
                                                                    <h3 class="col-md-12 col-lg-12 padding_below" style="color: #4b646f;margin-left:-15px">Vehicles </h3>
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




                                                        </div>
                                                        <!-- vehicle -->

                                                        <!-- Employerr -->
                                                        <div class="col-md-12 col-lg-12">
                                                        <div class="">

                                                            <div class="caption col-md-10 col-lg-10">
                                                                <h3 class="col-md-12 col-lg-12 padding_below" style="color: #4b646f;margin-left:-15px">Employer</h3>
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
                                                                        <label >Employer</label>
                                                                        {!! Form::text('employer[]',old('employer[]'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-2 col-lg-2">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <label >Role</label>
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
                                                                        {!! Form::text('duration[]',old('duration[]'),array('placeholder'=>"    ","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-2 col-lg-2">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <label >Earning Amount</label>
                                                                        {!! Form::text('income[]',old('income[]'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-1 col-lg-1">

                                                                </div>
                                                                <div class="clearfix"></div>

                                                            </div>

                                                        </div>
                                                        </div>
                                                        <!-- Employer -->
                                                        <div class="col-md-12 col-lg-12">
                                                        <div class="">
                                                            <div class="caption col-md-10 col-lg-10">
                                                                <h3 class="col-md-12 col-lg-12 padding_below" style="color: #4b646f;margin-left:-15px">Documents</h3>
                                                            </div>
                                                            <div class="tools pull-right" style="margin:15px 0px;">
                                                                <span class="pointer addDocumentHtml" ><icon class="fa fa-plus"></icon> Add Document</span>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="DocumentHtml" style="border-top:1px solid #fcfcfc;"></div>
                                                        </div>
                                                         <div class="clearfix"></div>
                                                        {!! Form::submit( 'SAVE', ['class' => 'btn greenish btn', 'name' => 'save', 'value' => 'email'])!!}
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