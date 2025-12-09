@extends('layouts.app')

@section('title', __('common.login'))
@section('body-class', 'auth-page')

@section('content')
<!-- Page Title -->
<div class="page-title" data-aos="fade">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>{{ __('common.login') }}</h1>
                    <p class="mb-0">{{ __('common.login_title') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Login Section -->
<section id="login" class="auth section">
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

                    <form method="POST" action="{{ route('login') }}" class="auth-form">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('common.email') }}</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus
                                   placeholder="{{ __('common.email_placeholder') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">{{ __('common.password') }}</label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   required
                                   placeholder="{{ __('common.password_placeholder') }}">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group form-check-group">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="remember" 
                                   name="remember">
                            <label class="form-check-label" for="remember">
                                {{ __('common.remember_me') }}
                            </label>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn-auth">{{ __('common.login') }}</button>
                        </div>
                    </form>

                    <div class="auth-footer">
                        <p>{{ __('common.no_account') }} <a href="{{ route('register') }}">{{ __('common.register') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection