@extends('layouts.app')

@section('title', 'Services')
@section('body-class', 'services-page')

@section('content')
  <!-- Page Title -->
  <div class="page-title" data-aos="fade">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>Services</h1>
            <p class="mb-0">Layanan profesional dari Photo It untuk kebutuhan fotografi Anda</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Services & Pricing Section -->
  <section id="services" class="services section">
    <div class="container" data-aos="fade-up">
      <div class="row gy-5">
        @forelse($services as $service)
          <div class="col-lg-4 col-md-8 d-flex" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="service-item position-relative h-100 d-flex flex-column">
              <div class="icon mb-3">
                <i class="{{ $service->icon ?? 'bi bi-camera' }}"></i>
              </div>
              <h4 class="mb-3">{{ $service->service_name }}</h4>
              <p class="flex-grow-1 mb-3">{{ $service->description }}</p>
              @if($service->price)
                <div class="pricing-info mb-3">
                  <span class="price-label">Starting from</span>
                  <h3 class="price-amount mb-0">Rp {{ number_format($service->price, 0, ',', '.') }}</h3>
                </div>
              @else
                <div class="pricing-info mb-3">
                  <span class="price-label">Contact us for pricing</span>
                </div>
              @endif
              <a href="{{ route('booking.create', ['service' => $service->id]) }}" class="btn-book-now">
                Booking
              </a>
            </div>
          </div>
        @empty
          <div class="col-12 text-center">
            <p>Belum ada layanan yang tersedia.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
<section id="testimonials" class="testimonials section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Testimonials</h2>
    <p>What they are saying</p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="swiper init-swiper">
      <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000,
            "disableOnInteraction": false,
            "pauseOnMouseEnter": true
          },
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          },
          "grabCursor": true,
          "allowTouchMove": true,
          "breakpoints": {
            "320": {
              "slidesPerView": 1,
              "spaceBetween": 40
            },
            "1200": {
              "slidesPerView": 3,
              "spaceBetween": 1
            }
          }
        }
      </script>
      <div class="swiper-wrapper">
        @forelse($testimonials as $testimonial)
          <div class="swiper-slide">
            <div class="testimonial-item">
              <div class="stars">
                @for($i = 0; $i < $testimonial->rating; $i++)
                  <i class="bi bi-star-fill"></i>
                @endfor
              </div>
              <p>{{ $testimonial->review_text }}</p>
              <div class="profile mt-auto">
                <img src="{{ $testimonial->image_url ?? asset('build/assets/img/testimonials/testimonials-1.jpg') }}"
                  class="testimonial-img" alt="{{ $testimonial->client_name }}">
                <h3>{{ $testimonial->client_name }}</h3>
                <h4>{{ $testimonial->client_title }}</h4>
              </div>
            </div>
          </div>
        @empty
          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>Belum ada testimonial yang tersedia.</p>
            </div>
          </div>
        @endforelse
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>
@endsection