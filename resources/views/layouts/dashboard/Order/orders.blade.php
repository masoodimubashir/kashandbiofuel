<x-app-layout>
    <!-- Large modal -->
    <div class="modal fade bd-example-modal-lg" id="orderModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Order Details</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="orderDetails">
                        <!-- Details will be dynamically loaded -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Orders</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i data-feather="home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item {{ Request::routeIs('order.index') ? 'active' : '' }}">
                        Orders
                    </li>
                </ol>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Table Section -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card p-3">
                    <div class="card-block row">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-md" id="orders">
                                    <thead>
                                    <tr>
                                        <th scope="col">Date of Purchase</th>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Transaction ID</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- Content injected via DataTable -->
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
                // Load DataTable
                let ordersTable = $('#orders').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route("order.index") }}',
                        type: 'GET',
                    },
                    columns: [
                        {data: 'date_of_purchase', name: 'date_of_purchase'},
                        {data: 'custom_order_id', name: 'custom_order_id'},
                        {data: 'user_name', name: 'user_name'},
                        {data: 'transaction_id', name: 'transaction_id'},
                        {data: 'address', name: 'address'},
                        {data: 'total_amount', name: 'total_amount'},
                        {data: 'status', name: 'status', orderable: false, sortable: false},
                    ]
                });

                $(document).on('change', '.changeStatus', function () {
                    // Get the selected field and order ID
                    let updateField = $(this).val(); // Get the selected option's value (is_cancelled, is_delivered, is_confirmed)
                    let orderId = $(this).data('id'); // Get the order ID from data-id attribute

                    // Prepare the AJAX request
                    $.ajax({
                        url: `/admin/order/${orderId}`,
                        type: 'PUT',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'), // CSRF Token
                            field: updateField, // Which field to activate
                            value: 1 // Always set the field to active (1)
                        },
                        success: function (response) {
                            if (response.success) {
                                // Reload the DataTable
                                ordersTable.ajax.reload(null, false); // Do not reset paging
                                Swal.fire("Success!", response.message || 'Status updated successfully', "success");
                            } else {
                                Swal.fire("Error!", response.message || 'Failed To Update Status', "error");
                            }
                        },
                        error: function (err) {
                            Swal.fire("Error!", 'An error occurred', "error");
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
