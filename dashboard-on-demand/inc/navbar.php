<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="https://newyorkpedicabservices.com/buttons_files/new-york-pedicab-services-banner.webp" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="https://newyorkpedicabservices.com/buttons_files/new-york-pedicab-services-banner.webp" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="https://newyorkpedicabservices.com/buttons_files/new-york-pedicab-services-banner.webp" alt="" height="22">
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
					<?php // if ($perm != "admin") { ?>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Driver Menu</span></li>
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
				 <?php // } ?>
					<?php if ($perm == "admin") { ?>
					 <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Admin Menu</span></li>
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_drivers.php">
                                <i class="bx bx-user-pin"></i> <span data-key="t-dashboards">Verified Drivers</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_verify_drivers.php">
                                <i class="bx bx-user-pin"></i> <span data-key="t-dashboards">Driver Verification</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="admin_available.php">
                                <i class="bx bxs-pin"></i> <span data-key="t-dashboards">Available</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_pending.php">
                                <i class="bx bx-time-five"></i> <span data-key="t-dashboards">Pending</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_past.php">
                                <i class="bx bx-history"></i> <span data-key="t-dashboards">Past</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_failed.php">
                                <i class="bx bx-x"></i> <span data-key="t-dashboards">Failed</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="logs.php">
                                <i class="bx bxs-file-blank"></i> <span data-key="t-dashboards">Logs</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="SMSMessages.php">
                                <i class="bx bxs-chat"></i> <span data-key="t-dashboards">Messages</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_rate_management.php">
                                <i class="bx bx-dollar"></i> <span data-key="t-dashboards">Rate Management</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_zip_codes.php">
                                <i class="bx bxs-edit-location"></i> <span data-key="t-dashboards">ZIP Codes</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_earnings.php">
                                <i class="bx bx-money-withdraw"></i> <span data-key="t-dashboards">Earnings</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
                    </ul>
					
					
					<?php } ?>
					<ul class="navbar-nav" id="navbar-nav">
						<li class="nav-item">
                            <a class="nav-link menu-link" href="logout.php">
                                <i class="bx bx-log-out"></i> <span data-key="t-dashboards">Logout</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
                    </ul>
                </div>
                <!-- Sidebar -->
					
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>