@extends('layouts.app')

@section('title', __('common.home'))
@section('body-class', 'index-page')

@section('content')
  @if(session('booking_success'))
    <div class="container mt-4" data-aos="fade-down">
      <div class="booking-success-notification">
        <div class="d-flex align-items-center justify-content-between">
          <div class="flex-grow-1">
            <strong style="font-size: 18px; display: block; margin-bottom: 8px;">{{ __('common.booking_success_title') }}</strong>
            <div style="font-size: 16px;">
              {!! session('success') !!}
            </div>
            <div style="margin-top: 10px; font-size: 14px; opacity: 0.9;">
              {{ __('common.booking_success_message') }}
            </div>
          </div>
          <button type="button" class="notification-close"
            onclick="this.closest('.booking-success-notification').style.display='none'" aria-label="{{ __('common.close') }}">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>
      </div>
    </div>
  @endif

  @if(session('success') && !session('booking_success'))
    <div class="container mt-4" data-aos="fade-down">
      <div class="php-email-form sent-message" style="display: block; margin-bottom: 0;">
        {!! session('success') !!}
      </div>
    </div>
  @endif

  <!-- Hero Section -->
  <section id="hero" class="hero section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center" data-aos="fade-up" data-aos-delay="100">
          <h2><span>{{ __('common.home_hero_title') }}</span><span class="underlight">{{ __('common.home_hero_company') }}</span>{{ __('common.home_hero_subtitle') }}</h2>
          <p>{{ __('common.home_hero_description') }}</p>
          <a href="{{ route('contact') }}" class="btn-get-started">{{ __('common.available_for_booking') }}</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Gallery Section -->
  <section id="gallery" class="gallery section">
    <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4 justify-content-center">
        @forelse($galleryItems as $item)
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="{{ $item->image_url }}" class="img-fluid" alt="{{ $item->title }}">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="{{ $item->image_url }}" title="{{ $item->title }}" class="glightbox preview-link"><i
                    class="bi bi-arrows-angle-expand"></i></a>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center">
            <p>{{ __('common.home_gallery_empty') }}</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>
@endsection