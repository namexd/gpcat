<html>
<head>
    <title> @yield('title')</title>
    @yield('front')

</head>
@include('temporary.header')

<body>
@include('temporary.top')

    @yield('content')

@include('temporary.footer')
@include('temporary.rightnav')

{{--@include('temporary.footer2')--}}
@yield('javascript')

</body>
</html>