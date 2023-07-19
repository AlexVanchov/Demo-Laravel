<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'My Laravel App')</title>
    <!-- Include any additional CSS or meta tags here -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
<header>
</header>

<main>
    @yield('content')
    <a href="{{ route('credit.index') }}" class="btn btn-primary">All Credits</a>
    @include('components.alerts') <!-- Include the alerts component here -->
</main>

<footer>
    <!-- Add your footer content here -->
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@yield('scripts')
</body>
</html>
