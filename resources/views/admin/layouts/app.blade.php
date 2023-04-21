<!DOCTYPE html>
<html lang="en">

<head>

    {{-- Meta Tags --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Stylesheets --}}
    <link rel="stylesheet" href="{{asset('admin/css/app.css')}}">

    {{-- Title --}}
    <title>Admin Panel </title>

</head>

<body>


    @include('admin.common.modal-dialog')

    {{-- Main (Start) --}}
    <main>

        {{-- Sidebar --}}
        @include('admin.common.sidebar')

        {{-- Panel --}}
        <section id="panel-section">
            <div class="panel-dark-background"></div>
            <div class="panel-container">
                <header class="panel-header">
                    <div>
                        @yield('panel-header')
                    </div>
                    <div class="flex md:space-x-5 sm:space-x-3">
                        @include('admin.common.profile-dropdown')
                    </div>
                </header>
                <section class="panel-body">
                    
                    @yield('panel-body')

                </section>
            </div>
        </section>

    </main>
    {{-- Main (End) --}}

    {{-- Script --}}
    <script src="{{asset('admin/js/app.js')}}"></script>

    <script>
        const handleLogout = () => {
            swal({
                    title: "Are you sure?",
                    text: "Once clicked ok you will logged out",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#logout-form').submit();
                    }
                });
        }
    </script>

    @yield('panel-script')

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
