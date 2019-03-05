@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="page-content">
            @include("common.breadcrumb")
            <!-- BEGIN SIDEBAR CONTENT LAYOUT -->
            <div class="page-content-container">
                <div class="page-content-row">
                <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">

                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=""></i></div>
                                    <div class="tools">
                                        <a style="display:none;" href="javascript:;" class="collapse"> </a>
                                        <a style="display:none;" href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a style="display:none;" href="javascript:;" class="reload"> </a>
                                        <a style="display:none;" href="javascript:;" class="remove"> </a>
                                        <div class="dt-buttons pull-right">
                                            <a class="dt-button buttons-pdf buttons-html5 btn red btn-outline pop" data-url="{{URL('work_order/add')}}" tabindex="0" aria-controls="sample_1"><span>NEW</span></a>
                                        </div>
                                    </div>


                                </div>
                                {{ csrf_field() }}
                                <div class="portlet-body flip-scroll">
                                    <table id="attribute" class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline collapsed">
                                        <thead class="flip-content">
                                        <tr>
                                            <th width="20%"> id </th>
                                            <th>Name</th>
                                            <th>Building | Property</th>
                                            <th>Unit Name</th>
                                            <th>Status</th>
                                            <th>Priority</th>
                                            <th>Created On</th>
                                            <th class="numeric"> Operation </th>
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
    </div>



    <!-- END CONTAINER -->
    @include("common.adminsideview")
@endsection
@push('scripts')
<script>

    $(document).ready(function(){
        $('#attribute').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! URL('/work_order/data') !!}',
            columns: [
                { data: 'work_order_id', name: 'work_order_id' },
                { data: 'name', name: 'name' },
                { data: 'building', name: 'building' },
                { data: 'unit_name', name: 'unit_name' },
                { data: 'status', name: 'status' },
                { data: 'priority', name: 'priority' },
                { data: 'created_at', name: 'created_at' },
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