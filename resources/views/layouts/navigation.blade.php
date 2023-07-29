<ul class="nav nav-tabs b-none">
    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#all-tab"><i class="fa fa-list-ul"></i>All</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#report-tab">Report</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting-tab">Settings</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade active show" id="all-tab">
        <nav class="sidebar-nav">
            <ul class="metismenu ci-effect-1">
                <li class="g_heading">Admin Panel</li>
                <li class="{{ request()->routeIs('admin.buyer.index') || request()->routeIs('admin.style.index') || request()->routeIs('admin.season.index') || request()->routeIs('admin.color.index') || request()->routeIs('admin.wash.index') || request()->routeIs('admin.garment-type.index') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-home"></i><span data-hover="Style Resources">Style Resources</span></a>
                    <ul>
                        <li class="{{ request()->routeIs('admin.buyer.index') ? 'active' : '' }}"><a href="{{ route('admin.buyer.index') }}"><span data-hover="Buyer">Buyer</span></a></li>
                        <li class="{{ request()->routeIs('admin.style.index') ? 'active' : '' }}"><a href="{{ route('admin.style.index') }}"><span data-hover="Style">Style</span></a></li>
                        <li class="{{ request()->routeIs('admin.season.index') ? 'active' : '' }}"><a href="{{ route('admin.season.index') }}"><span data-hover="Season">Season</span></a></li>
                        <li class="{{ request()->routeIs('admin.color.index') ? 'active' : '' }}"><a href="{{ route('admin.color.index') }}"><span data-hover="Color">Color</span></a></li>
                        <li class="{{ request()->routeIs('admin.wash.index') ? 'active' : '' }}"><a href="{{ route('admin.wash.index') }}"><span data-hover="Wash">Wash</span></a></li>
                        <li class="{{ request()->routeIs('admin.garment-type.index') ? 'active' : '' }}"><a href="{{ route('admin.garment-type.index') }}"><span data-hover="Garment Type">Garment Type</span></a></li>
                    </ul>
                </li>
                <li class="{{ request()->routeIs('admin.master-style.index') ? 'active' : '' }}"><a href="{{ route('admin.master-style.index') }}"><i class="icon-notebook"></i><span data-hover="Master Style">Master Style</span></a></li>
                <li class="{{ request()->routeIs('admin.line.index') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-home"></i><span data-hover="Others Resources">Others Resources</span></a>
                    <ul>
                        <li class="{{ request()->routeIs('admin.line.index') ? 'active' : '' }}"><a href="{{ route('admin.line.index') }}"><span data-hover="Line">Line</span></a></li>
                    </ul>
                </li>
                <li class="g_heading">Employee Panel</li>
                <li>
                    <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-tag"></i><span data-hover="Cutting">Cutting</span></a>
                    <ul>
                        <li><a href="#"><span data-hover="New Cutting">New Cutting</span></a></li>
                        <li><a href="#"><span data-hover="Delivery to Sewing">Delivery to Sewing</span></a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="icon-puzzle"></i><span data-hover="Sewing Completed">Sewing Completed</span></a></li>
                <li>
                    <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-tag"></i><span data-hover="Wash">Wash</span></a>
                    <ul>
                        <li><a href="#"><span data-hover="Delivery to Washing">Delivery to Washing</span></a></li>
                        <li><a href="#"><span data-hover="Receive from Washing ">Receive from Washing</span></a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-tag"></i><span data-hover="Finishing">Finishing</span></a>
                    <ul>
                        <li><a href="#"><span data-hover="Delivery to Finishing">Delivery to Finishing</span></a></li>
                        <li><a href="#"><span data-hover="Delivery to Packed GMTS">Delivery to Packed GMTS</span></a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="icon-puzzle"></i><span data-hover="Shipped GMTS">Shipped GMTS</span></a></li>
                <li class="g_heading">User Panel</li>
                <li>
                    <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-lock"></i><span data-hover="Authentication">Authentication</span></a>
                    <ul>
                        <li><a href="#"><span data-hover="Login">Login</span></a></li>
                        <li><a href="#"><span data-hover="Register">Register</span></a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="icon-map"></i><span data-hover="Maps">Maps</span></a></li>
            </ul>
        </nav>
    </div>
    <div class="tab-pane fade" id="report-tab">
        <nav class="sidebar-nav">
            <ul class="metismenu">
                <li class="g_heading">Admin Panel</li>
                <li><a href="#"><i class="fe fe-type"></i><span>Typography</span></a></li>
                <li><a href="#"><i class="fe fe-feather"></i><span>Colors</span></a></li>
            </ul>
        </nav>
    </div>
    <div class="tab-pane fade" id="setting-tab">
        <div class="mb-4 mt-3">
            <h6 class="font-14 font-weight-bold text-muted">Font Style</h6>
            <div class="custom-controls-stacked font_setting">
                <label class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" name="font" value="font-opensans" checked="">
                    <span class="custom-control-label">Open Sans Font</span>
                </label>
                <label class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" name="font" value="font-montserrat">
                    <span class="custom-control-label">Montserrat Google Font</span>
                </label>
                <label class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" name="font" value="font-poppins">
                    <span class="custom-control-label">Poppins Google Font</span>
                </label>
            </div>
        </div>
        <div class="mb-4">
            <h6 class="font-14 font-weight-bold text-muted">Dropdown Menu Icon</h6>
            <div class="custom-controls-stacked arrow_option">
                <label class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" name="marrow" value="arrow-a" checked="">
                    <span class="custom-control-label">A</span>
                </label>
                <label class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" name="marrow" value="arrow-b">
                    <span class="custom-control-label">B</span>
                </label>
                <label class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" name="marrow" value="arrow-c">
                    <span class="custom-control-label">C</span>
                </label>
            </div>
            <h6 class="font-14 font-weight-bold mt-4 text-muted">SubMenu List Icon</h6>
            <div class="custom-controls-stacked list_option">
                <label class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" name="listicon" value="list-a" checked="">
                    <span class="custom-control-label">A</span>
                </label>
                <label class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" name="listicon" value="list-b">
                    <span class="custom-control-label">B</span>
                </label>
                <label class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" name="listicon" value="list-c">
                    <span class="custom-control-label">C</span>
                </label>
            </div>
        </div>
        <div>
            <h6 class="font-14 font-weight-bold mt-4 text-muted">General Settings</h6>
            <ul class="setting-list list-unstyled mt-1 setting_switch">
                <li>
                    <label class="custom-switch">
                        <span class="custom-switch-description">Night Mode</span>
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-darkmode">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </li>
                <li>
                    <label class="custom-switch">
                        <span class="custom-switch-description">Fix Navbar top</span>
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-fixnavbar">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </li>
                <li>
                    <label class="custom-switch">
                        <span class="custom-switch-description">Header Dark</span>
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-pageheader">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </li>
                <li>
                    <label class="custom-switch">
                        <span class="custom-switch-description">Min Sidebar Dark</span>
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-min_sidebar">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </li>
                <li>
                    <label class="custom-switch">
                        <span class="custom-switch-description">Sidebar Dark</span>
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-sidebar" checked="">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </li>
                <li>
                    <label class="custom-switch">
                        <span class="custom-switch-description">Icon Color</span>
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-iconcolor" checked="">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </li>
                <li>
                    <label class="custom-switch">
                        <span class="custom-switch-description">Gradient Color</span>
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-gradient">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </li>
                <li>
                    <label class="custom-switch">
                        <span class="custom-switch-description">Box Shadow</span>
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxshadow">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </li>
            </ul>
        </div>
    </div>
</div>
