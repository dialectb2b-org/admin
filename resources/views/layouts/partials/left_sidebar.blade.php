<div class="left-sidenav">
    <!-- LOGO -->
    <div class="brand">
        <a href="{{ route('home') }}" class="logo">
            <span>
                <img src="{{ asset('assets/img/dialect-logo.png') }}" alt="logo-small" class="logo-sm">
            </span>
            <!-- <span>
                <img src="{{ asset('assets/img/yash-logo.png') }}" alt="logo-large" class="logo-lg logo-light">
                <img src="{{ asset('assets/img/yash-logo.png') }}" alt="logo-large" class="logo-lg logo-dark">
            </span> -->
        </a>
    </div>
    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        @auth
        <ul class="metismenu left-sidenav-menu">
            <li class="menu-label mt-0">Main</li>
            <li><a href="{{ route('home') }}"> <i data-feather="home" class="align-self-center menu-icon"></i><span>Dashboard</span><span class="menu-arrow"></span></a></li>
            <hr class="hr-dashed hr-menu">
            <li class="menu-label mt-0">Pre Registration</li>
            <li><a href="{{ route('pre-registration.index') }}"><i data-feather="folder" class="align-self-center menu-icon"></i>Pre-Registration</a></li>
            <hr class="hr-dashed hr-menu">
            <li class="menu-label mt-0">Registration & Approvals</li>
            <li><a href="{{ route('registration.index') }}"><i data-feather="folder" class="align-self-center menu-icon"></i>Registration Approval</a></li>
            <li><a href="{{ route('registration.todo') }}"><i data-feather="folder" class="align-self-center menu-icon"></i>To Do List</a></li>
            <hr class="hr-dashed hr-menu">
            <li class="menu-label mt-0">Client</li>
            <li><a href="{{ route('clients.unregistered.index') }}"> <i data-feather="folder" class="align-self-center menu-icon"></i><span>Un Registered Client</span><span class="menu-arrow"></span></a></li>
            <li><a href="{{ route('clients.approved.index') }}"> <i data-feather="folder" class="align-self-center menu-icon"></i><span>Approved Client</span><span class="menu-arrow"></span></a></li>
            <li><a href="{{ route('clients.registered.index') }}"> <i data-feather="folder" class="align-self-center menu-icon"></i><span>Registered Client</span><span class="menu-arrow"></span></a></li>
            <li><a href="{{ route('clients.verified.index') }}"> <i data-feather="folder" class="align-self-center menu-icon"></i><span>Verified Client</span><span class="menu-arrow"></span></a></li>
            <li><a href="#"> <i data-feather="folder" class="align-self-center menu-icon"></i><span>Subscribed Client</span><span class="menu-arrow"></span></a></li>
            <li><a href="{{ route('clients.superseded.index') }}"> <i data-feather="folder" class="align-self-center menu-icon"></i><span>Superseded Client</span><span class="menu-arrow"></span></a></li>
            <li><a href="{{ route('clients.disabled.index') }}"> <i data-feather="folder" class="align-self-center menu-icon"></i><span>Deactivate / Freeze Client</span><span class="menu-arrow"></span></a></li>
            <hr class="hr-dashed hr-menu">
            <li class="menu-label mt-0">Reported Enquiries</li>
            <li><a href="{{ route('reported.index') }}"> <i data-feather="folder" class="align-self-center menu-icon"></i><span>Spam / Junk Enquiries</span><span class="menu-arrow"></span></a></li>
            <hr class="hr-dashed hr-menu">
            <li class="menu-label my-2">Package Manager</li> 
            <li><a href="{{ route('packages.index') }}"> <i data-feather="folder" class="align-self-center menu-icon"></i><span>Package</span><span class="menu-arrow"></span></a></li>
            <hr class="hr-dashed hr-menu">
            <li class="menu-label my-2">HR</li> 
            <li><a href="{{ route('user.index') }}"> <i data-feather="folder" class="align-self-center menu-icon"></i><span>Employee</span><span class="menu-arrow"></span></a></li>
            <li><a href="{{ route('role.index') }}"><i data-feather="folder" class="align-self-center menu-icon"></i>Role</a></li>
            <hr class="hr-dashed hr-menu">
            <li class="menu-label my-2">Customer Support</li> 
            <li><a href="{{ route('notifications.index') }}"> <i data-feather="folder" class="align-self-center menu-icon"></i><span>Notifications</span></li>
            <hr class="hr-dashed hr-menu">
            <li class="menu-label my-2">Website</li> 
            <li><a href="{{ route('faqs.index') }}"> <i data-feather="folder" class="align-self-center menu-icon"></i><span>FAQ</span></li>
            <li><a href="{{ route('community-guidelines') }}"> <i data-feather="folder" class="align-self-center menu-icon"></i><span>Community Guidelines</span></li>
            <li><a href="{{ route('privacy-policy') }}"> <i data-feather="folder" class="align-self-center menu-icon"></i><span>Privacy Policy</span></li>
            <li><a href="{{ route('user-agreement') }}"> <i data-feather="folder" class="align-self-center menu-icon"></i><span>User Agreement</span></li>
            <hr class="hr-dashed hr-menu">
            <li class="menu-label my-2">Settings</li> 
            <li>
                <a href="javascript: void(0);"><i data-feather="map-pin" class="align-self-center menu-icon"></i>Location<span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">    
                    <li><a href="{{ route('country.index') }}">Country</a></li> 
                    <li><a href="{{ route('region.index') }}">Region</a></li>                            
                </ul>
            </li> 
            <li>
                <a href="javascript: void(0);"><i data-feather="database" class="align-self-center menu-icon"></i>Business Category<span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="{{ route('category.service') }}">Business Category List</a></li>
                    <li><a href="{{ route('category.index') }}">Category</a></li>           
                    <li><a href="{{ route('subcategory.index') }}">SubCategory</a></li>               
                </ul>
            </li>  
            <li>
                <a href="{{ route('document.index') }}"><i data-feather="file-text" class="align-self-center menu-icon"></i>Document</a>
            </li>  
        </ul>
        @endauth
    </div>
</div>