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
                                <table class="table table-md" id="contact_us">
                                    <thead>
                                        <tr>
                                            <th scope="col"> Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Message</th>
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
                let contact_us_table = $('#contact_us').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('dashboard.contact-us.index') }}",
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
                            data: 'message',
                            name: 'message'
                        },

                    ]
                });

            });
        </script>
    @endpush


</x-app-layout>
