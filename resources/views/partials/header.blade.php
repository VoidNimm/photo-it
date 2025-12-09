@php
    use App\Models\Setting;
    use App\Services\TranslationService;
    use Illuminate\Support\Facades\Storage;

    $logoText = Setting::getTranslated('navbar_logo_text', 'Photo It');
    $logoImage = Setting::get('navbar_logo_image');
    $menuItems = \App\Models\Setting::get('navbar_menu_items', []);

    $translator = app(\App\Services\TranslationService::class);
    $locale = app()->getLocale();
@endphp

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

        <a href="{{ route('index') }}" class="logo d-flex align-items-center me-auto me-xl-0">
            @if($logoImage)
                <img src="{{ Storage::url($logoImage) }}" alt="{{ $logoText }}"
                    style="max-height: 40px; margin-right: 10px;">
            @else
                <i class="bi bi-camera"></i>
            @endif
            <h1 class="sitename">{{ $logoText }}</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                @if(!empty($menuItems))
                    @foreach(collect($menuItems)->sortBy('order') as $item)
                        <li>
                            <a href="{{ $item['url'] }}" target="{{ $item['target'] ?? '_self' }}"
                                class="{{ request()->is(trim(parse_url($item['url'], PHP_URL_PATH), '/')) || request()->routeIs(trim(parse_url($item['url'], PHP_URL_PATH), '/')) ? 'active' : '' }}">
                                {{ $translator->translate($item['label'] ?? '', $locale) }}
                            </a>
                        </li>
                    @endforeach
                @else
                    <li><a href="{{ route('index') }}"
                            class="{{ request()->routeIs('index') ? 'active' : '' }}">{{ __('common.home') }}</a></li>
                    <li><a href="{{ route('about') }}"
                            class="{{ request()->routeIs('about') ? 'active' : '' }}">{{ __('common.about') }}</a></li>
                    <li><a href="{{ route('gallery') }}"
                            class="{{ request()->routeIs('gallery*') ? 'active' : '' }}">{{ __('common.gallery') }}</a></li>
                    <li><a href="{{ route('services') }}"
                            class="{{ request()->routeIs('services') ? 'active' : '' }}">{{ __('common.services') }}</a>
                    </li>
                    <li><a href="{{ route('contact') }}"
                            class="{{ request()->routeIs('contact*') ? 'active' : '' }}">{{ __('common.contact') }}</a></li>
                @endif

                {{-- Language Switcher untuk Mobile --}}
                <li class="mobile-lang-switcher d-xl-none">
                    <div class="mobile-lang-links">
                        <span class="lang-label">Language:</span>
                        <a href="{{ route('language.switch', 'en') }}"
                            class="lang-link {{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
                        <span class="lang-divider">|</span>
                        <a href="{{ route('language.switch', 'id') }}"
                            class="lang-link {{ app()->getLocale() === 'id' ? 'active' : '' }}">ID</a>
                    </div>
                </li>

                {{-- Auth Menu untuk Mobile --}}
                <li class="mobile-auth-menu d-xl-none">
                    <div class="mobile-auth-links">
                        @auth
                            <span class="auth-user-name">Halo, {{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="auth-link logout-btn">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="auth-link">Login</a>
                            <span class="auth-divider">|</span>
                            <a href="{{ route('register') }}" class="auth-link">Register</a>
                        @endauth
                    </div>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        {{-- Language Switcher + Auth Menu Container untuk Desktop --}}
        <div class="header-actions d-none d-xl-flex align-items-center">
            {{-- Language Switcher untuk Desktop --}}
            <div class="language-switcher d-none d-xl-block">
                <div class="dropdown">
                    <button class="btn btn-lang dropdown-toggle" type="button" id="languageDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-globe2"></i>
                        <span>{{ app()->getLocale() === 'id' ? 'ID' : 'EN' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        <li>
                            <a class="dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}"
                                href="{{ route('language.switch', 'en') }}">
                                <span class="flag-icon">🇺🇸</span> English
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ app()->getLocale() === 'id' ? 'active' : '' }}"
                                href="{{ route('language.switch', 'id') }}">
                                <span class="flag-icon">🇮🇩</span> Bahasa
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Auth Menu untuk Desktop --}}
            <div class="auth-menu d-none d-xl-flex align-items-center">
                @auth
                    <div class="dropdown">
                        <button class="btn btn-user dropdown-toggle" type="button" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            <span class="auth-user-name">{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <div class="dropdown-header">
                                    <div class="dropdown-user-info">
                                        <i class="bi bi-person-circle"></i>
                                        <div>
                                            <div class="dropdown-user-name">{{ Auth::user()->name }}</div>
                                            <div class="dropdown-user-email">{{ Auth::user()->email }}</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout-item">
                                        <i class="bi bi-box-arrow-right"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-auth-nav login-btn">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('register') }}" class="btn-auth-nav register-btn">
                        <i class="bi bi-person-plus"></i>
                        <span>Register</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>