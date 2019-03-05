@extends('layouts.appmodel')
@section('content')

<div class="portlet-title">
       
    </div>
    <div class="container-fluid">
        <div class="">
            <!-- BEGIN SIDEBAR CONTENT LAYOUT -->
            <div class="page-content-container">
                <div class="page-content-row">
                <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
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
<script src="{{asset('resources/assets/global/plugins/icheck/icheck.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/pages/scripts/form-icheck.min.js')}}" type="text/javascript"></script>

<script src="{{asset('resources/assets/js/payment.js')}}" type="text/javascript"></script>
<script >
    payment.init()
</script>

@endpush