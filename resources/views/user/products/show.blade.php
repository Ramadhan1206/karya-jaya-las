@extends('layouts.app')

@section('title', $product->name . ' - Karya Jaya Las')

@section('styles')
<style>
    .product-detail-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 20px 30px;
        color: white;
        margin-bottom: 30px;
    }
    .product-detail-image {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .product-detail-image .main-image {
        width: 100%;
        height: 400px;
        object-fit: contain;
        border-radius: 12px;
        background: #f8fafc;
    }
    .product-detail-image .thumbnails {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        overflow-x: auto;
        padding-bottom: 5px;
    }
    .product-detail-image .thumbnails img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }
    .product-detail-image .thumbnails img:hover,
    .product-detail-image .thumbnails img.active {
        border-color: #4f46e5;
    }
    .product-info-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .product-info-card .product-name {
        font-size: 28px;
        font-weight: 700;
        color: #1e293b;
    }
    .product-info-card .product-brand {
        color: #94a3b8;
        font-size: 16px;
    }
    .product-info-card .product-price {
        font-size: 32px;
        font-weight: 700;
        color: #4f46e5;
        margin: 15px 0;
    }
    .product-info-card .spec-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin: 15px 0;
    }
    .product-info-card .spec-list .spec-item {
        background: #f8fafc;
        padding: 10px 15px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
    }
    .product-info-card .spec-list .spec-item .label {
        color: #64748b;
        font-weight: 500;
    }
    .product-info-card .spec-list .spec-item .value {
        color: #1e293b;
        font-weight: 600;
    }
    .product-info-card .stock-info {
        padding: 12px 20px;
        border-radius: 10px;
        margin: 15px 0;
    }
    .product-info-card .stock-info.available {
        background: #d1fae5;
        color: #065f46;
    }
    .product-info-card .stock-info.low-stock {
        background: #fef3c7;
        color: #92400e;
    }
    .product-info-card .stock-info.sold-out {
        background: #fecaca;
        color: #991b1b;
    }
    .btn-back {
        background: #f1f5f9;
        color: #475569;
        padding: 10px 25px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
    }
    .related-product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        height: 100%;
    }
    .related-product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    }
    .related-product-card .image-container {
        height: 150px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .related-product-card .image-container img {
        max-height: 100%;
        object-fit: cover;
    }
    .related-product-card .body {
        padding: 15px;
        text-align: center;
    }
    .related-product-card .body h6 {
        font-weight: 600;
        margin-bottom: 5px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .related-product-card .body .price {
        color: #4f46e5;
        font-weight: 700;
        font-size: 16px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="product-detail-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('user.products') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i>Kembali ke Katalog
                </a>
                <h4 class="mt-2 mb-0">
                    <i class="fas fa-box me-2"></i>Detail Produk
                </h4>
            </div>
            <span class="badge bg-light text-dark">
                <i class="fas fa-eye me-1"></i> {{ $product->views }} kali dilihat
            </span>
        </div>
    </div>

    <!-- Detail -->
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="product-detail-image">
                <img src="{{ $product->primaryImage ? asset('storage/' . $product->primaryImage->image_url) : asset('default-product.png') }}" 
                     alt="{{ $product->name }}" 
                     class="main-image" 
                     id="mainImage">
                
                @if($product->images->count() > 1)
                    <div class="thumbnails">
                        @foreach($product->images as $image)
                            <img src="{{ asset('storage/' . $image->image_url) }}" 
                                 alt="Thumbnail" 
                                 onclick="changeMainImage(this)" 
                                 class="{{ $image->is_primary ? 'active' : '' }}">
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-7">
            <div class="product-info-card">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge bg-primary bg-opacity-10 text-primary">
                        <i class="fas {{ $product->category->icon ?? 'fa-folder' }} me-1"></i>
                        {{ $product->category->name }}
                    </span>
                    @if($product->featured)
                        <span class="badge bg-warning text-dark">
                            <i class="fas fa-star me-1"></i>Featured
                        </span>
                    @endif
                </div>

                <h2 class="product-name">{{ $product->name }}</h2>
                <p class="product-brand">
                    <i class="fas fa-tag me-1"></i>
                    {{ $product->brand ?? 'Karya Jaya Las' }}
                    @if($product->model)
                        | Model: {{ $product->model }}
                    @endif
                </p>

                <div class="product-price">
                    @if($product->price)
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    @else
                        Hubungi Kami untuk Harga
                    @endif
                </div>

                @php
                    $stockStatus = $product->stock > 10 ? 'available' : ($product->stock > 0 ? 'low-stock' : 'sold-out');
                    $stockLabel = $product->stock > 10 ? 'Tersedia' : ($product->stock > 0 ? 'Stok Terbatas' : 'Habis');
                @endphp
                <div class="stock-info {{ $stockStatus }}">
                    <i class="fas {{ $product->stock > 0 ? 'fa-check-circle' : 'fa-times-circle' }} me-2"></i>
                    <strong>{{ $stockLabel }}</strong>
                    @if($product->stock > 0)
                        - Sisa {{ $product->stock }} {{ $product->unit }}
                    @endif
                </div>

                <div class="mt-3">
                    <h6 class="fw-bold">
                        <i class="fas fa-info-circle me-2"></i>Deskripsi
                    </h6>
                    <p class="text-muted">{{ $product->description }}</p>
                </div>

                @if($product->specifications)
                    <div class="mt-3">
                        <h6 class="fw-bold">
                            <i class="fas fa-cogs me-2"></i>Spesifikasi Teknis
                        </h6>
                        <div class="spec-list">
                            @foreach($product->specifications as $key => $value)
                                <div class="spec-item">
                                    <span class="label">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                                    <span class="value">{{ $value }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($product->warranty)
                    <div class="mt-3">
                        <h6 class="fw-bold">
                            <i class="fas fa-shield-alt me-2"></i>Garansi
                        </h6>
                        <p class="text-muted">{{ $product->warranty }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($related->isNotEmpty())
        <div class="mt-5">
            <h4 class="fw-bold mb-3">
                <i class="fas fa-link me-2"></i>Produk Terkait
            </h4>
            <div class="row g-4">
                @foreach($related as $relatedProduct)
                    <div class="col-lg-3 col-md-4 col-6">
                        <a href="{{ route('user.products.show', $relatedProduct->slug) }}" class="text-decoration-none text-dark">
                            <div class="related-product-card">
                                <div class="image-container">
                                    @if($relatedProduct->primaryImage)
                                        <img src="{{ asset('storage/' . $relatedProduct->primaryImage->image_url) }}" 
                                             alt="{{ $relatedProduct->name }}" 
                                             class="img-fluid">
                                    @else
                                        <i class="fas fa-image text-muted" style="font-size: 40px;"></i>
                                    @endif
                                </div>
                                <div class="body">
                                    <h6>{{ $relatedProduct->name }}</h6>
                                    <div class="price">
                                        @if($relatedProduct->price)
                                            Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}
                                        @else
                                            Hubungi Kami
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<script>
    function changeMainImage(element) {
        // Update main image
        document.getElementById('mainImage').src = element.src;
        
        // Update active class
        document.querySelectorAll('.thumbnails img').forEach(img => {
            img.classList.remove('active');
        });
        element.classList.add('active');
    }
</script>
@endsection
