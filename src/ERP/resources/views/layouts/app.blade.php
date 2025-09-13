<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ERP')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    @yield('styles')
</head>
<body class="d-flex flex-column min-vh-100">
@include('layouts.navbar')

<main class="container py-4 flex-grow-1">
    @include('partials.flash')
    @yield('content')
</main>

<footer class="bg-dark text-white text-center py-3 mt-auto">
    <small>&copy; {{ date('Y') }} ERP App. All rights reserved.</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>feather.replace()</script>
@stack('scripts')
</body>
</html>
