@extends('layouts.app')

@section('title', 'Product | Sinar Graha Mitra')
    
@section('content')
<section class="error-page text-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <h1 class="fw-bold">404</h1>
          {{-- <h1>404 - Page Not Found</h1> --}}
          <h2 class="fw-bold">Oops! Page Not Found</h2>
          <p>The page you're looking for doesn't exist. It might have been moved, deleted, or never existed in the first place.</p>
          <a href={{ route('home.index') }} class="btn-read-more">Go Back to Homepage</a>
        </div>
      </div>
    </div>
  </section>
  
  
  <!-- /Real Estate Section -->
@endsection