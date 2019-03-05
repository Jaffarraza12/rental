<ul class="nav navbar-nav">
    <li class="{{(isset($ActiveMenu ) && $ActiveMenu == "dashboard") ? 'active open selected' : ''}}">
        <a href="{{ URL('/') }}" class="text-uppercase">
            <i class="icon-home"></i> Dashboard </a>

    </li>
    <li class="dropdown dropdown-fw dropdown-fw-disabled  ">
        <a href="javascript:;" class="text-uppercase">
            <i class="icon-users"></i> Applicants </a>
        <ul class="dropdown-menu dropdown-menu-fw">
            <li class="">
                <a href="{{ URL('applicant/add') }}">
                    <i class="icon-user"></i> New Applicant</a>

            </li>
            <li>
                <a href="{{ URL('applicant') }}">
                    <i class="fa fa-user-md"></i> Applicants  </a>
            </li>
        </ul>
    </li>
    <li class="dropdown dropdown-fw dropdown-fw-disabled {{(isset($ActiveMenu ) && $ActiveMenu == "building" ) ? 'active open selected' : ''}}">
        <a href="javascript:;" class="text-uppercase">
            <i class="fa fa-building"></i> Building </a>
        <ul class="dropdown-menu dropdown-menu-fw">
            <li>
                <a href="{{ URL('building') }}">
                        <i class="fa fa-building"></i>Buildings </a>
            </li>
            <li>
                <a href="table_static_basic.html">
                        <i class="fa fa-square-o"></i>Add Unit </a>
            </li>

        </ul>
    </li>
    <li class="dropdown dropdown-fw dropdown-fw-disabled {{(isset($ActiveMenu ) && $ActiveMenu == "payment" ) ? 'active open selected' : ''}}">
        <a  href="{{ URL('payment') }}"  class="text-uppercase">
            <i class="fa fa-money"></i> Payments </a>

    </li>
    <li class="dropdown dropdown-fw dropdown-fw-disabled {{(isset($ActiveMenu ) && $ActiveMenu == "work_order" ) ? 'active open selected' : ''}}">
        <a href="javascript:;" class="text-uppercase">
            <i class="fa fa-wrench"></i> Work Orders </a>
     </li>
    <li class="dropdown dropdown-fw dropdown-fw-disabled {{(isset($ActiveMenu ) && $ActiveMenu == "tenant" ) ? 'active open selected' : ''}}" ">
        <a href="javascript:;" class="text-uppercase">
            <i class="icon-user"></i> Tenants </a>
        <ul class="dropdown-menu dropdown-menu-fw">
            <li class="">
                <a href="{{ URL('tenant/add') }}">
                    <i class="icon-user"></i> New tenant</a>

            </li>
            <li>
                <a href="{{ URL('tenants') }}">
                    <i class="fa fa-user"></i> Tenants</a>
            </li>
        </ul>
    </li>
    <li class="dropdown dropdown-fw dropdown-fw-disabled {{(isset($ActiveMenu ) && $ActiveMenu == "tenant" ) ? 'active open selected' : ''}}" ">
    <a href="javascript:;" class="text-uppercase">
        <i class="icon-user"></i> Tenants </a>
    <ul class="dropdown-menu dropdown-menu-fw">
        <li class="">
            <a href="{{ URL('tenant/add') }}">
                <i class="icon-user"></i> New tenant</a>

        </li>
        <li>
            <a href="{{ URL('tenants') }}">
                <i class="fa fa-user"></i> Tenants</a>
        </li>
    </ul>
    </li>

</ul>