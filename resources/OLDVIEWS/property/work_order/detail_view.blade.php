@extends('layouts.app')
@push('css')
<link href="{{asset('resources/assets/global/plugins/icheck/skins/flat/_all.css')}}" rel="stylesheet" type="text/css" />
@endpush
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
                                       <h4><b><i class="fa fa-square-o"></i> {{$sub_heading}}.</b> </h4>
                                    </div>
                                    <div class="tools">
                                        <div class="dt-buttons pull-right">
                                            <ul class="nav nav-pills">
                                                <li class="nav active"><a class="tabColor" href="#main" data-toggle="tab">General</a></li>
                                                <li class="nav"><a class="tabColor" href="#expense" data-toggle="tab">Expenses</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    {!! Form::hidden("url",URL('unit/'.$id),array("class","url")) !!}
                                    {{ csrf_field() }}
                                    <div class="tab-content ">
                                        <div class="tab-pane fade in active" id="main"><div class="portlet light bordered">
                                          <div class="row">
                                            <!--Summary -->
                                            <div class="col-md-5 col-lg-5">
                                                <div class="portlet light bordered">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <span class="caption-subject font-dark bold uppercase"> Summary</span>
                                                        </div>
                                                        <div class="actions">
                                                            <a data-url="{!! URL('work_order/edit/'.$work_order->work_order_id) !!}" class="btn btn-circle btn-icon-only btn-default pop">
                                                                <i class="fa fa-edit"></i>
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <h4> {{$work_order->name}}.</h4>
                                                        <div class="margin-top-10 margin-bottom-10 clearfix">
                                                            <table class="table table-bordered table-striped">
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        Nature
                                                                    </td>
                                                                    <td>
                                                                       {{$work_order->type}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Date Opened
                                                                    </td>
                                                                    <td>
                                                                        {{$work_order->date_open}}
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        Due Date
                                                                    </td>
                                                                    <td>
                                                                        {{date('M d Y',strtotime($work_order->due_date))}}
                                                                    </td>
                                                                </tr>


                                                                <tr>
                                                                    <td>
                                                                        Status
                                                                    </td>
                                                                    <td>
                                                                        @if($work_order->status == 2)
                                                                            {{ 'Closed' }}
                                                                        @elseif($work_order->status == 1)
                                                                            {{ 'Pending' }}
                                                                        @else
                                                                            {{ 'Opened' }}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Priority</button>
                                                                    </td>
                                                                    <td>
                                                                        <div style="padding:5px;" id="pulsate-crazy-target">{{$work_order->priority}} </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Description</button>
                                                                    </td>
                                                                    <td>
                                                                        <div id="pulsate-crazy-target">{{$work_order->description}} </div>
                                                                    </td>
                                                                </tr>

                                                                </tbody></table>
                                                        </div>

                                                       <div aria-hidden="true" aria-labelledby="myModalLabel2" role="dialog" tabindex="-1" class="modal fade" id="myModal2">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                                                                        <h4 class="modal-title">Alert Header</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p> Body goes here... </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="btn green" data-dismiss="modal">OK</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div aria-hidden="true" aria-labelledby="myModalLabel3" role="dialog" tabindex="-1" class="modal fade" id="myModal3">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                                                                        <h4 class="modal-title">Confirm Header</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p> Body goes here... </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button aria-hidden="true" data-dismiss="modal" class="btn default">Close</button>
                                                                        <button class="btn blue" data-dismiss="modal">Confirm</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!--Summary -->
                                            <!--Buidling/Property-->
                                            <div class="col-md-5 col-lg-5">
                                                  <div class="portlet light bordered">
                                                      <div class="portlet-title">
                                                          <div class="caption">
                                                              <span class="caption-subject font-dark bold uppercase"> Building</span>
                                                          </div>
                                                          <div class="actions">
                                                              <a data-url="{!! URL('building/edit/'.$work_order->building_id) !!}"  title="Edit Building" class="btn btn-circle btn-icon-only btn-default pop">
                                                                  <i class="fa fa-edit"></i>
                                                              </a>
                                                          </div>
                                                      </div>
                                                      <div class="portlet-body">
                                                          <h3><icon class="fa fa-building"></icon> {{$building->name}}.</h3>
                                                          <h5><icon class="fa fa-square"></icon> {{$unit->name. ' '}}  <a class="tabColor" href="#"> &nbsp;<icon class="fa fa-edit"></icon></a></h5>
                                                          <h5><icon class="icon-user"></icon> {{$building->manager}}.</h5>
                                                          <h5><icon class="fa fa-phone"></icon> {{$building->phone}}.</h5>
                                                          <div class="margin-top-10 margin-bottom-10 clearfix">
                                                           </div>

                                                          <div aria-hidden="true" aria-labelledby="myModalLabel2" role="dialog" tabindex="-1" class="modal fade" id="myModal2">
                                                              <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                      <div class="modal-header">
                                                                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                                                                          <h4 class="modal-title">Alert Header</h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                          <p> Body goes here... </p>
                                                                      </div>
                                                                      <div class="modal-footer">
                                                                          <button class="btn green" data-dismiss="modal">OK</button>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div aria-hidden="true" aria-labelledby="myModalLabel3" role="dialog" tabindex="-1" class="modal fade" id="myModal3">
                                                              <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                      <div class="modal-header">
                                                                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                                                                          <h4 class="modal-title">Confirm Header</h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                          <p> Body goes here... </p>
                                                                      </div>
                                                                      <div class="modal-footer">
                                                                          <button aria-hidden="true" data-dismiss="modal" class="btn default">Close</button>
                                                                          <button class="btn blue" data-dismiss="modal">Confirm</button>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>

                                              </div>
                                            <!--Buidling/Property-->
                                            <!-- buttons -->
                                            <div class="col-md-2 col-lg-2">
                                                        <ul class="list-group">
                                                            <li class="list-group-item"><a class="tabColor" hred="">Email To Friend</a> </li>
                                                            <li class="list-group-item"><a class="tabColor" hred=""> Print PDF </a> </li>
                                                        </ul>
                                            </div>
                                            <!-- buttons -->
                                            <div class="clearfix"></div>
                                            <!--Pictures -->
                                            <div class="col-md-12 col-lg-12">
                                                  <div class="portlet light bordered">
                                                      <div class="portlet-title">
                                                          <div class="caption">
                                                              <span class="caption-subject font-dark bold uppercase"> Pictures</span>
                                                          </div>
                                                          <div class="actions">
                                                              <a href="javascript:;" class="btn btn-circle btn-icon-only btn-default">
                                                                  <i class="fa fa-edit"></i>
                                                              </a>
                                                              <a href="javascript:;" class="btn btn-circle btn-icon-only btn-default">
                                                                  <i class="icon-wrench"></i>
                                                              </a>
                                                          </div>
                                                      </div>
                                                      <div class="portlet-body">
                                                          <h4> {{ 'Add pictures' }}.</h4>
                                                          <div class="margin-top-10 margin-bottom-10 clearfix">
                                                         </div>

                                                          <div aria-hidden="true" aria-labelledby="myModalLabel2" role="dialog" tabindex="-1" class="modal fade" id="myModal2">
                                                              <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                      <div class="modal-header">
                                                                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                                                                          <h4 class="modal-title">Alert Header</h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                          <p> Body goes here... </p>
                                                                      </div>
                                                                      <div class="modal-footer">
                                                                          <button class="btn green" data-dismiss="modal">OK</button>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div aria-hidden="true" aria-labelledby="myModalLabel3" role="dialog" tabindex="-1" class="modal fade" id="myModal3">
                                                              <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                      <div class="modal-header">
                                                                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                                                                          <h4 class="modal-title">Confirm Header</h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                          <p> Body goes here... </p>
                                                                      </div>
                                                                      <div class="modal-footer">
                                                                          <button aria-hidden="true" data-dismiss="modal" class="btn default">Close</button>
                                                                          <button class="btn blue" data-dismiss="modal">Confirm</button>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>

                                              </div>
                                             <!--Pictures -->
                                            <!--dcoument -->
                                            <div class="col-md-12 col-lg-12">
                                                  <div class="portlet light bordered">
                                                      <div class="portlet-title">
                                                          <div class="caption">
                                                              <span class="caption-subject font-dark bold uppercase"> Documents</span>
                                                          </div>
                                                          <div class="actions">
                                                              <a href="javascript:;" class="btn btn-circle btn-icon-only btn-default">
                                                                  <i class="fa fa-edit"></i>
                                                              </a>
                                                              <a href="javascript:;" class="btn btn-circle btn-icon-only btn-default">
                                                                  <i class="icon-wrench"></i>
                                                              </a>
                                                          </div>
                                                      </div>
                                                      <div class="portlet-body">
                                                          <h4> {{ 'Add Legal documents' }}.</h4>
                                                          <div class="margin-top-10 margin-bottom-10 clearfix">
                                                          </div>

                                                          <div aria-hidden="true" aria-labelledby="myModalLabel2" role="dialog" tabindex="-1" class="modal fade" id="myModal2">
                                                              <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                      <div class="modal-header">
                                                                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                                                                          <h4 class="modal-title">Alert Header</h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                          <p> Body goes here... </p>
                                                                      </div>
                                                                      <div class="modal-footer">
                                                                          <button class="btn green" data-dismiss="modal">OK</button>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div aria-hidden="true" aria-labelledby="myModalLabel3" role="dialog" tabindex="-1" class="modal fade" id="myModal3">
                                                              <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                      <div class="modal-header">
                                                                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                                                                          <h4 class="modal-title">Confirm Header</h4>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                          <p> Body goes here... </p>
                                                                      </div>
                                                                      <div class="modal-footer">
                                                                          <button aria-hidden="true" data-dismiss="modal" class="btn default">Close</button>
                                                                          <button class="btn blue" data-dismiss="modal">Confirm</button>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>

                                              </div>
                                            <!--dcouments -->

                                          </div>
                                         </div>


                                        </div>
                                        <div class="tab-pane fade" id="expense">
                                            <div class="row">
                                            <!-- expenses -->
                                            <div class="col-md-10 col-lg-10">
                                                <div class="portlet light bordered">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <span class="caption-subject font-dark bold uppercase"> Expenses</span>
                                                        </div>
                                                        <div class="actions">
                                                            <a  title="Add Expenses"  data-url="{{ URL("expense/add/".$work_order->work_order_id)}}" class="btn btn-circle btn-icon-only btn-default pop">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <table id="attribute" class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline collapsed">
                                                            <thead class="flip-content">
                                                            <tr>
                                                                <th > id </th>
                                                                <th>Entry Date</th>
                                                                <th>Amount</th>
                                                                <th>Tax 1</th>
                                                                <th>Tax 2</th>
                                                                <th>Payee</th>
                                                                <th class="numeric"> Operation </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>



                                                    </div>
                                                </div>

                                            </div>
                                            <!-- expenses -->
                                            <!-- buttons -->
                                            <div class="col-md-2 col-lg-2">
                                                <ul class="list-group">
                                                    <li class="list-group-item"><a class="tabColor" hred=""> Print PDF </a> </li>
                                                </ul>
                                            </div>
                                            <!-- buttons -->
                                            </div>


                                        </div>
                                    </div>
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
<script src="{{asset('resources/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/js/work_order.js')}}" type="text/javascript"></script>
<script  type="text/javascript">
    $(document).ready(function () {
        work_order.init()
        $('#attribute').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! URL('/expense/data/'.$work_order->work_order_id) !!}',
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