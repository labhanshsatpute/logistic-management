@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Edit Child Category</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.child.category.list') }}">Child Categories</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.child.category.update', ['id' => $child_category->id]) }}">Edit</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.child.category.update', ['id' => $child_category->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Update Information</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
                <div>
                    <button type="button" class="btn-danger-md" onclick="handleDelete()">Delete</button>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    {{-- Name --}}
                    <div class="flex flex-col">
                        <label for="name" class="input-label">Name</label>
                        <input type="text" name="name" value="{{ old('name', $child_category->name) }}"
                            class="input-box-md @error('name') input-invalid @enderror" placeholder="Enter name" required>
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Parent Category ID --}}
                    <div class="flex flex-col">
                        <label for="parent_category_id" class="input-label">Parent Category</label>
                        <select name="parent_category_id"
                            class="input-box-md @error('parent_category_id') input-invalid @enderror" required>
                            <option value="">Select Parent Category</option>
                            @foreach ($parent_categories as $parent_category)
                                <option @selected($child_category->parent_category_id == $parent_category->id) value="{{ $parent_category->id }}">
                                    {{ $parent_category->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_category_id')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <label for="slug" class="input-label">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $child_category->slug) }}"
                            class="input-box-md @error('slug') input-invalid @enderror" placeholder="Enter slug" required>
                        @error('slug')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Summary --}}
                    <div class="flex flex-col md:col-span-4 sm:col-span-1">
                        <label for="summary" class="input-label">Summary</label>
                        <input type="text" name="summary" value="{{ old('summary', $child_category->summary) }}"
                            class="input-box-md @error('summary') input-invalid @enderror" placeholder="Enter summary"
                            required>
                        @error('summary')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="flex flex-col md:col-span-4 sm:col-span-1">
                        <label for="description" class="input-label">Description</label>
                        <textarea name="description" rows="5" class="input-box-md @error('description') input-invalid @enderror"
                            placeholder="Enter description">{{ old('description', $child_category->description) }}</textarea>
                        @error('description')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Thumbnail --}}
                    <div class="md:col-span-4 sm:col-span-1">
                        <label for="thumbnail" class="input-label">Thumbnail (Format: png, jpg, jpeg, webp)</label>
                        <div class="flex space-x-3 my-2">
                            <div class="input-box-dragable">
                                <input type="file" accept="image/jpeg, image/jpg, image/png, image/webp"
                                    onchange="handleThumbnailPreview(event)" name="thumbnail">
                                <i data-feather="upload-cloud"></i>
                                <span>Darg and Drop Image Files</span>
                            </div>
                            <img src="{{ is_null($child_category->thumbnail) ? asset('admin/images/default-thumbnail.png') : asset('storage/' . $child_category->thumbnail) }}"
                                id="thumbnail" alt="thumbnail" class="input-thumbnail-preview">
                        </div>
                        @error('thumbnail')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Cover Image --}}
                    <div class="md:col-span-4 sm:col-span-1">
                        <label for="cover_image" class="input-label">Cover Image (Format: png, jpg, jpeg, webp)</label>
                        <div class="flex space-x-3 my-2">
                            <div class="input-box-dragable">
                                <input type="file" accept="image/jpeg, image/jpg, image/png, image/webp"
                                    onchange="handleCoverImagePreview(event)" name="cover_image">
                                <i data-feather="upload-cloud"></i>
                                <span>Darg and Drop Image Files</span>
                            </div>
                            <img src="{{ is_null($child_category->cover_image) ? asset('admin/images/default-thumbnail.png') : asset('storage/' . $child_category->cover_image) }}"
                                id="cover_image" alt="cover_image" class="input-thumbnail-preview">
                        </div>
                        @error('cover_image')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Save Changes</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('category-tab').classList.add('active');

        const handleThumbnailPreview = (event) => {
            if (event.target.files.length == 0) {
                document.getElementById('thumbnail').src =
                    "{{ is_null($child_category->thumbnail) ? asset('admin/images/default-thumbnail.png') : asset('storage/' . $child_category->thumbnail) }}";
            } else {
                document.getElementById('thumbnail').src = URL.createObjectURL(event.target.files[0])
            }
        }

        const handleCoverImagePreview = (event) => {
            if (event.target.files.length == 0) {
                document.getElementById('cover_image').src =
                    "{{ is_null($child_category->cover_image) ? asset('admin/images/default-thumbnail.png') : asset('storage/' . $child_category->cover_image) }}";
            } else {
                document.getElementById('cover_image').src = URL.createObjectURL(event.target.files[0])
            }
        }

        const handleDelete = () => {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this category!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location =
                            "{{ route('admin.handle.child.category.delete', ['id' => $child_category->id]) }}";
                    }
                });
        }
    </script>
@endsection
