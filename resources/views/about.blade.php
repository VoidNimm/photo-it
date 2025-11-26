@extends('layouts.app')

@section('title', __('common.about'))
@section('body-class', 'about-page')

@section('content')
  <!-- Page Title -->
  <div class="page-title" data-aos="fade">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>{{ $pageTitle }}</h1>
            <p class="mb-0">{{ $pageSubtitle }}</p>
            @if($ctaText)
              <a href="{{ $ctaUrl }}" class="cta-btn">{{ $ctaText }}</a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- About Section -->
  <section id="about" class="about section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4 justify-content-center">
        @if($companyImage)
          <div class="col-lg-4">
            <img src="{{ asset('storage/' . $companyImage) }}" class="img-fluid" alt="{{ $companyTitle }}">
          </div>
        @endif
        <div class="{{ $companyImage ? 'col-lg-5' : 'col-lg-8' }} content">
          <h2>{{ $companyTitle }}</h2>
          @if($companySubtitle)
            <p class="fst-italic py-3">
              {{ $companySubtitle }}
            </p>
          @endif

          @if(count($companyInfo) > 0)
            <div class="row">
              <div class="col-lg-6">
                <ul>
                  @foreach($companyInfo as $index => $info)
                    @if($index % 2 == 0)
                      <li><i class="bi bi-chevron-right"></i> <strong>{{ $info['label'] ?? '' }}:</strong>
                        <span>{{ $info['value'] ?? '' }}</span>
                      </li>
                    @endif
                  @endforeach
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
                  @foreach($companyInfo as $index => $info)
                    @if($index % 2 == 1)
                      <li><i class="bi bi-chevron-right"></i> <strong>{{ $info['label'] ?? '' }}:</strong>
                        <span>{{ $info['value'] ?? '' }}</span>
                      </li>
                    @endif
                  @endforeach
                </ul>
              </div>
            </div>
          @endif

          @if($companyDesc1)
            <p class="py-3">
              {{ $companyDesc1 }}
            </p>
          @endif

          @if($companyDesc2)
            <p class="m-0">
              {{ $companyDesc2 }}
            </p>
          @endif
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section id="testimonials" class="testimonials section">
    <div class="container section-title" data-aos="fade-up">
      <h2>{{ $testimonialsTitle }}</h2>
      <p>{{ $testimonialsSubtitle }}</p>
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