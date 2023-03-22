<!DOCTYPE html>
<html lang="en">

<head>

    {{-- Meta Tags --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{asset('web/images/favicon.png')}}">

    {{-- Stylesheets --}}
    <link rel="stylesheet" href="{{asset('web/css/app.css')}}">

    {{-- Title --}}
    <title>{{env('APP_NAME')}} </title>

    @yield('web-head')

</head>

<body>

    @include('web.common.header')

    {{-- Main (Start) --}}
    <main>

       @yield('web-section')

    </main>
    {{-- Main (End) --}}

    @include('web.common.footer')

    {{-- Script --}}
    <script src="{{asset('web/js/app.js')}}"></script>

    @yield('web-script')

    @if (session('message'))
    <script defer>
        swal({
            icon: "{{session('message')['status']}}",
            title: "{{session('message')['title']}}",
            text: "{{session('message')['description']}}",
        });
    </script>
    @endif

</body>

</html>
