@extends('layouts.appmodel')
@section('content')

    <div class="page-container">
        @include("common.adminsideview")

        <div class="page-content-wrapper">
            <div class="page-content">
                @if (Session::has('success_message'))

                    <div class="alert alert-danger">

                       <br>
                        <p>{{ Session::get('success_message') }} </p>

                    </div>
                @endif
                <div class="row">
                    <h1 class="center" style="text-align: center">{{$heading}}</h1>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div >
                            <select name="building" id="building" class="form-control">
                                <option value="">Select Building</option>
                                @foreach($buildings as $building)
                                <option value="{{$building->building_id}}">{{$building->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <div >
                             <button class="btn btn-primary btn-lg buildingSave" type="button" >SAVE</button>
                        </div>
                    </div>
                </div>

            </div>
         </div>
     </div>
            <!-- END SIDEBAR CONTENT LAYOUT -->
    </div>
        <!-- BEGIN FOOTER -->
           <a href="#index" class="go2top">
            <i class="icon-arrow-up"></i>
        </a>
        <!-- END FOOTER -->
    </div>
</div>
<!-- END CONTAINER -->
   
@endsection
@push('scripts')
<script src="{{asset('resources/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>

<script src="{{asset('resources/assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        @if( \Illuminate\Support\Facades\Session::get('defaultBuilding') )
app.popUp('{{URL('show-building')}}','body')
        @endif
        $('.buildingSave').click(function(){
            var id = $('#building').val();
            if(id) {
                $.get('{{URL('/building/switch/')}}/' + id, function () {
                    if ('response') {
                        //alert('response');
                        //console.log('response');
                        parent.location.reload();
                    }
                });
            }

        })
    });
</script>
@endpush