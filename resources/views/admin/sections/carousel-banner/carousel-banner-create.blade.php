@extends('admin.layouts.app')

@section('panel-header')
<div>
    <h1 class="panel-title">Create Banner</h1>
    <ul class="breadcrumb">
        <li><a href="{{route('admin.view.dashboard')}}">Admin</a></li>
        <li><i data-feather="chevron-right"></i></li>
        <li><a href="{{route('admin.view.carousel.banner.list')}}">Carousel Banner</a></li>
        <li><i data-feather="chevron-right"></i></li>
        <li><a href="{{route('admin.view.carousel.banner.create')}}">Create Banner</a></li>
    </ul>
</div>
@endsection

@section('panel-body')
<form action="{{route('admin.handle.carousel.banner.create')}}" method="POST" enctype="multipart/form-data">
@csrf
<figure class="panel-card">
    <div class="panel-card-header">
        <div>
            <h1 class="panel-card-title">Add Information</h1>
            <p class="panel-card-description">Please fill the required fields</p>
        </div>
    </div>
    <div class="panel-card-body">
        <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

            {{-- Name --}}
            <div class="flex flex-col md:col-span-2 sm:col-span-1">
                <label for="name" class="input-label">Name</label>
                <input type="text" name="name" value="{{old('name')}}" class="input-box-md @error('name') input-invalid @enderror" placeholder="Enter name" required>
                @error('name')<span class="input-error">{{ $message }}</span>@enderror
            </div>

            {{-- Link --}}
            <div class="flex flex-col md:col-span-2 sm:col-span-1">
                <label for="link" class="input-label">Link</label>
                <input type="url" name="link" value="{{old('link')}}" class="input-box-md @error('link') input-invalid @enderror" placeholder="Enter link">
                @error('link')<span class="input-error">{{ $message }}</span>@enderror
            </div>

            {{-- Summary --}}
            <div class="flex flex-col md:col-span-4 sm:col-span-1">
                <label for="summary" class="input-label">Summary</label>
                <input type="text" name="summary" value="{{old('summary')}}" class="input-box-md @error('summary') input-invalid @enderror" placeholder="Enter summary">
                @error('summary')<span class="input-error">{{ $message }}</span>@enderror
            </div>

            {{-- Image --}}
            <div class="md:col-span-4 sm:col-span-1">
                <label for="image" class="input-label">Image (Format: png, jpg, jpeg, webp)</label>
                <div class="flex space-x-3 my-2">
                    <div class="input-box-dragable">
                        <input type="file" accept="image/jpeg, image/jpg, image/png, image/webp" onchange="handleImagePreview(event)" name="image" required>
                        <i data-feather="upload-cloud"></i>
                        <span>Darg and Drop Image Files</span>
                    </div>
                    <img src="{{asset('admin/images/default-thumbnail.png')}}" id="image" alt="image" class="input-thumbnail-preview">
                </div>
                @error('mobile_image')<span class="input-error">{{ $message }}</span>@enderror
            </div>

        </div>
    </div>
    <div class="panel-card-footer">
        <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Create Carousel Banner</button>
    </div>
</figure>
</form>
@endsection

@section('panel-script')
<script>
    document.getElementById('carousel-banner-tab').classList.add('active');
    const handleImagePreview = (event) => {
        if (event.target.files.length == 0) {
            document.getElementById('image').src = "{{asset('admin/images/default-thumbnail.png')}}";
        }
        else {
            document.getElementById('image').src = URL.createObjectURL(event.target.files[0])
        }
    }
</script>
@endsection
