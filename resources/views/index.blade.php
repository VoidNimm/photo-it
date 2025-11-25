@extends('layouts.app')

@section('title', 'Home')
@section('body-class', 'index-page')

@section('content')
  @if(session('booking_success'))
    <div class="container mt-4" data-aos="fade-down">
      <div class="booking-success-notification">
        <div class="d-flex align-items-center justify-content-between">
          <div class="flex-grow-1">
            <strong style="font-size: 18px; display: block; margin-bottom: 8px;">🎉 Booking Berhasil!</strong>
            <div style="font-size: 16px;">
              {!! session('success') !!}
            </div>
            <div style="margin-top: 10px; font-size: 14px; opacity: 0.9;">
              Kami akan menghubungi Anda segera untuk konfirmasi booking.
            </div>
          </div>
          <button type="button" class="notification-close"
            onclick="this.closest('.booking-success-notification').style.display='none'" aria-label="Close">
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
          <h2><span>We're</span><span class="underlight">Photo It</span> a Professional<span> Company Photographer from
              Jakarta</span></h2>
          <p>Photo It hadir untuk mengabadikan setiap momen berharga Anda melalui layanan fotografi profesional, mulai
            dari wedding, event, portrait, produk, hingga city view. Kami berkomitmen menghadirkan hasil terbaik yang
            mampu bercerita dan menyimpan kenangan Anda selamanya.</p>
          <a href="{{ route('contact') }}" class="btn-get-started">Available for Booking</a>
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
            <p>Belum ada gallery yang ditampilkan.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>
@endsection