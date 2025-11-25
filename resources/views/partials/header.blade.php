@php
    use App\Models\Setting;
    use Illuminate\Support\Facades\Storage;

    $logoText = Setting::get('navbar_logo_text', 'Photo It');
    $logoImage = Setting::get('navbar_logo_image');
    $menuItems = Setting::get('navbar_menu_items', []);
    $facebook = Setting::get('navbar_facebook');
    $twitter = Setting::get('navbar_twitter');
    $instagram = Setting::get('navbar_instagram');
    $linkedin = Setting::get('navbar_linkedin');
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
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
                @else
                    {{-- Fallback menu jika belum ada settings --}}
                    <li><a href="{{ route('index') }}" class="{{ request()->routeIs('index') ? 'active' : '' }}">Home</a>
                    </li>
                    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                    </li>
                    <li><a href="{{ route('gallery') }}"
                            class="{{ request()->routeIs('gallery*') ? 'active' : '' }}">Gallery</a></li>
                    <li><a href="{{ route('services') }}"
                            class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="{{ request()->routeIs('contact*') ? 'active' : '' }}">Contact</a></li>
                @endif
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

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

    </div>
</header>