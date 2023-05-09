<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>@yield('title')</title>

    @include('includes.admin.style')
    @stack('style')

</head>

<body>

    @include('includes.admin.sidebar')

    <div class="overlay"></div>

    <main class="main-wrapper">

        @include('includes.admin.header')

        <section class="section">

            @yield('content')

        </section>

        @include('includes.admin.footer')
        @stack('script')

    </main>

    <button class="option-btn">
        <i class="lni lni-cog"></i>
    </button>
    <div class="option-overlay"></div>
    <div class="option-box">
        <div class="option-header">
            <div>
                <h5>Theme Customizer</h5>
                <p class="text-gray">Customize and Preview in Real time</p>
            </div>
            <button class="option-btn-close text-gray">
                <i class="lni lni-close"></i>
            </button>
        </div>
        <h6 class="mb-10">Sidebar</h6>
        <ul class="mb-30">
            <li><button class="leftSidebarButton active">Left Sidebar</button></li>
            <li><button class="rightSidebarButton">Right Sidebar</button></li>
        </ul>

        <h6 class="mb-10">Theme</h6>
        <ul class="d-flex flex-wrap align-items-center">
            <li>
                <button class="lightThemeButton active">
                    Light Theme + Sidebar 1
                </button>
            </li>
            <li>
                <button class="lightThemeButton2">Light Theme + Sidebar 2</button>
            </li>
            <li><button class="darkThemeButton">Dark Theme + Sidebar 1</button></li>
            <li>
                <button class="darkThemeButton2">Dark Theme + Sidebar 2</button>
            </li>
        </ul>
    </div>

    @include('includes.admin.script')

</body>

</html>