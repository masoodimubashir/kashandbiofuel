<x-app-layout>

    <!-- Large modal-->
    <div class="modal fade bd-example-modal-lg" id="userModal" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Add New User</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="userForm">
                    <div class="modal-body">
                        <!-- Hidden input for user ID (used in edit mode) -->
                        <input type="hidden" id="user_id" name="user_id">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="Present">Present</option>
                                <option value="On leave">On leave</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="hours" class="form-label">Hours</label>
                            <input type="number" class="form-control" id="hours" name="hours" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="performance" class="form-label">Performance</label>
                            <input type="text" class="form-control" id="performance" name="performance" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>
                    Users
                </h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item {{ Request::routeIs('customers.index') ? 'active' : '' }}">Users</li>

                </ol>
            </div>
        </div>
    </x-slot>
    <div class="container-fluid">
        <!-- Top Controls Section -->
        <div class="row mb-3">
            <div class="col-md-6 col-sm-12 mb-2 mb-md-0">
                <button class="btn btn-success" type="button" data-bs-toggle="modal"
                    data-bs-target=".bd-example-modal-lg">
                    Add New
                </button>
            </div>

        </div>

        <!-- Table Section -->
        <div class="row">
            <div class="col-sm-12 ">
                <div class="card  p-3">

                    <div class="card-block row">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-md" id="userTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">name</th>
                                            <th scope="col">email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('dashboard.script')
        <script>
            // Add this to your layout or create a new JS file
            $(document).ready(function() {
                // Load DataTable
                let userTable = $('#userTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/admin/customers',
                        type: 'GET',
                    },
                    columns: [
                        {
                            data: 'created_at',
                            name: 'created_at',
                        },

                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                     
                    ]
                });
            
            });
        </script>
    @endpush


</x-app-layout>
