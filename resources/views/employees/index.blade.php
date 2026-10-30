<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Management | ELMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Employee Management</h2>
                <p class="text-secondary mb-0">
                    Register and manage employee records.
                </p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ url('/conferences/dashboard') }}"
                    class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Dashboard
                </a>

                <a href="{{ route('conference.employees.create') }}"
                    class="btn btn-primary">
                    <i class="bi bi-person-plus-fill"></i> Add Employee
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">

                <div class="p-3 border-bottom">
                    <h5 class="mb-0 fw-semibold">
                        Registered Employees ({{ $employees->count() }})
                    </h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Employee No.</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employee->employee_number }}</td>
                                <td>
                                    {{ $employee->first_name }}
                                    {{ $employee->middle_name }}
                                    {{ $employee->last_name }}
                                </td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->department }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>
                                    @if($employee->employment_status === 'active')
                                    <span class="badge bg-success-subtle text-success">
                                        Active
                                    </span>
                                    @else
                                    <span class="badge bg-secondary-subtle text-secondary">
                                        Inactive
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-people fs-1 text-secondary"></i>
                                    <p class="fw-semibold mt-2 mb-1">
                                        No employees registered yet
                                    </p>
                                    <p class="text-secondary small">
                                        Select Add Employee to register your first employee.
                                    </p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>