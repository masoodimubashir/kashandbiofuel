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
                                <!-- Price Fields Section -->
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="price">Price<span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control" id="price"
                                        name="price" value="{{ $product->price }}">
                                    <div class="invalid-feedback"></div>
                                </div>

                                @php
                                    $gst_amount =
                                        ($product->selling_price * $product->gst_amount) / (100 + $product->gst_amount);

                                    $selling_price_without_gst = $product->selling_price - $gst_amount;
                                @endphp


                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="selling_price_without_gst">Selling Price<span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control"
                                        id="selling_price_without_gst" name="selling_price_without_gst"
                                        value="{{ $selling_price_without_gst }}">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="gst">GST (%)<span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control" id="gst"
                                        name="gst" min="1" max="100" value="{{ $product->gst_amount }}">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="selling_price">Final Price (with GST)<span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control" id="selling_price"
                                        name="selling_price" value="{{ $product->selling_price }}" readonly>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="sku">SKU<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="sku" name="sku"
                                        value="{{ $product->sku }}">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="crafted_date">Crafted Date<span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="crafted_date" name="crafted_date"
                                        value="{{ $product->crafted_date }}">
                                    <div class="invalid-feedback"></div>
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


                    <!-- Product Attributes Section -->
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


                    <div class="col-12">
                        <button type="submit" class="btn btn-primary me-2">Update Product</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>


                </form>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    @push('dashboard.script')
        <script>
            $(document).ready(function() {
                let removedAttributes = [];
                let removedImages = [];

                // GST Calculation Variables and Functions
                const sellingPriceWithoutGst = document.querySelector('#selling_price_without_gst');
                const gstInput = document.querySelector('#gst');
                const finalSellingPrice = document.querySelector('#selling_price');

                function calculateFinalPrice() {
                    const basePrice = parseFloat(sellingPriceWithoutGst.value) || 0;
                    const gstPercentage = parseFloat(gstInput.value) || 0;
                    const gstAmount = (basePrice * gstPercentage) / 100;
                    const totalPrice = basePrice + gstAmount;
                    finalSellingPrice.value = totalPrice.toFixed(2);
                }

                sellingPriceWithoutGst.addEventListener('input', calculateFinalPrice);
                gstInput.addEventListener('input', calculateFinalPrice);

                // Subcategory Loading
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

                // Variation Row Functions
                function addVariationRow(data = null) {
                    const rowIndex = $('.variation-row').length;
                    const rowHtml = `
                    <div class="card">
                        <div class="card-body">
                            <div class="variation-row border rounded p-3 mt-3">
                                <input type="hidden" name="product_attributes[${rowIndex}][id]" value="${data ? data.id : ''}">
                                <div class="row">
                                    <div class="col-md-1">
                                        <label class="form-label">Color</label>
                                        <input type="color" class="form-control" name="product_attributes[${rowIndex}][hex_code]" value="${data ? data.hex_code : '#000000'}" required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Quantity</label>
                                        <input type="number" class="form-control" name="product_attributes[${rowIndex}][qty]" value="${data ? data.qty : ''}" required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Images</label>
                                        <input type="file" class="form-control" name="product_attributes[${rowIndex}][images][]" multiple accept="image/*">
                                        <div class="invalid-feedback"></div>
                                        <div class="existing-images row mt-2">
                                            ${data && data.images ? renderExistingImages(data.images) : ''}
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-row mt-4" data-attribute-id="${data ? data.id : ''}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                    $('#variationRows').append(rowHtml);
                }

                function renderExistingImages(images) {
                    const imageArray = typeof images === 'string' ? JSON.parse(images) : images;
                    return imageArray.map(image => `
                    <div class="col-3 mb-2 image-container">
                        <div class="position-relative">
                            <img src="/storage/${image}" class="img-thumbnail" style="height: 100px;">
                        </div>
                    </div>
                `).join('');
                }

                // Form Initialization
                function initializeProductForm(productId) {
                    $.ajax({
                        url: `/admin/products/${productId}/edit`,
                        method: 'GET',
                        success: function(response) {
                            const product = response.product;

                            // Calculate GST values
                            const gstAmount = (product.selling_price * product.gst_amount) / (100 + product
                                .gst_amount);
                            const sellingPriceWithoutGst = product.selling_price - gstAmount;

                            // Set all form values
                            $('#productId').val(product.id);
                            $('#name').val(product.name);
                            $('#price').val(product.price);
                            $('#selling_price_without_gst').val(sellingPriceWithoutGst.toFixed(2));
                            $('#gst').val(product.gst_amount);
                            $('#selling_price').val(product.selling_price);
                            $('#sku').val(product.sku);
                            $('#crafted_date').val(product.crafted_date);
                            $('#category_id').val(product.category_id);

                            // Set rich text editors
                            $('#description').summernote('code', product.description);
                            $('#short_description').summernote('code', product.short_description);
                            $('#additional_description').summernote('code', product.additional_description);

                            loadSubCategories(product.category_id, product.sub_category_id);

                            if (product.product_attributes?.length) {
                                product.product_attributes.forEach(attribute => {
                                    addVariationRow(attribute);
                                });
                            }
                        }
                    });
                }

                // Form Submission
                $('#productForm').on('submit', function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);

                    $('.variation-row').each(function(index) {
                        const attributeId = $(this).find(
                            'input[name^="product_attributes"][name$="[id]"]').val();
                        if (attributeId) {
                            formData.append(`product_attributes[${index}][id]`, attributeId);
                        }
                    });

                    if (removedAttributes.length) {
                        formData.append('removed_attributes', removedAttributes.join(','));
                    }

                    formData.append('_method', 'PUT');
                    formData.append('gst_percentage', gstInput.value);
                    formData.append('final_price', finalSellingPrice.value);

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
                            handleFormErrors(xhr);
                        }
                    });
                });

                // Event Handlers
                $('#addRowBtn').click(() => addVariationRow());

                $(document).on('click', '.remove-row', function() {
                    const attributeId = $(this).data('attribute-id');
                    if (attributeId) {
                        removedAttributes.push(attributeId);
                    }
                    $(this).closest('.variation-row').remove();
                });

                // Initialize form with product ID from URL
                const productId = window.location.pathname.split('/')[3];
                initializeProductForm(productId);
            });
        </script>
    @endpush

</x-app-layout>
