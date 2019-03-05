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
                            @if (Session::has('success_message'))
                                <div class="note note-success">
                                    <p>{{ Session::get('success_message') }} </p>
                                </div>
                            @endif
                            @include("common.errors")
                            @yield('content')

                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption"><i style="margin-top:2px;" class="icon-user">  </i> {{$heading. ' ' }}<br/><br/>
                                        <div class="clearfix"></div>
                                        <span> <a class="btn btn-sm red btn-outline" href="{{URL('applicant/add/')}}" ><small><icon class="fa fa-plus"></icon><span>  ADD APPLICANT</span></small></a></span>
                                        <span> <a class="btn btn-sm blue btn-outline pointer pop" data-url="{{URL('lease')}}" ><small><icon class="fa fa-money"></icon><span>  ADD LEASE AGREEMENT</span></small></a></span>

                                    </div>
                                    <div class="tools">
                                        <a style="display:none;" href="javascript:;" class="collapse"> </a>
                                         <a style="display:none;" href="javascript:;" class="reload"> </a>
                                        <a style="display:none;" href="javascript:;" class="remove"> </a>
                                        <div class="dt-buttons">
                                                    </div>
                                    </div>


                                </div>
                                {{ csrf_field() }}
                                <div class="portlet-body flip-scroll">
                                    <table id="attribute" class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline collapsed">
                                        <thead class="flip-content">
                                        <tr>
                                            <th class="filter-input"> id </th>
                                            <th class="filter-input" data-id="dsa" >Name</th>
                                            <th class="filter-input">Email</th>
                                            <th class="filter-input">Contact</th>
                                            <th class="filter-select-value" >Prefer type</th>
                                            <th >Address</th>
                                            <th class="numeric"> Operation </th>
                                        </tr>
                                        </thead>
                                        <tfoot>

                                        </tfoot>
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
<script src="{{asset('resources/assets/js/unit.js')}}" type="text/javascript"></script>
<script>

    $(document).ready(function(){


        var table = $('#attribute').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! URL('/applicant/data/') !!}',
            columns: [
                { data: 'applicant_id', name: 'applicant_id' , bSortable: false },
                { data: 'name', name: 'name', bSortable: false },
                { data: 'email', name: 'email', bSortable: false },
                { data: 'phone', name: 'phone', bSortable: false },
                { data: 'prefer_type', name: 'prefer_type', bSortable: false },
                { data: 'address', name: 'address', bSortable: false },
                { data: 'operations', name: 'operations' }
            ],"initComplete": function(settings, json){
                this.api().columns('.filter-select-index' ).every( function (i) {
                    var column = this;
                    var select = $('<select placeholder="Search"  class="form-control" ><option value="">Filter</option></select>')
                            .appendTo( $(column.header()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                );
                                column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                            } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+j+'">'+d+'</option>' )
                    } );
                } );

                this.api().columns('.filter-select-value' ).every( function (i) {
                    var column = this;
                    var select = $('<select placeholder="Search"  class="form-control" ><option value="">Filter</option></select>')
                            .appendTo( $(column.header()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                );
                                column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                            } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );

                } );

                this.api().columns('.filter-input' ).every( function (i) {
                    var column = this;
                    var title = $(this).text();
                    var input = $('<input type="text" placeholder="Search"  class="form-control" />')
                            .appendTo( $(column.header()).empty() )
                            .on( 'keyup change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                );
                                column
                                        .search(val )
                                        .draw();
                            } );

                } );

            }
        });
        //table.$('#column3_search').on( 'keyup', function () {


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
                    $("#UnitTotal").text(json.unit_total)
                })
            }

        })
    })

</script>
@endpush