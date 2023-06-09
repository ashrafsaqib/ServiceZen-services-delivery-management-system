<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Services Delivery Management System') }}</title>

    @vite(['resources/js/app.js'])

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <style>
        .table td,
        .table th {
            vertical-align: middle;
            text-align: center;
        }

        .badge {
            padding: 0em 1em;
            font-size: 85%;
            line-height: 2;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm no-print">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    Services Delivery Management System
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Sales
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <!-- @can('appointment-list')
                                    <a class="dropdown-item" href="{{ route('appointments.index') }}">Appointments</a>
                                    @endcan -->
                                @can('order-list')
                                <a class="dropdown-item" href="{{ route('orders.index') }}">Orders</a>
                                @endcan
                                @can('cash-collection-list')
                                <a class="dropdown-item" href="{{ route('cashCollection.index') }}">Cash Collections</a>
                                @endcan
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Store Config
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @can('service-list')
                                <a class="dropdown-item" href="{{ route('services.index') }}">Services</a>
                                @endcan
                                @can('service-category-list')
                                <a class="dropdown-item" href="{{ route('serviceCategories.index') }}">Service Categories</a>
                                @endcan
                                @can('holiday-list')
                                <a class="dropdown-item" href="/holidays">Holidays</a>
                                @endcan
                                @can('service-staff-list')
                                <a class="dropdown-item" href="{{ route('staffHolidays.index') }}">Staff Holiday</a>
                                @endcan
                                @can('staff-zone-list')
                                <a class="dropdown-item" href="{{ route('staffZones.index') }}">Staff Zones</a>
                                @endcan
                                @can('staff-group-list')
                                <a class="dropdown-item" href="{{ route('staffGroups.index') }}">Staff Groups</a>
                                @endcan
                                @can('time-slot-list')
                                <a class="dropdown-item" href="{{ route('timeSlots.index') }}">Time Slots</a>
                                @endcan
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Users
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @can('service-staff-list')
                                <a class="dropdown-item" href="{{ route('serviceStaff.index') }}">Staff</a>
                                @endcan

                                @can('customer-list')
                                <a class="dropdown-item" href="{{ route('customers.index') }}">Customer</a>
                                @endcan
                                @can('affiliate-list')
                                <a class="dropdown-item" href="{{ route('affiliates.index') }}">Affiliate</a>
                                @endcan
                                @can('manager-list')
                                <a class="dropdown-item" href="{{ route('managers.index') }}">Manager</a>
                                @endcan
                                @can('supervisor-list')
                                <a class="dropdown-item" href="{{ route('supervisors.index') }}">Supervisor</a>
                                @endcan
                                @can('assistant-supervisor-list')
                                <a class="dropdown-item" href="{{ route('assistantSupervisors.index') }}">Assistant Supervisor</a>
                                @endcan
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" target="_blank" href="/">Your Store</a>
                                @can('user-list')
                                <a class="dropdown-item" href="{{ route('users.index') }}">Users</a>
                                @endcan
                                @can('role-list')
                                <a class="dropdown-item" href="{{ route('roles.index') }}">Role</a>
                                @endcan
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>

            </div>
        </nav>
        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        $(".smsId").click(function() {
            $('.btn-close').css('display', 'none')
        });
    });
</script>

</html>