<!DOCTYPE html>
<html lang="en">

<head>

    <title>@yield('title') - Dashboard</title>

    @include('includes.dashboard.style')

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
        integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

    @stack('add-style')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body id="page-top">

    <div id="wrapper">

        @include('includes.dashboard.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('includes.dashboard.navbar')

                <div class="container-fluid">

                    @yield('content')
                </div>

            </div>

            @include('includes.dashboard.footer')

        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('includes.dashboard.script')

    @stack('add-script')

</body>

</html>