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
                                        <i class="fa fa-cogs"></i>Exiting Roles. </div>
                                    <div class="tools">
                                        <a style="display:none;" href="javascript:;" class="collapse"> </a>
                                        <a style="display:none;" href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a style="display:none;" href="javascript:;" class="reload"> </a>
                                        <a style="display:none;" href="javascript:;" class="remove"> </a>
                                        <div class="dt-buttons pull-right">
                                            <a class="dt-button buttons-pdf buttons-html5 btn red btn-outline pop" data-url="{{URL('role/add')}}" tabindex="0" aria-controls="sample_1"><span>NEW</span></a>
                                         </div>
                                    </div>

                                </div>
                                {{ csrf_field() }}
                                <div class="portlet-body flip-scroll">
                                    <table id="roles" class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline collapsed">
                                        <thead class="flip-content">
                                        <tr>

                                            <th width="20%"> Role id </th>
                                            <th> Name</th>
                                            <th class="numeric"> Display Name</th>
                                            <th class="numeric"> Created Date </th>
                                            <th class="numeric"> Updated Date </th>
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
        $('#roles').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! URL('/role/data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'display_name', name: 'display_name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'operations', name: 'operations' }
            ],"initComplete": function(settings, json) {
                $('#remove_row').confirmation('show');
            }
        });

        $("body").on("click",".pop",function () {
            url= $(this).data("url")
            app.popUp(url,$('#roles').DataTable( ));
        })

        $("body").on("click",".remove",function () {

            var sure = confirm("Are you sure you want to delete!");
            if(sure) {
                url = $(this).data("url")
                app.postWithCallback(url, {
                    'id': $(this).data("id"),
                    '_token': $("[name='_token']").val()
                }, function () {
                    $('#roles').DataTable().ajax.reload()
                })
            }

        })
    })

</script>
@endpush