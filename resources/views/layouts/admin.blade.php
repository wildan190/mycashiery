<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MyCashiery') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="sidebar-brand-text mx-3">MyCashiery</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Nav::isRoute('home') }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>{{ __('Dashboard') }}</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Transaction') }}
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ Nav::isRoute('transactions.index') }}">
                <a class="nav-link" href="{{ route('transactions.index') }}">
                    <i class="fas fa-fw fa-file-invoice"></i>
                    <span>{{ __('Transactions') }}</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Management') }}
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ Nav::isRoute(['products.index', 'categories.index']) }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseManagement" aria-expanded="true" aria-controls="collapseManagement">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>{{ __('Management') }}</span>
                </a>
                <div id="collapseManagement" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Nav::isRoute('products.index') }}" href="{{ route('products.index') }}">{{ __('Products') }}</a>
                        @if(Auth::user()->hasRole('Admin'))
                        <a class="collapse-item {{ Nav::isRoute('categories.index') }}" href="{{ route('categories.index') }}">{{ __('Categories') }}</a>
                        @endif
                    </div>
                </div>
            </li>

            @if(Auth::user()->hasPermissionTo('Report Access'))
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Reports') }}
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ Nav::isRoute(['reports.monthly', 'reports.product']) }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports" aria-expanded="true" aria-controls="collapseReports">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>{{ __('Reports') }}</span>
                </a>
                <div id="collapseReports" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Nav::isRoute('reports.monthly') }}" href="{{ route('reports.monthly') }}">{{ __('Monthly Report') }}</a>
                        <a class="collapse-item {{ Nav::isRoute('reports.product') }}" href="{{ route('reports.product') }}">{{ __('Products Report') }}</a>
                    </div>
                </div>
            </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Settings') }}
            </div>

            <!-- Nav Item - Profile -->
            <li class="nav-item {{ Nav::isRoute('profile') }}">
                <a class="nav-link" href="{{ route('profile') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>{{ __('Profile') }}</span>
                </a>
            </li>

            @if(Auth::user()->hasRole('Admin'))
            <!-- Nav Item - Role -->
            <li class="nav-item {{ Nav::isRoute('roles.index') }}">
                <a class="nav-link" href="{{ route('roles.index') }}">
                    <i class="fas fa-fw fa-users-cog"></i>
                    <span>{{ __('Role') }}</span>
                </a>
            </li>

            <!-- Nav Item - Permission -->
            <li class="nav-item {{ Nav::isRoute('permissions.index') }}">
                <a class="nav-link" href="{{ route('permissions.index') }}">
                    <i class="fas fa-fw fa-user-shield"></i>
                    <span>{{ __('Permission') }}</span>
                </a>
            </li>
            @endif

            
            @if(Auth::user()->hasPermissionTo('Assign Role User'))
            <!-- Nav Item - User -->
            <li class="nav-item {{ Nav::isRoute('users.index') }}">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>{{ __('User') }}</span>
                </a>
            </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('About') }}
            </div>

            <!-- Nav Item - About -->
            <li class="nav-item {{ Nav::isRoute('about') }}">
                <a class="nav-link" href="{{ route('about') }}">
                    <i class="fas fa-fw fa-hands-helping"></i>
                    <span>{{ __('About') }}</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">
                                    {{ Auth::user()->unreadNotifications->count() }}
                                </span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                @forelse (Auth::user()->unreadNotifications as $notification)
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('notifications.read', $notification->id) }}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{ $notification->created_at->diffForHumans() }}</div>
                                        <span class="font-weight-bold">{{ $notification->data['action'] }}</span> - {{ $notification->data['details'] }}
                                    </div>
                                </a>
                                @empty
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="text-center">
                                        <span class="font-weight-bold">No notifications</span>
                                    </div>
                                </a>
                                @endforelse
                                @if (Auth::user()->unreadNotifications->count() > 0)
                                <a class="dropdown-item text-center small text-gray-500 mark-as-read" href="{{ route('notifications.markAllRead') }}">Mark all as read</a>
                                @endif
                            </div>
                        </li>
                        @push('css')
                        <style>
                            .mark-as-read {
                                background-color: #f8f9fa;
                                padding: 0.5rem;
                                border-radius: 0.3rem;
                            }
                        </style>
                        @endpush


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="{{ Auth::user()->name[0] }}"></figure>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Profile') }}
                                </a>
                                @if(Auth::user()->hasRole('Admin'))
                                <a class="dropdown-item" href="{{route('logs.index')}}">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Activity Log') }}
                                </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('main-content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <a href="#" target="_blank">Micro Padma Nusantara</a> {{ now()->year }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>