        <div class="c-sidebar-brand makel-logo">
            <!-- MakeLandCompany -->
            <img alt="Image placeholder" src="http://localhost/makelandcompany/public/assets/brand/makel_logo.png" class="avatar">
        </div>
        
        <ul class="c-sidebar-nav">
        
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon icon-dashboard mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('admin/users') }}">
                    <i class="nav-icon icon-user mr-2"></i>
                    Users
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('admin/employees') }}">
                    <i class="nav-icon icon-user mr-2"></i>
                    Employees (Mazdur)
                </a>
            </li>
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-cogs mr-2"></i>
                    Cold Store
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url('admin/cold-store') }}">
                            <i class="nav-icon icon-user mr-2"></i>
                            Cold Store
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url('admin/cold-store-stock') }}">
                            <i class="nav-icon icon-user mr-2"></i>
                            Cold Store Stock
                        </a>
                    </li>
                </ul>
            </li>
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-cogs mr-2"></i>
                    Stock Management
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url('admin/add-stock-transaction') }}">
                            <i class="nav-icon icon-user mr-2"></i>
                           Add Stock Transaction
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url('admin/add-stock-transaction') }}">
                            <i class="nav-icon icon-user mr-2"></i>
                           Stocks Information
                        </a>
                    </li>
                </ul>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('admin/transport-vehicle') }}">
                    <i class="nav-icon icon-user mr-2"></i>
                    Transport Vehicle (Gaadi)
                </a>
            </li>
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-cogs mr-2"></i>
                    Banks
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url('admin/banks') }}">
                            <i class="nav-icon icon-bookmark mr-2"></i>
                            Banks
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url('admin/payment-type') }}">
                            <i class="nav-icon icon-bookmark mr-2"></i>
                            Payment Type
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('admin/villages') }}">
                    <i class="nav-icon icon-user mr-2"></i>
                    Villages
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('admin/suggestions') }}">
                    <i class="nav-icon icon-bookmark mr-2"></i>
                    Suggestions / Complain
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('admin/pages') }}">
                    <i class="nav-icon icon-bookmark mr-2"></i>
                    Pages
                </a>
            </li>
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-cogs mr-2"></i>
                    Settings
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url('/admin/change-password') }}">
                        <i class="nav-icon icon-key mr-2"></i> Change Password </a>
                    </li>
                </ul>
            </li>
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-circle mr-2"></i>
                    Regions
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url('/admin/countries') }}">
                        <i class="nav-icon icon-circle-blank mr-2"></i> Countries </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url('/admin/states') }}">
                        <i class="nav-icon icon-circle-blank mr-2"></i> States</a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url('/admin/cities') }}">
                        <i class="nav-icon icon-circle-blank mr-2"></i> Cities</a>
                    </li>
                </ul>
            </li>
            <li class="c-sidebar-nav-title">
                <i class="c-sidebar-nav-icon"></i> 
                MakeLandCompany
            </li>
        </ul>
        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>


    
        
            
        
            
                
                    
                
            
        
    