<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <!-- Default Nav -->
    <header class="header kleon-default-nav">
        <div class="d-none d-xl-block">
            <div
                class="header-inner d-flex align-items-center justify-content-around justify-content-xl-between flex-wrap flex-xl-nowrap gap-3 gap-xl-5">
                <div class="header-left-part d-flex align-items-center flex-grow-1 w-100">
                    <div class="header-search w-100">
                        <form class="search-form" action="#">
                            <input type="text" name="search" class="keyword form-control w-100" placeholder="Search">
                            <button type="submit" class="btn"><img src="{{asset('assets/img/svg/search.svg')}}" alt="">
                            </button>
                        </form>
                    </div>
                </div>

                <div class="header-right-part d-flex align-items-center flex-shrink-0">
                    <ul class="nav-elements d-flex align-items-center list-unstyled m-0 p-0">
                        <li class="nav-item nav-color-switch d-flex align-items-center gap-3">
                            <div class="sun"><img src="{{asset('assets/img/sun.svg')}}" alt="img"></div>
                            <div class="switch">
                                <input type="checkbox" id="colorSwitch" value="false" name="defaultMode">
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
                                <img src="{{ asset('assets/img/svg/bell.svg') }}" alt="bell">
                                <div class="badge rounded-circle">12</div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0">
                                <div class="dropdown-wrapper pd-50">
                                    <div class="dropdown-wrapper--title">
                                        <h4 class="d-flex align-items-center justify-content-between">Notifications <a
                                                href="#">View All</a></h4>
                                    </div>
                                    <ul class="notification-board list-unstyled">
                                        <li class="author-online has-new-message d-flex gap-3">
                                            <div class="media bg-primary text-white">
                                                <i class="bi bi-lightning"></i>
                                            </div>
                                            <div class="user-message">
                                                <h6 class="message"><a href="#">Jackie Kun</a> mentioned you at <a
                                                        href="#">Kleon Projects</a></h6>
                                                <p class="message-footer d-flex align-items-center justify-content-between">
                                                    <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as read</span>
                                                </p>
                                            </div>
                                        </li>
                                        <li class="author-online has-new-message d-flex gap-3">
                                            <div class="media bg-secondary text-white">
                                                <i class="bi bi-lightning"></i>
                                            </div>
                                            <div class="user-message">
                                                <h6 class="message"><a href="#">Olivia Johanna</a> has created new task
                                                    at <a href="#">Kleon Projects</a></h6>
                                                <p class="message-footer d-flex align-items-center justify-content-between">
                                                    <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as read</span>
                                                </p>
                                            </div>
                                        </li>
                                        <li class="author-online has-new-message d-flex gap-3">
                                            <div class="media media-outline-red text-red">
                                                <i class="bi bi-clock-fill"></i>
                                            </div>
                                            <div class="user-message">
                                                <h6 class="message">[REMINDER] Due date of <a href="#">Highspeed Studios
                                                        Projects</a> te task will be coming</h6>
                                                <p class="message-footer d-flex align-items-center justify-content-between">
                                                    <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as read</span>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                    <h6 class="all-notifications"><a href="#"
                                                                     class="btn bg-muted text-primary w-100 fw-bold mt-3 ff-heading px-0">View
                                            All Notifications</a></h6>
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
                                <img
                                    src="{{ $user->image ? asset('storage/' . $user->image->path) : asset('placeholders/picture.jpg') }}"
                                    alt="img" width="54" class="rounded-2">
                                <div class="nav-toggler-content">
                                    <h6 class="mb-0">
                                        {{ \Illuminate\Support\Str::ucfirst($user->name) }}
                                        -
                                        {{ \Illuminate\Support\Str::ucfirst($user->sname) }}
                                    </h6>
                                    <div
                                        class="ff-heading fs-14 fw-normal text-gray">{{ $user->role->name=='user' ? 'UTILISATEUR': $user->role->name  }}</div>
                                </div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0 admin-card">
                                <div class="dropdown-wrapper">
                                    <div class="card mb-0">
                                        <div class="card-header p-3 text-center">
                                            <img
                                                src="{{ $user->image ? asset('storage/' . $user->image->path) : asset('placeholders/picture.jpg') }}"
                                                alt="img" width="80" class="rounded-circle avatar">
                                            <div class="mt-2">
                                                <h6 class="mb-0 lh-18">
                                                    {{ \Illuminate\Support\Str::ucfirst($user->name) }}
                                                    -
                                                    {{ \Illuminate\Support\Str::ucfirst($user->sname) }}
                                                </h6>
                                                <div
                                                    class="fs-14 fw-normal text-gray">{{ $user->role->name=='user' ? 'UTILISATEUR': $user->role->name  }}</div>
                                            </div>
                                        </div>
                                        <div class="card-body p-3">
                                            <ul class="list-unstyled p-0 m-0">
                                                <li>
                                                    <a href="{{ route('app.user.profile') }}"
                                                       class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-person me-2"></i> Profile</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-envelope me-2 "></i> Inbox</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-gear me-2"></i> Setting & Privacy</a>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="card-footer p-3">
                                            <a href=""
                                               onclick="event.preventDefault(); getElementById('nav-logout-form').submit()"
                                               class="btn btn-outline-gray bg-transparent w-100 py-1 rounded-1 text-dark fs-14 fw-medium"><i
                                                    class="bi bi-box-arrow-right"></i> Deconnexion</a>
                                            <form id="nav-logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                            </form>
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
                <a href="{{route('app.home')}}" class="d-flex align-items-center gap-3 flex-shrink-0">
                    <img src="{{ asset('assets/favicons/favicon.ico') }}" alt="logo">
                    <div class="position-relative flex-shrink-0">
                        <h4>OP</h4>
                    </div>
                </a>
            </div>
            <div>
                <button type="button" class="kleon-header-expand-toggle"><span class="fs-24"><i
                            class="bi bi-three-dots-vertical"></i></button>
                <button type="button" class="kleon-mobile-menu-opener"><span class="close"><i
                            class="bi bi-arrow-left"></i></span> <span class="open"><i class="bi bi-list"></i></span>
                </button>
            </div>
        </div>

        <div class="header-mobile-option">
            <div class="header-inner">
                <div class="d-flex align-items-center justify-content-end flex-shrink-0">
                    <ul class="nav-elements d-flex align-items-center list-unstyled m-0 p-0">
                        <li class="nav-item nav-search">
                            <button type="button" class="btn p-0 m-0 border-0" data-bs-toggle="modal"
                                    data-bs-target="#searchModal">
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
                                        <h4 class="d-flex align-items-center justify-content-between">Notifications <a
                                                href="#">View All</a></h4>
                                    </div>
                                    <ul class="notification-board list-unstyled">
                                        <li class="author-online has-new-message d-flex gap-3">
                                            <div class="media bg-primary text-white">
                                                <i class="bi bi-lightning"></i>
                                            </div>
                                            <div class="user-message">
                                                <h6 class="message"><a href="#">Jackie Kun</a> mentioned you at <a
                                                        href="#">Kleon Projects</a></h6>
                                                <p class="message-footer d-flex align-items-center justify-content-between">
                                                    <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as read</span>
                                                </p>
                                            </div>
                                        </li>
                                        <li class="author-online has-new-message d-flex gap-3">
                                            <div class="media bg-secondary text-white">
                                                <i class="bi bi-lightning"></i>
                                            </div>
                                            <div class="user-message">
                                                <h6 class="message"><a href="#">Olivia Johanna</a> has created new task
                                                    at <a href="#">Kleon Projects</a></h6>
                                                <p class="message-footer d-flex align-items-center justify-content-between">
                                                    <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as read</span>
                                                </p>
                                            </div>
                                        </li>
                                        <li class="author-online has-new-message d-flex gap-3">
                                            <div class="media media-outline-red text-red">
                                                <i class="bi bi-clock-fill"></i>
                                            </div>
                                            <div class="user-message">
                                                <h6 class="message">[REMINDER] Due date of <a href="#">Highspeed Studios
                                                        Projects</a> te task will be coming</h6>
                                                <p class="message-footer d-flex align-items-center justify-content-between">
                                                    <span class="fs-14 text-gray fw-normal">2m ago</span> <span>Mark as read</span>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                    <h6 class="all-notifications"><a href="#"
                                                                     class="btn bg-muted text-primary w-100 fw-bold mt-3 ff-heading px-0">View
                                            All Notifications</a></h6>
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
                                <img
                                    src="{{ $user->image ? asset('storage/' . $user->image->path) : asset('placeholders/picture.jpg') }}"
                                    alt="img" width="40" class="rounded-2">
                                <div class="nav-toggler-content">
                                    <h6 class="mb-0">
                                        {{ \Illuminate\Support\Str::ucfirst($user->name) }}
                                        -
                                        {{ \Illuminate\Support\Str::ucfirst($user->sname) }}
                                    </h6>
                                    <div
                                        class="ff-heading fs-14 fw-normal text-gray">{{ $user->role->name=='user' ? 'UTILISATEUR': $user->role->name  }}</div>
                                </div>
                            </a>
                            <div class="dropdown-widget dropdown-menu p-0 admin-card">
                                <div class="dropdown-wrapper">
                                    <div class="card mb-0">
                                        <div class="card-header p-3 text-center">
                                            <img
                                                src="{{ $user->image ? asset('storage/' . $user->image->path) : asset('placeholders/picture.jpg') }}"
                                                alt="img" width="60" class="rounded-circle avatar">
                                            <div class="mt-2">
                                                <h6 class="mb-0 lh-18">
                                                    {{ \Illuminate\Support\Str::ucfirst($user->name) }}
                                                    -
                                                    {{ \Illuminate\Support\Str::ucfirst($user->sname) }}
                                                </h6>
                                                <div
                                                    class="fs-14 fw-normal text-gray">{{ $user->role->name=='user' ? 'UTILISATEUR': $user->role->name  }}</div>
                                            </div>
                                        </div>
                                        <div class="card-body p-3">
                                            <ul class="list-unstyled p-0 m-0">
                                                <li>
                                                    <a href="{{ route('app.user.profile') }}"
                                                       class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-person me-2"></i> Profile</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-envelope me-2 "></i> Inbox</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="fs-14 fw-normal text-dark d-block p-1"><i
                                                            class="bi bi-gear me-2"></i> Setting & Privacy</a>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="card-footer p-3">
                                            <a href=""
                                               onclick="event.preventDefault(); getElementById('nav-logout-form').submit()"
                                               class="btn btn-outline-gray bg-transparent w-100 py-1 rounded-1 text-dark fs-14 fw-medium"><i
                                                    class="bi bi-box-arrow-right"></i> Deconnexion</a>
                                            <form id="nav-logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                            </form>
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


</div>
