@extends('layouts.app')

@section('title', 'Lupa Password')
@section('body-class', 'auth-page')

@section('content')
<div class="page-title" data-aos="fade">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Lupa Password</h1>
                    <p class="mb-0">Masukkan email Anda untuk menerima link reset password</p>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="forgot-password" class="auth section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="auth-card">
                    @if ($errors->any())
                        <div class="auth-alert error-message">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus
                                   placeholder="Masukkan email Anda">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn-auth">Kirim Link Reset Password</button>
                        </div>
                    </form>

                    <div class="auth-footer">
                        <p><a href="{{ route('login') }}">Kembali ke Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    (function() {
        function initForgotPassword() {
            // Pastikan Swal sudah tersedia
            if (typeof window.Swal === 'undefined') {
                setTimeout(initForgotPassword, 100);
                return;
            }

            const Swal = window.Swal;

            // SweetAlert untuk success message
            @if(session('status'))
                Swal.fire({
                    icon: 'success',
                    title: 'Email Terkirim!',
                    text: '{{ session('status') }}',
                    confirmButtonColor: '#27a776',
                    confirmButtonText: 'OK',
                    timer: 5000,
                    timerProgressBar: true,
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
                    title: 'Terjadi Kesalahan',
                    html: '<ul style="text-align: left; margin: 10px 0; padding-left: 20px;">' +
                        errorMessages.map(msg => '<li>' + msg + '</li>').join('') +
                        '</ul>',
                    confirmButtonColor: '#27a776',
                    confirmButtonText: 'OK'
                });
            @endif
        }

        // Tunggu sampai DOM ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initForgotPassword);
        } else {
            initForgotPassword();
        }
    })();
</script>
@endpush
@endsection