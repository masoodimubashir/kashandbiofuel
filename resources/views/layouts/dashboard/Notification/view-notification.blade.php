<x-app-layout>

    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Notifications</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item {{ Request::routeIs('order.index') ? 'active' : '' }}">
                        Notification
                    </li>
                </ol>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="email-wrap email-main-wrapper">
            <div class="row">

                <div class="col-12 box-col-12">
                    <div class="email-right-aside">
                        <div class="card email-body email-list">
                            <div class="mail-header-wrapper">

                                <form class="mail-body">
                                    <select class="form-select" id="notificationFilter">
                                        <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All
                                        </option>
                                        <option value="read" {{ request('filter') == 'read' ? 'selected' : '' }}>Read
                                        </option>
                                        <option value="unread" {{ request('filter') == 'unread' ? 'selected' : '' }}>
                                            Unread</option>
                                    </select>

                                    <div class="light-square bg-light-info txt-info">
                                        <i class="fa fa-refresh" id="resetFilters"></i>
                                    </div>


                                </form>

                            </div>
                            <div class="mail-body-wrapper">
                                <ul id="paginated-list" data-current-page="1" aria-live="polite">
                                    @foreach ($notifications as $notification)
                                        <li class="inbox-data">
                                            <div class="inbox-user">
                                               
                                                <p>{{ $notification['data']['user'] }}</p>
                                            </div>
                                            <div class="inbox-message">
                                                <div class="email-data"><span>
                                                        Order Id: {{ $notification['data']['customer_order_id'] }}

                                                        <span>
                                                            {{ $notification['data']['message'] }}
                                                        </span></span>

                                                    @if ($notification->read_at)
                                                        <div class="badge badge-light-primary">
                                                            Read
                                                        </div>
                                                    @else
                                                        <div class="badge badge-light-danger">
                                                            Unread
                                                        </div>
                                                    @endif


                                                  
                                                </div>
                                                <div class="email-timing">
                                                    <span>{{ $notification->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="email-options">
                                                    <div class=" show"></div>
                                                    <div class=" hide"></div>
                                                    <a
                                                        href="{{ route('order.show', $notification['data']['order_id']) }}">View
                                                        Order</a>

                                                    <form
                                                        action="{{ route('admin.notifications.markAsRead', $notification->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-link">Mark As
                                                            Read</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            @if ($notifications->hasPages())
                                <div class="mail-pagination">
                                    <button class="pagination-button"
                                        {{ $notifications->onFirstPage() ? 'disabled' : '' }}
                                        onclick="window.location='{{ $notifications->previousPageUrl() }}'"
                                        aria-label="Previous page" title="Previous page">&lt;</button>

                                    <div class="pagination-index" id="pagination-numbers">
                                        @for ($i = 1; $i <= $notifications->lastPage(); $i++)
                                            <button
                                                class="pagination-button {{ $notifications->currentPage() == $i ? 'active' : '' }}"
                                                onclick="window.location='{{ $notifications->url($i) }}'">
                                                {{ $i }}
                                            </button>
                                        @endfor
                                    </div>

                                    <button class="pagination-button"
                                        {{ $notifications->hasMorePages() ? '' : 'disabled' }}
                                        onclick="window.location='{{ $notifications->nextPageUrl() }}'"
                                        aria-label="Next page" title="Next page">&gt;</button>
                                </div>
                            @endif


                        </div>


                    </div>
                </div>
            </div>
        </div>

        @push('dashboard.script')
            <script>
                $(document).ready(function() {
                    $('#resetFilters').click(function() {
                        window.location.href = "{{ route('admin.notifications') }}";
                    });

                    $('#notificationFilter').change(function() {
                        window.location.href = "{{ route('admin.notifications') }}?filter=" + $(this).val();
                    });
                });
            </script>
        @endpush

</x-app-layout>
