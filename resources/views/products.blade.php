@extends('layouts.app', $company)

@section('title', 'Product | Sinar Graha Mitra')
    
@section('content')
   <!-- Page Title -->
   <div class="page-title" data-aos="fade"> 
    {{-- <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>Properties</h1>
            <p class="mb-0">Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.</p>
          </div>
        </div>
      </div>
    </div> --}}
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ route('home.index') }}">Home</a></li>
          <li class="current">Products</li>
        </ol>
      </div>
    </nav>
  </div>
  <!-- End Page Title -->

  <!-- Real Estate Section -->
  <section id="real-estate" class="real-estate section">
    <div class="container">
      <form class="d-flex mb-4" role="search">
        @csrf
        <input class="form-control me-2" name="search" id="search" type="search" placeholder="Search a product" aria-label="Search">
        <button class="btn my-btn-custom" type="submit">Search</button>
      </form>

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
      {{-- <div class="centering-btn" data-aos="fade-up" data-aos-delay="100">
        <a href="{{ route('product.index') }}" class="btn-read-more">Load More</a>
      </div> --}}
      

      <div class="mt-4">
        {{ $products->links('vendor.pagination.bootstrap-5') }}
      </div>
    </div>
    
    {{-- <nav class="mt-4" aria-label="Page navigation example" data-aos="fade-up" data-aos-delay="100">
      <ul class="pagination justify-content-center">
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Next</a>
        </li>
      </ul>
    </nav> --}}
  </section>
  
  
  <!-- /Real Estate Section -->
@endsection