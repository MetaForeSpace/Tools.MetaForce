<!doctype html>
<html>
<head>
    @yield('head')
    @vite(['resources/css/app.css'])
    @include('includes.header')
</head>
<body>
    <div id="main">
        @yield('content')
    </div>
    <footer class="row">
        @include('includes.footer')
    </footer>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>
</html>
