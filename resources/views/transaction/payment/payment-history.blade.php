@extends('layouts.appmodel')
@section('content')
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <h3 class="caption-subject bold uppercase text-center"> <i class="fa fa-money"></i> {{$heading}}
            </h3>

        </div>

    </div>
    <div class="container-fluid">
        <div class="">
            <!-- BEGIN SIDEBAR CONTENT LAYOUT -->
            <div class="page-content-container">
                <div class="page-content-row">
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        {!! Form::open(array('url' => $ActionURL ,'method'=>'post')) !!}
                        <div class="col-md-11">


                            <div class="portlet light ">
                                {{ csrf_field() }}
                                <div class="portlet-body flip-scroll">
                                    <table id="attribute" class="table table-striped table-bordered table-hover dt-responsive dataTable no-footer dtr-inline collapsed">
                                        <thead class="flip-content">
                                        <tr>

                                            <th>ID</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Date</th>



                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($final as $finals)
                                            <tr>

                                                <td> {{($finals->tenant_id) }}</td>
                                                <td> {{($finals->comment) }}</td>
                                                <td>{{$finals->amount}}</td>
                                                <td> {{($finals->created_at) }}</td>

                                        </tr>
                                        @endforeach
                                        <td>Total</td>
                                        <td> {{$total}}</td>
                                        <td> </td>
                                        <td> </td>
                                        <tr>


                                    </table>
                                    <h3>Your remaining balance is {{$totals}}</h3>
                                </div>
                            </div>


                            </div>
                            {!! Form::close() !!}
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



@endsection
@push('scripts')
<script src="{{asset('resources/assets/global/plugins/icheck/icheck.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/pages/scripts/form-icheck.min.js')}}" type="text/javascript"></script>

<script src="{{asset('resources/assets/js/payment.js')}}" type="text/javascript"></script>
<script >
    payment.init();

</script>
@endpush