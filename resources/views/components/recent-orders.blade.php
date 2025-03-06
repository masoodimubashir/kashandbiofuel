<div class="dashboard-download">
    <div class="title">
        <h2>My Download</h2>
        <span class="title-leaf">
            <svg class="icon-width bg-gray">
                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                </use>
            </svg>
        </span>
    </div>

    <div class="download-detail dashboard-bg-box">
        <form>
            <div class="input-group download-form">
                <input type="text" class="form-control" placeholder="Search your download">
                <button class="btn theme-bg-color text-light" type="button" id="button-addon2">Search
                </button>
            </div>
        </form>




        <div class="tab-pane fade show active" id="pills-data" role="tabpanel">
            <div class="download-table">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Order Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders)
                                @foreach ($orders as $order)
                                    <tr>

                                        <td>{{ $order->custom_order_id }}</td>

                                        <td>{{ $order->status }}</td>

                                        <td>
                                            <a href="{{ route('invoice.download', $order->id) }}">
                                                Download
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>We Cannot Find Any Order Yet</tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
