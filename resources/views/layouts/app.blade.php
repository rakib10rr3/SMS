<!DOCTYPE html>
<html>
<head>
    @include('layouts.header')
</head>
<body>

@include('layouts.navbar')

@include('layouts.sidebar')

<div class="main-container">
    <div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">



        @yield('content')




    </div>

</div>






@include('layouts.footer')

@include('layouts.script')

@yield('scripts')

</body>
</html>