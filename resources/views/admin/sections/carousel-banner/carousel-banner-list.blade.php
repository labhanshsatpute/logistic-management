@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Carousel Banners</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.carousel.banner.list') }}">Carousel Banners</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <div class="grid md:grid-cols-3 sm:grid-cols-1 md:gap-10 sm:gap-5">

        @foreach ($carousel_banners as $carousel_banner)
            <figure class="panel-card">
                <img src="{{ asset('storage/' . $carousel_banner->image) }}" alt="image" class="w-full h-auto">
                <div class="space-y-5 p-7">
                    <div class="space-y-2">
                        <div class="flex items-start justify-between">
                            <h1 class="font-semibold text-2xl">{{ $carousel_banner->name }}</h1>
                            <label class="relative cursor-pointer">
                                <input onchange="handleUpdateStatus({{ $carousel_banner->id }})"
                                    @checked($carousel_banner->status) type="checkbox" class="sr-only peer">
                                <div
                                    class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2.5px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-admin-ascent">
                                </div>
                            </label>
                        </div>
                        <p class="text-sm text-slate-500">{{ $carousel_banner->summary }}</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.view.carousel.banner.update', ['id' => $carousel_banner->id]) }}">
                            <button type="button" class="btn-primary-md w-full"><i data-feather="edit"
                                    class="h-4 w-4 opacity-50 absolute mr-auto"></i>Edit Information</button></a>
                    </div>
                </div>
            </figure>
        @endforeach

        <figure class="panel-card">
            <div class="space-y-5 p-7">
                <div class="space-y-2">
                    <h1 class="font-bold text-2xl">Add Banner</h1>
                    <p class="text-sm text-slate-500">Create a new carousel banner</p>
                </div>
                <div>
                    <a href="{{ route('admin.view.carousel.banner.create') }}">
                        <button type="button" class="btn-primary-md w-full">Create Carousel Banner</button></a>
                </div>
            </div>
        </figure>

    </div>
@endsection

@section('panel-script')
    <script>
        document.getElementById('carousel-banner-tab').classList.add('active');
        const handleUpdateStatus = (id) => {
            fetch("{{ route('admin.handle.carousel.banner.status') }}", {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    _token: "{{ csrf_token() }}"
                })
            }).then((response) => {
                return response.json();
            }).then((result) => {
                console.log(result);
            }).catch((error) => {
                console.error(error);
            });
        }
    </script>
@endsection
