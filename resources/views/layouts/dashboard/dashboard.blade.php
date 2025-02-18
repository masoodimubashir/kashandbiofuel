<x-app-layout>

    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>
                    Dashboard
                </h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</li>

                </ol>
            </div>
        </div>
    </x-slot>


    <div class="container-fluid dashboard_ecommerce">
        <div class="row">

            <x-admin-sale-component/>

            <x-admin-dashboard-revenue-component/>

            <x-admin-dashboard-total-order-component/>

        </div>
    </div>

</x-app-layout>
