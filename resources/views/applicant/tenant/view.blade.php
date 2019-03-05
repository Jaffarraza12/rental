@extends('layouts.app')

@section('content')
    <div class="page-container">
        @include("common.adminsideview")
        <div class="page-content-wrapper">
            <div class="page-content">

                {{--@include("common.breadcrumb")--}}
                        <!-- BEGIN PAGE BASE CONTENT -->
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
                                <div class="col">
                                    <div class="caption"><h1>{{$heading. ' ' }}</h1>
                                        <span> <a class="btn btn-redish " href="{{URL('tenant/add/')}}" ><small><icon class="fa fa-plus"></icon><span>  ADD TENANT</span></small></a></span>    </div>
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
                                    <div id="searchBar">
                                        <label>
                                            <input type="text" class="global_filter" id="global_filter" placeholder="Search Anything">
                                            <input type="button" id="searchbtn" value="Go">
                                        </label>
                                    </div>
                                    <table id="attribute" class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline collapsed">
                                        <thead class="flip-content">
                                        <tr>
                                            <th class="filter-input" data-id="dsa" data-placeholder="Name">Name</th>
                                            <th class="filter-input" data-placeholder="Email">Email</th>
                                            <th class="filter-input" data-placeholder="Contact">Contact</th>
                                            <th class="">Unit</th>
                                            <th class="" >Payment</th>
                                            <th class="numeric">  </th>
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
        <!-- END SIDEBAR CONTENT LAYOUT -->
    </div>

    </div>
    </div>



@endsection
@push('scripts')
<script src="{{asset('resources/assets/js/unit.js')}}" type="text/javascript"></script>
<script>

    $(document).ready(function(){


        var table = $('#attribute').DataTable({
            processing: true,
            serverSide: false   ,
            ajax: '{!! URL('/tenants/data/') !!}',
            columns: [
                     { data: 'tenant.name', name: 'name', bSortable: false },
                { data: 'email', name: 'email', bSortable: false },
                { data: 'phone', name: 'phone', bSortable: false },
                { data: 'UNIT', name: 'UNIT', bSortable: false },
                { data: 'payment_id', name: 'payment_id', searchable: false, bSortable: false},
                { data: 'actions', name: 'actions', searchable: false, bSortable: false }
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



                $('.filter-input').each( function () {
                    var title = $(this).attr('data-placeholder');
                    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                } );

                // DataTable
                var table = $('#attribute').DataTable();

                // Apply the search
                table.columns().every( function () {
                    var that = this;

                    $( 'input', this.header() ).on( 'keyup change', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );

                //}, 3000);

                function filterGlobal () {
                    $('#attribute').DataTable().search(
                        $('#global_filter').val()
                    ).draw();
                }


                $('#searchbtn').on('click', function () {
                    //alert( 'You clicked search btn' );
                    filterGlobal();
                } );

                $(".actionBox").on('change',function () {
                    var actionB = $(this).val();
                    window.location.href = actionB;

                })

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