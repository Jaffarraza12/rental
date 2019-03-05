@extends('layouts.appmodel')
@section('content')
    <!-- BEGIN BREADCRUMBS -->
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <h3 class="caption-subject bold uppercase text-center"> <i class="fa fa-user-md"></i> {{$heading}}</h3>
        </div>

    </div>
    <!-- END BREADCRUMBS -->
    <div class="portlet-body form">
        {!! Form::open(array('url' => $ActionURL ,'method'=>'post')) !!}
        <div class="form-body">
            <div class="form-group">
                  <div class="input-icon input-icon-lg right">
                    <i class="fa fa-text-width"></i>
                    {!! Form::text('name','',array('placeholder'=>"Name","class"=>"form-control" )) !!}
                    </div>
            </div>

            <div class="form-group">
                <div class="input-icon input-icon-lg right">
                    <i class="fa fa-text-width"></i>
                    {!! Form::text('display_name','',array('placeholder'=>"Diplay Name","class"=>"form-control" )) !!}
                </div>
             </div>

            <div class="form-group">
                <div class="input-icon input-icon-lg right">
                    <i class="icon-speech"></i>
                    {!! Form::textarea('description','',array('placeholder'=>"Description","class"=>"form-control" )) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon input-icon-lg right">
                    <button class="btn red btn-block" type="submit"> SAVE</button>
                    <button class="btn btn-default btn-block" type="button"> CANCEL</button>
                </div>
            </div>
       </div>
        {!! Form::close() !!}
    </div>
@endsection