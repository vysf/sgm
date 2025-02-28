@extends('layouts.app', [$company, $product])

@section('title', 'Product Detail | Sinar Graha Mitra')
    
@section('content')
   <!-- Page Title -->
   <div class="page-title" data-aos="fade">
    {{-- <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>Property Single</h1>
            <p class="mb-0">Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.</p>
          </div>
        </div>
      </div>
    </div> --}}
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ route('home.index') }}">Home</a></li>
          <li><a href="{{ route('product.index') }}">Products</a></li>
          <li class="current">{{ $product->name }}</li>
        </ol>
      </div>
    </nav>
  </div><!-- End Page Title -->

  <!-- Real Estate 2 Section -->
  <section id="real-estate-2" class="real-estate-2 section">

    <div class="container" data-aos="fade-up">

      <div class="portfolio-details-slider swiper init-swiper">
        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "navigation": {
              "nextEl": ".swiper-button-next",
              "prevEl": ".swiper-button-prev"
            },
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            }
          }
        </script>
        {{-- @dd($product->galeries) --}}
        <div class="swiper-wrapper align-items-center">
          @forelse ($product->galeries as $image)
            <div class="swiper-slide">
              <img src="{{ Storage::url($image) }}" alt="{{ $product->name }}" class="rounded">
            </div>
          @empty
              
          @endforelse
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-pagination"></div>
      </div>

      <div class="row justify-content-between gy-4 mt-4">

        <div class="col-lg-8" data-aos="fade-up">

          <div class="portfolio-description">
            {!! $product->content !!}
            <div class="testimonial-item">
              <p>
                <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
              </p>
              <div>
                <img src="{{ asset('assets/img/testimonials/testimonials-2.jpg') }}" class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Agent</h4>
              </div>
            </div>
          </div><!-- End Portfolio Description -->

          <!-- Tabs -->
          <ul class="nav nav-pills mb-3">
            <li><a class="nav-link active" data-bs-toggle="pill" href="#real-estate-2-tab1">Video</a></li>
            <li><a class="nav-link" data-bs-toggle="pill" href="#real-estate-2-tab2">Floor Plans</a></li>
            <li><a class="nav-link" data-bs-toggle="pill" href="#real-estate-2-tab3">Location</a></li>
          </ul><!-- End Tabs -->

          <!-- Tab Content -->
          <div class="tab-content">

            <div class="tab-pane fade show active" id="real-estate-2-tab1">
              @if (!is_null($product->video))
                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $product->video }}?si=xF5_3vy-XC5pD6rC" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
              @else
                <p>No video available for this product.</p>  
              @endif
            </div>
            <!-- End Tab 1 Content -->

            <div class="tab-pane fade" id="real-estate-2-tab2">
              <img src="{{ asset('assets/img/floor-plan.jpg') }}" alt="" class="img-fluid">
            </div><!-- End Tab 2 Content -->

            <div class="tab-pane fade" id="real-estate-2-tab3">
              <iframe style="border:0; width: 100%; height: 400px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div><!-- End Tab 3 Content -->

          </div><!-- End Tab Content -->

        </div>

        <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
          <div class="portfolio-info">
            <h3>Quick Summary</h3>
            <ul>
              <li><strong>Property ID:</strong> 1134n</li>
              <li><strong>Location:</strong> Chicago, IL 606543</li>
              <li><strong>Property Type:</strong> House</li>
              <li><strong>Status:</strong> Sale</li>
              <li><strong>Area:</strong> <span>340m <sup>2</sup></span></li>
              <li><strong>Beds:</strong> 4</li>
              <li><strong>Baths:</strong> 1</li>
            </ul>
          </div>
        </div>

      </div>

    </div>

  </section><!-- /Real Estate 2 Section -->
@endsection