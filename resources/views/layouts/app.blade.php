<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('layouts.header')
</head>

<body>

@include('layouts.navbar') @include('layouts.sidebar')

<div class="main-container">

    <div class="pd-lr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">

        @yield('content')

        @include('layouts.footer')

    </div>

</div>


@include('layouts.script')

@yield('scripts')

</body>

</html>