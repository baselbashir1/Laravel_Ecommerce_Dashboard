{{-- 

/**
*
* Created a new component <x-rtl.menu.vertical-menu/>.
* 
*/

--}}


<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="/modern-dark-menu/dashboard">
                        <img src="{{ Vite::asset('resources/images/logo.svg') }}" class="navbar-logo logo-dark"
                            alt="logo">
                        <img src="{{ Vite::asset('resources/images/logo2.svg') }}" class="navbar-logo logo-light"
                            alt="logo">
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="/modern-dark-menu/dashboard" class="nav-link"> CORK </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="/modern-dark-menu/dashboard" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-chart-pie"></i>
                        <span class="ml-1">{{ __('trans.dashboard') }}</span>
                    </div>
                </a>
            </li>
            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-minus">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg><span style="text-transform:uppercase">{{ __('trans.services_management') }}</span></div>
            </li>
            <li class="menu">
                <a href="/modern-dark-menu/services" class="dropdown-toggle">
                    <div class="">
                        <i class="fab fa-servicestack"></i>
                        <span class="ml-1">{{ __('trans.services_table') }}</span>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
</div>
