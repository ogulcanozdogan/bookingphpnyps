<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="https://newyorkpedicabservices.com/buttons_files/new-york-pedicab-services-banner.webp" style="margin-left:-10%;" alt="" height="57">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
						<li class="nav-item">
                            <a class="nav-link menu-link" href="index.php">
                                <i class="bx bxs-dashboard"></i> <span data-key="t-dashboards">Your Dashboard</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="available.php">
                                <i class="bx bxs-pin"></i> <span data-key="t-dashboards">Available</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="pending.php">
                                <i class="bx bx-time-five"></i> <span data-key="t-dashboards">Pending</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="past.php">
                                <i class="bx bx-history"></i> <span data-key="t-dashboards">Past</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
                    </ul>
					<?php if ($perm == "admin") { ?>
					 <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Admin Menu</span></li>
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_drivers.php">
                                <i class="bx bx-user-pin"></i> <span data-key="t-dashboards">Admin Drivers</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_verify_drivers.php">
                                <i class="bx bx-user-pin"></i> <span data-key="t-dashboards">Admin Verify Drivers</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="admin_available.php">
                                <i class="bx bxs-pin"></i> <span data-key="t-dashboards">Admin Available</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_pending.php">
                                <i class="bx bx-time-five"></i> <span data-key="t-dashboards">Admin Pending</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_past.php">
                                <i class="bx bx-history"></i> <span data-key="t-dashboards">Admin Past</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_failed.php">
                                <i class="bx bx-x"></i> <span data-key="t-dashboards">Admin Failed</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_earnings.php">
                                <i class="bx bx-money-withdraw"></i> <span data-key="t-dashboards">Admin Earnings</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
                    </ul>
					
					<?php } ?>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>