<x-app-layout>

    <!-- Large modal-->

    <div class="modal fade bd-example-modal-lg" class="modal fade" id="subCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Add New Sub Category</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="subCategoryForm" class="row g-3 p-4">

                    @csrf
                    <input type="hidden" id="subCategoryId" name="subCategory_id">

                    <div class="col-12">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" id="name" name="name" type="text">
                        <div class="invalid-feedback">Please enter a valid name</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="category_id">Category</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="">Select Your Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please select a category</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                        <div class="invalid-feedback">Please enter a description</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="show_on_navbar">Show On Navbar</label>
                        <input class="tgl tgl-flip navbar_show" id="show_on_navbar" type="checkbox"
                            name="show_on_navbar">
                        <label class="tgl-btn" data-tg-off="No" data-tg-on="Yes!" for="show_on_navbar"></label>
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
                <h3>Sub Category</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item {{ Request::routeIs('sub-categories.index') ? 'active' : '' }}">Sub
                        Category</li>
                </ol>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Top Controls Section -->
        <div class="row mb-3">
            <div class="col-md-6 col-sm-12 mb-2 mb-md-0">
                <button class="btn btn-success " type="button" data-bs-toggle="modal" id="subCategoryBtn"
                    data-bs-target=".bd-example-modal-lg">
                    Add Sub Category
                </button>
            </div>
        </div>

        <!-- Table Section -->
        <div class="row">
            <div class="col-sm-12 ">
                <div class="card p-3">
                    <div class="card-block row">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-md" id="subCategory">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Show On Navbar</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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
                let subCategory = $('#subCategory').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/admin/sub-categories', // Correct URL for sub-categories
                        type: 'GET',
                    },
                    columns: [{
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'category.name',
                            name: 'category.name'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            sortable: false,
                            orderable: false,

                        },
                        {
                            data: 'show_on_navbar',
                            name: 'show_on_navbar',
                            sortable: false,
                            orderable: false
                        },
                        {
                            data: 'action',
                            name: 'action',
                            sortable: false,
                            orderable: false
                        }
                    ]
                });

                $('#subCategoryForm').on('submit', function(e) {
                    e.preventDefault();

                    // Clear any existing error messages
                    $('.invalid-feedback').hide();
                    $('.is-invalid').removeClass('is-invalid');

                    // Form data
                    const formData = {
                        name: $('#name').val(),
                        description: $('#description').val(),
                        category_id: $('#category_id').val(),
                        show_on_navbar: $('#show_on_navbar').prop('checked') ? 1 : 0,
                        _token: $('input[name="_token"]').val()
                    };

                    let hasErrors = false;

                    // Validate Name
                    if (!formData.name.trim()) {
                        $('#name').addClass('is-invalid').siblings('.invalid-feedback').show();
                        hasErrors = true;
                    }

                    // Validate Category ID (Make sure a category is selected)
                    if (!formData.category_id) {
                        $('#category_id').addClass('is-invalid').siblings('.invalid-feedback').show();
                        hasErrors = true;
                    }

                    // Validate Description
                    if (!formData.description.trim()) {
                        $('#description').addClass('is-invalid').siblings('.invalid-feedback').show();
                        hasErrors = true;
                    }

                    // If there are errors, stop form submission
                    if (hasErrors) return;

                    const subCategoryId = $('#subCategoryId').val(); // Get the value of the hidden input field

                    const isUpdate = subCategoryId !== '';

                    console.log('subCategoryId:', subCategoryId);

                    // Determine the request URL and type (POST for create, PUT for update)
                    const url = isUpdate ? `/admin/sub-categories/${subCategoryId}` : '/admin/sub-categories';
                    const method = isUpdate ? 'PUT' : 'POST';

                    // Submit the form using AJAX
                    $.ajax({
                        url: url,
                        type: method,
                        data: formData,
                        success: function(response) {
                            if (response.status === 'success') {
                                // Reset the form and hide the modal
                                resetForm();
                                $('#subCategoryModal').modal('hide');
                                subCategory.ajax.reload(); // Reload the DataTable
                                Swal.fire('Success', response.message, 'success');
                            }
                        },
                        error: function(xhr) {
                            const errors = xhr.responseJSON.errors; // Get errors from the response

                            if (errors) {
                                let errorMessage = '';
                                for (let key in errors) {
                                    if (errors.hasOwnProperty(key)) {
                                        errorMessage += errors[key].join('<br>');
                                    }
                                }
                                Swal.fire('Error!', errorMessage, 'error');
                            } else {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        }
                    });
                });

                // Edit Sub Category
                $(document).on('click', '.editBtn', function() {
                    const subCategoryId = $(this).data('id');

                    resetForm();
                    $.ajax({
                        url: `/admin/sub-categories/${subCategoryId}`,
                        type: 'GET',
                        success: function(response) {

                            if (response.status === 'success') {
                                $('#name').val(response.subCategory.name);
                                $('#description').val(response.subCategory.description);
                                $('#category_id').val(response.subCategory
                                    .category_id);
                                $('#show_on_navbar').prop('checked', response.subCategory
                                    .show_on_navbar === 1); // Set checkbox state
                                $('#subCategoryId').val(response.subCategory.id);
                                $('#subCategoryModal').modal('show');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Failed to fetch subCategory data.', 'error');
                        }
                    });
                });

                // Delete Sub Category
                $(document).on('click', '.deleteBtn', function() {
                    const subCategoryId = $(this).data('id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action cannot be undone.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        confirmButtonColor: '#d33'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `/admin/sub-categories/${subCategoryId}`,
                                type: 'DELETE',
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function() {
                                    Swal.fire('Deleted!', 'SubCategory has been deleted.',
                                        'success');
                                    subCategory.ajax.reload();
                                },
                                error: function() {
                                    Swal.fire('Error!', 'Failed to delete SubCategory.',
                                        'error');
                                }
                            });
                        }
                    });
                });

                // Clear Form When Showing The Modal
                $('#subCategoryBtn').on('click', function() {
                    resetForm();
                    $('#subCategoryModal').modal('show');
                });

                // Handle checkbox toggle (status change)
                $(document).on('change', '.changeStatus', function() {

                    var subCategoryId = $(this).attr('id').replace('cb_', '');
                    var newStatus = $(this).prop('checked') ? 1 : 0;

                    // Send AJAX request to update status
                    $.ajax({
                        url: '/admin/update-status/' + subCategoryId,
                        type: 'PUT',
                        data: {
                            status: newStatus,
                            model: 'SubCategory',
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                subCategory.ajax.reload();
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

                // Handle show_on_navbar toggle
                $(document).on('change', '.showOnNavbar', function() {
                    var subCategoryId = $(this).attr('id').replace('navbar_', '');
                    var newStatus = $(this).prop('checked') ? 1 : 0;

                    $.ajax({
                        url: '/admin/update-show-on-navbar/' + subCategoryId,
                        type: 'PUT',
                        data: {
                            show_on_navbar: newStatus,
                            model: 'SubCategory',
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                subCategory.ajax.reload(null, false);
                            } else {
                                Swal.fire('Error!', 'Failed to update Show On Navbar status.',
                                    'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!',
                                'Something went wrong while updating Show On Navbar status.',
                                'error');
                        }
                    });
                });

                function resetForm() {
                    $('#subCategoryForm')[0].reset();
                    $('#category_id').val('');
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').hide();
                }



            });
        </script>
    @endpush

</x-app-layout>
