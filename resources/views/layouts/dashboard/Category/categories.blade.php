<x-app-layout>

    <!-- Large modal-->
    <div class="modal fade bd-example-modal-lg" class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">Add New Category</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="customerForm" class="row g-3 p-4" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="customerId" name="id">

                    <div class="col-12">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" id="name" name="name" type="text">
                        <div class="invalid-feedback">Please enter a valid name</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image"
                            accept="image/jpeg,image/png,image/jpg,image/webp">
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
                <h3>
                    Category
                </h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item {{ Request::routeIs('categories.index') ? 'active' : '' }}">Category
                    </li>

                </ol>
            </div>
        </div>
    </x-slot>
    <div class="container-fluid">
        <!-- Top Controls Section -->
        <div class="row mb-3">
            <div class="col-md-6 col-sm-12 mb-2 mb-md-0">
                <button class="btn btn-success " type="button" data-bs-toggle="modal" id="createCategoryBtn"
                    data-bs-target=".bd-example-modal-lg">
                    Add Category
                </button>
            </div>

        </div>

        <!-- Table Section -->
        <div class="row">
            <div class="col-sm-12 ">
                <div class="card  p-3">

                    <div class="card-block row">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-md" id="category">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">status</th>
                                            <th scope="col">Show On Navbar</th>
                                            <th scope=col>Action</th>
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
                let category = $('#category').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/admin/categories',
                        type: 'GET',
                    },
                    columns: [{
                            data: 'category_image',
                            name: 'category_image'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            sortable: false,
                            orderable: false
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


                $('#customerForm').on('submit', function(e) {
                    e.preventDefault();

                    // Clear any existing error messages
                    $('.invalid-feedback').hide();
                    $('.is-invalid').removeClass('is-invalid');

                    // Create FormData object to handle file uploads
                    const formData = new FormData();
                    formData.append('name', $('#name').val());
                    formData.append('show_on_navbar', $('#show_on_navbar').prop('checked') ? 1 : 0);
                    formData.append('_token', $('input[name="_token"]').val());

                    // Add image if one is selected
                    if ($('#image')[0].files[0]) {
                        formData.append('image', $('#image')[0].files[0]);
                    }

                    let hasErrors = false;

                    if (!$('#name').val().trim()) {
                        $('#name').addClass('is-invalid').siblings('.invalid-feedback').show();
                        hasErrors = true;
                    }

                    if (hasErrors) return;

                    const customerId = $('#customerId').val();
                    const isUpdate = customerId !== '';

                    // If updating, append the _method field for Laravel to handle PUT request
                    if (isUpdate) {
                        formData.append('_method', 'PUT');
                    }

                    $.ajax({
                        url: isUpdate ? `/admin/categories/${customerId}` : '/admin/categories',
                        type: 'POST', // Always use POST for FormData
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(response) {
                            if (response.status === 'success') {
                                resetForm();
                                $('#categoryModal').modal('hide');
                                category.ajax.reload(null, false);
                            }
                        },

                    });
                });

                // Handle show_on_navbar toggle
                $(document).on('change', '.showOnNavbar', function() {
                    var categoryId = $(this).attr('id').replace('navbar_', '');
                    var newStatus = $(this).prop('checked') ? 1 : 0;

                    $.ajax({
                        url: '/admin/update-show-on-navbar/' + categoryId,
                        type: 'PUT',
                        data: {
                            show_on_navbar: newStatus,
                            model: 'Category',
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                category.ajax.reload(null, false);
                            } else {
                                Swal.fire('Error!', 'Failed to update Show On Navbar status.',
                                    'error');
                            }
                        },
                        error: function(xhr) {

                            const errors = xhr.responseJSON.errors;


                            // Check if errors are present
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
                    })
                });


                // Handle Delete button click
                $(document).on('click', '.deleteBtn', function() {
                    var categoryId = $(this).data('id');
                    // Show confirmation dialog
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
                            // Send DELETE request to server
                            $.ajax({
                                url: '/admin/categories/' + categoryId,
                                type: 'DELETE',
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    Swal.fire('Deleted!', 'The category has been deleted.',
                                        'success');
                                    category.ajax.reload(null, false);
                                },
                                error: function(xhr) {
                                    // Parse the error response and extract the message
                                    let errorMessage = 'Failed to delete category.';

                                    if (xhr.responseJSON && xhr.responseJSON.message) {
                                        errorMessage = xhr.responseJSON.message;
                                    }

                                    Swal.fire('Error!', errorMessage, 'error');
                                }
                            });
                        }
                    });
                });

                // Handle checkbox toggle (status change)
                $(document).on('change', '.changeStatus', function() {

                    var categoryId = $(this).attr('id').replace('cb_', '');
                    var newStatus = $(this).prop('checked') ? 1 : 0;

                    $.ajax({
                        url: '/admin/update-status/' + categoryId,
                        type: 'PUT',
                        data: {
                            status: newStatus,
                            model: 'Category',
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                // Handle success if needed
                                category.ajax.reload(null, false);

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

                // Add real-time validation
                $('#name, #description').on('input', function() {
                    if ($(this).val().trim()) {
                        $(this).removeClass('is-invalid').siblings('.invalid-feedback').hide();
                    }
                });


                // Handle Edit button click
                $(document).on('click', '.editBtn', function() {
                    var categoryId = $(this).data('id'); // Get category ID from the button data-id

                    // Reset the form to clear previous values before loading the modal
                    resetForm();

                    // Send AJAX request to fetch category data
                    $.ajax({
                        url: '/admin/categories/' + categoryId,
                        type: 'GET',
                        success: function(response) {

                            if (response.status === 'success') {
                                $('#name').val(response.category.name);
                                $('#description').val(response.category.description);
                                $('#customerId').val(response.category.id);
                                $('#show_on_navbar').prop('checked', response.category
                                    .show_on_navbar === 1); // Set checkbox state
                                // Show the modal
                                $('#categoryModal').modal('show');
                            } else {
                                Swal.fire('Error!', 'Category data not found.', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Failed to fetch category data.', 'error');
                        }
                    });
                });

                //  Clear Form When Showing The modal
                $('#createCategoryBtn').on('click', function() {
                    resetForm();
                    $('#categoryModal').modal('show');
                });

                // Add this function to properly reset form and clear validation states
                function resetForm() {
                    $('#customerForm')[0].reset();
                    $('#customerId').val('');
                    $('#show_on_navbar').prop('checked', false); // Reset checkbox
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').hide();
                }


            });
        </script>
    @endpush


</x-app-layout>
