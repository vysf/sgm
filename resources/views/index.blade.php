@extends('layouts.app', $company)

@section('title', 'Home | Sinar Graha Mitra')
{{-- @dd($company->commitment->commitment_list[0]->icon) --}}
@section('content')
    
    {{-- @dd('products') --}}

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

        <div class="carousel-item active">
          <img src="{{ asset('assets/img/hero-carousel/hero-1.jpg') }}" alt="">
          <div class="carousel-container">
            <div>
              <p>Pontianak, Indonesia</p>
              {{-- <h2>Sinar Graha <span>Mitra</span></h2> --}}
              <h2>Estate<span>Agency</span></h2>
              <h3>The Best Indonesian Export Product</h3>
              <h3>Product Supplier Comes From Here</h3>
              <a href="{{ route('product.index') }}" class="btn-get-started">Explore Products</a>
            </div>
          </div>
        </div>
        <!-- End Carousel Item -->

      </div>

    </section>
    <!-- /Hero Section -->

    <!-- About Us Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About Us</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p class="who-we-are">Who We Are</p>
            <h3>{{ $company->aboutUs->title }}</h3>
            {{-- <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
            </ul> --}}
            {!! $company->aboutUs->description !!}
            <!-- <a href="property-single.html" class="btn-read-more">Read More</a> -->
          </div>

          <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">
              <div class="col-lg-6">
                <img src="{{ asset('assets/img/hero-carousel/hero-5.jpg') }}" class="img-fluid" alt="">
              </div>
              <div class="col-lg-6">
                <div class="row gy-4">
                  <div class="col-lg-12">
                    <img src="{{ asset('assets/img/hero-carousel/hero-3.jpg') }}" class="img-fluid" alt="">
                  </div>
                  <div class="col-lg-12">
                    <img src="{{ asset('assets/img/hero-carousel/hero-7.jpg') }}" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </section>
    <!-- End About Us Section -->

    <!-- Product Section -->
    <section id="real-estate" class="real-estate section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Products</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          <!-- End Property Item -->
          @forelse ($products as $product)
            <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="card">
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                <div class="card-body">
                  <h3><a href="{{ route('product.detail', $product->slug) }}" class="stretched-link">{{ $product->name }}</a></h3>
                  <!-- <div class="card-content d-flex flex-column justify-content-center text-center"> -->
                  <div class="card-content d-flex flex-column justify-content-center">
                    <p class="propery-info">{{ Str::limit(strip_tags($product->content), 150) }}</p>
                  </div>
                  <span class="sale-rent">Read more &raquo;</span>
                </div>
              </div>
            </div>
          @empty
            <p>No products found</p>
          @endforelse
          
          <!-- End Property Item -->
        </div>
        <div class="centering-btn mt-4" data-aos="fade-up" data-aos-delay="100">
          <a href="{{ route('product.index') }}" class="btn-read-more">Explore Products</a>
        </div>
      </div>

    </section>
    <!-- /Product Section -->

    <!-- Key Feature Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Our Key Features</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <!-- Card Produk -->
          @forelse ($company->keyFeatures as $keyFeature)
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="product-card position-relative">
                <!-- Gambar Produk -->
                 
                <div class="image">
                    <img src="{{ asset('assets/img/hero-carousel/hero-6.jpg') }}" alt="Produk" class="product-image">
                </div>
                <div class="card-info">
                  
                  <div class="icon">
                    <i class="{{ $keyFeature->icon }}"></i>
                  </div>
                  <div class="stretched-link">
                    <h3>{{ $keyFeature->title }}</h3>
                  </div>
                  <p>{{ $keyFeature->description }}</p>
                </div>
            </div>
          </div>
          @empty
          <p>No key features found</p>
          @endforelse
        </div>
      </div>
    </section>
    <!-- /Services Section -->

    

     <!-- Features Section -->
     <section id="features" class="features section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Our Commitment</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row justify-content-around gy-4">
          <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <img src="{{ asset('assets/img/hero-carousel/hero-8.jpg') }}" alt="">
          </div>

          <div class="col-lg-5 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <h3>{{ $company->commitment->title }}</h3>
            <p>{{ $company->commitment->description }}</p>

            {{-- @dd($company->commitment->commitment_list) --}}
            
            @forelse ($company->commitment->commitment_list as $commitment)
            {{-- @dd($commitment['icon']) --}}
            <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="300">
              <i class="{{ $commitment['icon'] }} flex-shrink-0"></i>
              <div>
                <h4>
                  <p href="" class="stretched-link">{{ $commitment['title'] }}</p>
                </h4>
                <p>{{ $commitment['description'] }}</p>
              </div>
            </div><!-- End Icon Box -->
            @empty
            <p>No commitment list found</p>
            @endforelse
          </div>
        </div>

      </div>

    </section><!-- /Features Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact Us</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
          <iframe class="rounded" style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.8175145444766!2d109.3311766!3d-0.0364145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d59aaa158addb%3A0x9916ae6426d80357!2sPontianak%20Convention%20Centre!5e0!3m2!1sen!2sid!4v1737615349205!5m2!1sen!2sid" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div><!-- End Google Maps -->

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Address</h3>
                <p>{{ $company->contact->address }}</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>{{ $company->contact->phone }}</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>{{ $company->contact->email }}</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('contact.sendEmail') }}" method="POST" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              @csrf
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control rounded" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control rounded" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control rounded" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control rounded" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->
    @endsection