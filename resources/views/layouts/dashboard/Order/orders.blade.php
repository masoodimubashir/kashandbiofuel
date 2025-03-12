<x-app-layout>

    <style>
        .hide {
            display: none;
        }

        .show {
            display: block;
        }
    </style>

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

                    <div class="list-product-header">
                        <div>
                            <div class="light-box">
                                <a data-bs-toggle="collapse" href="#collapseProduct" role="button"
                                    aria-expanded="false" aria-controls="collapseProduct">
                                    <i class="fa fa-filter"></i>
                                </a>
                            </div>

                        </div>

                        <div class="collapse" id="collapseProduct">
                            <div class="card card-body list-product-body">
                                <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3">

                                    <div class="col">
                                        <select class="form-select product-filter" id="status-select">
                                            <option value="">All Orders</option>
                                            <option value="pending-0">Pending</option>
                                            <option value="cancelled-1">Cancelled</option>
                                            <option value="confirmed-1">Confirmed</option>
                                            <option value="shipped-1">Shipped</option>
                                        </select>
                                    </div>
                                    

                                    <div class="col">
                                        <select class="form-select product-filter" id="price-select">
                                            <option selected value="">Price</option>
                                            <option value="0-1000">0 - 1000</option>
                                            <option value="1001-5000">1001 - 5000</option>
                                            <option value="5001-10000">5001 - 10000</option>
                                            <option value="10001-above">10001 and above</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-block row">

                        <div class="col-sm-12 col-lg-12 col-xl-12">

                            <div class="table-responsive">
                                <table class="table table-md" id="orders">
                                    <thead>
                                        <tr>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date of Purchase</th>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Total Amount</th>
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
            $(document).ready(function() {
                // Load DataTable
                let ordersTable = $('#orders').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('order.index') }}',
                        type: 'GET',
                    },
                    columns: [{
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            sortable: false
                        },
                        {
                            data: 'date_of_purchase',
                            name: 'date_of_purchase'
                        },
                        {
                            data: 'custom_order_id',
                            name: 'custom_order_id'
                        },
                        {
                            data: 'user_name',
                            name: 'user_name'
                        },

                        {
                            data: 'address',
                            name: 'address'
                        },
                        {
                            data: 'total_amount',
                            name: 'total_amount'
                        },
                        {
                            data: 'action',
                            name: 'action',
                        }

                    ]
                });

                $(document).on('change', '.changeStatus', function() {

                    let updateField = $(this).val();
                    let orderId = $(this).data('id');

                    $.ajax({
                        url: `/admin/order/${orderId}`,
                        type: 'PUT',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            field: updateField,
                            value: 1
                        },
                        success: function(response) {
                            if (response.status) {
                                ordersTable.ajax.reload(null, false);
                                if (response.redirect_url) {
                                    window.location.href = response.redirect_url;
                                } else {
                                    Swal.fire("Success!", response.message, "success");

                                }
                            } else {
                                Swal.fire("Error!", response.message || 'Failed To Update Status',
                                    "error");
                            }
                        },
                        error: function(err) {
                            Swal.fire("Error!", 'An error occurred', "error");
                        }
                    });
                });


                $('.product-filter').on('change', function() {
                    ordersTable.ajax.url('{{ route('order.index') }}?' + $.param({
                        price_range: $('#price-select').val(),
                        status: $('#status-select').val()
                    })).load();
                });

                $('.light-box a').on('click', function(event) {
                    console.log(event);

                    $('.filter-icon').toggleClass('show hide');
                    $('.filter-close').toggleClass('show hide');
                });

                // Toggle add product button visibility
                $('.light-box a').on('click', function() {
                    $('.btn-primary').toggleClass('d-none');
                });

            });
        </script>
    @endpush
</x-app-layout>
