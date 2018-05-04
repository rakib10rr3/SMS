<!DOCTYPE html>
<html>
<head>
    @include('layouts.header')
</head>
<body>

@include('layouts.navbar')

@include('layouts.sidebar')


@yield('content')


@include('layouts.footer')

@include('layouts.script')

</body>
</html>