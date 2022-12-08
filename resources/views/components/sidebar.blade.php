<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav" id="sidebar-menu">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Data Master</div>
                <a class="nav-link" href="{{ route('units.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-scale-unbalanced-flip"></i>
                    </div>
                    Units
                </a>
                <a class="nav-link" href="{{ route('roles.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-user-tag"></i>
                    </div>
                    Roles
                </a>
                <a class="nav-link" href="{{ route('customers.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-users-between-lines"></i>
                    </div>
                    Customers
                </a>
                <a class="nav-link" href="{{ route('rolls.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    Rolls
                </a>
                <a class="nav-link" href="{{ route('registration.credentials.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    Registration Credential
                </a>
                <a class="nav-link" href="{{ route('users.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>
                    User Management
                </a>


                <div class="sb-sidenav-menu-heading">Transaction</div>
                <a class="nav-link" href="{{ route('invoices.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                    Invoices
                </a>
                <a class="nav-link" href="{{ route('payments.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-money-check-dollar"></i>
                    </div>
                    Payments
                </a>
                <a class="nav-link" href="{{ route('search-roll.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    Search Roll
                </a>
                <a class="nav-link" href="{{ route('whatsapp.messaging.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    Whatsapp Messaging
                </a>
                <a class="nav-link" href="{{ route('roll.transactions.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-right-left"></i>
                    </div>
                    Roll Transactions
                </a>
                <a class="nav-link" href="{{ route('restock.create') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-truck-ramp-box"></i>
                    </div>
                    Restock
                </a>
                <a class="nav-link" href="{{ route('roll.transactions.putAway') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                    Put Away
                </a>
                <a class="nav-link" href="{{ route('shopping.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    Shopping
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ ucwords(Auth::user()->name) }}
        </div>
    </nav>
</div>