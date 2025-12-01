@php
    use App\Models\Setting;
    use App\Services\TranslationService;
    use Illuminate\Support\Facades\Storage;

    $logoText = Setting::getTranslated('navbar_logo_text', 'Photo It');
    $logoImage = Setting::get('navbar_logo_image');
    $menuItems = Setting::get('navbar_menu_items', []);
    $facebook = Setting::get('navbar_facebook');
    $twitter = Setting::get('navbar_twitter');
    $instagram = Setting::get('navbar_instagram');
    $linkedin = Setting::get('navbar_linkedin');
    
    $translator = app(TranslationService::class);
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
                    <li><a href="{{ route('index') }}" class="{{ request()->routeIs('index') ? 'active' : '' }}">{{ __('common.home') }}</a></li>
                    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">{{ __('common.about') }}</a></li>
                    <li><a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery*') ? 'active' : '' }}">{{ __('common.gallery') }}</a></li>
                    <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">{{ __('common.services') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact*') ? 'active' : '' }}">{{ __('common.contact') }}</a></li>
                @endif
                
                                {{-- NEW: Social Links untuk Mobile (Hanya tampil di < 1200px) --}}
                                @if($facebook || $twitter || $instagram || $linkedin)
                    <li class="mobile-social-links d-xl-none d-flex justify-content-center py-2">
                        <div class="header-social-links">
                            @if($facebook)
                                <a href="{{ $facebook }}" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
                            @endif
                            @if($twitter)
                                <a href="{{ $twitter }}" class="twitter" target="_blank"><i class="bi bi-twitter-x"></i></a>
                            @endif
                            @if($instagram)
                                <a href="{{ $instagram }}" class="instagram" target="_blank"><i class="bi bi-instagram"></i></a>
                            @endif
                            @if($linkedin)
                                <a href="{{ $linkedin }}" class="linkedin" target="_blank"><i class="bi bi-linkedin"></i></a>
                            @endif
                        </div>
                    </li>
                @endif
                {{-- Language Switcher untuk Mobile (di dalam menu) --}}
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
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        {{-- Social Links + Language Switcher Container untuk Desktop --}}
        <div class="header-actions d-none d-xl-flex align-items-center">
            <div class="header-social-links">
                @if($facebook)
                    <a href="{{ $facebook }}" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
                @endif
                @if($twitter)
                    <a href="{{ $twitter }}" class="twitter" target="_blank"><i class="bi bi-twitter-x"></i></a>
                @endif
                @if($instagram)
                    <a href="{{ $instagram }}" class="instagram" target="_blank"><i class="bi bi-instagram"></i></a>
                @endif
                @if($linkedin)
                    <a href="{{ $linkedin }}" class="linkedin" target="_blank"><i class="bi bi-linkedin"></i></a>
                @endif
            </div>

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
        </div>
    </div>
</header>