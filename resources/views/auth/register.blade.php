@extends('layouts.app')

@section('title', __('common.register'))
@section('body-class', 'auth-page')

@section('content')
<!-- Page Title -->
<div class="page-title" data-aos="fade">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>{{ __('common.register') }}</h1>
                    <p class="mb-0">{{ __('common.register_title') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Register Section -->
<section id="register" class="auth section">
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

                    @if (session('success'))
                        <div class="auth-alert sent-message">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="auth-form">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="form-label">{{ __('common.name') }}</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autofocus
                                   placeholder="{{ __('common.name_placeholder') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('common.email') }}</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required
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

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">{{ __('common.password_confirmation') }}</label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required
                                   placeholder="{{ __('common.password_confirmation_placeholder') }}">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn-auth">{{ __('common.register') }}</button>
                        </div>
                    </form>

                    <div class="auth-footer">
                        <p>{{ __('common.have_account') }} <a href="{{ route('login') }}">{{ __('common.login') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection