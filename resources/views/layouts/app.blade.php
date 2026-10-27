<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'BookStore')</title>

    {{-- Bootstrap CSS --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- CSS riêng của BookStore --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- CSS bổ sung cho nội dung --}}
    <style>
        .main-content {
            min-height: 65vh;
        }

        .checkout-page {
            padding-top: 40px;
            padding-bottom: 50px;
        }

        .checkout-page .form-control {
            padding: 11px 13px;
            border: 1px solid #ced4da;
            border-radius: 8px;
        }

        .checkout-page .form-control:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.12);
        }

        .checkout-page .card {
            border-radius: 14px;
        }

        .checkout-page .checkout-heading {
            color: #114b3e;
            font-weight: 700;
        }

        .checkout-page .checkout-submit {
            background-color: #114b3e;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 13px;
            font-weight: 700;
            transition: background-color 0.2s;
        }

        .checkout-page .checkout-submit:hover {
            background-color: #176b54;
            color: #fff;
        }

        .checkout-page .checkout-product-image {
            width: 55px;
            height: 72px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
        }

        .checkout-page .checkout-total {
            color: #dc3545;
            font-size: 24px;
            font-weight: 800;
        }

        .checkout-page .payment-option {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: border-color 0.2s, background-color 0.2s;
        }

        .checkout-page .payment-option:has(input:checked) {
            border-color: #198754;
            background-color: #f2faf5;
        }

        .checkout-page .payment-option input {
            margin-top: 5px;
            flex-shrink: 0;
        }

        @media (max-width: 767.98px) {
            .checkout-page {
                padding-top: 24px;
                padding-bottom: 30px;
            }

            .checkout-page .checkout-total {
                font-size: 21px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    @include('partials.header')

    @include('partials.navbar')

    <main class="main-content">
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- Bootstrap JavaScript --}}
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

    @stack('scripts')
</body>
</html>