<div>
    {{-- Do your work, then step back. --}}

    <!-- Vertical Nav -->
    <div class="kleon-vertical-nav">
        <!-- Logo  -->
        <div class="logo d-flex align-items-center justify-content-between">
            <a href="{{ route('app.home') }}" class="d-flex align-items-center gap-3 flex-shrink-0">
                <img src="{{ asset('assets/favicons/favicon.ico') }}" alt="logo">
                <div class="position-relative flex-shrink-0">
                    <h4>OP</h4>
                </div>
            </a>
            <button type="button" class="kleon-vertical-nav-toggle"><i class="bi bi-list"></i></button>
        </div>

        <div class="kleon-navmenu">
            <h6 class="hidden-header text-gray text-uppercase ls-1 ms-4 mb-4">MENU PRINCIPAL</h6>
            <ul class="main-menu">
                <!-- Apps -->

                <li class="menu-item"><a href="{{ route('app.home') }}"><span class="nav-icon flex-shrink-0"><i
                                class="bi bi-house-fill text-primary fs-18" style="font-size: 36px;"></i></span> <span
                            class="nav-text">ACCUEIL</span></a></li>

                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>OPERATIONS</span>
                </li>

                <li class="menu-item"><a href="{{ route('app.order.index') }}"><span class="nav-icon flex-shrink-0"><i
                                class="bi bi-basket-fill  fs-18 text-success" style="font-size: 36px;"></i></span> <span
                            class="nav-text">Ventes</span></a></li>

                <!-- Charts -->
                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>Statistiques</span>
                </li>
                <li class="menu-item"><a href="{{ route('app.report.index') }}"><span class="nav-icon flex-shrink-0 text-warning"><i
                                class="bi bi-pie-chart-fill  fs-18" style="font-size: 36px;"></i></span> <span
                            class="nav-text">Rapports</span></a></li>


                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>GESTIONS</span>
                </li>

                <li class="menu-item menu-item-has-children "><a href="#"><span
                            class="nav-icon flex-shrink-0">
                            <i class="bi bi-bag-plus-fill text-info" style="font-size: 36px;"></i>
</span> <span
                            class="nav-text">Gestions</span></a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a href="{{ route('app.unit.index') }}">Unité de mesuré</a></li>
                        <li class="menu-item"><a href="{{ route('app.product.index') }}">Produits</a></li>
                        <li class="menu-item"><a href="{{ route('app.supply.index') }}">Approvisionnement</a></li>
                    </ul>
                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                </li>

                <!-- Charts -->
                <li class="menu-section-title text-gray ff-heading fs-16 fw-bold text-uppercase mt-4 mb-2">
                    <span>Paramètres</span>
                </li>
                <li class="menu-item menu-item-has-children"><a href="#"><span
                            class="nav-icon flex-shrink-0"><i class="bi-gear-fill fs-18 text-danger"
                                                              style="font-size: 36px;"></i></span> <span
                            class="nav-text">Paramètres</span></a>
                    <ul class="sub-menu">
                        <li class="menu-item"><a href="{{ route('app.user.index') }}">Utilisateurs</a></li>
                        <li class="menu-item"><a href="{{ route('app.role.index') }}">Roles utilisateurs</a></li>
                        <li class="menu-item"><a href="{{ route('app.permission.index') }}">Fonctions Système</a></li>
                    </ul>
                    <span class='submenu-opener'><i class='bi bi-chevron-right'></i></span>
                </li>


            </ul>
        </div>

        <div class="card border-0 rounded-0 mt-6">
            <div class="card-body p-0">
                <h6 class="text-gray lh-20 mb-0">Oprah Phamarcie</h6>
                <h6 class="text-gray fs-14 fw-medium"> Powered by <a
                        href="https://actu-soft.com/about" target="_blank">Rochap</a></h6>
            </div>
        </div>
    </div>

</div>
