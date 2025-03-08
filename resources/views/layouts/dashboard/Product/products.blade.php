<x-app-layout>

    <!-- Product Form Modal -->
    <div class="modal fade" id="bd-example-modal-fullscreen" id="productModal" tabindex="-1" role="dialog"
        aria-labelledby="myFullLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header sticky-top bg-white">
                    <h4 class="modal-title" id="modalTitle">Add New Product</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <form id="productForm" class="row g-3 p-3 p-md-4 overflow-auto" enctype='multipart/form-data'>

                        @csrf
                        <input type="hidden" id="productId" name="product_id">

                        <!-- Product Name -->
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="name">Product Name</label>
                            <input class="form-control" id="name" name="name" type="text">
                            <div class="invalid-feedback">Please enter a valid product name</div>
                        </div>

                        <!-- Category -->
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="category_id">Category</label>
                            <select class="form-select" id="category_id" name="category_id">
                                <option value="">Select Your Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please select a category</div>
                        </div>

                        <!-- Subcategory -->
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="sub_category_id">Subcategory</label>
                            <select class="form-select" id="sub_category_id" name="sub_category_id">
                                <option value="">Select Subcategory</option>
                            </select>
                            <div class="invalid-feedback">Please select a subcategory</div>
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Crafted Date</label>
                            <div class="input-group flatpicker-calender">
                                <input class="form-control" id="crafted_date" type="date" name="crafted_date">
                                <div class="invalid-feedback">Please enter Crafted Date</div>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="price">Price</label>
                            <input class="form-control" id="price" name="price" type="number" step="0.01">
                            <div class="invalid-feedback">Please enter a valid price</div>
                        </div>

                        <!-- SKU -->
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="sku">SKU</label>
                            <input class="form-control" id="sku" name="sku" type="text">
                            <div class="invalid-feedback">Please enter SKU</div>
                        </div>

                        <!-- Selling Price -->
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="selling_price_without_gst">Selling Price</label>
                            <input class="form-control" id="selling_price_without_gst" name="selling_price_without_gst"
                                type="number" step="1" min="0" max="1000000000">
                            <div class="invalid-feedback">Please enter a valid selling_price_without_gst</div>
                        </div>

                        <!-- GST Field -->
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="gst">GST In Percentage - EX: (10%)</label>
                            <input class="form-control" id="gst" name="gst" type="text">
                            <div class="invalid-feedback">Please Enter The GST</div>
                        </div>

                        <!-- Selling Price -->
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="selling_price">Selling Price (with GST)</label>
                            <input class="form-control" id="selling_price" name="selling_price" type="text" readonly>
                            <div class="invalid-feedback">Please enter Selling Price</div>
                        </div>


                        <!-- Description Fields -->
                        <div class="col-12 mt-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-12 col-lg-6 mt-3">
                            <label class="form-label" for="short_description">Short Description</label>
                            <textarea class="form-control" id="short_description" name="short_description" rows="3"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-12 col-lg-6 mt-3">
                            <label class="form-label" for="additional_description">Additional Description</label>
                            <textarea class="form-control" id="additional_description" name="additional_description" rows="3"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>


                        <div class="col-12 mt-3">
                            <div class="d-flex flex-wrap gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="featured" name="featured">
                                    <label class="form-check-label" for="featured">Featured</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="discounted"
                                        name="discounted">
                                    <label class="form-check-label" for="discounted">Discounted</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="new_arrival"
                                        name="new_arrival">
                                    <label class="form-check-label" for="new_arrival">New Arrival</label>
                                </div>
                            </div>
                        </div>

                        <!-- Product Variations -->
                        <div class="col-12  mt-4">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <label class="form-label mb-2 mb-sm-0">Product Attributes</label>
                                <button type="button" class="btn btn-primary btn-sm" id="addRowBtn">Add Row</button>
                            </div>

                            <div id="variationRows" class="mt-2">
                                <!-- Variation rows will be added here -->
                                <p>
                                    <strong class="text-danger">
                                        <span>
                                            Note : At Least One Product Attribute Is Required
                                        </span>
                                        <span>
                                            & Images Should Not Exceed Above 2mb
                                        </span>
                                    </strong>
                                </p>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 mt-4 sticky-bottom bg-white py-3">
                            <button type="submit" class="btn btn-success">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    {{-- Seo Manager Model --}}
    <div class="modal fade bd-example-modal-lg" id="seoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-ld">
            <div class="modal-content">
                <div class="modal-header">

                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="seoForm" class="row g-3 p-4">

                    @csrf

                    <input type="hidden" id="product_id" name="product_id">

                    <!-- Product Name -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="name">Meta Title</label>
                        <input class="form-control" id="meta_title" name="meta_title" type="text">
                        <div class="invalid-feedback">Please enter a valid Title</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="name">Meta Keywords</label>
                        <input class="form-control" id="meta_keyword" name="meta_keyword" type="text">
                        <div class="invalid-feedback">Please enter a valid Keywords</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="name">Meta Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description"></textarea>
                        <div class="invalid-feedback">Please enter a valid Description</div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Generate SEO</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Products</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item {{ Request::routeIs('products.index') ? 'active' : '' }}">
                        Products</li>
                </ol>
            </div>
        </div>
    </x-slot>


    <div class="container-fluid">

        <!-- Table Section -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="product_excel" class="product-pond">
                        </form>

                    </div>



                </div>




                <div class="card">

                    <div class="card-body">
                        <div class="list-product-header">

                            <div>
                                <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                    id="productBtn" data-bs-target="#bd-example-modal-fullscreen">
                                    Add Product
                                </button>
                                <a href="{{ route('products.export') }}" class="btn btn-success" type="button">
                                    <i class="fa fa-download"></i> Download Excel Template
                                </a>

                            </div>

                        </div>
                        <div class="list-product">
                            <div class="table-responsive">
                                <table class="table table-md table-striped" id="productsTable">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 15%;">Product Name</th>
                                            <th scope="col" style="width: 10%;">Price</th>
                                            <th scope="col" style="width: 15%;">Selling Price</th>
                                            <th scope="col" style="width: 10%;">Status</th>
                                            <th scope="col" style="width: 20%;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody class="text-center   "></tbody>
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


                const productTable = $('#productsTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/admin/products',
                        type: 'GET',
                    },
                    columns: [{
                            data: 'product_name',
                            name: 'product_name',
                            orderable: false,
                            searchable: false
                        },

                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'selling_price',
                            name: 'selling_price'
                        },

                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    drawCallback: function(settings) {
                        // Initialize select2 for the dynamically added select elements
                        $('.select_flag').select2({
                            placeholder: "Select Flag",
                            width: '10px' // Adjust width if needed
                        });
                    }
                });

                //  Bulk Upload PDF Input
                FilePond.registerPlugin(
                    FilePondPluginFileValidateType,
                    FilePondPluginFileValidateSize
                );

                const inputElement = document.querySelector('.product-pond');

                const pond = FilePond.create(inputElement, {

                    maxFileSize: '10MB',
                    server: {
                        process: {
                            url: '{{ route('products.import') }}',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            onload: (response) => {
                                productTable.ajax.reload(null, false);
                                Swal.fire('Success', response.message, 'success');
                            },
                            onerror: (response) => {
                                Swal.fire('Error', response.message, 'error');
                            }
                        }
                    }
                });

                // Summernote Initialization
                const summernoteConfig = {
                    height: 100,
                    tabsize: 2,

                };

                $('#description').summernote({
                    ...summernoteConfig,
                    placeholder: 'Enter Product description here'
                });

                $('#short_description').summernote({
                    ...summernoteConfig,
                    placeholder: 'Enter short description'
                });

                $('#additional_description').summernote({
                    ...summernoteConfig,
                    placeholder: 'Enter additional description'
                });

                // Category and Subcategory Selection
                $('#category_id').on('change', function() {
                    const categoryId = $(this).val();
                    if (categoryId) {
                        $.ajax({
                            url: `/admin/categories/${categoryId}`,
                            method: "GET",
                            success: function(response) {
                                const category = response.category;
                                let options = '<option value="">Select Subcategory</option>';
                                category.sub_categories.forEach(subcategory => {
                                    options +=
                                        `<option value="${subcategory.id}">${subcategory.name}</option>`;
                                });
                                $('#sub_category_id').html(options);
                            }
                        });
                    } else {
                        $('#sub_category_id').html('<option value="">Select Subcategory</option>');
                    }
                });

                // Product Delete Confirmation
                $(document).on('click', '.deleteBtn', function() {
                    const productId = $(this).data('id');
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
                                url: '/admin/products/' + productId,
                                type: 'DELETE',
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    Swal.fire('Deleted!', 'The Product has been deleted.',
                                        'success');
                                    productTable.ajax.reload(null, false);
                                },
                                error: function() {
                                    Swal.fire('Error!', 'Failed to delete the Product.',
                                        'error');
                                }
                            });
                        }
                    });
                });

                // Product Status Change
                $(document).on('change', '.changeStatus', function() {

                    const categoryId = $(this).attr('id').replace('cb_', '');
                    const newStatus = $(this).prop('checked') ? 1 : 0;

                    $.ajax({
                        url: '/admin/update-status/' + categoryId,
                        type: 'PUT',
                        data: {
                            status: newStatus,
                            model: 'Product',
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                productTable.ajax.reload(null, false);
                            } else {
                                Swal.fire('Error!', 'Failed to update status.', 'error');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', 'Something went wrong while updating status.',
                                'error');
                        }
                    });
                });

                // SEO Form Submission

                $('#seoForm').on('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    formData.append('_method', 'PUT');


                    const url = "{{ route('Product.seo') }}";

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                productTable.ajax.reload();
                                $('#seoModal').modal('hide');
                                formData.resetForm();
                                Swal.fire('Success', 'SEO data updated successfully', 'success');
                            }
                        },
                        error: function(xhr) {
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                handleFormErrors(xhr.responseJSON.errors);

                            } else {
                                Swal.fire('Error', 'An unexpected error occurred.', 'error');

                            }

                        }
                    });
                });


                let rowCounter = 0;

                // Add row button click handler
                $('#addRowBtn').click(function() {
                    addAttributeRow();
                });

                function addAttributeRow() {
                    rowCounter++;
                    const rowHtml = `
               
                        <div class="attribute-row row border shadow-md pb-2 pt-2 align-items-end ">
                            <div class="col-md-1">
                                <label class="form-label">Color</label>
                                <input type="color" class="form-control form-control-color" name="attributes[${rowCounter}][hex_code]" value="#000000" title="Choose color">
                                 <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="attributes[${rowCounter}][qty]" min="0">
                                 <div class="invalid-feedback"></div>
                            </div>
                           <div class="col-md-6">
                                <label class="form-label">Images</label>
                                <input type="file" class="form-control" name="attributes[${rowCounter}][images][]" multiple accept="image/*">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger btn-sm remove-row">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    `;
                    $('#variationRows').append(rowHtml);
                }

                // Remove row handler (using event delegation)
                $(document).on('click', '.remove-row', function() {
                    $(this).closest('.attribute-row').remove();
                });

                // GST Calculation Variables
                const sellingPriceWithoutGst = document.querySelector('#selling_price_without_gst');
                const gstInput = document.querySelector('#gst');
                const finalSellingPrice = document.querySelector('#selling_price');
                
                function validateGstInput(value) {
                    let numericValue = value.replace(/[^0-9.]/g, '');
                    numericValue = parseFloat(numericValue) || 0;
                    
                    if (numericValue > 100) numericValue = 100;
                    if (numericValue < 1) numericValue = 1;
                    
                    return numericValue;
                }
                
                function calculateFinalPrice() {
                    const basePrice = parseFloat(sellingPriceWithoutGst.value) || 0;
                    const gstPercentage = validateGstInput(gstInput.value);
                    
                    const gstAmount = (basePrice * gstPercentage) / 100;
                    const totalPrice = basePrice + gstAmount;
                    
                    finalSellingPrice.value = totalPrice.toFixed(2);
                }
                
                // Event listeners for GST calculation
                sellingPriceWithoutGst.addEventListener('input', calculateFinalPrice);
                gstInput.addEventListener('input', calculateFinalPrice);
                

                gstInput.addEventListener('blur', function() {
                    const validatedValue = validateGstInput(this.value);
                    this.value = validatedValue + '%';
                });


                $('#productForm').submit(function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);

                    const basePrice = parseFloat(sellingPriceWithoutGst.value) || 0;
                    const gstPercentage = validateGstInput(gstInput.value);
                    const finalPrice = parseFloat(finalSellingPrice.value) || 0;

                    formData.append('gst_percentage', gstPercentage);
                    formData.append('final_price', finalPrice);

                    $.ajax({
                        url: '/admin/products',
                        data: formData,
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Success', response.message, 'success');
                                $('#bd-example-modal-fullscreen').modal('hide');
                                productTable.ajax.reload();
                            }
                        },
                        error: function(xhr) {
                            handleFormErrors(xhr);
                        }
                    });
                });


                function handleFormErrors(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;

                        // Clear any existing validation states
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').empty();

                        // Handle field-specific errors
                        for (const field in errors) {
                            const inputElement = $(`[name="${field}"]`);
                            inputElement.addClass('is-invalid');
                            inputElement.siblings('.invalid-feedback').text(errors[field][0]);
                        }

                        // Show first error message in Swal
                        const firstError = Object.values(errors)[0][0];
                        Swal.fire('Validation Error', firstError, 'error');
                    } else {
                        // Handle generic error
                        Swal.fire('Error', 'An unexpected error occurred. Please try again.', 'error');
                    }
                }


            });
        </script>
    @endpush


</x-app-layout>
