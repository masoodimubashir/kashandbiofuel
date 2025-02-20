<div class=" box-col-12">
    <div class="card total-revenue">
        <div class="card-header card-no-border pb-2">
            <div class="header-top">
                <h4>Total Revenue</h4>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="row gy-5">
                <div class="col-12">
                    {!! $chart->container() !!}

                </div>
            </div>
        </div>
    </div>
    @push('dashboard.script')
    {!! $chart->script() !!}
@endpush
</div>
