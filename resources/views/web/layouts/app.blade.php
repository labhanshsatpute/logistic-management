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
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRm-puyhwAKWWpghbaEvch4QvNGDG4HSE&libraries=places&region=in"></script>

    {{-- Title --}}
    <title>{{env('APP_NAME')}} | Deliviring With Security </title>

    @yield('web-head')

</head>

<body>

    <div class="h-auto w-full fixed z-[100] bg-white" id="preloader-div">
        <div class="h-[113vh] w-full flex items-center justify-center">
            <img src="{{asset('web/images/preloader.gif')}}" alt="preloader" class="h-[400px] w-auto">
        </div>
    </div>

    @include('web.common.header')

    @include('web.common.mobile-sidebar')

    {{-- Main (Start) --}}
    <main class="md:pt-0 sm:pt-[82px]">

       @yield('web-section')

    </main>
    {{-- Main (End) --}}

    @include('web.common.footer')

    {{-- Script --}}
    <script src="{{asset('web/js/app.js')}}"></script>
    <script src="{{asset('web/js/swiper.min.js')}}"></script>

    <script>
        const handleToggleSidebar = () => {
            if (document.getElementById('sidebar').classList.contains('active')) {
                document.getElementById('sidebar').classList.remove('active');
                document.getElementById('sidebar-toggler-close').style.display = "none";
                document.getElementById('sidebar-toggler-menu').style.display = "block";
            }
            else {
                document.getElementById('sidebar').classList.add('active');
                document.getElementById('sidebar-toggler-close').style.display = "block";
                document.getElementById('sidebar-toggler-menu').style.display = "none";
            }
        }
    </script>

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

    <script>
        window.addEventListener('load',function(){
            setTimeout(() => {
                document.getElementById('preloader-div').style.display = "none";
            }, 1000);
        });
    </script>

</body>

</html>
