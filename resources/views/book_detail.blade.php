@extends('layouts.app')

@section('title', 'Book Detail - BookStore')

@section('content')
<div class="book-detail-container">
    <div class="book-breadcumb">
        {{-- <a href="{{route('home')}}" >Trang chủ</a> --}}
        <span>/</span>
        <a href="#">Sách</a>
        <span>/</span>
        <span>Chi tiết sách</span>
    </div>
    <div class="book-detail">
        <div class="book-image">
            <img src="{{ asset('images/book.jpg') }}" alt="Book Image">
        </div>
        <div class="book-info">
            <span class="book-category">{{ $product['category'] }}</span>
            <h1 class="book-title">{{ $product['name'] }}</h1>
            <p class="book-author">Tác giả: {{ $product['author'] }}</p>
            <div class="book-rating">
                <span>
                    @for ($i = 0; $i < 5; $i++)
                        @if ($i < $product['rating'])
                            <i class="fas fa-star"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </span>
            </div>
            <p class="book-price">Giá: {{ number_format($product['price'], 0, ',', '.') }} VND</p>
            <p class="book-description">
                Mô tả: {{ $product['description'] }}
            </p>
            <p class="stock-status">
                Tình trạng: 
                @if ($product['stock'] > 0)
                    <span class="in-stock">Còn hàng</span>
                @else
                    <span class="out-of-stock">Hết hàng</span>
                @endif
            </p>    
            <button class="add-to-cart-btn">Thêm vào giỏ hàng</button>
        </div>
</div>
@endsection