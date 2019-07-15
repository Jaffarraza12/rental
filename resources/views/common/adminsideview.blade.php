<div class="page-sidebar-wrapper" style="background: #1a2226">
    <!-- END SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse" style="position: fixed;">
        <!-- BEGIN SIDEBAR MENU -->
<section  style="height: 100%">
    <ul class="sidebar-menu">
        <li class="sidebar-header">MAIN NAVIGATION</li>
        <li>
            <a href="{{URL('/')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>

        </li>
        <li  @if(!empty($active_menu) && $active_menu =='building') class="active" @endif >
            <a href="#">
                <i class="fa fa-building-o"></i>
                <span>Buildings</span>
                <i class="fa fa-angle-left pull-right"></i>
                <span class="label label-primary pull-right">4</span>

            </a>
            <ul class="sidebar-submenu"  @if(!empty($active_menu) && $active_menu =='building')  style="display: block;" @else  style="display: none;" @endif>
                <li><a href="{{URL('building')}}"> Building List</a></li>
                <li><a href="{{URL('building/add')}}"> Add Building  </a></li>
                <li><a href="{{URL('unit')}}"> Units</a></li>
                <li><a href="{{URL('unit/add' )}}">Add Unit</a></li>
            </ul>
        </li>
        <li @if(!empty($active_menu) && $active_menu =='applicant') class="active" @endif >
            <a >
                <i class="fa fa-user-md"></i> <span>Applicant</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu" @if(!empty($active_menu) && $active_menu =='applicant')  style="display: block;" @else  style="display: none;" @endif>
                <li><a href="{{URL('applicants')}}"> Applicant List</a></li>
            </ul>
        </li>
        <li @if(!empty($active_menu) && $active_menu =='rental') class="active" @endif>
            <a href="#">
                <i class="fa fa-user-md"></i>
                <span>Rental</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu" @if(!empty($active_menu) && $active_menu =='rental')  style="display: block;" @else  style="display: none;" @endif>
                <li><a href="{{URL('tenants')}}"> Tenants</a></li>
                <li><a href="{{URL('lease')}}">Create Lease</a></li>
                <li><a href="{{URL('outstanding-balance')}}"> Outstanding Balance</a></li>
                <li><a href="{{URL('rentroll')}}">Rent Roll</a></li>
            </ul>
        </li>
        <li @if(!empty($active_menu) && $active_menu =='payment') class="active" @endif>
            <a href="{{URL('payment')}}">
                <i class="fa fa-money"></i>
                <span>Payments</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>

        </li>
        <li @if(!empty($active_menu) && $active_menu =='vendor') class="active" @endif>
            <a href="{{URL('work_order')}}">
                <i class="fa fa-edit"></i> <span>Vendors</span>
            </a>
            <ul class="sidebar-submenu" @if(!empty($active_menu) && $active_menu =='vendor')  style="display: block;" @else  style="display: none;" @endif>
                <li><a href="{{URL('vendors')}}"> Vendors</a></li>
                <li><a href="{{URL('vendors/create')}}"> Add Vendor</a></li>
                <li><a href="{{URL('vendors-category')}}"> Vendor Category</a></li>
                <li><a href="{{URL('vendors-category/create')}}">  Add Category</a></li>
            </ul>


        </li>
        <li @if(!empty($active_menu) && $active_menu =='work_order') class="active" @endif>
            <a href="{{URL('work_order')}}">
                <i class="fa fa-edit"></i> <span>Work Order</span>
            </a>

        </li>
        <li class="hidden">
            <a href="{{URL('')}}">
                <i class="fa fa-edit"></i> <span>Communication</span>
            </a>

        </li>
        <li class="hidden">
            <a href="#">
                <i class="fa fa-folder"></i> <span>Reports</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>

        </li>
        <li @if(!empty($active_menu) && $active_menu =='setting') class="active" @endif>
            <a href="#">
                <i class="fa fa-cog"></i> <span>Setting</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu" @if(!empty($active_menu) && $active_menu =='setting')  style="display: block;" @else  style="display: none;" @endif>
                <li><a href="{{URL('sub_users')}}">Users</a></li>
                <li><a href="{{URL('account')}}">Chart Of Account</a></li>
                <li><a href="{{URL('logout')}}">Log Out</a></li>
            </ul>
        </li>
        <li class="hidden"><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
    </ul>
</section>
    </div>
    </div>