<x-app-layout>

    <style>
        .hide {
            display: none;
        }

        .show {
            display: block;
        }
    </style>

  

    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Refunds</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item {{ Request::routeIs('refund.index') ? 'active' : '' }}">
                        Refunds
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
                                <table class="table table-md" id="refunds">
                                    <thead>
                                        <tr>
                                            <th scope="col">Status</th>
                                            <th scope="col">Refund ID</th>
                                            <th scope="col">Phone Refund Id</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Refund Initiated</th>
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
            $(document).ready(function() {
                // Load DataTable
                let refundsTable = $('#refunds').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('refund.index') }}',
                        type: 'GET',
                    },
                    columns: [
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            sortable: false
                        },
                        {
                            data: 'refund_id',
                            name: 'refund_id'
                        },
                        {
                            data: 'phonepe_refund_id',
                            name: 'phonepe_refund_id'
                        },
                        {
                            data: 'amount',
                            name: 'amount'
                        },
                        {
                            data: 'refund_initiated_at',
                            name: 'refund_initiated_at'
                        },
                       
                    ]
                });

                $(document).on('change', '.changeStatus', function() {
                    let updateField = $(this).val();
                    let refundId = $(this).data('id');

                    $.ajax({
                        url: `/admin/refund/${refundId}`,
                        type: 'PUT',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            field: updateField,
                            value: 1
                        },
                        success: function(response) {
                            if (response.status) {
                                refundsTable.ajax.reload(null, false);
                                if (response.redirect_url) {
                                    window.location.href = response.redirect_url;
                                } else {
                                    Swal.fire("Success!", response.message, "success");
                                }
                            } else {
                                Swal.fire("Error!", response.message || 'Failed To Update Status', "error");
                            }
                        },
                        error: function(err) {
                            Swal.fire("Error!", 'An error occurred', "error");
                        }
                    });
                });

                $('.refund-filter').on('change', function() {
                    refundsTable.ajax.url('{{ route('refund.index') }}?' + $.param({
                        amount_range: $('#amount-select').val(),
                        status: $('#status-select').val()
                    })).load();
                });

                $('.light-box a').on('click', function() {
                    $('.filter-icon').toggleClass('show hide');
                    $('.filter-close').toggleClass('show hide');
                });

                // Toggle add refund button visibility
                $('.light-box a').on('click', function() {
                    $('.btn-primary').toggleClass('d-none');
                });

            });
        </script>
    @endpush
</x-app-layout>
