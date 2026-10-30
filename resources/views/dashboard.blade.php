@extends('layouts.sidebar.master')

@section('title', 'ELMS | Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="p-4 mb-4 rounded-4 text-white"
    style="background:linear-gradient(120deg,#173b70,#347fbd);">
    <h2 class="fw-bold">Welcome to ELMS!</h2>
    <p class="mb-0">
        Manage employees and leave activities from one central workspace.
    </p>
</div>

<h5 class="fw-bold mb-3">System Overview</h5>

<div class="row g-3 mb-4">

    <div class="col-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <i class="bi bi-people-fill fs-3 text-primary"></i>
                <h2 class="fw-bold mt-3">{{ $totalEmployees ?? 0 }}</h2>
                <div class="text-secondary">Total Employees</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <i class="bi bi-calendar2-week fs-3 text-warning"></i>
                <h2 class="fw-bold mt-3">{{ $totalLeaveApplications ?? 0 }}</h2>
                <div class="text-secondary">Leave Applications</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <i class="bi bi-hourglass-split fs-3 text-info"></i>
                <h2 class="fw-bold mt-3">{{ $pendingApprovals ?? 0 }}</h2>
                <div class="text-secondary">Pending Approvals</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <i class="bi bi-check-circle-fill fs-3 text-success"></i>
                <h2 class="fw-bold mt-3">{{ $approvedLeaves ?? 0 }}</h2>
                <div class="text-secondary">Approved Leaves</div>
            </div>
        </div>
    </div>

</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <h5 class="fw-bold">Getting Started</h5>
        <p class="text-secondary mb-3">
            Start by registering employees in the system.
        </p>

        <a href="{{ route('conference.employees.create') }}"
            class="btn btn-primary">
            <i class="bi bi-person-plus-fill me-1"></i>
            Add First Employee
        </a>
    </div>
</div>

@endsection