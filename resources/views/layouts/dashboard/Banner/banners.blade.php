<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>
                    Banners
                </h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item {{ Request::routeIs('/admin/banners') ? 'active' : '' }}">Banner
                    </li>

                </ol>
            </div>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-sm-12">
            <!-- First Row -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4>Hero Banner</h4>
                        </div>
                        <div class="card-body">
                            <input class="show-preview my-pond" type="file" name="file">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4>Header Banner 2</h4>
                        </div>
                        <div class="card-body">
                            <input class="show-preview my-pond2" type="file" name="file">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slider Banners Row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4>Banner Slider 1</h4>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control mb-3 banner-link" data-pond="slider-1"
                                placeholder="Paste Banner Link URL">
                            <input class="show-preview my-pond3" type="file" name="file">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4>Banner Slider 2</h4>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control mb-3 banner-link" data-pond="slider-2"
                                placeholder="Paste Banner Link URL">
                            <input class="show-preview my-pond4" type="file" name="file">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4>Banner Slider 3</h4>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control mb-3 banner-link" data-pond="slider-3"
                                placeholder="Paste Banner Link URL">
                            <input class="show-preview my-pond5" type="file" name="file">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4>Banner Slider 4</h4>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control mb-3 banner-link" data-pond="slider-4"
                                placeholder="Paste Banner Link URL">
                            <input class="show-preview my-pond6" type="file" name="file">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Banners Row -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4>Featured Banner</h4>
                        </div>
                        <div class="card-body">
                            <input class="show-preview my-pond7" type="file" name="file">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4>Featured Banner</h4>
                        </div>
                        <div class="card-body">
                            <input class="show-preview my-pond8" type="file" name="file">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('dashboard.script')
        <script>
            $(document).ready(function() {
                // Hide slider FilePonds initially
                $('.my-pond3, .my-pond4, .my-pond5, .my-pond6').hide();

                // Show/hide FilePond based on URL input value for sliders
                $('.banner-link').on('input', function() {
                    const correspondingPond = $(this).siblings('.show-preview');
                    if ($(this).val().trim()) {
                        correspondingPond.show();
                    } else {
                        correspondingPond.hide();
                    }
                });

                FilePond.registerPlugin(
                    FilePondPluginImagePreview,
                    FilePondPluginFileValidateType
                );

                const positions = {
                    'my-pond': 'hero-1',
                    'my-pond2': 'hero-2',
                    'my-pond3': 'slider-1',
                    'my-pond4': 'slider-2',
                    'my-pond5': 'slider-3',
                    'my-pond6': 'slider-4',
                    'my-pond7': 'featured',
                    'my-pond8': 'limited-offer'
                };

                function createServerConfig(data) {
                    return {
                        load: (source, load) => {
                            $.ajax({
                                url: source,
                                method: 'GET',
                                xhr: () => {
                                    const xhr = new XMLHttpRequest();
                                    xhr.responseType = 'blob';
                                    return xhr;
                                },
                                success: load
                            });
                        },
                        process: {
                            url: data.files ? '/admin/banners/update/' + data.files.id : '/admin/banners',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            onload: (response) => {
                                const parsedResponse = JSON.parse(response);
                                location.reload();
                                return parsedResponse.id;
                            }
                        }
                    };
                }

                function createPondConfig(position, serverConfig) {
                    return {
                        allowMultiple: false,
                        server: {
                            ...serverConfig,
                            process: {
                                url: '/admin/banners',
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                ondata: (formData) => {
                                    formData.append('position', position);
                                    const linkInput = document.querySelector(
                                        `.banner-link[data-pond="${position}"]`);
                                    formData.append('link', linkInput ? linkInput.value : '');
                                    return formData;
                                }
                            }
                        },
                        imagePreviewHeight: 400,
                        allowImagePreview: true,
                        allowImageResize: true,
                    };
                }

                // Modified initializeFilePonds to handle link values for sliders
                function initializeFilePonds(data) {
                    const serverConfig = createServerConfig(data);

                    Object.entries(positions).forEach(([pondClass, position]) => {
                        const pondConfig = createPondConfig(position, serverConfig);

                        if (data.files && data.files.length > 0) {
                            const matchingFile = data.files.find(file => file.id === position);
                            if (matchingFile) {
                                pondConfig.files = [{
                                    source: matchingFile.id,
                                    options: {
                                        type: 'local'
                                    },
                                    source: matchingFile.url
                                }];

                                // Show FilePond for sliders if link exists
                                if (position.includes('slider-')) {
                                    const linkInput = document.querySelector(
                                        `.banner-link[data-pond="${position}"]`);
                                    if (linkInput && matchingFile.link) {
                                        linkInput.value = matchingFile.link;
                                        $(`.${pondClass}`).show();
                                    }
                                }
                            }
                        }

                        FilePond.create(document.querySelector('.' + pondClass), pondConfig);
                    });
                }

                $.ajax({
                    url: '/admin/banners',
                    method: 'GET',
                    success: initializeFilePonds
                });

                $('.banner-link').on('change', function() {
                    const position = $(this).data('pond');
                    const link = $(this).val();

                    $.ajax({
                        url: '/admin/banners/links/update/' + position,
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            link
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    icon: 'success'
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Error!',
                                text: xhr.responseJSON.message || 'Something went wrong',
                                icon: 'error'
                            });
                        }
                    });
                });
            });
        </script>
    @endpush


</x-app-layout>
