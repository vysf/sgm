<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title', 'Index - EstateAgency Bootstrap Template')</title>

  {{-- SEO --}}
  @if (isset($product) && $product)
    <meta name="description" content="{{ $product->description }}">
    <meta name="keywords" content="{{ $product->keyword }}">

    {{-- Open Graph Tags --}}
    <meta property="og:title" content="{{ $product->name }}">
    <meta property="og:description" content="{{ $product->description }}">
    <meta property="og:image" content="{{ Storage::url($product->image) }}">
    <meta property="og:url" content="{{ route('product.detail', $product->slug) }}">

    {{-- Twitter Card Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $product->name }}">
    <meta name="twitter:description" content="{{ $product->description }}">
    <meta name="twitter:image" content="{{ Storage::url($product->image) }}">

  @else    
    <meta name="description" content="">
    <meta name="keywords" content="export, tropical">
  @endif

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo-STA-32x32.png') }}" rel="icon" type="image/png">
  <link href="{{ asset('assets/img/logo-STA-32x32.png') }}" rel="apple-touch-icon" type="image/png">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="{{ route('home.index') }}" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('assets/img/logo-STA-140x211.png') }}" alt="">
        {{-- <h1 class="sitename">CV. Sinar Graha <span>Mitra</span></h1> --}}
        <h1 class="sitename">Estate<span>Agency</span></h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('home.index') }}" class="{{ request()->routeIs('home.index') ? 'active' : '' }}">Home</a></li>
          <li><a href="{{ route('gallery.index') }}" class="{{ request()->routeIs('gallery.index') ? 'active' : '' }}">Gallery</a></li>
          <li><a href="{{ route('product.index') }}" class="{{ request()->routeIs('product.index') ? 'active' : '' }}">Products</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">
    @yield('content')
  </main>

  @if (isset($product) && $product)
    <footer id="footer" class="footer light-background">

      <div class="container">
        <div class="row gy-3">
          <div class="col-lg-3 col-md-6 d-flex">
            <i class="bi bi-geo-alt icon"></i>
            @php
                // Memisahkan alamat berdasarkan koma
                $parts = explode(',', $company->contact->address);
                $addressPart1 = trim($parts[0]);
                $addressPart2 = implode(', ', array_slice($parts, 1));
            @endphp
            <div class="address">
              <h4>Address</h4>
              <p>{{ $addressPart1 }}</p>
              <p>{{ $addressPart2 }}</p>
              <p></p>
            </div>

          </div>

          <div class="col-lg-3 col-md-6 d-flex">
            <i class="bi bi-telephone icon"></i>
            <div>
              <h4>Contact</h4>
              <p>
                <strong>Phone:</strong> <span>{{ $company->contact->phone }}</span><br>
                <strong>Email:</strong> <span>{{ $company->contact->email }}</span><br>
              </p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex">
            <i class="bi bi-clock icon"></i>
            <div>
              <h4>Opening Hours</h4>
              <p>
                <strong>Mon-Sat:</strong> <span>11AM - 23PM</span><br>
                <strong>Sunday</strong>: <span>Closed</span>
              </p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <h4>Follow Us</h4>
            <div class="social-links d-flex">
              @forelse ($company->socialMedias as $socialMedia)
              <a href="{{ $socialMedia->url }}" class="{{ $socialMedia->name }}"><i class="{{ $socialMedia->icon }}"></i></a>
              @empty
                  <p>no social media founded</p>
              @endforelse
            </div>
          </div>

        </div>
      </div>

      <div class="container copyright text-center mt-4">
        <p>
          © <span>Copyright</span> <strong class="px-1 sitename">CV. Sinar Graha Mandiri</strong> <span>All Rights Reserved</span>
        </p>
      </div>

    </footer>
  @else
      @php
          $company = [
            'contact' => [
                'phone' => '+1 5589 55488 55',
                'email' => 'info@example.com',
                'address' => 'A108 Adam Street, New York, NY 535022'
            ],
            'socialMedias' => [
                [
                    'name' => 'twitter',
                    'icon' => 'bi bi-twitter',
                    'url' => 'http://127.0.0.1:8000/',
                ],
                [
                    'name' => 'facebook',
                    'icon' => 'bi bi-facebook',
                    'url' => 'http://127.0.0.1:8000/',
                ],
                [
                    'name' => 'instagram',
                    'icon' => 'bi bi-instagram',
                    'url' => 'http://127.0.0.1:8000/',
                ],
                [
                    'name' => 'linkedin',
                    'icon' => 'bi bi-linkedin',
                    'url' => 'http://127.0.0.1:8000/',
                ],
            ]
        ]
      @endphp

      <footer id="footer" class="footer light-background">

        <div class="container">
          <div class="row gy-3">
            <div class="col-lg-3 col-md-6 d-flex">
              <i class="bi bi-geo-alt icon"></i>
              @php
                  // Memisahkan alamat berdasarkan koma
                  $parts = explode(',', $company['contact']['address']);
                  $addressPart1 = trim($parts[0]);
                  $addressPart2 = implode(', ', array_slice($parts, 1));
              @endphp
              <div class="address">
                <h4>Address</h4>
                <p>{{ $addressPart1 }}</p>
                <p>{{ $addressPart2 }}</p>
                <p></p>
              </div>

            </div>

            <div class="col-lg-3 col-md-6 d-flex">
              <i class="bi bi-telephone icon"></i>
              <div>
                <h4>Contact</h4>
                <p>
                  <strong>Phone:</strong> <span>{{ $company['contact']['phone'] }}</span><br>
                  <strong>Email:</strong> <span>{{ $company['contact']['email'] }}</span><br>
                </p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex">
              <i class="bi bi-clock icon"></i>
              <div>
                <h4>Opening Hours</h4>
                <p>
                  <strong>Mon-Sat:</strong> <span>11AM - 23PM</span><br>
                  <strong>Sunday</strong>: <span>Closed</span>
                </p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <h4>Follow Us</h4>
              <div class="social-links d-flex">
                @forelse ($company['socialMedias'] as $socialMedia)
                <a href="{{ $socialMedia['url'] }}" class="{{ $socialMedia['name'] }}"><i class="{{ $socialMedia['icon'] }}"></i></a>
                @empty
                    <p>no social media founded</p>
                @endforelse
              </div>
            </div>

          </div>
        </div>

        <div class="container copyright text-center mt-4">
          <p>
            © <span>Copyright</span> <strong class="px-1 sitename">CV. Sinar Graha Mandiri</strong> <span>All Rights Reserved</span>
          </p>
        </div>

      </footer>
  @endif

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>