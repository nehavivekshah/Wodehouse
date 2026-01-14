<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>Member Portal - WODEHOUSE GYMKHANA</title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&amp;display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/all.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="member_style.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="member-portal-wrapper">
        <aside class="member-sidebar">
            <div class="sidebar-header">
                <a href="dashboard.php">
                    <img src="../images/favicon.png" alt="Logo" class="sidebar-logo">
                    <span>Welcome Back!</span>
                </a>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                    <li class="nav-heading">Services</li>
                    <li><a href="facility_availability.php"><i class="fas fa-calendar-alt"></i> Facilities & Bookings</a></li>
                    <li><a href="menu.php"><i class="fas fa-utensils"></i> Food & Beverage</a></li>
                    <li><a href="events.php"><i class="fas fa-glass-cheers"></i> Events</a></li>
                    <li class="nav-heading">History & Billing</li>
                    <li><a href="payment_history.php"><i class="fas fa-history"></i> Payment & Invoices</a></li>
                    <li><a href="subscriptions.php"><i class="fas fa-sync-alt"></i> Subscriptions</a></li>
                    <li class="nav-heading">Notices</li>
                    <li><a href="agm.php"><i class="fas fa-file-alt"></i> AGM</a></li>
                    <li><a href="../docs/candidate_list.pdf" target="_blank"><i class="fas fa-users"></i> Candidate Lists</a></li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <a href="../index.php" class="sidebar-link"><i class="fas fa-globe"></i> Back to Site</a>
            </div>
        </aside>
        <div class="main-panel">
            <header class="top-header">
                <div class="header-right">
                    <a href="#" class="notification-bell">
                        <i class="fas fa-bell"></i>
                        <span class="badge rounded-pill bg-danger">3</span>
                    </a>
                    <div class="dropdown header-profile">
                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://i.pravatar.cc/150?u=a042581f4e29026704d" alt="Profile" class="profile-avatar">
                            <div class="profile-info">
                                <span class="profile-name">John Doe</span>
                                <span class="profile-id">WG12345</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user-circle fa-fw me-2"></i> My Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="change_password.php"><i class="fas fa-key fa-fw me-2"></i> Change Password</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="../login.php"><i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </header>
            <main class="member-content">