<!-- BEGIN BREADCRUMBS -->
<div class="breadcrumbs">
    <h1 style="display: none;"> {{$heading}}</h1>
    <h2></h2>
    @if($breadcrumb)
        <ol class="breadcrumb">
            @foreach($breadcrumb as $key => $link)
                <li>
                    <a href="{{$link}}">{{$key}}</a>
                </li>
            @endforeach
        </ol>
@endif
<!-- Sidebar Toggle Button -->
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".page-sidebar">
        <span class="sr-only">Toggle navigation</span>
        <span class="toggle-icon">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </span>
    </button>
    <!-- Sidebar Toggle Button -->
</div>
<!-- END BREADCRUMBS -->