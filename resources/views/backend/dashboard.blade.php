@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="page-title">Admin Dashboard</h1>
        <p class="page-subtitle">Overview of system activity.</p>

        <div class="row">
            {{-- Members Card --}}
            <div class="col-md-3 mb-4">
                <div class="card bg-primary text-white shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1">Total Members</h6>
                                <h2 class="mb-0">{{ $totalMembers }}</h2>
                            </div>
                            <i class="fas fa-users fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Food Orders Card --}}
            <div class="col-md-3 mb-4">
                <div class="card bg-success text-white shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1">Total Orders</h6>
                                <h2 class="mb-0">{{ $totalOrders }}</h2>
                            </div>
                            <i class="fas fa-utensils fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pending Orders Card --}}
            <div class="col-md-3 mb-4">
                <div class="card bg-warning text-dark shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1">Pending Orders</h6>
                                <h2 class="mb-0">{{ $pendingOrders }}</h2>
                            </div>
                            <i class="fas fa-clock fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Events Card --}}
            <div class="col-md-3 mb-4">
                <div class="card bg-info text-white shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1">Active Events</h6>
                                <h2 class="mb-0">{{ $totalEvents }}</h2>
                            </div>
                            <i class="fas fa-calendar-alt fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.foodOrders') }}" class="btn btn-outline-primary me-2 mb-2">
                            <i class="fas fa-hamburger me-1"></i> Manage Food Orders
                        </a>
                        <a href="{{ route('admin.eventRegistrations') }}" class="btn btn-outline-info me-2 mb-2">
                            <i class="fas fa-list me-1"></i> View Registrations
                        </a>
                        <a href="{{ route('admin.facilityBookings') }}" class="btn btn-outline-success me-2 mb-2">
                            <i class="fas fa-calendar-check me-1"></i> View Bookings
                        </a>
                        <a href="{{ route('admin.manageEvent') }}" class="btn btn-outline-secondary me-2 mb-2">
                            <i class="fas fa-plus me-1"></i> Add New Event
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection