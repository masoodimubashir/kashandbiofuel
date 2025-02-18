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
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
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
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },

                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'address',
                            name: 'address'
                        },
                    ]
                });


            });
        </script>
    @endpush


</x-app-layout>
