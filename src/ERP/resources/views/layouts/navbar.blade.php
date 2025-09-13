<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <i data-feather="briefcase" class="me-1"></i> ERP
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('clients.index') }}"><i data-feather="users" class="me-1"></i>Clients</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('suppliers.index') }}"><i data-feather="truck" class="me-1"></i>Suppliers</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}"><i data-feather="box" class="me-1"></i>Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}"><i data-feather="file-text" class="me-1"></i>Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('invoices.index') }}"><i data-feather="file" class="me-1"></i>Invoices</a></li>

                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('registration-codes.index') }}"><i data-feather="key" class="me-1"></i>Reg. Codes</a></li>
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown">
                            <i data-feather="user" class="me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item"><i data-feather="log-out" class="me-1"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
