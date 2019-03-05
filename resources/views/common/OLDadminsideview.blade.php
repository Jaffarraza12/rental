<div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->


        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start {{(isset($ActiveMenu ) && $ActiveMenu == "dashboard" ) ? 'active open' : ''}}">
                <a href="{{ URL('/') }}" class="nav-link nav-toggle">
                    <i class="fa fa-tachometer"></i>
                    <span class="title">Dashboard</span>
                    {{--<span class="selected"></span>--}}
                    <span class="active open"></span>

                </a>
            </li>
            <li class="nav-item {{(isset($ActiveMenu ) && $ActiveMenu == "applicant" ) ? 'active open' : ''}}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">Applicants</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">

                    <li class="nav-item  ">
                        <a href="{{ URL('prospect') }}" class="nav-link ">
                            <span class="title">Prospect</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ URL('applicant/add') }}" class="nav-link ">
                            <span class="title">New Applicant</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{ URL('applicant') }}" class="nav-link ">
                            <span class="title">Applicant</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a  class="pop" data-url="{{URL('/lease')}}" >
                            <span class="title">Add Lease</span>
                        </a>
                    </li>
                </ul>
            </li>

            @if(Auth::user()->pid  == 0)
                <li class="nav-item   {{(isset($ActiveMenu ) && $ActiveMenu == "building" ) ? 'active open' : ''}}">
                    <a href="{{URL('building')}}" class="nav-link nav-toggle">
                        <i class="fa fa-building-o"></i>
                        <span class="title">Building</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="{{URL('building')}}" class="nav-link ">
                                <span class="title">New Building</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="{{URL('building')}}" class="nav-link ">
                                <span class="title">Add Unit</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            <li class="nav-item  {{(isset($ActiveMenu ) && $ActiveMenu == "payment" ) ? 'active open' : ''}}">
                <a href="{{URL('payment')}}" class="nav-link nav-toggle">
                    <i class="fa fa-money"></i>
                    <span class="title">Payment</span>
                </a>
            </li>
            <li class="nav-item  {{(isset($ActiveMenu ) && $ActiveMenu == "work_order" ) ? 'active open selected' : ''}}">
                <a href="{{ URL('work_order')  }}" class="nav-link nav-toggle">
                    <i class="fa fa-wrench"></i>
                    <span class="title">Work Orders</span>
                </a>
            </li>
            <li class="nav-item {{(isset($ActiveMenu ) && $ActiveMenu == "tenant" ) ? 'active open selected' : ''}} ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">Tenant</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{URL('rentroll')}}" class="nav-link ">
                            <span class="title">Rent Roll</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{URL('outstanding-balance')}}" class="nav-link ">
                            <span class="title">Outstanding Balance</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{URL('tenants')}}" class="nav-link ">
                            <span class="title"> Tenants</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{URL('tenants')}}" class="nav-link ">
                            <span class="title"> Outstanding Balance</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  {{(isset($ActiveMenu ) && $ActiveMenu == "inventory" ) ? 'active open selected' : ''}}">
                <a href="{{ URL('/inventory')  }}" class="nav-link nav-toggle">
                    <i class="fa fa-wrench"></i>
                    <span class="title">Inventory</span>
                </a>
            </li>
            @if(Auth::user()->pid  == 0)
                <li class="nav-item  {{(isset($ActiveMenu ) && $ActiveMenu == "sub_users" ) ? 'active open selected' : ''}}">
                    <a href="{{ URL('/sub_users')  }}" class="nav-link nav-toggle">
                        <i class="icon-users"></i>
                        <span class="title">Users</span>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a href="{{URL('/logout')}}" class="nav-link nav-toggle">
                    <i class="fa fa-sign-out"></i>
                    <span class="title">Logout</span>
                </a>
            </li>
        </ul>



        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
