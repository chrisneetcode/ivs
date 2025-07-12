   <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="http://localhost/ivs/">
                <div class="sidebar-brand-icon ">
                <img src="isv/../src/images/dar_logo.png" alt="Logo" style="width: 65px; height: 65px;">
                </div>
                <div class="sidebar-brand-text mx-3">ISAMS <sup>1.0</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="http://localhost/ivs/">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

                                    <!-- Nav Item - Stocks -->
            <li class="nav-item <?= $currentPage === 'managestocks' ? 'active' : '' ?>">
                <a class="nav-link" href="index.php?page=managestocks">
                    <i class="fas fa-truck"></i>
                    <span>Manage Stocks</span>
                </a>
            </li>
                                    <!-- Nav Item - Supply -->
            <li class="nav-item <?= $currentPage === 'managesupply' ? 'active' : '' ?>">
                <a class="nav-link" href="index.php?page=managesupply">
                    <i class="fas fa-boxes"></i>
                    <span>Manage Supply</span>
                </a>
            </li>
                        <!-- Nav Item - Tables -->
            <li class="nav-item <?= $currentPage === 'manageuser' ? 'active' : '' ?>">
                <a class="nav-link" href="index.php?page=manageuser">
                    <i class="fas fa-users-cog"></i>
                    <span>Manage User</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <!-- Footer 2nd Page Can add here -->
        </ul>
        <!-- End of Sidebar -->