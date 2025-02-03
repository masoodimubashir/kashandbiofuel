<x-app-layout>


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
                    <li class="breadcrumb-item {{ Request::routeIs('coupons.index') ? 'active' : '' }}">Coupons</li>
                </ol>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Top Controls Section -->
        <div class="row mb-3">
            <div class="col-md-6 col-sm-12 mb-2 mb-md-0">
                <button class="btn btn-success" type="button" data-bs-toggle="modal" id="createCouponBtn"
                        data-bs-target=".bd-example-modal-lg">
                    Add Coupon
                </button>
            </div>
        </div>

        <!-- Table Section -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card p-3">
                    <div class="card-block row">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-md" id="user">
                                    <thead>
                                    <tr>
                                        <th scope="col">Email</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Created At</th>
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
            $(document).ready(function () {
                // Initialize DataTable
                let users = $('#user').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/admin/users',
                    columns: [
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'message',
                            name: 'message'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                    ]
                });


            });
        </script>
    @endpush


</x-app-layout>
