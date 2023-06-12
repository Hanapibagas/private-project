<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @stack('css')
    @include('includes.app.style')

</head>

<body>
    @include('includes.app.navbar')

    @yield('content')

    @include('includes.app.footer')

    @stack('js')
    @include('includes.app.script')
</body>

</html>