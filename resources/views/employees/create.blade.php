<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Employee | ELMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="mb-4">
            <a href="{{ route('conference.employees.index') }}"
                class="text-decoration-none">
                <i class="bi bi-arrow-left"></i> Back to Employees
            </a>

            <h2 class="fw-bold mt-3 mb-1">Register New Employee</h2>
            <p class="text-secondary">
                Enter the employee's information below.
            </p>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Please correct the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('conference.employees.store') }}"
                    method="POST">

                    @csrf

                    <h5 class="fw-semibold mb-3">Personal Information</h5>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Employee Number *</label>
                            <input type="text" name="employee_number"
                                class="form-control"
                                value="{{ old('employee_number') }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">First Name *</label>
                            <input type="text" name="first_name"
                                class="form-control"
                                value="{{ old('first_name') }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middle_name"
                                class="form-control"
                                value="{{ old('middle_name') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Last Name *</label>
                            <input type="text" name="last_name"
                                class="form-control"
                                value="{{ old('last_name') }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email"
                                class="form-control"
                                value="{{ old('email') }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone"
                                class="form-control"
                                value="{{ old('phone') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">Select Gender</option>
                                <option value="Male" @selected(old('gender')==='Male' )>Male</option>
                                <option value="Female" @selected(old('gender')==='Female' )>Female</option>
                                <option value="Other" @selected(old('gender')==='Other' )>Other</option>
                            </select>
                        </div>

                    </div>

                    <hr class="my-4">

                    <h5 class="fw-semibold mb-3">Employment Information</h5>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Department *</label>
                            <input type="text" name="department"
                                class="form-control"
                                value="{{ old('department') }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Position *</label>
                            <input type="text" name="position"
                                class="form-control"
                                value="{{ old('position') }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Employment Date</label>
                            <input type="date" name="employment_date"
                                class="form-control"
                                value="{{ old('employment_date') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Employment Status *</label>
                            <select name="employment_status"
                                class="form-select" required>
                                <option value="active"
                                    @selected(old('employment_status', 'active' )==='active' )>
                                    Active
                                </option>
                                <option value="inactive"
                                    @selected(old('employment_status')==='inactive' )>
                                    Inactive
                                </option>
                            </select>
                        </div>

                    </div>

                    <hr class="my-4">

                    <div class="d-flex flex-wrap gap-2 justify-content-end">
                        <a href="{{ route('conference.employees.index') }}"
                            class="btn btn-light border">
                            Cancel
                        </a>

                        <button type="reset" class="btn btn-outline-secondary">
                            Reset
                        </button>

                        <button type="submit" class="btn btn-primary px-4">
                            Save Employee
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</body>

</html>