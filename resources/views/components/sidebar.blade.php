<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav" id="sidebar-menu">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="index.html">
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




                <div class="sb-sidenav-menu-heading">Transaction</div>
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
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>