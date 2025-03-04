<x-app-layout>


    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Edit Product</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i data-feather="home"></i></a>
                    </li>

                    <li class="breadcrumb-item {{ Request::routeIs('products.index') }}">Products</li>

                    <li class="breadcrumb-item {{ Request::routeIs('products.show', $product->id) ? 'active' : '' }}">
                        Edit {{ $product->name }}</li>

                </ol>
            </div>
        </div>
    </x-slot>

    {{-- <input type="text" id="Product-id" value="{{ $Product->id }}">
    <div class="card-body">
        <input class="Product-images-pond" type="file" name="file" multiple>
    </div> --}}


    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <form id="productForm" class="row g-3" enctype="multipart/form-data">

                    @csrf
                    <div class="card">
                        <div class="card-body">

                            <input type="hidden" id="productId" name="product_id">

                            <!-- Basic Product Information -->
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="name">Product Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="category_id">Category<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="category_id" name="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $product->category_id === $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforEach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="sub_category_id">Subcategory<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="sub_category_id" name="sub_category_id">
                                        <option value="">Select Subcategory</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <!-- Product Details -->
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="price">Price<span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control" id="price"
                                        name="price">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="selling_price">Selling Price<span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control" id="selling_price"
                                        name="selling_price">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="sku">SKU<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="sku" name="sku">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="crafted_date">Crafted Date<span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="crafted_date" name="crafted_date">
                                    <div class="invalid-feedback"></div>
                                </div>

                                {{-- <div class="col-md-3 mb-3">
                                    <label class="form-label" for="qty">Quantity<span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="qty" name="qty">
                                    <div class="invalid-feedback"></div>
                                </div> --}}
                            </div>

                            <!-- Additional Details -->
                            <div class="row">

                                {{-- 
                                <div class="col-md-6 mb-3">

                                    <label class="form-label" for="tags">Search Tags</label>
                                    <select class="form-select tags" id="tags" name="search_tags" multiple>
                                        @if ($product->search_tags)
                                            @php
                                                $tags = json_decode($product->search_tags, true); // Decodes into an array
                                            @endphp

                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag }}" selected>{{ $tag }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">Tags Are Required</div>
                                </div> --}}
                            </div>


                            <!-- Descriptions -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="short_description">Short Description</label>
                                    <textarea class="form-control" id="short_description" name="short_description" rows="3"></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="additional_description">Additional
                                        Description</label>
                                    <textarea class="form-control" id="additional_description" name="additional_description" rows="3"></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="description">Main Description<span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="col-12 mt-3">
                                <div class="d-flex flex-wrap gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="featured"
                                            name="featured" value="{{ $product->featured }}"
                                            {{ $product->featured ? 'checked' : '' }}>
                                        <label class="form-check-label" for="featured">Featured</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="discounted"
                                            name="discounted" value="{{ $product->discounted }}"
                                            {{ $product->discounted ? 'checked' : '' }}>
                                        <label class="form-check-label" for="discounted">Discounted</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="new_arrival"
                                            name="new_arrival" value="{{ $product->new_arrival }}"
                                            {{ $product->new_arrival ? 'checked' : '' }}>
                                        <label class="form-check-label" for="new_arrival">New Arrival</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <!-- Product Attributes Section -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Product Attributes</h5>
                                        <button type="button" class="btn btn-primary btn-sm" id="addRowBtn">
                                            <i class="fas fa-plus"></i> Add Attribute
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div id="variationRows">
                                            <!-- Dynamic rows will be added here -->
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-2">Update Product</button>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    @push('dashboard.script')
        <script>
            // Initialize variables

            $(document).ready(function() {

                let removedAttributes = [];
                let removedImages = [];

             

                function initializeProductForm(productId) {
                    $.ajax({
                        url: `/admin/products/${productId}/edit`,
                        method: 'GET',
                        success: function(response) {

                            console.log(response);
                            const product = response.product;

                            // Set form values
                            $('#productId').val(product.id);
                            $('#name').val(product.name);
                            $('#price').val(product.price);
                            $('#selling_price').val(product.selling_price);
                            $('#sku').val(product.sku);
                            $('#qty').val(product.qty);
                            $('#crafted_date').val(product.crafted_date);
                            $('#category_id').val(product.category_id);

                            // Set descriptions
                            $('#description').summernote('code', product.description);
                            $('#short_description').summernote('code', product.short_description);
                            $('#additional_description').summernote('code', product.additional_description);

                            // Load subcategories
                            loadSubCategories(product.category_id, product.sub_category_id);

                            // Add Product attributes with images
                            if (product.product_attributes?.length) {
                                product.product_attributes.forEach(attribute => {
                                    addVariationRow(attribute);
                                });
                            }
                        }
                    });
                }

                function loadSubCategories(categoryId, selectedSubCategoryId = null) {
                    if (categoryId) {
                        $.ajax({
                            url: `/admin/categories/${categoryId}`,
                            method: "GET",
                            success: function(response) {
                                const category = response.category;
                                let options = '<option value="">Select Subcategory</option>';
                                category.sub_categories.forEach(subcategory => {
                                    const selected = subcategory.id == selectedSubCategoryId ?
                                        'selected' : '';
                                    options +=
                                        `<option value="${subcategory.id}" ${selected}>${subcategory.name}</option>`;
                                });
                                $('#sub_category_id').html(options);
                            }
                        });
                    }
                }

                $('#category_id').on('change', function() {
                    const categoryId = $(this).val();
                    loadSubCategories(categoryId);
                });

                function addVariationRow(data = null) {
                    // Generate a unique index for the new row
                    const rowIndex = $('.variation-row').length;

                    const rowHtml = `
                        <div class="variation-row border rounded p-3 mt-3">
                            <input type="hidden" name="product_attributes[${rowIndex}][id]" value="${data ? data.id : ''}">
                            <div class="row">
                                <!-- Color Input -->
                                <div class="col-md-1">
                                    <label class="form-label">Color</label>
                                    <input type="color" class="form-control" name="product_attributes[${rowIndex}][hex_code]" value="${data ? data.hex_code : '#000000'}" required>
                                </div>

                                <!-- Quantity Input -->
                                <div class="col-md-4">
                                    <div class="color-input">
                                        <label class="form-label">Quantity</label>
                                        <div class="d-flex align-items-center">
                                            <input type="number" class="form-control me-2" name="product_attributes[${rowIndex}][qty]" value="${data ? data.qty : ''}" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Upload -->
                                <div class="col-md-6">
                                    <label class="form-label">Images</label>
                                    <input type="file" class="form-control" name="product_attributes[${rowIndex}][image]" accept="image/*">
                                    <div class="existing-images row mt-2">
                                        ${data ? `
                                                            <div class="col-md-3 mb-2 image-container">
                                                                <div class="position-relative">
                                                                    <img src="/storage/${data.image_path}" class="img-thumbnail" style="height: 100px; width: 100px;">
                                                                </div>
                                                            </div>
                                                        ` : ''}
                                    </div>
                                </div>

                                <!-- Remove Button -->
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger remove-row mt-4 delete-image" data-image-id="${data ? data.id : ''}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;

                    $('#variationRows').append(rowHtml);
                }

                $('#addRowBtn').click(function() {
                    addVariationRow();
                });

                // $(document).on('click', '.delete-image', function() {
                //     const imageId = $(this).data('image-id');
                //     const container = $(this).closest('.image-container');


                //     removedImages.push(imageId);
                //     container.remove();
                // });

                $(document).on('click', '.remove-row', function() {
                    const row = $(this).closest('.variation-row');

                    const attributeId = row.find('input[name^="product_attributes"][name$="[id]"]').val();

                    if (attributeId) {
                        removedAttributes.push(attributeId);
                    }
                    row.remove();
                });

                $('#productForm').on('submit', function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);

                    formData.append('id', $('#productId').val());
                    formData.append('name', $('#name').val());

                    $('.variation-row').each(function(index) {
                        const attributeId = $(this).find('input[name="attribute_id[]"]').val();
                        const hexCode = $(this).find('input[type="color"]').val();
                        const quantity = $(this).find('input[type="number"]').val();
                        const imageInput = $(this).find('input[type="file"]')[0];
                        const imageFile = imageInput.files[0];

                        if (attributeId) {
                            formData.append(`product_attributes[${index}][id]`, attributeId);
                        }

                        formData.append(`product_attributes[${index}][hex_code]`, hexCode);
                        formData.append(`product_attributes[${index}][qty]`, quantity);

                        if (imageFile) {
                            formData.append(`product_attributes[${index}][image]`, imageFile);
                        }
                    });

                    if (removedAttributes.length) {
                        formData.append('removed_attributes', removedAttributes.join(','));
                    }
                    if (removedImages.length) {
                        formData.append('removed_images', removedImages.join(','));
                    }

                    formData.append('_method', 'PUT');

                    $.ajax({
                        url: `/admin/products/${$('#productId').val()}`,
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire('Success', 'Product updated successfully', 'success')
                                .then(() => window.location.href = '/admin/products');
                        },
                        error: function(error) {

                            if (error.status === 422) {
                                handleFormErrors(error.responseJSON?.errors);

                            }

                            Swal.fire('Error', 'Something Went Wrong Try Again..', 'error');
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
                        'crafted_date.required': 'Crafted date is required',
                        'product_attributes.required': 'At least one color attribute is required',
                        'images.required': 'Images are required for each color'
                    };

                    // Display errors in respective invalid-feedback divs
                    Object.entries(errors).forEach(([field, messages]) => {

                        const input = $(`[name="${field}"]`);
                        input.addClass('is-invalid');

                        const errorMessage = errorMessages[`${field}.required`] || messages[0];
                        input.siblings('.invalid-feedback').text(errorMessage);

                        Swal.fire('Error', errorMessage, 'error');

                        // Handle special fields
                        if (field === 'description') {
                            $('#summernote').next('.note-editor').addClass('is-invalid');
                        }
                        if (field === 'search_tags') {
                            $('.select2-container').addClass('is-invalid');
                        }
                    });

                    // Scroll to first error
                    const firstError = $('.is-invalid').first();
                    if (firstError.length) {
                        $('html, body').animate({
                            scrollTop: firstError.offset().top - 100
                        }, 500);
                    }
                }

                const productId = window.location.pathname.split('/')[3];
                initializeProductForm(productId);

            });
        </script>
    @endpush

</x-app-layout>
