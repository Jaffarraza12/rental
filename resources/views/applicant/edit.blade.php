
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
                                    <div class="tab-content ">
                                        <div  id="main">
                                            {{--<div class="portlet light lighterPadding">--}}
                                            <div class="">
                                                <div class="row">

                                                    <!--Buidling/Property-->
                                                    <div class="">
                                                        <div class="tab-content">
                                                            <br>
                                                            <!-- General -->
                                                            <div id="general" >
                                                                <div class="form-group col-md-3 col-lg-3">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <label>Full Name</label>
                                                                        {!! Form::text('name',$applicant->name,array("class"=>"form-control" )) !!}
                                                                        <span class="help-block">{{ $errors->mess->first('name') }}</span>
                                                                        {!! Form::hidden("applicant_id",$applicant->applicant_id,array("class","url")) !!}
                                                                        {!! Form::hidden("status",$applicant->status,array("class","")) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-3 col-lg-3">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <label>Email</label>
                                                                        {!! Form::text('email',$applicant->email,array("class"=>"form-control" )) !!}
                                                                        <span class="help-block">{{ $errors->mess->first('email') }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>

                                                                <div class="form-group col-md-3 col-lg-3">
                                                                    <div class="input-icon  right">
                                                                        <label>Phone</label>
                                                                        {!! Form::text('phone',$applicant->phone,array("class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-3 col-lg-3">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <label>Mobile</label>
                                                                        {!! Form::text('mobile',$applicant->mobile,array("class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="clearfix"></div>

                                                                <div class="form-group col-md-3 col-lg-3">
                                                                    <div class="input-icon right">
                                                                        <label>Unit Preference</label>
                                                                        {!! Form::select('unit_prefer', array(
                                                                                'Studio' => 'Studio',
                                                                                'Bachelor' => 'Bachelor',
                                                                                'Junior1' => 'Junior1',
                                                                                '1 Bedroom' => '1 Bedroom',
                                                                                '2 Bedroom' => '2 Bedroom',
                                                                                '3 Bedroom' => '3 Bedroom'
                                                                                ),$applicant->unit_prefer,array("class"=>"form-control","id"=>"type" )) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-3 col-lg-3">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <label>Unit no (optional)</label>
                                                                        {!! Form::text('unit_id',$applicant->unit_id,array("class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="clearfix"></div>

                                                                <div class="form-group col-md-6 col-lg-6">
                                                                    <div class="input-icon input-icon-lg right">
                                                                        <label>address</label>
                                                                        {!! Form::text('address',$applicant->address,array("class"=>"form-control" )) !!}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Main -->
                                                            <div class="form-group row">
                                                                <div  class="form-group col-md-12 col-lg-12" style="margin-top: 10px;">
                                                                    {!! Form::submit( 'Save & Enter Applicant Details', ['class' => 'btn greenish btn', 'name' => 'save', 'value' => 'email'])!!}
                                                                    {!! Form::submit( 'Save And Email Rental Applicantion', ['class' => 'btn greenish btn', 'name' => 'save', 'value' => 'continue']) !!}
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