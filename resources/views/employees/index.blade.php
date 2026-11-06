@extends('layouts.sidebar.master')

@section('title', 'ELMS | Employee Management')
@section('page-title', 'Employee Management')

@section('module-tabs')
<a href="{{ route('conference.employees.index') }}" class="active">
    <i class="bi bi-people me-1"></i> All Employees
</a>

<a href="{{ route('conference.employees.index', ['openAddEmployee' => 1]) }}">
    <i class="bi bi-person-plus me-1"></i> Add Employee
</a>
@endsection

@push('styles')
<style>
    .employee-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .employee-page-header h4 {
        font-weight: 700;
        color: #26364a;
        margin-bottom: 5px;
    }

    .employee-page-header p {
        color: #7b8794;
        margin-bottom: 0;
        font-size: 14px;
    }

    .employee-table-card {
        border: 0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0, 0, 0, .05);
    }

    .employee-table-card .card-header {
        background: #fff;
        padding: 18px 20px;
        border-bottom: 1px solid #edf0f4;
    }

    .employee-table thead th {
        background: #f8fafc;
        color: #526174;
        font-size: 12px;
        text-transform: uppercase;
        white-space: nowrap;
        padding: 14px;
    }

    .employee-table tbody td {
        padding: 14px;
        font-size: 13px;
        color: #475569;
        vertical-align: middle;
    }

    .employee-table tbody tr:hover {
        background: #f8fafc;
    }

    .employee-modal .modal-header {
        background: #173b70;
        color: #fff;
    }

    .employee-modal .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .employee-modal .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #475569;
    }

    .employee-modal .form-control,
    .employee-modal .form-select {
        min-height: 42px;
        font-size: 13px;
    }

    .employee-modal .modal-footer {
        background: #f8fafc;
    }

    #employeeFormModal .modal-dialog {
        max-height: calc(100vh - 2rem);
    }

    #employeeFormModal .modal-content {
        max-height: calc(100vh - 2rem);
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    #employeeFormModal .modal-content form {
        display: flex;
        flex-direction: column;
        flex: 1 1 auto;
        min-height: 0;
        overflow: hidden;
    }

    #employeeFormModal .modal-body {
        flex: 1 1 auto;
        min-height: 0;
        overflow-y: auto;
    }

    #employeeFormModal .modal-footer {
        flex-shrink: 0;
    }

    .employee-actions {
        display: flex;
        gap: 5px;
        white-space: nowrap;
    }

    .employee-actions .btn {
        width: 30px;
        height: 30px;
        padding: 0;
        display: inline-flex;
        justify-content: center;
        align-items: center;
    }

    .view-detail-label {
        font-size: 12px;
        color: #8793a1;
        margin-bottom: 4px;
    }

    .view-detail-value {
        font-size: 14px;
        font-weight: 600;
        color: #344256;
        margin-bottom: 16px;
        overflow-wrap: anywhere;
    }

    #employeesTable_wrapper {
        padding: 15px;
    }

    #employeesTable_wrapper .dataTables_filter input,
    #employeesTable_wrapper .dataTables_length select {
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 5px 9px;
    }

    #employeesTable_wrapper .dataTables_filter input:focus,
    #employeesTable_wrapper .dataTables_length select:focus {
        outline: none;
        border-color: #86b7fe;
        box-shadow: 0 0 0 .15rem rgba(13, 110, 253, .15);
    }

    #employeesTable_wrapper .dataTables_info,
    #employeesTable_wrapper .dataTables_paginate {
        font-size: 13px;
        margin-top: 12px;
    }
</style>
@endpush

@section('content')

<div id="employeePage"
    data-data-url="{{ route('conference.employees.data') }}"
    data-store-url="{{ route('conference.employees.store') }}"
    data-employee-base="{{ url('/conferences/employees') }}"
    data-open-add-modal="{{ request()->query('openAddEmployee') == '1' ? 1 : 0 }}">
    
    <!-- PAGE HEADER -->
    <div class="employee-page-header">
        <div>
            <h4>Employee Management</h4>
            <p>Register and manage employee records.</p>
        </div>

        <button type="button" class="btn btn-primary" id="btnAddEmployee">
            <i class="bi bi-person-plus-fill me-1"></i>
            Add Employee
        </button>
    </div>

    <!-- EMPLOYEE TABLE -->
    <div class="card employee-table-card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0">Registered Employees</h6>

            <span class="badge bg-primary-subtle text-primary" id="employeeCount">
                0 Employees
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">

                <table id="employeesTable"
                    class="table table-hover align-middle mb-0 employee-table"
                    style="width:100%">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee No.</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody></tbody>

                </table>

            </div>
        </div>
    </div>

</div>


<!-- ADD / EDIT EMPLOYEE MODAL -->
<div class="modal fade employee-modal"
    id="employeeFormModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content border-0 shadow">

            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-bold" id="employeeFormModalLabel">
                        <i class="bi bi-person-plus-fill me-2"></i>
                        Register New Employee
                    </h5>

                    <small class="text-white-50" id="employeeFormSubtitle">
                        Enter employee information below.
                    </small>
                </div>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"></button>
            </div>

            <form id="employeeForm" method="POST">

                @csrf

                <div class="modal-body p-4">

                    <h6 class="fw-bold text-primary mb-3">
                        <i class="bi bi-person-lines-fill me-1"></i>
                        Personal Information
                    </h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">
                                Employee Number <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="employee_number"
                                class="form-control" placeholder="e.g. EMP001" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                First Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="first_name"
                                class="form-control" placeholder="Enter first name" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middle_name"
                                class="form-control" placeholder="Enter middle name">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                Last Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="last_name"
                                class="form-control" placeholder="Enter last name" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                Email Address <span class="text-danger">*</span>
                            </label>
                            <input type="email" name="email"
                                class="form-control" placeholder="example@company.com" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone"
                                class="form-control" placeholder="Enter phone number">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>

                    </div>

                    <hr class="my-4">

                    <h6 class="fw-bold text-primary mb-3">
                        <i class="bi bi-briefcase-fill me-1"></i>
                        Employment Information
                    </h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">
                                Department <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="department"
                                class="form-control" placeholder="Enter department" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                Position <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="position"
                                class="form-control" placeholder="Enter position" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Employment Date</label>
                            <input type="date" name="employment_date" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                Employment Status <span class="text-danger">*</span>
                            </label>
                            <select name="employment_status" class="form-select" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>

                    </div>

                    <p class="text-secondary small mt-3 mb-0">
                        <span class="text-danger">*</span> Required fields
                    </p>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-light border"
                        data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </button>

                    <button type="submit" class="btn btn-primary" id="btnSaveEmployee">
                        <i class="bi bi-save me-1"></i>
                        Save Employee
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>


<!-- VIEW EMPLOYEE MODAL -->
<div class="modal fade employee-modal"
    id="viewEmployeeModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-person-vcard me-2"></i>
                        Employee Details
                    </h5>
                    <small class="text-white-50">
                        Complete employee information.
                    </small>
                </div>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">

                <h6 class="fw-bold text-primary mb-3">
                    Personal Information
                </h6>

                <div class="row">
                    <div class="col-md-6">
                        <div class="view-detail-label">Employee Number</div>
                        <div class="view-detail-value" id="view_employee_number">-</div>
                    </div>

                    <div class="col-md-6">
                        <div class="view-detail-label">Full Name</div>
                        <div class="view-detail-value" id="view_full_name">-</div>
                    </div>

                    <div class="col-md-6">
                        <div class="view-detail-label">Email Address</div>
                        <div class="view-detail-value" id="view_email">-</div>
                    </div>

                    <div class="col-md-6">
                        <div class="view-detail-label">Phone Number</div>
                        <div class="view-detail-value" id="view_phone">-</div>
                    </div>

                    <div class="col-md-6">
                        <div class="view-detail-label">Gender</div>
                        <div class="view-detail-value" id="view_gender">-</div>
                    </div>
                </div>

                <hr>

                <h6 class="fw-bold text-primary mb-3">
                    Employment Information
                </h6>

                <div class="row">
                    <div class="col-md-6">
                        <div class="view-detail-label">Department</div>
                        <div class="view-detail-value" id="view_department">-</div>
                    </div>

                    <div class="col-md-6">
                        <div class="view-detail-label">Position</div>
                        <div class="view-detail-value" id="view_position">-</div>
                    </div>

                    <div class="col-md-6">
                        <div class="view-detail-label">Employment Date</div>
                        <div class="view-detail-value" id="view_employment_date">-</div>
                    </div>

                    <div class="col-md-6">
                        <div class="view-detail-label">Employment Status</div>
                        <div class="view-detail-value" id="view_employment_status">-</div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light border"
                    data-bs-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>

@endsection


@push('scripts')
<script>
    $(document).ready(function() {

        // URLs kutoka Laravel routes
        const page = $('#employeePage');
        const dataUrl = page.data('data-url');
        const storeUrl = page.data('store-url');
        const employeeBase = page.data('employee-base');

        const formModalElement = document.getElementById('employeeFormModal');
        const viewModalElement = document.getElementById('viewEmployeeModal');

        const formModal = bootstrap.Modal.getOrCreateInstance(formModalElement);
        const viewModal = bootstrap.Modal.getOrCreateInstance(viewModalElement);

        const employeeForm = $('#employeeForm');

        let employeeTable;


        // CSRF TOKEN
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                'Accept': 'application/json'
            }
        });


        // ESCAPE HTML TO PREVENT HTML INJECTION
        function escapeHtml(value) {
            return $('<div>').text(value ?? '').html();
        }


        // CLEAR VALIDATION ERRORS
        function clearValidationErrors() {

            employeeForm.find('.is-invalid').removeClass('is-invalid');

            employeeForm.find('.invalid-feedback').text('');

        }


        // DISPLAY VALIDATION ERRORS
        function showValidationErrors(errors) {

            clearValidationErrors();

            let messages = [];

            $.each(errors, function(field, fieldErrors) {

                const input = employeeForm.find('[name="' + field + '"]');

                input.addClass('is-invalid');

                input.next('.invalid-feedback').text(fieldErrors[0]);

                messages.push(fieldErrors[0]);

            });

            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: messages.map(message => escapeHtml(message)).join('<br>')
            });
        }


        // RESET FORM TO ADD MODE
        function resetEmployeeForm() {

            employeeForm[0].reset();

            clearValidationErrors();

            employeeForm.find('[name="employment_status"]').val('active');

            $('#employeeFormModalLabel').html(
                '<i class="bi bi-person-plus-fill me-2"></i> Register New Employee'
            );

            $('#employeeFormSubtitle').text(
                'Enter employee information below.'
            );

            $('#btnSaveEmployee').html(
                '<i class="bi bi-save me-1"></i> Save Employee'
            );

            employeeForm.attr('data-mode', 'create');

            employeeForm.removeAttr('data-id');

        }


        // OPEN ADD EMPLOYEE MODAL
        $('#btnAddEmployee').on('click', function() {

            resetEmployeeForm();

            formModal.show();

        });


        // INITIALIZE DATATABLE
        employeeTable = $('#employeesTable').DataTable({

            processing: true,

            ajax: {
                url: dataUrl,
                type: 'GET',
                dataSrc: 'data'
            },

            columns: [

                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

                {
                    data: 'employee_number',
                    render: function(data) {
                        return '<span class="fw-semibold">' +
                            escapeHtml(data) + '</span>';
                    }
                },

                {
                    data: null,
                    render: function(data, type, row) {

                        let fullName = [
                            row.first_name,
                            row.middle_name,
                            row.last_name
                        ].filter(Boolean).join(' ');

                        return escapeHtml(fullName);
                    }
                },

                {
                    data: 'email',
                    render: function(data) {
                        return escapeHtml(data);
                    }
                },

                {
                    data: 'department',
                    render: function(data) {
                        return escapeHtml(data);
                    }
                },

                {
                    data: 'position',
                    render: function(data) {
                        return escapeHtml(data);
                    }
                },

                {
                    data: 'employment_status',
                    render: function(data) {

                        if (data === 'active') {
                            return '<span class="badge bg-success-subtle text-success">Active</span>';
                        }

                        return '<span class="badge bg-secondary-subtle text-secondary">Inactive</span>';
                    }
                },

                {
                    data: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(id) {

                        return `
                        <div class="employee-actions">

                            <button type="button"
                                class="btn btn-sm btn-outline-info btn-view-employee"
                                data-id="${id}" title="View">
                                <i class="bi bi-eye"></i>
                            </button>

                            <button type="button"
                                class="btn btn-sm btn-outline-primary btn-edit-employee"
                                data-id="${id}" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <button type="button"
                                class="btn btn-sm btn-outline-danger btn-delete-employee"
                                data-id="${id}" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>

                        </div>
                    `;
                    }
                }

            ],

            pageLength: 10,

            lengthMenu: [10, 25, 50, 100],

            order: [
                [1, 'asc']
            ],

            language: {
                emptyTable: 'No employees registered yet.',
                zeroRecords: 'No matching employees found.',
                search: 'Search:',
                lengthMenu: 'Show _MENU_ employees',
                info: 'Showing _START_ to _END_ of _TOTAL_ employees',
                infoEmpty: 'Showing 0 employees',
                processing: 'Loading employees...'
            },

            drawCallback: function() {

                const count = this.api().page.info().recordsTotal;

                $('#employeeCount').text(count + ' Employees');

            }

        });


        // ADD OR UPDATE EMPLOYEE
        employeeForm.on('submit', function(e) {

            e.preventDefault();

            clearValidationErrors();

            const mode = employeeForm.attr('data-mode');

            const employeeId = employeeForm.attr('data-id');

            const url = mode === 'edit' ?
                employeeBase + '/' + employeeId :
                storeUrl;

            const method = mode === 'edit' ? 'PUT' : 'POST';

            const saveButton = $('#btnSaveEmployee');

            saveButton.prop('disabled', true);

            saveButton.html(
                '<span class="spinner-border spinner-border-sm me-1"></span> Processing...'
            );

            $.ajax({

                url: url,

                type: method,

                data: employeeForm.serialize(),

                success: function(response) {

                    formModal.hide();

                    employeeForm[0].reset();

                    employeeTable.ajax.reload(null, false);

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                },

                error: function(xhr) {

                    if (xhr.status === 422 && xhr.responseJSON.errors) {

                        showValidationErrors(xhr.responseJSON.errors);

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Operation Failed',
                            text: xhr.responseJSON?.message ||
                                'Something went wrong. Please try again.'
                        });

                    }

                },

                complete: function() {

                    saveButton.prop('disabled', false);

                    if (mode === 'edit') {
                        saveButton.html(
                            '<i class="bi bi-check-circle me-1"></i> Update Employee'
                        );
                    } else {
                        saveButton.html(
                            '<i class="bi bi-save me-1"></i> Save Employee'
                        );
                    }

                }

            });

        });


        // VIEW EMPLOYEE
        $('#employeesTable').on('click', '.btn-view-employee', function() {

            const id = $(this).data('id');

            $.ajax({

                url: employeeBase + '/' + id,

                type: 'GET',

                success: function(response) {

                    const employee = response.data;

                    const fullName = [
                        employee.first_name,
                        employee.middle_name,
                        employee.last_name
                    ].filter(Boolean).join(' ');

                    $('#view_employee_number').text(employee.employee_number || '-');

                    $('#view_full_name').text(fullName || '-');

                    $('#view_email').text(employee.email || '-');

                    $('#view_phone').text(employee.phone || '-');

                    $('#view_gender').text(employee.gender || '-');

                    $('#view_department').text(employee.department || '-');

                    $('#view_position').text(employee.position || '-');

                    $('#view_employment_date').text(employee.employment_date || '-');

                    $('#view_employment_status').text(
                        employee.employment_status === 'active' ? 'Active' : 'Inactive'
                    );

                    viewModal.show();

                },

                error: function() {

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Unable to retrieve employee information.'
                    });

                }

            });

        });


        // EDIT EMPLOYEE
        $('#employeesTable').on('click', '.btn-edit-employee', function() {

            const id = $(this).data('id');

            resetEmployeeForm();

            $.ajax({

                url: employeeBase + '/' + id,

                type: 'GET',

                success: function(response) {

                    const employee = response.data;

                    employeeForm.attr('data-mode', 'edit');

                    employeeForm.attr('data-id', employee.id);

                    employeeForm.find('[name="employee_number"]').val(employee.employee_number);

                    employeeForm.find('[name="first_name"]').val(employee.first_name);

                    employeeForm.find('[name="middle_name"]').val(employee.middle_name);

                    employeeForm.find('[name="last_name"]').val(employee.last_name);

                    employeeForm.find('[name="email"]').val(employee.email);

                    employeeForm.find('[name="phone"]').val(employee.phone);

                    employeeForm.find('[name="gender"]').val(employee.gender);

                    employeeForm.find('[name="department"]').val(employee.department);

                    employeeForm.find('[name="position"]').val(employee.position);

                    employeeForm.find('[name="employment_date"]').val(
                        employee.employment_date ?
                        employee.employment_date.substring(0, 10) :
                        ''
                    );

                    employeeForm.find('[name="employment_status"]').val(
                        employee.employment_status
                    );

                    $('#employeeFormModalLabel').html(
                        '<i class="bi bi-pencil-square me-2"></i> Edit Employee'
                    );

                    $('#employeeFormSubtitle').text(
                        'Update employee information below.'
                    );

                    $('#btnSaveEmployee').html(
                        '<i class="bi bi-check-circle me-1"></i> Update Employee'
                    );

                    formModal.show();

                },

                error: function() {

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Unable to load employee information.'
                    });

                }

            });

        });


        // DELETE EMPLOYEE
        $('#employeesTable').on('click', '.btn-delete-employee', function() {

            const id = $(this).data('id');

            Swal.fire({

                title: 'Delete Employee?',

                text: 'This action will remove this employee record.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#dc3545',

                cancelButtonColor: '#6c757d',

                confirmButtonText: 'Yes, Delete',

                cancelButtonText: 'Cancel'

            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({

                        url: employeeBase + '/' + id,

                        type: 'DELETE',

                        success: function(response) {

                            employeeTable.ajax.reload(null, false);

                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });

                        },

                        error: function(xhr) {

                            Swal.fire({
                                icon: 'error',
                                title: 'Delete Failed',
                                text: xhr.responseJSON?.message ||
                                    'Unable to delete this employee.'
                            });

                        }

                    });

                }

            });

        });


        // RESET FORM WHEN MODAL IS CLOSED
        $('#employeeFormModal').on('hidden.bs.modal', function() {

            resetEmployeeForm();

        });


        // OPEN ADD MODAL WHEN URL HAS ?openAddEmployee=1
        if ($('#employeePage').data('open-add-modal') === 1) {

            resetEmployeeForm();

            formModal.show();

        }
    });
</script>
@endpush