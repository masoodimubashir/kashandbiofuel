<div class="container-fluid-lg">
    <div class="row">
        <div class="col-12">
            <div class="header-nav">

                <div class="header-nav-middle">
                    <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                        <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                            <div class="offcanvas-header navbar-shadow">
                                <h5>Menu</h5>
                                <button class="btn-close lead" type="button" data-bs-dismiss="offcanvas"></button>
                            </div>
                            <div class="offcanvas-body">

                                <ul class="navbar-nav">

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                            data-bs-toggle="dropdown">Pages</a>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('home') }}">Home</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('contact-us.index') }}">Contact
                                                    Us</a>
                                            </li>
                                        </ul>
                                    </li>

                                    @foreach ($navigation as $category)
                                        <li
                                            class="nav-item {{ $category->subCategories->count() > 0 ? 'dropdown' : '' }}">
                                            <a class="nav-link {{ $category->subCategories->count() > 0 ? 'dropdown-toggle' : '' }}"
                                                href="{{ $category->subCategories->count() > 0 ? 'javascript:void(0)' : '' }}"
                                                {{ $category->subCategories->count() > 0 ? 'data-bs-toggle=dropdown' : '' }}>
                                                {{ $category->name }}
                                            </a>

                                            @if ($category->subCategories->count() > 0)
                                                @if ($category->subCategories->count() <= 6)
                                                    <ul class="dropdown-menu">
                                                        @foreach ($category->subCategories as $subCategory)
                                                            <li>
                                                                <a class="dropdown-item" href="">
                                                                    {{ $subCategory->name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <div class="dropdown-menu dropdown-menu-2">
                                                        <div class="row">
                                                            @foreach ($category->subCategories->chunk(ceil($category->subCategories->count() / 3)) as $chunk)
                                                                <div class="dropdown-column col-xl-3">
                                                                    @foreach ($chunk as $subCategory)
                                                                        <a class="dropdown-item" href="">
                                                                            {{ $subCategory->name }}
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            @endforeach

                                                            <div class="dropdown-column dropdown-column-img col-3">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
