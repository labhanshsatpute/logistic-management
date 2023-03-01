@extends('admin.layouts.app')

@section('panel-header')
<div>
    <h1 class="panel-title">Add Parent Category</h1>
    <ul class="breadcrumb">
        <li><a href="{{route('admin.view.dashboard')}}">Admin</a></li>
        <li><i data-feather="chevron-right"></i></li>
        <li><a href="{{route('admin.view.parent.category.list')}}">Parent Categories</a></li>
        <li><i data-feather="chevron-right"></i></li>
        <li><a href="{{route('admin.view.parent.category.create')}}">Create</a></li>
    </ul>
</div>
@endsection

@section('panel-body')
<form action="{{route('admin.handle.parent.category.create')}}" method="POST" enctype="multipart/form-data">
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

            {{-- Slug --}}
            <div class="flex flex-col md:col-span-2 sm:col-span-1">
                <label for="slug" class="input-label">Slug</label>
                <input type="text" name="slug" value="{{old('slug')}}" class="input-box-md @error('slug') input-invalid @enderror" placeholder="Enter slug" required>
                @error('slug')<span class="input-error">{{ $message }}</span>@enderror
            </div>

            {{-- Summary --}}
            <div class="flex flex-col md:col-span-4 sm:col-span-1">
                <label for="summary" class="input-label">Summary</label>
                <input type="text" name="summary" value="{{old('summary')}}" class="input-box-md @error('summary') input-invalid @enderror" placeholder="Enter summary" required>
                @error('summary')<span class="input-error">{{ $message }}</span>@enderror
            </div>

            {{-- Description --}}
            <div class="flex flex-col md:col-span-4 sm:col-span-1">
                <label for="description" class="input-label">Description</label>
                <textarea name="description" rows="5" class="input-box-md @error('description') input-invalid @enderror" placeholder="Enter description">{{old('description')}}</textarea>
                @error('description')<span class="input-error">{{ $message }}</span>@enderror
            </div>

            {{-- Thumbnail --}}
            <div class="md:col-span-4 sm:col-span-1">
                <label for="thumbnail" class="input-label">Thumbnail (Format: png, jpg, jpeg, webp)</label>
                <div class="flex space-x-3 my-2">
                    <div class="input-box-dragable">
                        <input type="file" accept="image/jpeg, image/jpg, image/png, image/webp" onchange="handleThumbnailPreview(event)" name="thumbnail" required>
                        <i data-feather="upload-cloud"></i>
                        <span>Darg and Drop Image Files</span>
                    </div>
                    <img src="{{asset('admin/images/default-thumbnail.png')}}" id="thumbnail" alt="thumbnail" class="input-thumbnail-preview">
                </div>
                @error('thumbnail')<span class="input-error">{{ $message }}</span>@enderror
            </div>

            {{-- Cover Image --}}
            <div class="md:col-span-4 sm:col-span-1">
                <label for="cover_image" class="input-label">Cover Image (Format: png, jpg, jpeg, webp)</label>
                <div class="flex space-x-3 my-2">
                    <div class="input-box-dragable">
                        <input type="file" accept="image/jpeg, image/jpg, image/png, image/webp" onchange="handleCoverImagePreview(event)" name="cover_image" required>
                        <i data-feather="upload-cloud"></i>
                        <span>Darg and Drop Image Files</span>
                    </div>
                    <img src="{{asset('admin/images/default-thumbnail.png')}}" id="cover_image" alt="cover_image" class="input-thumbnail-preview">
                </div>
                @error('cover_image')<span class="input-error">{{ $message }}</span>@enderror
            </div>

        </div>
    </div>
    <div class="panel-card-footer">
        <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Add Parent Category</button>
    </div>
</figure>
</form>
@endsection

@section('panel-script')
<script>
    document.getElementById('category-tab').classList.add('active');

    const handleThumbnailPreview = (event) => {
        if (event.target.files.length == 0) {
            document.getElementById('thumbnail').src = "{{asset('admin/images/default-thumbnail.png')}}";
        }
        else {
            document.getElementById('thumbnail').src = URL.createObjectURL(event.target.files[0])
        }
    }

    const handleCoverImagePreview = (event) => {
        if (event.target.files.length == 0) {
            document.getElementById('cover_image').src = "{{asset('admin/images/default-thumbnail.png')}}";
        }
        else {
            document.getElementById('cover_image').src = URL.createObjectURL(event.target.files[0])
        }
    }
</script>
@endsection