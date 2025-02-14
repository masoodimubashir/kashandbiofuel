<x-app-layout>

    <!-- Large modal-->
    <div class="modal fade bd-example-modal-lg" id="couponModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Add New Coupon</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="couponForm" class="row g-3 p-4">
                    @csrf
                    <input type="hidden" id="couponId" name="id">

                    <div class="col-md-6">
                        <label class="form-label" for="coupon_code">Coupon Code</label>
                        <input class="form-control" id="coupon_code" name="coupon_code" type="text">
                        <div class="invalid-feedback">Please enter a valid coupon code</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="coupon_type">Coupon Type</label>
                        <select class="form-control" id="coupon_type" name="coupon_type">
                            <option value="">Select Type</option>
                            <option value="1">Percentage</option>
                            <option value="2">Fixed Amount</option>
                        </select>
                        <div class="invalid-feedback">Please select a coupon type</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="discount_value">Discount Value</label>
                        <input class="form-control" id="discount_value" name="discount_value" type="text">
                        <div class="invalid-feedback">Please enter a valid discount value</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="end_date">End Date</label>
                        <input class="form-control" id="end_date" name="end_date" type="date">
                        <div class="invalid-feedback">Please select an end date</div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit" id="submitBtn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>
                    Coupons
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
                                <table class="table table-md" id="coupon">
                                    <thead>
                                        <tr>
                                            <th scope="col">Coupon Code</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Discount Value</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
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
                // Initialize DataTable
                let couponTable = $('#coupon').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/admin/coupons',
                    columns: [{
                            data: 'coupon_code',
                            name: 'coupon_code'
                        },
                        {
                            data: 'coupon_type',
                            name: 'coupon_type'
                        },
                        {
                            data: 'discount_value',
                            name: 'discount_value'
                        },

                        {
                            data: 'end_date',
                            name: 'end_date'
                        },
                      
                        {
                            data: 'status',
                            name: 'status',
                            sortable: false,
                            orderable: false,

                        },
                        {
                            data: 'action',
                            name: 'action',
                            sortable: false,
                            orderable: false,

                        }
                    ]
                });

                // Create/Edit Coupon - Open Modal
                $('#createCouponBtn').on('click', function() {
                    resetForm();
                    $('#couponModal').modal('show');
                });

                $(document).on('click', '.editBtn', function() {
                    var couponId = $(this).data('id');
                    $.ajax({
                        url: '/admin/coupons/' + couponId,
                        type: 'GET',
                        success: function(response) {
                            if (response.status === 'success') {
                                $('#coupon_code').val(response.coupon.coupon_code);
                                $('#coupon_type').val(response.coupon.coupon_type);
                                $('#discount_value').val(response.coupon.discount_value);
                                $('#end_date').val(response.coupon.end_date);
                                $('#status').prop('checked', response.coupon.status === 1);
                                $('#couponId').val(response.coupon.id);
                                $('#couponModal').modal('show');
                            } else {
                                Swal.fire('Error!', 'Coupon data not found.', 'error');
                            }
                        }
                    });
                });

                // Handle Coupon Form Submission (Create or Update)
                $('#couponForm').on('submit', function(e) {
                    e.preventDefault();
                    clearValidationErrors();

                    const formData = {
                        coupon_code: $('#coupon_code').val(),
                        coupon_type: $('#coupon_type').val(),
                        discount_value: $('#discount_value').val(),
                        end_date: $('#end_date').val(),
                        status: $('#status').prop('checked') ? 1 : 0,
                        _token: $('input[name="_token"]').val()
                    };

                    // if (validateForm(formData)) return;

                    const couponId = $('#couponId').val();
                    const isUpdate = couponId !== '';
                    const url = isUpdate ? '/admin/coupons/' + couponId : '/admin/coupons';
                    const method = isUpdate ? 'PUT' : 'POST';

                    $.ajax({
                        url: url,
                        type: method,
                        data: formData,
                        success: function(response) {
                            if (response.status === 'success') {
                                resetForm();
                                $('#couponModal').modal('hide');
                                couponTable.ajax.reload(null, false);
                                Swal.fire('Success!', response.message, 'success');
                            } else {
                                Swal.fire('Error!', response.message || 'Something went wrong.',
                                    'error');
                            }
                        },
                        error: function(xhr) {
                            handleFormError(xhr);
                        }
                    });
                });

                // Handle Delete button click
                $(document).on('click', '.deleteBtn', function() {
                    var couponId = $(this).data('id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action cannot be undone.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/admin/coupons/' + couponId,
                                type: 'DELETE',
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    Swal.fire('Deleted!', 'The coupon has been deleted.',
                                        'success');
                                    couponTable.ajax.reload(null, false);
                                },
                                error: function() {
                                    Swal.fire('Error!', 'Failed to delete coupon.',
                                        'error');
                                }
                            });
                        }
                    });
                });

                // Handle checkbox toggle (status change)
                $(document).on('change', '.changeStatus', function() {
                    var couponId = $(this).attr('id').replace('cb_', '');
                    var newStatus = $(this).prop('checked') ? 1 : 0;
                    $.ajax({
                        url: '/admin/update-status/' + couponId,
                        type: 'PUT',
                        data: {
                            status: newStatus,
                            model: 'Coupon',
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                couponTable.ajax.reload(null, false);
                            } else {
                                Swal.fire('Error!', 'Failed to update status.', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Something went wrong while updating status.',
                                'error');
                        }
                    });
                });

                // Add real-time validation
                // $('#coupon_code, #coupon_type, #discount_value').on('input', function() {
                //     if ($(this).val().trim()) {
                //         $(this).removeClass('is-invalid').siblings('.invalid-feedback').hide();
                //     }
                // });

                // Reset the form
                function resetForm() {
                    $('#couponForm')[0].reset();
                    $('#couponId').val('');
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').hide();
                }

                // Clear validation errors
                function clearValidationErrors() {
                    $('.invalid-feedback').hide();
                    $('.is-invalid').removeClass('is-invalid');
                }

                // Validate form fields
                function validateForm(data) {
                    let hasErrors = false;
                    for (const key in data) {
                        if (data[key] === '') {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).siblings('.invalid-feedback').show();
                            hasErrors = true;
                        }
                    }
                    return hasErrors;
                }

                // Handle form error response
                function handleFormError(xhr) {
                    const errors = xhr.responseJSON.errors;
                    for (const field in errors) {
                        $('#' + field).addClass('is-invalid');
                        $('#' + field).siblings('.invalid-feedback').text(errors[field][0]).show();
                    }
                }
            });
        </script>
    @endpush


</x-app-layout>
