    @extends('layouts.app')
@push('css')
<link href="{{asset('resources/assets/global/plugins/icheck/skins/flat/_all.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('resources/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('resources/assets/css/tell.components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{asset('resources/assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->



    @endpush
@section('content')
    <div class="page-container rentalForm">
        @include("common.adminsideview")
        <div class="page-content-wrapper">
            <div class="page-content">
            @include("common.breadcrumb")
            <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    {!! Form::open(array('url' => $ActionURL ,'method'=>'post', 'files' => true ,'class'=> 'mt-repeater')) !!}
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

                            @yield('content')
                            <div class="portlet-body flip-scroll">
                                <form action="echo.php" class="repeater" enctype="multipart/form-data">
                                    <div data-repeater-list="group-a">
                                        <div data-repeater-item>
                                            <input name="untyped-input" value="A"/>

                                            <input type="text" name="text-input" value="A"/>

                                            <input type="date" name="date-input"/>

                                            <textarea name="textarea-input">A</textarea>

                                            <input type="radio" name="radio-input" value="A" checked/>
                                            <input type="radio" name="radio-input" value="B"/>

                                            <input type="checkbox" name="checkbox-input" value="A" checked/>
                                            <input type="checkbox" name="checkbox-input" value="B"/>

                                            <select name="select-input">
                                                <option value="A" selected>A</option>
                                                <option value="B">B</option>
                                            </select>

                                            <select name="multiple-select-input" multiple>
                                                <option value="A" selected>A</option>
                                                <option value="B" selected>B</option>
                                            </select>

                                            <input data-repeater-delete type="button" value="Delete"/>
                                        </div>
                                        <div data-repeater-item>
                                            <input name="untyped-input" value="A"/>

                                            <input type="text" name="text-input" value="B"/>

                                            <input type="date" name="date-input"/>

                                            <textarea name="textarea-input">B</textarea>

                                            <input type="radio" name="radio-input" value="A" />
                                            <input type="radio" name="radio-input" value="B" checked/>

                                            <input type="checkbox" name="checkbox-input" value="A"/>
                                            <input type="checkbox" name="checkbox-input" value="B" checked/>

                                            <select name="select-input">
                                                <option value="A">A</option>
                                                <option value="B" selected>B</option>
                                            </select>

                                            <select name="multiple-select-input" multiple>
                                                <option value="A" selected>A</option>
                                                <option value="B" selected>B</option>
                                            </select>

                                            <input data-repeater-delete type="button" value="Delete"/>
                                        </div>
                                    </div>
                                    <input data-repeater-create type="button" value="Add"/>
                                </form>

                                {{ csrf_field() }}


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
            <script src="{{asset('resources/assets/global/plugins/jquery-repeater/jquery.repeater.min.js')}}" type="text/javascript"></script>
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
                $(document).ready(function () {
                    'use strict';

                    $('.repeater').repeater({
                        defaultValues: {
                            'textarea-input': 'foo',
                            'text-input': 'bar',
                            'select-input': 'B',
                            'checkbox-input': ['A', 'B'],
                            'radio-input': 'B'
                        },
                        show: function () {
                            $(this).slideDown();
                        },
                        hide: function (deleteElement) {
                            if(confirm('Are you sure you want to delete this element?')) {
                                $(this).slideUp(deleteElement);
                            }
                        },
                        ready: function (setIndexes) {

                        }
                    });

                    window.outerRepeater = $('.outer-repeater').repeater({
                        isFirstItemUndeletable: true,
                        defaultValues: { 'text-input': 'outer-default' },
                        show: function () {
                            console.log('outer show');
                            $(this).slideDown();
                        },
                        hide: function (deleteElement) {
                            console.log('outer delete');
                            $(this).slideUp(deleteElement);
                        },
                        repeaters: [{
                            isFirstItemUndeletable: true,
                            selector: '.inner-repeater',
                            defaultValues: { 'inner-text-input': 'inner-default' },
                            show: function () {
                                console.log('inner show');
                                $(this).slideDown();
                            },
                            hide: function (deleteElement) {
                                console.log('inner delete');
                                $(this).slideUp(deleteElement);
                            }
                        }]
                    });
                });
            </script>


    @endpush