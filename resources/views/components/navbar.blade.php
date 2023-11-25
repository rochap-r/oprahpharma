<!-- Horizontal Nav -->
<header class="header kleon-horizontal-nav shadow">
    <div class="d-none d-xl-block">
        <div class="d-flex align-items-center justify-content-around justify-content-xl-between flex-wrap flex-xl-nowrap gap-3 gap-xl-5">
            <div class="d-flex align-items-center gap-7">
                <div class="logo">
                    <a href="{{ route('app.home') }}" class="d-flex align-items-center gap-3 flex-shrink-0">
                        <img src="{{ asset('assets/favicons/favicon.ico') }}" alt="logo">
                        <div class="position-relative flex-shrink-0">
                            <h4>OP</h4>
                        </div>
                    </a>
                </div>

                <div class="kleon-navmenu text-center">
                    <ul class="main-menu">

                        <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-speedometer fs-16"></i></span> <span class="nav-text">Dashboards</span></a>
                            <ul class="sub-menu">
                                <li class="menu-item"><a href="#">Invoice Management</a></li>
                            </ul>
                            <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                        </li>

                        <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-speedometer2 fs-16"></i></span> <span class="nav-text">Sass</span></a>
                            <ul class="sub-menu">
                                <!-- HR Management -->
                                <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-people fs-16"></i></span> <span class="nav-text">HR Management</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="#"> Employees <span class="menuIndicator bg-soft-secondary rounded-3 py-0 px-3">New</span></a></li>
                                    </ul>
                                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                                </li>

                                <!-- Job Hiring -->
                                <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-briefcase fs-16"></i></span> <span class="nav-text">Job Hiring</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="#"> Jobs <span class="menuIndicator bg-info rounded-circle text-white">17</span></a></li>
                                    </ul>
                                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                                </li>

                                <!-- Project Management -->
                                <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-kanban fs-16"></i></span> <span class="nav-text">Project Management</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="#"> Contacts</a></li>
                                    </ul>
                                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                                </li>

                                <!-- General Dashboard -->
                                <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-speedometer2 fs-16"></i></span> <span class="nav-text">General Dashboard</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="#"> Preferences</a></li>
                                    </ul>
                                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                                </li>
                            </ul>
                        </li>

                        <!-- Apps -->
                        <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-app-indicator fs-16"></i></span> <span class="nav-text">Apps</span></a>
                            <ul class="sub-menu">
                                <li class="menu-item"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-calendar-day fs-16"></i></span> <span class="nav-text">Calendar</span></a></li>
                            </ul>
                        </li>

                        <!-- UI Components -->
                        <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-bricks fs-16"></i></span> <span class="nav-text">Components</span></a>
                            <ul class="sub-menu">
                                <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-bricks fs-16"></i></span> <span class="nav-text">UI Elements</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="#">Accordion</a></li>
                                    </ul>
                                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                                </li>
                            </ul>
                        </li>

                        <!-- Pages -->
                        <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-briefcase fs-16"></i></span> <span class="nav-text">Pages</span></a>
                            <ul class="sub-menu">
                                <!-- Authentication -->
                                <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-person-bounding-box fs-16"></i></span> <span class="nav-text">Authentication</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-info-circle fs-16"></i></span> <span class="nav-text">Error</span></a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="#">403 Error</a></li>
                                            </ul>
                                            <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Charts -->
                                <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-graph-up-arrow fs-16"></i></span> <span class="nav-text">Charts</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-pie-chart-fill fs-16"></i></span> <span class="nav-text">Apex Chart</span></a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="#">Line Chart</a></li>
                                            </ul>
                                            <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="d-flex align-items-center flex-shrink-0">
                <ul class="nav-elements d-flex align-items-center list-unstyled m-0 p-0">
                    <li class="nav-item nav-search">
                        <button type="button" class="btn p-0 m-0 border-0" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <img src="{{asset('assets/img/svg/search.svg')}}" alt="">
                        </button>
                    </li>
                    <li class="nav-item nav-color-switch d-flex align-items-center gap-3">
                        <div class="sun"><img src="{{asset('assets/img/sun.svg')}}" alt="img"></div>
                        <div class="switch">
                            <input type="checkbox" id="colorSwitch2" value="false" name="defaultMode">
                            <div class="shutter">
                                <span class="lbl-off"></span>
                                <span class="lbl-on"></span>
                                <div class="slider bg-primary"></div>
                            </div>
                        </div>
                        <div class="moon"><img src="{{asset('assets/img/moon.svg')}}" alt="img"></div>
                    </li>

                    <li class="nav-item nav-flag">
                        <select class="kleon-select-single nav-toggler-content">
                            <option selected value="en">Eng(US)</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                            <option value="sp">Spanish</option>
                        </select>
                    </li>

                    <li class="nav-item nav-notification dropdown">
                        <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('assets/img/svg/bell.svg')}}" alt="bell">
                            <div class="badge rounded-circle">12</div>
                        </a>
                        <div class="dropdown-widget dropdown-menu p-0">
                            <div class="dropdown-wrapper pd-50">
                                <div class="dropdown-wrapper--title">
                                    <h4 class="d-flex align-items-center justify-content-between">Notifications <a href="#">View All</a></h4>
                                </div>
                                <ul class="notification-board list-unstyled">
                                    <li class="author-online has-new-message d-flex gap-3">
                                        <div class="media bg-primary text-white">
                                            <i class="bi bi-lightning"></i>
                                        </div>
                                        <div class="user-message">
                                            <h6 class="message"><a href="#">Jackie Kun</a> mentioned you at <a href="#">Kleon Projects</a></h6>
                                            <p class="message-footer d-flex align-items-center justify-content-between"> <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as read</span></p>
                                        </div>
                                    </li>
                                </ul>
                                <h6 class="all-notifications"> <a href="#" class="btn bg-muted text-primary w-100 fw-bold mt-3 ff-heading px-0">View All Notifications</a> </h6>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item nav-settings">
                        <a href="#" class="nav-toggler">
                            <img src="{{asset('assets/img/svg/settings.svg')}}" alt="img">
                        </a>
                    </li>

                    <li class="nav-item nav-author">
                        <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('assets/img/nav_author.jpg')}}" alt="img" width="54" class="rounded-2">
                            <div class="nav-toggler-content">
                                <h6 class="mb-0">Franklin Jr.</h6>
                                <div class="ff-heading fs-14 fw-normal text-gray">Super Admin</div>
                            </div>
                        </a>
                        <div class="dropdown-widget dropdown-menu p-0 admin-card">
                            <div class="dropdown-wrapper">
                                <div class="card mb-0">
                                    <div class="card-header p-3 text-center">
                                        <img src="{{asset('assets/img/nav_author.jpg')}}" alt="img" width="80" class="rounded-circle avatar">
                                        <div class="mt-2">
                                            <h6 class="mb-0 lh-18">Franklin Jr.</h6>
                                            <div class="fs-14 fw-normal text-gray">Super Admin</div>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <ul class="list-unstyled p-0 m-0">
                                            <li>
                                                <a href="#" class="fs-14 fw-normal text-dark d-block p-1"><i class="bi bi-person me-2"></i> Profile</a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="small-header d-flex align-items-center justify-content-between d-xl-none">
        <div class="logo">
            <a href="{{ route('app.home') }}" class="d-flex align-items-center gap-3 flex-shrink-0">
                <img src="{{ asset('assets/favicons/favicon.ico') }}" alt="logo">
                <div class="position-relative flex-shrink-0">
                    <h4>OP</h4>
                </div>
            </a>
        </div>
        <div>
            <button type="button" class="kleon-header-expand-toggle"><span class="fs-24"><i class="bi bi-three-dots-vertical"></i></button>
            <button type="button" class="kleon-mobile-menu-opener"><span class="close"><i class="bi bi-arrow-left"></i></span> <span class="open"><i class="bi bi-list"></i></span></button>
        </div>
    </div>

    <div class="header-mobile-option">
        <div class="header-inner">
            <div class="d-flex align-items-center justify-content-end flex-shrink-0">
                <ul class="nav-elements d-flex align-items-center list-unstyled m-0 p-0">
                    <li class="nav-item nav-search">
                        <button type="button" class="btn p-0 m-0 border-0" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="bi bi-search"></i>
                        </button>
                    </li>
                    <li class="nav-item nav-notification dropdown">
                        <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell-fill"></i>
                            <div class="badge rounded-circle">12</div>
                        </a>
                        <div class="dropdown-widget dropdown-menu p-0">
                            <div class="dropdown-wrapper pd-50">
                                <div class="dropdown-wrapper--title">
                                    <h4 class="d-flex align-items-center justify-content-between">Notifications <a href="#">View All</a></h4>
                                </div>
                                <ul class="notification-board list-unstyled">
                                    <li class="author-online has-new-message d-flex gap-3">
                                        <div class="media bg-primary text-white">
                                            <i class="bi bi-lightning"></i>
                                        </div>
                                        <div class="user-message">
                                            <h6 class="message"><a href="#">Jackie Kun</a> mentioned you at <a href="#">Kleon Projects</a></h6>
                                            <p class="message-footer d-flex align-items-center justify-content-between"> <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as read</span></p>
                                        </div>
                                    </li>
                                    <li class="author-online has-new-message d-flex gap-3">
                                        <div class="media bg-secondary text-white">
                                            <i class="bi bi-lightning"></i>
                                        </div>
                                        <div class="user-message">
                                            <h6 class="message"><a href="#">Olivia Johanna</a> has created new task at <a href="#">Kleon Projects</a></h6>
                                            <p class="message-footer d-flex align-items-center justify-content-between"> <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as read</span></p>
                                        </div>
                                    </li>
                                    <li class="author-online has-new-message d-flex gap-3">
                                        <div class="media media-outline-red text-red">
                                            <i class="bi bi-clock-fill"></i>
                                        </div>
                                        <div class="user-message">
                                            <h6 class="message">[REMINDER] Due date of <a href="#">Highspeed Studios Projects</a> te task will be coming</h6>
                                            <p class="message-footer d-flex align-items-center justify-content-between"> <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as read</span></p>
                                        </div>
                                    </li>
                                </ul>
                                <h6 class="all-notifications"> <a href="#" class="btn bg-muted text-primary w-100 fw-bold mt-3 ff-heading px-0">View All Notifications</a> </h6>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item nav-settings">
                        <a href="#" class="nav-toggler">
                            <i class="bi bi-gear-fill"></i>
                        </a>
                    </li>

                    <li class="nav-item nav-author px-3">
                        <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('assets/img/nav_author.jpg')}}" alt="img" width="40" class="rounded-2">
                            <div class="nav-toggler-content">
                                <h6 class="mb-0">Franklin Jr.</h6>
                                <div class="ff-heading fs-14 fw-normal text-gray">Super Admin</div>
                            </div>
                        </a>
                        <div class="dropdown-widget dropdown-menu p-0 admin-card">
                            <div class="dropdown-wrapper">
                                <div class="card mb-0">
                                    <div class="card-header p-3 text-center">
                                        <img src="{{asset('assets/img/nav_author.jpg')}}" alt="img" width="60" class="rounded-circle avatar">
                                        <div class="mt-2">
                                            <h6 class="mb-0 lh-18">Franklin Jr.</h6>
                                            <div class="fs-14 fw-normal text-gray">Super Admin</div>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <ul class="list-unstyled p-0 m-0">
                                            <li>
                                                <a href="#" class="fs-14 fw-normal text-dark d-block p-1"><i class="bi bi-person me-2"></i> Profile</a>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="card-footer p-3">
                                        <a href="#" class="btn btn-outline-gray bg-transparent w-100 py-1 rounded-1 text-dark fs-14 fw-medium"><i class="bi bi-box-arrow-right"></i> Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<!-- Combo Nav -->
<header class="header kleon-combo-nav shadow">
    <div class="d-none d-xl-block">
        <div class="d-flex align-items-center justify-content-around justify-content-xl-between flex-wrap flex-xl-nowrap gap-3 gap-xl-5">
            <div class="d-flex align-items-center flex-shrink-0">
                <ul class="nav-elements d-flex align-items-center list-unstyled m-0 p-0">
                    <li class="nav-item nav-notification dropdown">
                        <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('assets/img/svg/bell.svg')}}" alt="bell">
                            <div class="badge rounded-circle">12</div>
                        </a>
                        <div class="dropdown-widget dropdown-menu p-0">
                            <div class="dropdown-wrapper pd-50">
                                <div class="dropdown-wrapper--title">
                                    <h4 class="d-flex align-items-center justify-content-between">Notifications <a href="#">View All</a></h4>
                                </div>
                                <ul class="notification-board list-unstyled">
                                    <li class="author-online has-new-message d-flex gap-3">
                                        <div class="media bg-primary text-white">
                                            <i class="bi bi-lightning"></i>
                                        </div>
                                        <div class="user-message">
                                            <h6 class="message"><a href="#">Jackie Kun</a> mentioned you at <a href="#">Kleon Projects</a></h6>
                                            <p class="message-footer d-flex align-items-center justify-content-between"> <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as read</span></p>
                                        </div>
                                    </li>
                                    <li class="author-online has-new-message d-flex gap-3">
                                        <div class="media bg-secondary text-white">
                                            <i class="bi bi-lightning"></i>
                                        </div>
                                        <div class="user-message">
                                            <h6 class="message"><a href="#">Olivia Johanna</a> has created new task at <a href="#">Kleon Projects</a></h6>
                                            <p class="message-footer d-flex align-items-center justify-content-between"> <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as read</span></p>
                                        </div>
                                    </li>
                                    <li class="author-online has-new-message d-flex gap-3">
                                        <div class="media media-outline-red text-red">
                                            <i class="bi bi-clock-fill"></i>
                                        </div>
                                        <div class="user-message">
                                            <h6 class="message">[REMINDER] Due date of <a href="#">Highspeed Studios Projects</a> te task will be coming</h6>
                                            <p class="message-footer d-flex align-items-center justify-content-between"> <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as read</span></p>
                                        </div>
                                    </li>
                                </ul>
                                <h6 class="all-notifications"> <a href="#" class="btn bg-muted text-primary w-100 fw-bold mt-3 ff-heading px-0">View All Notifications</a> </h6>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item nav-giftbox">
                        <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('assets/img/svg/gift.svg')}}" alt="img">
                            <div class="badge rounded-circle">5</div>
                        </a>
                        <div class="dropdown-widget dropdown-menu p-0">
                            <div class="dropdown-wrapper pd-50">
                                <div class="dropdown-wrapper--title">
                                    <h4 class="d-flex align-items-center justify-content-between">Notifications <a href="#"><i class="bi bi-three-dots-vertical"></i></a></h4>
                                </div>
                                <ul class="notification-board list-unstyled">
                                    <li class="author-online has-new-message d-flex gap-3">
                                        <div class="media bg-soft-primary">
                                            <i class="bi bi-bell-fill"></i>
                                        </div>
                                        <div class="user-message d-flex align-items-center justify-content-between gap-5">
                                            <h6 class="message mb-0">Review New Candidate Application</h6>
                                            <p class="message-footer flex-shrink-0 mb-0"> <span class="time">08:00 AM</span></p>
                                        </div>
                                    </li>
                                    <li class="author-online has-new-message d-flex gap-3">
                                        <div class="media bg-soft-warning">
                                            <i class="bi bi-bell-fill"></i>
                                        </div>
                                        <div class="user-message d-flex align-items-center justify-content-between gap-5">
                                            <h6 class="message mb-0">Your Premium service end soon. <a href="#">Renew your service</a></h6>
                                            <p class="message-footer flex-shrink-0 mb-0"> <span class="time">08:00 AM</span></p>
                                        </div>
                                    </li>
                                    <li class="author-online has-new-message d-flex gap-3">
                                        <div class="media bg-soft-secondary">
                                            <i class="bi bi-bell-fill"></i>
                                        </div>
                                        <div class="user-message d-flex align-items-center justify-content-between gap-5">
                                            <h6 class="message mb-0">You got New 10 Appilcation. <a href="#" class="text-secondary">Check Now</a></h6>
                                            <p class="message-footer flex-shrink-0 mb-0"> <span class="time">08:00 AM</span></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item nav-folder">
                        <a href="#" class="nav-toggler">
                            <img src="{{asset('assets/img/svg/folder.svg')}}" alt="img">
                            <div class="badge rounded-circle">!</div>
                        </a>
                        <div class="dropdown-widget dropdown-menu dropdown-schedule p-0">
                            <div class="dropdown-wrapper pd-50">
                                <div class="dropdown-wrapper--title">
                                    <h4 class="d-flex align-items-center justify-content-between">Schedule <a href="#"><i class="bi bi-three-dots-vertical"></i></a></h4>
                                    <p>Thursday January 10th, 2022</p>
                                </div></div>
                        </div>
                    </li>

                    <li class="nav-item nav-settings">
                        <a href="#" class="nav-toggler">
                            <img src="{{asset('assets/img/svg/settings.svg')}}" alt="img">
                        </a>
                    </li>
                </ul>
            </div>

            <div class="d-flex align-items-center gap-7 order-1 order-xl-0">
                <div class="kleon-navmenu text-center">
                    <ul class="main-menu">

                        <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-speedometer fs-16"></i></span> <span class="nav-text">Dashboards</span></a>
                            <ul class="sub-menu">
                                <li class="menu-item"><a href="#">Invoice Management</a></li>
                            </ul>
                            <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                        </li>

                        <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-speedometer2 fs-16"></i></span> <span class="nav-text">Sass</span></a>
                            <ul class="sub-menu">
                                <!-- HR Management -->
                                <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-people fs-16"></i></span> <span class="nav-text">HR Management</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="#"> Employees <span class="menuIndicator bg-soft-secondary rounded-3 py-0 px-3">New</span></a></li>
                                    </ul>
                                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                                </li>

                                <!-- Job Hiring -->
                                <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-briefcase fs-16"></i></span> <span class="nav-text">Job Hiring</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="#"> Jobs <span class="menuIndicator bg-info rounded-circle text-white">17</span></a></li>
                                    </ul>
                                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                                </li>

                                <!-- Project Management -->
                                <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-kanban fs-16"></i></span> <span class="nav-text">Project Management</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="#"> Contacts</a></li>
                                    </ul>
                                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                                </li>

                                <!-- General Dashboard -->
                                <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-speedometer2 fs-16"></i></span> <span class="nav-text">General Dashboard</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="#"> Preferences</a></li>
                                    </ul>
                                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                                </li>
                            </ul>
                        </li>

                        <!-- Apps -->
                        <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-app-indicator fs-16"></i></span> <span class="nav-text">Apps</span></a>
                            <ul class="sub-menu">
                                <li class="menu-item"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-calendar-day fs-16"></i></span> <span class="nav-text">Calendar</span></a></li>
                            </ul>
                        </li>

                        <!-- UI Components -->
                        <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-bricks fs-16"></i></span> <span class="nav-text">Components</span></a>
                            <ul class="sub-menu">
                                <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-bricks fs-16"></i></span> <span class="nav-text">UI Elements</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="#">Accordion</a></li>
                                    </ul>
                                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                                </li>
                            </ul>
                        </li>

                        <!-- Pages -->
                        <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-briefcase fs-16"></i></span> <span class="nav-text">Pages</span></a>
                            <ul class="sub-menu">
                                <!-- Authentication -->
                                <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-person-bounding-box fs-16"></i></span> <span class="nav-text">Authentication</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-info-circle fs-16"></i></span> <span class="nav-text">Error</span></a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="#">403 Error</a></li>
                                            </ul>
                                            <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Charts -->
                                <li class="menu-item menu-item-has-children"><a href="#"> <span class="nav-icon flex-shrink-0"><i class="bi bi-graph-up-arrow fs-16"></i></span> <span class="nav-text">Charts</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item menu-item-has-children"><a href="#"><span class="nav-icon flex-shrink-0"><i class="bi bi-pie-chart-fill fs-16"></i></span> <span class="nav-text">Apex Chart</span></a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="#">Line Chart</a></li>
                                            </ul>
                                            <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="d-flex align-items-center flex-shrink-0">
                <ul class="nav-elements d-flex align-items-center list-unstyled m-0 p-0">
                    <li class="nav-item nav-search">
                        <button type="button" class="btn p-0 m-0 border-0" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <img src="{{asset('assets/img/svg/search.svg')}}" alt="">
                        </button>
                    </li>
                    <li class="nav-item nav-color-switch d-flex align-items-center gap-3">
                        <div class="sun"><img src="{{asset('assets/img/sun.svg')}}" alt="img"></div>
                        <div class="switch">
                            <input type="checkbox" id="colorSwitch3" value="false" name="defaultMode">
                            <div class="shutter">
                                <span class="lbl-off"></span>
                                <span class="lbl-on"></span>
                                <div class="slider bg-primary"></div>
                            </div>
                        </div>
                        <div class="moon"><img src="{{asset('assets/img/moon.svg')}}" alt="img"></div>
                    </li>

                    <li class="nav-item nav-flag">
                        <select class="kleon-select-single nav-toggler-content">
                            <option selected value="en">Eng(US)</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                            <option value="sp">Spanish</option>
                        </select>
                    </li>

                    <li class="nav-item nav-author">
                        <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="" alt="img" width="54" class="rounded-2">
                            <div class="nav-toggler-content">
                                <h6 class="mb-0">Franklin Jr.</h6>
                                <div class="ff-heading fs-14 fw-normal text-gray">Super Admin</div>
                            </div>
                        </a>
                        <div class="dropdown-widget dropdown-menu p-0 admin-card">
                            <div class="dropdown-wrapper">
                                <div class="card mb-0">
                                    <div class="card-header p-3 text-center">
                                        <img src="{{asset('assets/img/nav_author.jpg')}}" alt="img" width="80" class="rounded-circle avatar">
                                        <div class="mt-2">
                                            <h6 class="mb-0 lh-18">Franklin Jr.</h6>
                                            <div class="fs-14 fw-normal text-gray">Super Admin</div>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <ul class="list-unstyled p-0 m-0">
                                            <li>
                                                <a href="#" class="fs-14 fw-normal text-dark d-block p-1"><i class="bi bi-person me-2"></i> Profile</a>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="card-footer p-3">
                                        <a href="#" class="btn btn-outline-gray bg-transparent w-100 py-1 rounded-1 text-dark fs-14 fw-medium"><i class="bi bi-box-arrow-right"></i> Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="small-header d-flex align-items-center justify-content-between d-xl-none">
        <div class="logo">
            <a href="{{ route('app.home') }}" class="d-flex align-items-center gap-3 flex-shrink-0">
                <img src="{{ asset('assets/favicons/favicon.ico') }}" alt="logo">
                <div class="position-relative flex-shrink-0">
                    <h4>OP</h4>
                </div>
            </a>
        </div>
        <div>
            <button type="button" class="kleon-header-expand-toggle"><span class="fs-24"><i class="bi bi-three-dots-vertical"></i></button>
            <button type="button" class="kleon-mobile-menu-opener"><span class="close"><i class="bi bi-arrow-left"></i></span> <span class="open"><i class="bi bi-list"></i></span></button>
        </div>
    </div>

    <div class="header-mobile-option">
        <div class="header-inner">
            <div class="d-flex align-items-center justify-content-end flex-shrink-0">
                <ul class="nav-elements d-flex align-items-center list-unstyled m-0 p-0">
                    <li class="nav-item nav-search">
                        <button type="button" class="btn p-0 m-0 border-0" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="bi bi-search"></i>
                        </button>
                    </li>
                    <li class="nav-item nav-notification dropdown">
                        <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell-fill"></i>
                            <div class="badge rounded-circle">12</div>
                        </a>
                        <div class="dropdown-widget dropdown-menu p-0">
                            <div class="dropdown-wrapper pd-50">
                                <div class="dropdown-wrapper--title">
                                    <h4 class="d-flex align-items-center justify-content-between">Notifications <a href="#">View All</a></h4>
                                </div>
                                <ul class="notification-board list-unstyled">
                                    <li class="author-online has-new-message d-flex gap-3">
                                        <div class="media bg-primary text-white">
                                            <i class="bi bi-lightning"></i>
                                        </div>
                                        <div class="user-message">
                                            <h6 class="message"><a href="#">Jackie Kun</a> mentioned you at <a href="#">Kleon Projects</a></h6>
                                            <p class="message-footer d-flex align-items-center justify-content-between"> <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as read</span></p>
                                        </div>
                                    </li>
                                    <li class="author-online has-new-message d-flex gap-3">
                                        <div class="media bg-secondary text-white">
                                            <i class="bi bi-lightning"></i>
                                        </div>
                                        <div class="user-message">
                                            <h6 class="message"><a href="#">Olivia Johanna</a> has created new task at <a href="#">Kleon Projects</a></h6>
                                            <p class="message-footer d-flex align-items-center justify-content-between"> <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as read</span></p>
                                        </div>
                                    </li>
                                    <li class="author-online has-new-message d-flex gap-3">
                                        <div class="media media-outline-red text-red">
                                            <i class="bi bi-clock-fill"></i>
                                        </div>
                                        <div class="user-message">
                                            <h6 class="message">[REMINDER] Due date of <a href="#">Highspeed Studios Projects</a> te task will be coming</h6>
                                            <p class="message-footer d-flex align-items-center justify-content-between"> <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as read</span></p>
                                        </div>
                                    </li>
                                </ul>
                                <h6 class="all-notifications"> <a href="#" class="btn bg-muted text-primary w-100 fw-bold mt-3 ff-heading px-0">View All Notifications</a> </h6>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item nav-settings">
                        <a href="#" class="nav-toggler">
                            <i class="bi bi-gear-fill"></i>
                        </a>
                    </li>

                    <li class="nav-item nav-author px-3">
                        <a href="#" class="nav-toggler" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('assets/img/nav_author.jpg')}}" alt="img" width="40" class="rounded-2">
                            <div class="nav-toggler-content">
                                <h6 class="mb-0">Franklin Jr.</h6>
                                <div class="ff-heading fs-14 fw-normal text-gray">Super Admin</div>
                            </div>
                        </a>
                        <div class="dropdown-widget dropdown-menu p-0 admin-card">
                            <div class="dropdown-wrapper">
                                <div class="card mb-0">
                                    <div class="card-header p-3 text-center">
                                        <img src="{{asset('assets/img/nav_author.jpg')}}" alt="img" width="60" class="rounded-circle avatar">
                                        <div class="mt-2">
                                            <h6 class="mb-0 lh-18">Franklin Jr.</h6>
                                            <div class="fs-14 fw-normal text-gray">Super Admin</div>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <ul class="list-unstyled p-0 m-0">
                                            <li>
                                                <a href="#" class="fs-14 fw-normal text-dark d-block p-1"><i class="bi bi-person me-2"></i> Profile</a>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="card-footer p-3">
                                        <a href="#" class="btn btn-outline-gray bg-transparent w-100 py-1 rounded-1 text-dark fs-14 fw-medium"><i class="bi bi-box-arrow-right"></i> Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</header>

@livewire('layouts.navbar')
