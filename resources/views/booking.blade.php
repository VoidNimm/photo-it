@extends('layouts.app')

@section('title', 'Booking')
@section('body-class', 'booking-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Book Your Service</h1>
                        <p class="mb-0">Isi form di bawah ini untuk melakukan booking layanan fotografi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Form Section -->
    <section id="booking" class="booking section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @if(session('success'))
                        <div class="php-email-form sent-message" style="display: block;">
                            {!! session('success') !!}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="php-email-form error-message" style="display: block;">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('booking.store') }}" method="POST" class="booking-form" data-aos="fade-up"
                        data-aos-delay="200" id="booking-form">
                        @csrf

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <input type="text" name="client_name" id="client_name" class="form-control"
                                    placeholder="Nama Lengkap *" value="{{ old('client_name') }}" required>
                            </div>

                            <div class="col-md-6">
                                <input type="email" name="client_email" id="client_email" class="form-control"
                                    placeholder="Email *" value="{{ old('client_email') }}" required>
                            </div>

                            <div class="col-md-6">
                                <input type="tel" name="client_phone" id="client_phone" class="form-control"
                                    placeholder="Nomor Telepon *" value="{{ old('client_phone') }}" required>
                            </div>

                            <div class="col-md-6">
                                <select name="service_id" id="service_id" class="form-control">
                                    <option value="">Pilih Layanan (Opsional)</option>
                                    @foreach($services as $s)
                                        <option value="{{ $s->id }}" {{ (old('service_id', $service?->id) == $s->id) ? 'selected' : '' }}>
                                            {{ $s->service_name }}
                                            @if($s->price)
                                                - Rp {{ number_format($s->price, 0, ',', '.') }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <input type="date" name="event_date" id="event_date" class="form-control" placeholder="Tanggal Acara"
                                    value="{{ old('event_date') }}" min="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="col-md-6">
                                <input type="text" name="location" id="location" class="form-control"
                                    placeholder="Lokasi Acara" value="{{ old('location') }}" required>
                            </div>

                            <div class="col-md-12">
                                <textarea name="notes" id="notes" class="form-control" rows="6"
                                    placeholder="Catatan Tambahan">{{ old('notes') }}</textarea>
                            </div>

                            <div class="col-md-12 text-center">
                                <button type="submit" id="booking-submit-btn">Submit Booking</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection