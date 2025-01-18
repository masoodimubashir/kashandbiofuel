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

    {{-- <input type="text" id="product-id" value="{{ $product->id }}">
    <div class="card-body">
        <input class="product-images-pond" type="file" name="file" multiple>
    </div> --}}


    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4>Product Form</h4>
                    </div>
                    <div class="card-body">
                        <form id="productForm" class="row g-3" enctype="multipart/form-data">

                            @csrf

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
                                    <label class="form-label" for="qty">Quantity<span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="qty" name="qty">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <!-- Additional Details -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="crafted_date">Crafted Date<span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="crafted_date" name="crafted_date">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label" for="tags">Search Tags</label>
                                    <select class="form-select tags" id="tags" name="search_tags[]" multiple>
                                        @if ($product->search_tags)
                                            @foreach (json_decode($product->search_tags) as $tag)
                                                <option value="{{ $tag }}" selected>{{ $tag }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">Tags Are Required</div>
                                </div>
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

                            <!-- Product Attributes Section -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="card">
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
                            </div>



                            <!-- Form Actions -->
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary me-2">Update Product</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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

                $('.tags').select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    placeholder: 'Enter tags...'
                });

                function initializeProductForm(productId) {
                    $.ajax({
                        url: `/admin/products/${productId}/edit`,
                        method: 'GET',
                        success: function(response) {

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

                            // Add product attributes with images
                            if (product.product_attributes?.length) {
                                product.product_attributes.forEach(attribute => {
                                    addVariationRow(attribute);
                                });
                            }
                        }
                    });
                }

                // Initial load of subcategories for existing product
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


                // Handle category change
                $('#category_id').on('change', function() {
                    const categoryId = $(this).val();
                    loadSubCategories(categoryId);
                });

                function addVariationRow(data = null) {
                    const rowHtml = `
        <div class="variation-row border rounded p-3 mt-3">
            <input type="hidden" name="attribute_id[]" value="${data ? data.id : ''}">
            <div class="row">
                <div class="col-md-2">
                    <label class="form-label">Color</label>
                    <input type="color" class="form-control" name="hex_code[]" value="${data ? data.hex_code : '#000000'}">
                </div>
                <div class="col-md-9">
                    <label class="form-label">Images</label>
                    <input type="file" class="form-control" name="images[]" multiple accept="image/*">
                    <div class="existing-images row mt-2">

                        ${data ?  `
                                                    <div class="col-md-3 mb-2 image-container">
                                                        <div class="position-relative">
                                                            <img src="/storage/${data.image_path}" class="img-thumbnail" style="height: 100px; width: 100px;">
                                                        </div>
                                                    </div>` : ''}

                                    
                    </div>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger remove-row mt-4 delete-image" data-image-id="${data ? data.id : ''}" >
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;

                    $('#variationRows').append(rowHtml);
                }

                // Remove the duplicate append
                // const $row = $(rowHtml);
                // $('#variationRows').append($row);

                $('#addRowBtn').click(function() {
                    addVariationRow();
                });



                // Handle existing image deletion
                $(document).on('click', '.delete-image', function() {
                    const imageId = $(this).data('image-id');
                    const container = $(this).closest('.image-container');

                    Swal.fire({
                        title: 'Delete Image?',
                        text: 'This action cannot be undone',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            removedImages.push(imageId);
                            container.remove();
                        }
                    });
                });

                // Handle row removal
                $(document).on('click', '.remove-row', function() {
                    const row = $(this).closest('.variation-row');
                    const attributeId = row.find('input[name="attribute_id[]"]').val();

                    if (attributeId) {
                        removedAttributes.push(attributeId);
                    }
                    row.remove();
                });

                // Form submission
                $('#productForm').on('submit', function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);

                    // Add basic product data
                    formData.append('id', $('#productId').val());
                    formData.append('name', $('#name').val());
                    formData.append('search_tags', JSON.stringify($('#tags').val()));

                    // Handle product attributes and images
                    $('.variation-row').each(function(index) {
                        const hexCode = $(this).find('input[type="color"]').val();
                        const images = $(this).find('input[type="file"]')[0].files;
                        const attributeId = $(this).find('input[name="attribute_id[]"]').val();

                        // Add attribute ID if exists
                        if (attributeId) {
                            formData.append(`product_attributes[${index}][id]`, attributeId);
                        }

                        // Add hex code
                        formData.append(`product_attributes[${index}][hex_code]`, hexCode);

                        // Add images for this color
                        for (let i = 0; i < images.length; i++) {
                            formData.append(`product_attributes[${index}][images][]`, images[i]);
                        }
                    });

                    // Add removed items
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
                        error: function(xhr) {
                            handleFormErrors(xhr.responseJSON?.errors);
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
                        'qty.required': 'Quantity is required',
                        'search_tags.required': 'Search tags are required',
                        'product_attributes.required': 'At least one color attribute is required',
                        'images.required': 'Images are required for each color'
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

                    // Scroll to first error
                    const firstError = $('.is-invalid').first();
                    if (firstError.length) {
                        $('html, body').animate({
                            scrollTop: firstError.offset().top - 100
                        }, 500);
                    }
                }



                // Initialize form with product data
                const productId = window.location.pathname.split('/')[3];
                initializeProductForm(productId);

            });
        </script>
    @endpush

</x-app-layout>
