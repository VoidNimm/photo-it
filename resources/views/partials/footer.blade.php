@php
    use App\Models\Setting;

    $copyright = Setting::get('footer_copyright', '© Copyright Photo It All Rights Reserved');
    $credits = Setting::get('footer_credits', 'Designed by BootstrapMade');
    $creditsUrl = Setting::get('footer_credits_url', 'https://bootstrapmade.com/');
    $facebook = Setting::get('footer_facebook');
    $twitter = Setting::get('footer_twitter');
    $instagram = Setting::get('footer_instagram');
    $linkedin = Setting::get('footer_linkedin');
@endphp

<footer id="footer" class="footer">
    <div class="container">
        <div class="copyright text-center">
            <p>{!! $copyright !!}</p>
        </div>
        <div class="social-links d-flex justify-content-center">
            @if($facebook)
                <a href="{{ $facebook }}" target="_blank"><i class="bi bi-facebook"></i></a>
            @endif
            @if($twitter)
                <a href="{{ $twitter }}" target="_blank"><i class="bi bi-twitter-x"></i></a>
            @endif
            @if($instagram)
                <a href="{{ $instagram }}" target="_blank"><i class="bi bi-instagram"></i></a>
            @endif
            @if($linkedin)
                <a href="{{ $linkedin }}" target="_blank"><i class="bi bi-linkedin"></i></a>
            @endif
        </div>
        @if($credits)
            <div class="credits">
                @if($creditsUrl)
                    <a href="{{ $creditsUrl }}" target="_blank">{{ $credits }}</a>
                @else
                    {{ $credits }}
                @endif
            </div>
        @endif
    </div>
</footer>