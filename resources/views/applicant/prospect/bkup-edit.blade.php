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
                            <div class="col">
                                {!! Form::hidden("url",URL('unit/'),array("class","url")) !!}
                                <div class="caption">
                                    <h4><i class="fa fa-user"></i> {{$heading}}.</h4>
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
                                        <div class="portlet light">
                                            <div class="row">

                                                <!--Buidling/Property-->
                                                <div class="col-md-12 col-lg-12">
                                                    <div class="tab-content">
                                                        <!-- General -->
                                                        <div id="general" >
                                                            <div class="clearfix"></div>
                                                            <div class="form-group ">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <label>Full Name</label>
                                                                    {!! Form::text('name',old('name'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <label >Email</label>
                                                                    {!! Form::text('email',old('email'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="input-icon  right">
                                                                    <label >Phone</label>
                                                                    {!! Form::text('phone',old('phone'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <label >Mobile</label>
                                                                    {!! Form::text('mobile',old('address'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <label class="fa fa-location">Address</label>
                                                                    {!! Form::text('address',old('address'),array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
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
                                                            {{$applicant->applicant_id}}
                                                            <div class="form-group ">
                                                                <div class="input-icon input-icon-lg right">
                                                                    <label >Unit No (Optional)</label>
                                                                    {!! Form::text('unit_id',$applicant->unit_id,array('placeholder'=>"","class"=>"form-control" )) !!}
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- Main -->
                                                        {!! Form::submit( 'Save And Manually Enter Applicant Details', ['class' => 'btn red btn', 'name' => 'save', 'value' => 'email'])!!}
                                                        {!! Form::submit( 'Save And Emai Link For Rental Application', ['class' => 'btn red btn', 'name' => 'save', 'value' => 'continue']) !!}

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