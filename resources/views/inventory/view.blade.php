@extends('layouts.app')
@section('content')
    <div class="page-container">
        @include("common.adminsideview")
        <div class="page-content-wrapper">
            <div class="page-content">

            @include("common.breadcrumb")
            <!-- BEGIN PAGE BASE CONTENT -->
                <div class="row">
                    <div class="col-md-12">

                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption"><i style="margin-top:2px;" class="fa fa-wrench">  </i> {{$heading. ' ' }}<br/><br/>
                                    <div class="clearfix"></div>
                                    <span> <a class="btn btn-redish pop" data-url="{{URL('inventory/add')}}" ><small><icon class="fa fa-plus"></icon><span>  ADD INVENTORY</span></small></a></span>

                                    {{--<span> <a class="btn btn-redish" href="{{URL('')}}" ><small><icon class="fa fa-plus"></icon><span>  PDF</span></small></a></span>--}}
                                </div>
                                <div class="tools">
                                    <a style="display:none;" href="javascript:;" class="collapse"> </a>
                                    <a style="display:none;" href="#portlet-config" data-toggle="modal" class="config"> </a>
                                    <a style="display:none;" href="javascript:;" class="reload"> </a>
                                    <a style="display:none;" href="javascript:;" class="remove"> </a>
                                    <div class="dt-buttons pull-right" style="display: none">
                                        <a class="dt-button buttons-pdf buttons-html5 btn red btn-outline pop" data-url="{{URL('inventory/add')}}" tabindex="0" aria-controls="sample_1"><span>NEW</span></a>
                                    </div>
                                </div>


                            </div>
                            {{ csrf_field() }}
                            <div class="portlet-body flip-scroll">
                                <table id="attribute" class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline collapsed">
                                    <thead class="flip-content">
                                    <tr>
                                        <th width="20%"> id </th>
                                        <th>Product Name</th>
                                        <th>Description</th>
                                        <th>Unit Cost</th>
                                        <th>Quantity</th>
                                        <th>Vendor</th>
                                        <th>Vendor Contact</th>
                                        <th>Purchasing Date</th>
                                        <th class="numeric"> Actions </th>
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
            ajax: '{!! URL('/inventory/data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'productName', name: 'productName' },
                { data: 'productDescription', name: 'productDescription' },
                { data: 'unitCost', name: 'unitCost' },
                { data: 'quantity', name: 'quantity' },
                { data: 'vendor', name: 'vendor' },
                { data: 'contactNumber', name: 'contactNumber' },
                { data: 'purchasingDate', name: 'purchasingDate' },
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
                app.getWithCallback(url, {
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