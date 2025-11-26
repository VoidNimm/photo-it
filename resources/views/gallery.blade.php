@extends('layouts.app')

@section('title', __('common.gallery'))
@section('body-class', 'gallery-page')

@section('content')
  <!-- Page Title -->
  <div class="page-title" data-aos="fade">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>{{ __('common.gallery') }}</h1>
            <p class="mb-0">{{ __('common.gallery_subtitle') }}</p>
            <a href="{{ route('contact') }}" class="cta-btn">{{ __('common.available_for_booking') }}</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Filter Section -->
  <section class="gallery-filters-section section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="gallery-filters">
        <form action="{{ route('gallery') }}" method="GET" class="gallery-filter-form mx-auto" style="max-width: 800px;">
          <div class="row g-3 align-items-end justify-content-center">

            <!-- Category Filter -->
            <div class="col-md-6 col-lg-4">
              <select name="category" id="gallery-category" class="form-control gallery-filter-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ ($selectedCategory ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Filter Buttons -->
            <div class="col-md-12 col-lg-4">
              <div class="d-flex gap-2">
                <button type="submit" class="btn-filter">
                  <i class="bi bi-funnel"></i>Filter
                </button>
                @if($searchTerm || $selectedCategory)
                  <a href="{{ route('gallery') }}" class="btn-reset">
                    <i class="bi bi-x-circle"></i> Reset
                  </a>
                @endif
              </div>
            </div>
          </div>
        </form>
      </div>

      <!-- Results Count -->
      @if($searchTerm || $selectedCategory)
        <div class="gallery-results-info mt-3" data-aos="fade-up" data-aos-delay="150">
          <p class="mb-0">
            {{ __('common.gallery_results_count') }} <strong>{{ $galleryItems->count() }}</strong> gambar
            @if($searchTerm)
              {{ __('common.gallery_results_count_search_term') }} "<strong>{{ $searchTerm }}</strong>"
            @endif
            @if($selectedCategory)
              {{ __('common.gallery_results_count_selected_category') }} <strong>{{ $categories->where('id', $selectedCategory)->first()?->category_name }}</strong>
            @endif
          </p>
        </div>
      @endif
    </div>
  </section>

  <!-- Gallery Section -->
  <section id="gallery" class="gallery section">
    <div class="container-fluid" data-aos="fade-up" data-aos-delay="200">
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
          <div class="col-12 text-center py-5">
            <i class="bi bi-image" style="font-size: 48px; opacity: 0.3; margin-bottom: 15px;"></i>
            <p style="font-size: 18px; opacity: 0.7;">
              @if($searchTerm || $selectedCategory)
                {{ __('common.gallery_empty_search_term_selected_category') }}
              @else
                {{ __('common.gallery_empty_no_gallery') }}
              @endif
            </p>
            @if($searchTerm || $selectedCategory)
              <a href="{{ route('gallery') }}" class="btn-reset mt-3">
                <i class="bi bi-arrow-counterclockwise"></i> {{ __('common.gallery_reset_filter_button') }}
              </a>
            @endif
          </div>
        @endforelse
      </div>
    </div>
  </section>
@endsection