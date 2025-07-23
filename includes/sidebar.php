   <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="http://localhost/ivs/">
                <div class="sidebar-brand-icon ">
                <img src="isv/../src/images/dar_logo.png" alt="Logo" style="width: 70px; height: 55px;">
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
                                    <!-- Nav Item - Inventory Management -->
                        <li class="nav-item <?= ($currentPage === 'manageitems' || $currentPage === '') ? 'active' : '' ?>">
                <a class="nav-link <?= ($currentPage === 'manageitems' || $currentPage === '') ? '' : 'collapsed' ?>" href="#" data-bs-toggle="collapse" data-bs-target="#inventoryPages"
                    aria-expanded="<?= ($currentPage === 'manageitems' || $currentPage === '') ? 'true' : 'false' ?>" aria-controls="inventoryPages">
                    <i class="fa-solid fa-gear"></i>
                    <span>Inventory Management</span>
                </a>
                <div id="inventoryPages" class="collapse <?= ($currentPage === 'manageitems' || $currentPage === '') ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Inventory Management:</h6>
                        <a class="collapse-item <?= $currentPage === 'manageitems' ? 'active' : '' ?>" href="index.php?page=manageitems">Manage Items</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Stocks-In:</h6>
                        <a class="collapse-item" href="">Stock-In Entry</a>
                        <a class="collapse-item" href="">Stock-In History</a>
                    </div>
                </div>
            </li>

                                                <!-- Nav Item - RIS Management -->
                <li class="nav-item <?= $currentPage === '' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#risPages"
                    aria-expanded="true" aria-controls="risPages">
                    <i class="fa-solid fa-folder-open"></i>
                    <span>RIS Management</span>
                </a>
                <div id="risPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">RIS:</h6>
                        <a class="collapse-item" href="">Create RIS</a>
                        <a class="collapse-item" href="">RIS List</a>
                        <a class="collapse-item" href="">RIS Issuance</a>
                    </div>
                </div>
            </li>

                                                            <!-- Nav Item - Stock Ledger -->
                <li class="nav-item <?= $currentPage === '' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#stockledgerPages"
                    aria-expanded="true" aria-controls="stockledgerPages">
                    <i class="fa-solid fa-folder"></i>
                    <span>Stock Ledger</span>
                </a>
                <div id="stockledgerPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Stock Ledger:</h6>
                        <a class="collapse-item" href="">Add Ledger Entry</a>
                        <a class="collapse-item" href="">Stock Card</a>
                    </div>
                </div>
            </li>

                                                                        <!-- Nav Item - Reports -->
                <li class="nav-item <?= $currentPage === '' ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#reportsPages"
                    aria-expanded="true" aria-controls="reportsPages">
                    <i class="fa-solid fa-print"></i>
                    <span>Reports</span>
                </a>
                <div id="reportsPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Reports:</h6>
                        <a class="collapse-item" href="">RSMI Report</a>
                        <a class="collapse-item" href="">RIS Summary</a>
                    </div>
                </div>
            </li>

                                                                        <!-- Nav Item - Master Data -->
            <li class="nav-item <?= ($currentPage === 'managesupplier' || $currentPage === 'managedivision') ? 'active' : '' ?>">
                <a class="nav-link <?= ($currentPage === 'managesupplier' || $currentPage === 'managedivision') ? '' : 'collapsed' ?>" href="#" data-bs-toggle="collapse" data-bs-target="#masterdataPages"
                    aria-expanded="<?= ($currentPage === 'managesupplier' || $currentPage === 'managedivision') ? 'true' : 'false' ?>" aria-controls="masterdataPages">
                    <i class="fa-solid fa-gear"></i>
                    <span>Master Data</span>
                </a>
                <div id="masterdataPages" class="collapse <?= ($currentPage === 'managesupplier' || $currentPage === 'managedivision') ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Master Data:</h6>
                        <a class="collapse-item <?= $currentPage === 'managesupplier' ? 'active' : '' ?>" href="index.php?page=managesupplier">Manage Suppliers</a>
                        <a class="collapse-item <?= $currentPage === 'managedivision' ? 'active' : '' ?>" href="index.php?page=managedivision">Manage Divisions</a>
                    </div>
                </div>
            </li>
                                    <!-- Nav Item - Stocks -->
            <li class="nav-item <?= $currentPage === 'managestocks' ? 'active' : '' ?>">
                <a class="nav-link" href="index.php?page=managestocks">
                    <i class="fas fa-truck"></i>
                    <span>Manage Stocks</span>
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