@extends('layouts.app')

@section('content')
    <div class="page-container">
        @include("common.adminsideview")
        <div class="page-content-wrapper">
            <div class="page-content rentalForm">

                {{--@include("common.breadcrumb")--}}
                <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            @if (Session::has('success_message'))
                                <div class="note note-success">
                                    <p>{{ Session::get('success_message') }} </p>
                                </div>
                            @endif

                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="col">
                                    <div class="caption"><h1>{{$heading. ' ' }}</h1>
                                        <span> <a class="btn btn-redish" href="{{URL('work_order/add')}}" ><small><icon class="fa fa-plus"></icon><span>  ADD WORK ORDER</span></small></a></span>

                                        {{--<span> <a class="btn btn-redish" href="{{URL('')}}" ><small><icon class="fa fa-plus"></icon><span>  PDF</span></small></a></span>--}}
                                    </div>
                                    <div class="tools">
                                        <a style="display:none;" href="javascript:;" class="collapse"> </a>
                                        <a style="display:none;" href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a style="display:none;" href="javascript:;" class="reload"> </a>
                                        <a style="display:none;" href="javascript:;" class="remove"> </a>
                                        <div class="dt-buttons pull-right" style="display: none">
                                            <a class="dt-button buttons-pdf buttons-html5 btn red btn-outline pop" data-url="{{URL('work_order/add')}}" tabindex="0" aria-controls="sample_1"><span>NEW</span></a>
                                        </div>
                                    </div>


                                </div>
                                {{ csrf_field() }}
                                <div class="portlet-body flip-scroll">
                                    <table id="attribute" class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline collapsed">
                                        <thead class="flip-content">
                                        <tr>
                                            <th>Name</th>
                                            <th>Assign To</th>
                                            <th>Unit Name</th>
                                            <th>Status</th>
                                            <th>Priority</th>
                                            <th>Created On</th>
                                            <th class="numeric">  </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
            </div>
        </div>
        <!-- END SIDEBAR CONTENT LAYOUT -->
    </div>

    </div>



    <!-- END CONTAINER -->
@endsection
@push('scripts')
<script>

    $(document).ready(function(){
        $('#attribute').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! URL('/work_order/data') !!}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'building', name: 'building' },
                { data: 'unit_name', name: 'unit_name' },
                { data: 'status', name: 'status' },
                { data: 'priority', name: 'priority' },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: 'actions' }
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