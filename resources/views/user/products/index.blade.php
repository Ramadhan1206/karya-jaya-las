@extends('layouts.app')

@section('title', 'Katalog Produk - Karya Jaya Las')

@section('styles')
<style>
    .product-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 40px;
        color: white;
        margin-bottom: 30px;
    }
    .product-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
    }
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.12);
    }
    .product-card .image-container {
        height: 220px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    .product-card .image-container img {
        max-height: 100%;
        object-fit: cover;
    }
    .product-card .image-container .no-image {
        font-size: 60px;
        color: #cbd5e1;
    }
    .product-card .product-body {
        padding: 20px;
    }
    .product-card .product-body .category-badge {
        background: #eef2ff;
        color: #4f46e5;
        font-size: 11px;
        padding: 3px 12px;
        border-radius: 20px;
        font-weight: 600;
    }
    .product-card .product-body .product-name {
        font-weight: 700;
        color: #1e293b;
        margin: 10px 0 5px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .product-card .product-body .product-brand {
        color: #94a3b8;
        font-size: 13px;
    }
    .product-card .product-body .product-price {
        font-size: 20px;
        font-weight: 700;
        color: #4f46e5;
        margin-top: 10px;
    }
    .product-card .product-body .product-price .old-price {
        text-decoration: line-through;
        color: #94a3b8;
        font-size: 14px;
        font-weight: 400;
        margin-left: 8px;
    }
    .product-card .featured-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #f59e0b;
        color: white;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        z-index: 1;
    }
    .product-card .stock-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        z-index: 1;
    }
    .product-card .stock-badge.available {
        background: #d1fae5;
        color: #065f46;
    }
    .product-card .stock-badge.low-stock {
        background: #fef3c7;
        color: #92400e;
    }
    .product-card .stock-badge.sold-out {
        background: #fecaca;
        color: #991b1b;
    }
    .btn-detail {
        background: #4f46e5;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
    }
    .btn-detail:hover {
        background: #4338ca;
        color: white;
        transform: translateY(-2px);
    }
    .filter-sidebar {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        position: sticky;
        top: 20px;
    }
    .filter-sidebar .filter-title {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 20px;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 10px;
    }
    .filter-sidebar .form-control, .filter-sidebar .form-select {
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        padding: 10px 15px;
    }
    .filter-sidebar .form-control:focus, .filter-sidebar .form-select:focus {
        border-color: #4f46e5;
        box-shadow: none;
    }
    .filter-sidebar .category-item {
        padding: 8px 12px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #475569;
        text-decoration: none;
        display: block;
    }
    .filter-sidebar .category-item:hover {
        background: #f1f5f9;
        color: #4f46e5;
    }
    .filter-sidebar .category-item.active {
        background: #eef2ff;
        color: #4f46e5;
        font-weight: 600;
    }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    .empty-state i {
        font-size: 80px;
        color: #cbd5e1;
        margin-bottom: 20px;
    }
    .empty-state h4 {
        color: #475569;
        margin-bottom: 10px;
    }
    .empty-state p {
        color: #94a3b8;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="product-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-2">
                    <i class="fas fa-boxes me-2"></i>Katalog Produk
                </h2>
                <p class="mb-0 opacity-75">
                    Temukan berbagai produk las berkualitas dari Karya Jaya Las
                </p>
            </div>
            <div class="col-md-4">
                <form action="{{ route('user.products') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control bg-white bg-opacity-25 text-white border-0" 
                           placeholder="Cari produk..." value="{{ request('search') }}" style="border-radius: 10px 0 0 10px;">
                    <button type="submit" class="btn btn-light" style="border-radius: 0 10px 10px 0;">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Sidebar Filter -->
        <div class="col-lg-3">
            <div class="filter-sidebar">
                <h5 class="filter-title">
                    <i class="fas fa-filter me-2"></i>Filter Produk
                </h5>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori</label>
                    <div class="d-flex flex-column gap-1">
                        <a href="{{ route('user.products') }}" class="category-item {{ !request('category') ? 'active' : '' }}">
                            <i class="fas fa-th-list me-2"></i>Semua Kategori
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('user.products', ['category' => $cat->id]) }}" 
                               class="category-item {{ request('category') == $cat->id ? 'active' : '' }}">
                                <i class="fas {{ $cat->icon ?? 'fa-folder' }} me-2"></i>{{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <hr>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Urutkan</label>
                    <select name="sort" class="form-select" onchange="this.form.submit()" form="filter-form">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama (A-Z)</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga (Termurah)</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga (Termahal)</option>
                    </select>
                </div>

                <form id="filter-form" action="{{ route('user.products') }}" method="GET">
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                </form>

                <a href="{{ route('user.products') }}" class="btn btn-outline-secondary w-100">
                    <i class="fas fa-undo me-2"></i>Reset Filter
                </a>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">
                    Menampilkan <strong>{{ $products->total() }}</strong> produk
                </span>
            </div>

            @if($products->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <h4>Tidak ada produk</h4>
                    <p>Belum ada produk yang tersedia pada kategori ini.</p>
                    <a href="{{ route('user.products') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>Lihat Semua Produk
                    </a>
                </div>
            @else
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-md-4 col-6">
                            <div class="product-card">
                                @if($product->featured)
                                    <span class="featured-badge">
                                        <i class="fas fa-star me-1"></i>Featured
                                    </span>
                                @endif
                                
                                @php
                                    $stockStatus = $product->stock > 10 ? 'available' : ($product->stock > 0 ? 'low-stock' : 'sold-out');
                                    $stockLabel = $product->stock > 10 ? 'Tersedia' : ($product->stock > 0 ? 'Stok Terbatas' : 'Habis');
                                @endphp
                                <span class="stock-badge {{ $stockStatus }}">
                                    <i class="fas {{ $product->stock > 0 ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                                    {{ $stockLabel }}
                                </span>

                                <div class="image-container">
                                    @if($product->primaryImage)
                                        <img src="{{ asset('storage/' . $product->primaryImage->image_url) }}" 
                                             alt="{{ $product->name }}" 
                                             class="img-fluid">
                                    @else
                                        <div class="no-image">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="product-body">
                                    <span class="category-badge">
                                        <i class="fas {{ $product->category->icon ?? 'fa-folder' }} me-1"></i>
                                        {{ $product->category->name }}
                                    </span>
                                    <h5 class="product-name">{{ $product->name }}</h5>
                                    <p class="product-brand">
                                        <i class="fas fa-tag me-1"></i>
                                        {{ $product->brand ?? 'Karya Jaya Las' }}
                                    </p>
                                    <div class="product-price">
                                        @if($product->price)
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        @else
                                            Hubungi Kami
                                        @endif
                                    </div>
                                    <a href="{{ route('user.products.show', $product->slug) }}" 
                                       class="btn-detail btn mt-2">
                                        <i class="fas fa-eye me-2"></i>Detail Produk
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection