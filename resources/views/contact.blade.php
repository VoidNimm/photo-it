@extends('layouts.app')

@section('title', 'Contact')
@section('body-class', 'contact-page')

@section('content')
  <!-- Page Title -->
  <div class="page-title" data-aos="fade">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>Contact</h1>
            <p class="mb-0">Tim Photo It siap membantu merencanakan pemotretan brand, pernikahan, maupun event korporat
              Anda. Ceritakan kebutuhan visual Anda dan kami akan merespons kurang dari 24 jam.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Contact Section -->
  <section id="contact" class="contact section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="info-wrap" data-aos="fade-up" data-aos-delay="200">
        <div class="row gy-5">
          <div class="col-lg-4">
            <div class="info-item d-flex align-items-center">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Studio</h3>
                <p>Jl. Senopati No. 14, Kebayoran Baru<br>Jakarta Selatan 12190</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="info-item d-flex align-items-center">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Telepon</h3>
                <p>+62 811-2222-410<br>Senin - Sabtu, 09.00–20.00 WIB</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="info-item d-flex align-items-center">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email</h3>
                <p>hello@photoit.id<br>booking@photoit.id</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      @if(session('success'))
        <div class="contact-form sent-message" style="display: block;">
          {{ session('success') }}
        </div>
      @endif

      @if($errors->any())
        <div class="contact-form error-message" style="display: block;">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('contact.send') }}" method="POST" class="contact-form" id="contact-form" data-aos="fade-up"
        data-aos-delay="300">
        @csrf

        <div class="row gy-4">
          <div class="col-md-6">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
              placeholder="Nama Lengkap *" value="{{ old('name') }}" required>
            @error('name')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
              placeholder="Email *" value="{{ old('email') }}" required>
            @error('email')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone"
              placeholder="Nomor Telepon (Opsional)" value="{{ old('phone') }}">
            @error('phone')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject"
              placeholder="Subjek *" value="{{ old('subject') }}" required>
            @error('subject')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-12">
            <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="6"
              placeholder="Pesan Anda *" required>{{ old('message') }}</textarea>
            @error('message')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>

          @if(config('services.recaptcha.site_key'))
            <div class="col-md-12">
              <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
              @error('g-recaptcha-response')
                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
              @enderror
            </div>
          @endif

          <div class="col-md-12 text-center">
            <button type="submit" class="btn-send" id="submit-btn">Kirim Pesan</button>
          </div>
        </div>
      </form>
@endsection

    @push('scripts')
      @if(config('services.recaptcha.site_key'))
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('contact-form');

            if (form) {
              form.addEventListener('submit', function (e) {
                // Tunggu sampai reCAPTCHA script ter-load
                if (typeof grecaptcha === 'undefined') {
                  e.preventDefault();
                  alert('reCAPTCHA sedang dimuat, silakan tunggu sebentar dan coba lagi.');
                  return false;
                }

                // Pastikan reCAPTCHA sudah diisi
                const recaptchaResponse = grecaptcha.getResponse();
                if (!recaptchaResponse) {
                  e.preventDefault();
                  alert('Silakan centang reCAPTCHA terlebih dahulu.');
                  return false;
                }
              });
            }
          });
        </script>
      @endif
    @endpush