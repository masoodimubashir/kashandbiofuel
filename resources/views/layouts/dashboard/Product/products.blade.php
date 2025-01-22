<x-app-layout>

    <style>
        #filePreview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .file-preview-item {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 5px;
            background: #f8f9fa;
            text-align: center;
            font-size: 12px;
        }

        .file-preview-item img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .file-preview-item .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            line-height: 20px;
            text-align: center;
            cursor: pointer;
        }
    </style>



    <!-- Product Form Modal -->
    <div class="modal fade bd-example-modal-lg" id="productModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">


                    <h4 class="modal-title" id="modalTitle">Add New Product</h4>


                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="productForm" class="row g-3 p-4" enctype='multipart/form-data'>
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

                    <div class="col-md-4">
                        <label class="box-col-12 text-start">Crafted Date </label>
                        <div class="box-col-12">
                            <div class="input-group flatpicker-calender">
                                <input class="form-control" id="datetime-local" id="crafted_date" type="date"
                                    name="crafted_date">
                                <div class="invalid-feedback">Please enter Crafted Date</div>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="qty">Quantity</label>
                        <input class="form-control" id="qty" name="qty" type="text">
                        <div class="invalid-feedback">Enter Quantity</div>
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
                        <label class="form-label" for="selling_price">Selling Price</label>
                        <input class="form-control" id="selling_price" name="selling_price" type="text">
                        <div class="invalid-feedback">Please enter Selling Price</div>
                    </div>
                    <!-- Tags Multi-select -->
                    <div class="col-12 col-md-4">

                        <label class="form-label" for="search_tags">Tags</label>
                        <select class="form-select tags" id="search_tags" name="search_tags" multiple>
                        </select>
                        <div class="invalid-feedback">Please enter Search Tags</div>

                    </div>

                    <!-- Description Fields -->
                    <div class="col-12 col-lg-6 mt-3">
                        <label class="form-label" for="short_description">Short Description</label>
                        <textarea class="form-control" id="short_description" name="short_description"></textarea>
                        <div class="invalid-feedback ">Please enter a short description</div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label" for="additional_description">Additional Description</label>
                        <textarea class="form-control" id="additional_description" name="additional_description"></textarea>
                        <div class="invalid-feedback">Please enter an additional description</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" id="summernote" name="description"></textarea>
                        <div class="invalid-feedback">Please enter a description</div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="d-flex flex-wrap gap-3">
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="featured" name="featured">
                                <label class="form-check-label" for="featured">Featured</label>
                            </div>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="discounted" name="discounted">
                                <label class="form-check-label" for="discounted">Discounted</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="new_arrival" name="new_arrival">
                                <label class="form-check-label" for="new_arrival">New Arrival</label>
                            </div>
                           
                        </div>
                    </div>

                    <!-- Product Variations -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label">Product Attributes</label>
                            <button type="button" class="btn btn-primary" id="addRowBtn">Add Row</button>
                        </div>
                        <div id="variationRows">
                            <!-- Variation rows will be added here -->
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Save Product</button>
                    </div>
                </form>
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
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item {{ Request::routeIs('products.index') ? 'active' : '' }}">Products</li>
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


                                <button class="btn btn-success " type="button" data-bs-toggle="modal"
                                    id="productBtn" data-bs-target=".bd-example-modal-lg">
                                    Add Product
                                </button>





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
                                const data = JSON.parse(response);
                                productTable.ajax.reload(null, false);
                                Swal.fire('Success', data.message, 'success');
                            },
                            onerror: (response) => {
                                const data = JSON.parse(response);
                                Swal.fire('Error', data.message, 'error');
                            }
                        }
                    }
                });


                const summernoteConfig = {
                    height: 100,
                    tabsize: 2,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['view', ['codeview', 'help']]
                    ]
                };

                $('#summernote').summernote({
                    ...summernoteConfig,
                    placeholder: 'Enter product description here'
                });

                $('#short_description').summernote({
                    ...summernoteConfig,
                    placeholder: 'Enter short description'
                });

                $('#additional_description').summernote({
                    ...summernoteConfig,
                    placeholder: 'Enter additional description'
                });

                $('.tags').select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    placeholder: 'Enter tags...'
                });




                $(document).on('click', '.remove-row', function() {
                    $(this).closest('.variation-row').remove();
                });

                function validateFile(file) {

                    const validTypes = ["image/jpeg", "image/png", "image/gif", "image/webp", "file/csv"];
                    return validTypes.includes(file.type);
                }

                function previewFile(file, previewContainer) {
                    const previewItem = $('<div class="col-3 p-2"></div>');
                    const previewWrapper = $('<div class="preview-wrapper position-relative"></div>');
                    const img = $('<img class="img-thumbnail rounded" style="height:100px;width:100px;">');
                    const removeBtn = $(
                        '<button type="button" class="btn btn-danger btn-sm position-absolute" style="top: 5px; right: 5px;"><i class="fa fa-times"></i></button>'
                    );

                    previewWrapper.append(img);
                    previewWrapper.append(removeBtn);
                    previewItem.append(previewWrapper);

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img.attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);

                    removeBtn.click(function() {
                        const index = files.findIndex(f => f.file === file);
                        if (index > -1) {
                            files.splice(index, 1);
                        }
                        previewItem.remove();
                    });

                    previewContainer.append(previewItem);
                }

                $('#productForm').on('submit', function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);

                    // Get all variation rows and organize images by color
                    $('.variation-row').each(function(index) {


                        const hexCode = $(this).find('input[type="color"]').val();
                        const images = $(this).find('input[type="file"]')[0].files;

                        // Add hex code
                        formData.append(`product_attributes[${index}][hex_code]`, hexCode);

                        // Add all images for this color
                        for (let i = 0; i < images.length; i++) {
                            formData.append(`product_attributes[${index}][images][]`, images[i]);
                        }
                    });

                    // Add tags as JSON
                    const tags = $('#search_tags').val();
                    formData.append('search_tags', tags);

                    $.ajax({
                        url: '/admin/products',
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
                                $('#productModal').modal('hide');
                                resetForm();
                                Swal.fire('Success', 'Product created successfully', 'success');
                            }
                        },
                        error: function(xhr) {
                            handleFormErrors(xhr.responseJSON.errors);
                        }
                    });
                });


                function handleFormErrors(errors) {
                    // Clear previous errors
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').empty();

                    // Map backend error messages to user-friendly messages
                    const errorMessages = {
                        'name.required': 'Product name is required',
                        'sku.required': 'SKU is required',
                        'price.required': 'Price is required',
                        'selling_price.required': 'Selling price is required',
                        'short_description.required': 'Short description is required',
                        'additional_description.required': 'Additional description is required',
                        'description.required': 'Description is required',
                        'category_id.required': 'Category is required',
                        'sub_category_id.required': 'Sub category is required',
                        'colors.required': 'At least one color is required',
                        'images.required': 'At least one image is required',
                        'crafted_date.required': 'Crafted date is required',
                        'qty.required': 'Quantity is required',
                        'search_tags.required': 'Search tags are required'
                    };

                    // Display errors in respective invalid-feedback divs
                    Object.entries(errors).forEach(([field, messages]) => {
                        const input = $(`[name="${field}"]`);
                        input.addClass('is-invalid');

                        const errorMessage = errorMessages[`${field}.required`] || messages[0];
                        input.siblings('.invalid-feedback').text(errorMessage);

                        // Handle special fields
                        if (field === 'description') {
                            $('#summernote').next('.note-editor').addClass('is-invalid');
                        }
                        if (field === 'search_tags') {
                            $('.select2-container').addClass('is-invalid');
                        }
                    });
                }


                function clearErrors() {
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').text('');
                    $('.note-editor').removeClass('is-invalid');
                    $('.select2-container').removeClass('is-invalid');
                }

                function resetForm() {
                    $('#productForm')[0].reset();
                    $('#variationRows').empty();
                    clearErrors();

                    // Reset Select2
                    $('#search_tags').val(null).trigger('change');

                    // Reset Summernote editors
                    $('#summernote').summernote('reset');
                    $('#short_description').summernote('reset');
                    $('#additional_description').summernote('reset');
                }


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

                let rowIndex = 0;

                $('#addRowBtn').click(function() {
                    const newRow = `
                        <div class="variation-row border rounded p-3 mt-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="color-input">
                                        <label class="form-label">Color</label>
                                        <div class="d-flex align-items-center">
                                            <input type="color" class="form-control me-2" name="colors[${rowIndex}][hex_code]" value="#000000" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="image-upload">
                                        <label class="form-label">Images for this color</label>
                                        <input type="file" class="form-control" name="images[]" multiple accept="image/jpeg,png,jpg,webp">
                                        <small class="text-muted">Select multiple images for this color</small>
                                        <div class="file-preview row mt-2"></div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger remove-row mt-4">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#variationRows').append(newRow);
                    rowIndex++;
                });

                $(document).on('click', '.remove-row', function() {
                    $(this).closest('.variation-row').remove();
                });



                $(document).on('click', '.remove-color', function() {
                    $(this).closest('.color-group').remove();
                });

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
                                    Swal.fire('Deleted!', 'The product has been deleted.',
                                        'success');
                                    productTable.ajax.reload(null, false);
                                },
                                error: function() {
                                    Swal.fire('Error!', 'Failed to delete the product.',
                                        'error');
                                }
                            });
                        }
                    });
                });

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



                $('#seoModal').on('show.bs.modal', function(event) {
                    const button = $(event.relatedTarget); // Button that triggered the modal
                    const productId = button.data('id'); // Extract info from data-* attributes

                    $('#seoModal #product_id').val(productId); // Set the product ID in the modal's hidden input
                });

                $('#seoForm').on('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    formData.append('_method', 'PUT');


                    const url = "{{ route('product.seo') }}";

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


            



            });
        </script>
    @endpush


</x-app-layout>
