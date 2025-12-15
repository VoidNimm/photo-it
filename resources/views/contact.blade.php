@extends('layouts.app')

@section('title', __('common.contact'))
@section('body-class', 'contact-page')

@section('content')
  <!-- Page Title -->
  <div class="page-title" data-aos="fade">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>{{ __('common.contact') }}</h1>
            <p class="mb-0">{{ __('common.contact_subtitle') }}</p>
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
                <h3>{{ __('common.contact_studio') }}</h3>
                <p>Jl. Senopati No. 14, Kebayoran Baru<br>{{ __('common.contact_studio_city') }}</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="info-item d-flex align-items-center">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>0811-2222-410</h3>
                <p>{{ __('common.contact_session_hours') }}</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="info-item d-flex align-items-center">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>hello@photoit.id</h3>
                <p>booking@photoit.id</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Hapus success message div karena akan menggunakan SweetAlert --}}
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
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" maxlength="255"
              placeholder="{{ __('common.contact_form_name') }} *" value="{{ old('name') }}" required>
            @error('name')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" maxlength="255"
              placeholder="{{ __('common.contact_form_email') }} *" value="{{ old('email') }}" required>
            @error('email')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" maxlength="255"
              placeholder="{{ __('common.contact_form_phone') }}" value="{{ old('phone') }}">
            @error('phone')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" maxlength="255"
              placeholder="{{ __('common.contact_form_subject') }} *" value="{{ old('subject') }}" required>
            @error('subject')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-12">
            <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="6" maxlength="1000"
              placeholder="{{ __('common.contact_form_message') }} *" required>{{ old('message') }}</textarea>
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
            <button type="submit" class="btn-send" id="submit-btn">{{ __('common.contact_send_message') }}</button>
          </div>
        </div>
      </form>
@endsection

@push('scripts')
  <script>
    // Tunggu sampai DOM dan Vite bundle ter-load
    (function() {
      function initContactForm() {
        // Pastikan Swal sudah tersedia (dari Vite bundle)
        if (typeof window.Swal === 'undefined') {
          // Jika belum, tunggu sebentar dan coba lagi
          setTimeout(initContactForm, 100);
          return;
        }

        const Swal = window.Swal;

        // SweetAlert untuk success message
        @if(session('success'))
          Swal.fire({
            icon: 'success',
            title: '{{ __('common.contact_success_title') }}',
            text: '{{ __('common.contact_success_message') }}',
            confirmButtonColor: '#27a776',
            confirmButtonText: 'OK',
            timer: 5000,
            timerProgressBar: true,
          }).then(() => {
            // Reset form setelah user klik OK
            const form = document.getElementById('contact-form');
            if (form) {
              form.reset();
            }
          });
        @endif

        // SweetAlert untuk error messages
        @if($errors->any())
          const errorMessages = [
            @foreach($errors->all() as $error)
              '{{ $error }}'@if(!$loop->last),@endif
            @endforeach
          ];
          
          Swal.fire({
            icon: 'error',
            title: '{{ __('common.contact_error_title') }}',
            html: '<ul style="text-align: left; margin: 10px 0; padding-left: 20px;">' +
              errorMessages.map(msg => '<li>' + msg + '</li>').join('') +
              '</ul>',
            confirmButtonColor: '#27a776',
            confirmButtonText: 'OK'
          });
        @endif

        // Form submission dengan reCAPTCHA
        const form = document.getElementById('contact-form');
        if (form) {
          form.addEventListener('submit', function (e) {
            @if(config('services.recaptcha.site_key'))
              // Tunggu sampai reCAPTCHA script ter-load
              if (typeof grecaptcha === 'undefined') {
                e.preventDefault();
                Swal.fire({
                  icon: 'warning',
                  title: 'Tunggu sebentar',
                  text: 'reCAPTCHA sedang dimuat, silakan tunggu sebentar dan coba lagi.',
                  confirmButtonColor: '#27a776',
                });
                return false;
              }

              // Pastikan reCAPTCHA sudah diisi
              const recaptchaResponse = grecaptcha.getResponse();
              if (!recaptchaResponse) {
                e.preventDefault();
                Swal.fire({
                  icon: 'warning',
                  title: 'Perhatian',
                  text: 'Silakan centang reCAPTCHA terlebih dahulu.',
                  confirmButtonColor: '#27a776',
                });
                return false;
              }
            @endif

            // Show loading state
            const submitBtn = document.getElementById('submit-btn');
            if (submitBtn) {
              submitBtn.disabled = true;
              submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mengirim...';
            }
          });
        }
      }

      // Jalankan setelah DOM ready
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initContactForm);
      } else {
        // DOM sudah ready, tunggu sebentar untuk memastikan Vite bundle ter-load
        setTimeout(initContactForm, 200);
      }
    })();
  </script>

  {{-- reCAPTCHA tetap CDN karena harus dari Google --}}
  @if(config('services.recaptcha.site_key'))
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  @endif
@endpush