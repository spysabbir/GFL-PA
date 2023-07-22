<ul class="nav nav-tabs b-none">
    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#all-tab"><i class="fa fa-list-ul"></i>All</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#report-tab">Report</a></li>
    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting-tab">Settings</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade active show" id="all-tab">
        <nav class="sidebar-nav">
            <ul class="metismenu ci-effect-1">
                <li class="g_heading">Master Form</li>
                <li class="{{ request()->routeIs('admin.buyer.index') || request()->routeIs('admin.season.index') || request()->routeIs('admin.color.index') || request()->routeIs('admin.wash.index') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-home"></i><span data-hover="Style Resources">Style Resources</span></a>
                    <ul>
                        <li class="{{ request()->routeIs('admin.buyer.index') ? 'active' : '' }}"><a href="{{ route('admin.buyer.index') }}"><span data-hover="Buyer">Buyer</span></a></li>
                        <li class="{{ request()->routeIs('admin.season.index') ? 'active' : '' }}"><a href="{{ route('admin.season.index') }}"><span data-hover="Season">Season</span></a></li>
                        <li class="{{ request()->routeIs('admin.color.index') ? 'active' : '' }}"><a href="{{ route('admin.color.index') }}"><span data-hover="Color">Color</span></a></li>
                        <li class="{{ request()->routeIs('admin.wash.index') ? 'active' : '' }}"><a href="{{ route('admin.wash.index') }}"><span data-hover="Wash">Wash</span></a></li>
                        {{-- <li><a href="{{ route('admin.style.index') }}"><span data-hover="Style">Style</span></a></li> --}}
                    </ul>
                </li>
                <li><a href="app-calendar.html"><i class="icon-calendar"></i><span data-hover="Calendar">Calendar</span></a></li>
                <li><a href="app-chat.html"><i class="icon-speech"></i><span data-hover="Chat">Chat</span></a></li>
                <li><a href="app-contact.html"><i class="icon-notebook"></i><span data-hover="Contact">Contact</span></a></li>
                <li><a href="app-blog.html"><i class="icon-globe"></i><span data-hover="Blog">Blog</span></a></li>
                <li><a href="app-filemanager.html"><i class="icon-folder-alt"></i><span data-hover="FileManager">File Manager</span></a></li>
                <li><a href="page-gallery.html"><i class="icon-picture"></i><span data-hover="Gallery">Gallery</span></a></li>
                <li class="g_heading">Utilities</li>
                <li>
                    <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-tag"></i><span data-hover="Icons">Icons</span></a>
                    <ul>
                        <li><a href="icons-feather.html"><span data-hover="Feather">Feather Icons</span></a></li>
                        <li><a href="icons-line.html"><span data-hover="Line">Line Icons</span></a></li>
                        <li><a href="icons-fontawesome.html"><span data-hover="FontAwesome">FontAwesome</span></a></li>
                        <li><a href="icons-flags.html"><span data-hover="Flags">Flags Icons</span></a></li>
                        <li><a href="icons-payments.html"><span data-hover="Payments">Payments Icons</span></a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-bar-chart"></i><span data-hover="Charts">Charts</span></a>
                    <ul>
                        <li><a href="charts-apex.html"><span data-hover="ChartsApex">Charts Apex</span></a></li>
                        <li><a href="charts-e.html"><span data-hover="EChart">EChart</span></a></li>
                        <li><a href="charts-c3.html"><span data-hover="C3Chart">C3 Chart</span></a></li>
                        <li><a href="charts-knob.html"><span data-hover="JQueryKnob">JQuery Knob</span></a></li>
                        <li><a href="charts-sparkline.html"><span data-hover="SparklineChart">Sparkline Chart</span></a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-layers"></i><span data-hover="Forms">Forms</span></a>
                    <ul>
                        <li><a href="form-elements.html"><span data-hover="BasicElements">Basic Elements</span></a></li>
                        <li><a href="form-advanced.html"><span data-hover="AdvancedElements">Advanced Elements</span></a></li>
                        <li><a href="form-validation.html"><span data-hover="FormValidation">Form Validation</span></a></li>
                        <li><a href="form-wizard.html"><span data-hover="FormWizard">Form Wizard</span></a></li>
                        <li><a href="form-summernote.html"><span data-hover="Summernote">Summernote</span></a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-tag"></i><span data-hover="Tables">Tables</span></a>
                    <ul>
                        <li><a href="table-normal.html"><span data-hover="Bootstrap">Bootstrap Table</span></a></li>
                        <li><a href="table-datatable.html"><span data-hover="Datatable">Jquery Datatable</span></a></li>
                    </ul>
                </li>
                <li><a href="widgets.html"><i class="icon-puzzle"></i><span data-hover="Widgets">Widgets</span></a></li>
                <li class="g_heading">Extra Pages</li>
                <li>
                    <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-lock"></i><span data-hover="Authentication">Authentication</span></a>
                    <ul>
                        <li><a href="login.html"><span data-hover="Login">Login</span></a></li>
                        <li><a href="register.html"><span data-hover="Register">Register</span></a></li>
                        <li><a href="forgot-password.html"><span data-hover="Forgot">Forgot password</span></a></li>
                        <li><a href="404.html"><span data-hover="404">404 error</span></a></li>
                        <li><a href="500.html"><span data-hover="500">500 error</span></a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="fe fe-file"></i><span data-hover="Pages">Pages</span></a>
                    <ul>
                        <li><a href="page-empty.html"><span data-hover="Emptypage">Empty page</span></a></li>
                        <li><a href="page-profile.html"><span data-hover="Profile">Profile</span></a></li>
                        <li><a href="page-search.html"><span data-hover="SearchResults">Search Results</span></a></li>
                        <li><a href="page-timeline.html"><span data-hover="Timeline">Timeline</span></a></li>
                        <li><a href="page-invoices.html"><span data-hover="Invoices">Invoices</span></a></li>
                        <li><a href="page-pricing.html"><span data-hover="Pricing">Pricing</span></a></li>
                        <li><a href="page-carousel.html"><span data-hover="Carousel">Carousel</span></a></li>
                    </ul>
                </li>
                <li><a href="page-maps.html"><i class="icon-map"></i><span data-hover="Maps">Maps</span></a></li>
            </ul>
        </nav>
    </div>
    <div class="tab-pane fade" id="report-tab">
        <nav class="sidebar-nav">
            <ul class="metismenu">
                <li class="g_heading">Components</li>
                <li><a href="components/typography.html"><i class="fe fe-type"></i><span>Typography</span></a></li>
                <li><a href="components/colors.html"><i class="fe fe-feather"></i><span>Colors</span></a></li>
                <li><a href="components/alerts.html"><i class="fe fe-alert-triangle"></i><span>Alerts</span></a></li>
                <li><a href="components/avatars.html"><i class="fe fe-user"></i><span>Avatars</span></a></li>
                <li><a href="components/buttons.html"><i class="fe fe-toggle-right"></i><span>Buttons</span></a></li>
                <li><a href="components/breadcrumb.html"><i class="fe fe-link-2"></i><span>Breadcrumb</span></a></li>
                <li><a href="components/forms.html"><i class="fe fe-layers"></i><span>Input group</span></a></li>
                <li><a href="components/list-group.html"><i class="fe fe-list"></i><span>List group</span></a></li>
                <li><a href="components/modal.html"><i class="fe fe-square"></i><span>Modal</span></a></li>
                <li><a href="components/pagination.html"><i class="fe fe-file-text"></i><span>Pagination</span></a></li>
                <li><a href="components/cards.html"><i class="fe fe-image"></i><span>Cards</span></a></li>
                <li><a href="components/charts.html"><i class="fe fe-pie-chart"></i><span>Charts</span></a></li>
                <li><a href="components/form-components.html"><i class="fe fe-check-square"></i><span>Form</span></a></li>
                <li><a href="components/tags.html"><i class="fe fe-tag"></i><span>Tags</span></a></li>
                <li><a href="javascript:void(0)"><i class="fe fe-help-circle"></i><span>Documentation</span></a></li>
                <li><a href="javascript:void(0)"><i class="fe fe-life-buoy"></i><span>Changelog</span></a></li>
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
                <li>
                    <label class="custom-switch">
                        <span class="custom-switch-description">RTL Support</span>
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-rtl">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </li>
                <li>
                    <label class="custom-switch">
                        <span class="custom-switch-description">Box Layout</span>
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxlayout">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </li>
            </ul>
        </div>
    </div>
</div>
