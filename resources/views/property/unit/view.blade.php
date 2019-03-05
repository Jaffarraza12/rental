@extends('layouts.app')
@section('content')
    <div class="page-container">
        @include("common.adminsideview")
        <div class="page-content-wrapper">
            <div class="page-content">

                @include("common.breadcrumb")
                @if(isset($building_selected))
                    <div class="row">
                        <div class="col-md-12">

                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="col">
                                    <div class="caption"><h1>{{$building->name }} <span id="UnitTotal">{{count($units)}}</span> / {{$building->units}} units</h1>
                                        <span> <a class="btn btn-redish" href="{{URL('unit/add')}}" ><small><icon class="fa fa-plus"></icon><span>  ADD UNIT</span></small></a></span>
                                    </div>

                                    <div class="tools">
                                        <a style="display:none;" href="javascript:;" class="collapse"> </a>
                                         <a style="display:none;" href="javascript:;" class="reload"> </a>
                                        <a style="display:none;" href="javascript:;" class="remove"> </a>
                                        <div style="display: none" class="dt-buttons pull-right">
                                            <a class="dt-button buttons-pdf buttons-html5 btn red btn-outline pop" data-url="{{URL('unit/add/'.$id)}}" tabindex="0" aria-controls="sample_1"><icon class="fa fa-plus"></icon><span>  ADD Unit</span></a>
                                        </div>
                                    </div>


                                </div>
                                {{ csrf_field() }}
                                <div class="portlet-body flip-scroll">
                                    <table id="attribute" class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline collapsed">
                                        <thead class="flip-content">
                                        <tr>
                                            <th class="filter-input" data-id="dsa" >Name</th>
                                            <th class="filter-select-value">Type</th>
                                            <th class="filter-select-index">Occupancy</th>
                                            <th class="filter-select-index">Furnished</th>
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
                @else
                    @include('errors.builing_not_selected')
                @endif
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
<script src="{{asset('resources/assets/js/unit.js')}}" type="text/javascript"></script>
<script>

    $(document).ready(function(){

        var table = $('#attribute').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! URL('/unit/data/'.$id) !!}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'type', name: 'type' },
                { data: 'available', name: 'available' },
                { data: 'furnished', name: 'furnished' },
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
        unit.init()
        //table.$('#column3_search').on( 'keyup', function () {


        $("body").on("click",".pop",function () {
            url= $(this).data("url")
            app.getWithCallback(app.baseUrl()+"/unit/total/{{$building->building_id}}",[],function(x){
                var js = x.parseJSON(x)
                if(js.total_unit){
                    $("#UnitTotal").text(js.total_unit)
                }
            })
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