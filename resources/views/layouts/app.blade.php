<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @include('includes.pages.style')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('cs')

</head>

<body>

    @include('includes.pages.navbar')

    @yield('content')

    @include('includes.pages.footer')

    @include('includes.pages.script')

    @stack('js')

</body>

</html>