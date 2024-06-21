@if (!isset($disabled_sidebar))
    <div>
        <nav class="side-nav">
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}" class="side-menu {{request()->routeIs('dashboard') ? 'side-menu--active' : null}}">
                        <div class="side-menu__icon">
                            <i icon-name="home"></i>
                        </div>
                        <div class="side-menu__title">
                            Dashboard
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('orders.index') }}" class="side-menu {{request()->routeIs('orders') ? 'side-menu--active' : null}}">
                        <div class="side-menu__icon">
                            <i icon-name="pencil"></i>
                        </div>
                        <div class="side-menu__title">
                            Master Data
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="side-menu">
                        <div class="side-menu__icon">
							<i icon-name="book"></i>
                        </div>
                        <div class="side-menu__title">
                            Eksplorasi Data
                            <div class="side-menu__sub-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="chevron-down" class="lucide lucide-chevron-down stroke-1.5 w-5 h-5"><path d="m6 9 6 6 6-6"></path></svg>
                            </div>
                        </div>
                    </a>
                    <ul class="">
                    <li>
                            <a href="{{ route('transactions.index') }}" class="side-menu {{ request()->routeIs('transactions') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon">
                                    <i icon-name="book-open"></i>
                                </div>
                                <div class="side-menu__title">
                                    Transaksi
                                </div>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="" class="side-menu {{ request()->routeIs('') ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon">
                                    <i icon-name="book-open"></i>
                                </div>
                                <div class="side-menu__title">
                                    Produk Terjual
                                </div>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li>
                    <a href="{{ route('fp_growths.index') }}" class="side-menu {{request()->routeIs('fp_growths') ? 'side-menu--active' : null}}">
                        <div class="side-menu__icon">
                            <i icon-name="pencil"></i>
                        </div>
                        <div class="side-menu__title">
                           FP-Growth
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('bundings.index') }}" class="side-menu {{request()->routeIs('bundlings') ? 'side-menu--active' : null}}">
                        <div class="side-menu__icon">
                            <i icon-name="pencil"></i>
                        </div>
                        <div class="side-menu__title">
                           Bundling
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endif
