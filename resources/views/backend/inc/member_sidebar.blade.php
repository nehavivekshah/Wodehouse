<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>Member Portal - WODEHOUSE GYMKHANA</title>
    <link rel="shortcut icon" type="image/x-icon" href="/public/frontend/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&amp;display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/frontend/css/all.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="/public/frontend/member_style.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="member-portal-wrapper">
        <aside class="member-sidebar">
            <div class="sidebar-header">
                <a href="/admin/dashboard">
                    <img src="/public/frontend/images/favicon.png" alt="Logo" class="sidebar-logo">
                    <span>Welcome Back!</span>
                </a>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="/admin/dashboard">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    
                    <li class="nav-heading">Facility Management</li>
                    <li>
                        <a href="/admin/facilities">
                            <i class="fas fa-building"></i> Facilities
                        </a>
                    </li>
                    <li>
                        <a href="/admin/facility-category">
                            <i class="fas fa-layer-group"></i> Facility Categories
                        </a>
                    </li>
                    
                    <li class="nav-heading">Food & Beverage</li>
                    <li>
                        <a href="/admin/food-beverage">
                            <i class="fas fa-utensils"></i> Foods
                        </a>
                    </li>
                    <li>
                        <a href="/admin/food-beverage-category">
                            <i class="fas fa-list-ul"></i> Foods Categories
                        </a>
                    </li>
                    <li>
                        <a href="/admin/food-orders">
                            <i class="fas fa-shopping-cart"></i> Orders
                        </a>
                    </li>
                    
                    <li class="nav-heading">Event Management</li>
                    <li>
                        <a href="/admin/events">
                            <i class="fas fa-calendar-check"></i> Events
                        </a>
                    </li>
                    <li>
                        <a href="/admin/event-category">
                            <i class="fas fa-list-alt"></i> Event Categories
                        </a>
                    </li>
                    
                    <li class="nav-heading">Blog Management</li>
                    <li>
                        <a href="/admin/posts">
                            <i class="fas fa-file-alt"></i> All Posts
                        </a>
                    </li>
                    <li>
                        <a href="/admin/post-category">
                            <i class="fas fa-tags"></i> Post Categories
                        </a>
                    </li>
                    
                    <li class="nav-heading">History & Billing</li>
                    <li>
                      <a href="/admin/payment_history">
                        <i class="fas fa-file-invoice-dollar"></i> Payment & Invoices
                      </a>
                    </li>
                    <li>
                      <a href="/admin/subscriptions">
                        <i class="fas fa-credit-card"></i> Subscriptions
                      </a>
                    </li>
                    
                    <li class="nav-heading">User Management</li>
                    <li>
                      <a href="/admin/users">
                        <i class="fas fa-users"></i> All Users
                      </a>
                    </li>
                    <li>
                      <a href="/admin/members">
                        <i class="fas fa-user-check"></i> Members
                      </a>
                    </li>
                    <li>
                      <a href="/admin/staff">
                        <i class="fas fa-user-tie"></i> Staff
                      </a>
                    </li>
                    
                </ul>
            </nav>
            <div class="sidebar-footer">
                <a href="/" class="sidebar-link" target="_blank"><i class="fas fa-globe"></i> Open Website</a>
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
                                <span class="profile-name">{{Auth::User()->first_name}}</span>
                                <span class="profile-id">{{Auth::User()->email}}</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="/member/profile"><i class="fas fa-user-circle fa-fw me-2"></i> My Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/member/change_password"><i class="fas fa-key fa-fw me-2"></i> Change Password</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="login"><i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </header>
            <main class="member-content">