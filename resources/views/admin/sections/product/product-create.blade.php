@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Add Product</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.product.list') }}">Products</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.product.create') }}">Create</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{ route('admin.handle.product.create') }}" method="POST" enctype="multipart/form-data">
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

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold">General Information</h1>
                    </div>

                    {{-- Name --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <label for="name" class="input-label">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="input-box-md @error('name') input-invalid @enderror" placeholder="Enter name" required minlength="1" maxlength="250">
                        @error('name')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <label for="slug" class="input-label">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug') }}"
                            class="input-box-md @error('slug') input-invalid @enderror" placeholder="Enter slug" required minlength="1" maxlength="250">
                        @error('slug')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- SKU --}}
                    <div class="flex flex-col">
                        <label for="sku" class="input-label">SKU</label>
                        <input type="text" name="sku" value="{{ old('sku') }}"
                            class="input-box-md @error('sku') input-invalid @enderror" placeholder="Enter sku" required minlength="1" maxlength="250">
                        @error('sku')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Parent Category --}}
                    <div class="flex flex-col">
                        <label for="parent_category" class="input-label">Parent Category</label>
                        <select name="parent_category"
                            class="input-box-md @error('parent_category') input-invalid @enderror" required>
                            <option value="">Select Parent Category</option>
                            @foreach ($parent_categories as $parent_category)
                                <option value="{{ $parent_category->name }}">{{ $parent_category->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_category')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Child Category --}}
                    <div class="flex flex-col">
                        <label for="child_category" class="input-label">Child Category</label>
                        <select name="child_category" class="input-box-md @error('child_category') input-invalid @enderror">
                            <option value="">Select Child Category</option>
                            @foreach ($child_categories as $child_category)
                                <option value="{{ $child_category->name }}">{{ $child_category->name }}</option>
                            @endforeach
                        </select>
                        @error('child_category')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Summary --}}
                    <div class="flex flex-col md:col-span-4 sm:col-span-1">
                        <label for="summary" class="input-label">Summary</label>
                        <input type="text" name="summary" value="{{ old('summary') }}"
                            class="input-box-md @error('summary') input-invalid @enderror" placeholder="Enter summary" minlength="1" maxlength="500">
                        @error('summary')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="flex flex-col md:col-span-4 sm:col-span-1">
                        <label for="description" class="input-label">Description</label>
                        <textarea name="description" rows="5" class="input-box-md @error('description') input-invalid @enderror"
                            placeholder="Enter description" minlength="1" maxlength="1000">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold">SEO Information</h1>
                    </div>

                    {{-- Meta Title --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <label for="meta_title" class="input-label">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                            class="input-box-md @error('meta_title') input-invalid @enderror"
                            placeholder="Enter met keywords" required minlength="1" maxlength="250">
                        @error('meta_title')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Meta Keywords --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <label for="meta_keywords" class="input-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}"
                            class="input-box-md @error('meta_keywords') input-invalid @enderror"
                            placeholder="Enter meta keywords" required minlength="1" maxlength="1000">
                        @error('meta_keywords')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Meta Description --}}
                    <div class="flex flex-col md:col-span-4 sm:col-span-1">
                        <label for="meta_description" class="input-label">Meta Description</label>
                        <textarea name="meta_description" rows="5"
                            class="input-box-md @error('meta_description') input-invalid @enderror" placeholder="Enter meta description" minlength="1" maxlength="1000">{{ old('meta_description') }}</textarea>
                        @error('meta_description')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold">Pricing Information</h1>
                    </div>

                    {{-- Original Price --}}
                    <div class="flex flex-col">
                        <label for="price_original" class="input-label">Original Price</label>
                        <input type="number" step="any" name="price_original" value="{{ old('price_original') }}"
                            class="input-box-md @error('price_original') input-invalid @enderror"
                            placeholder="Enter original price" required min="0" max="1000000">
                        @error('price_original')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Discounted Price --}}
                    <div class="flex flex-col">
                        <label for="price_discounted" class="input-label">Discounted Price</label>
                        <input type="number" step="any" name="price_discounted" value="{{ old('price_discounted') }}"
                            class="input-box-md @error('price_discounted') input-invalid @enderror"
                            placeholder="Enter discounted price" min="0" max="1000000">
                        @error('price_discounted')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tax Percentage --}}
                    <div class="flex flex-col">
                        <label for="tax_percentage" class="input-label">Tax Percentage</label>
                        <input type="number" step="any" name="tax_percentage" value="{{ old('tax_percentage') }}"
                            class="input-box-md @error('tax_percentage') input-invalid @enderror"
                            placeholder="Enter discounted price" required min="0" max="1000000">
                        @error('tax_percentage')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold">Optional Information</h1>
                    </div>

                    {{-- Highlights --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <label for="highlights" class="input-label">Highlights</label>
                        <div class="space-y-2">
                            <div class="space-y-2" id="highlights-inputs">

                            </div>
                            <button type="button" onclick="handleCreateHighlightInput(null)" class="btn-secondary-md">Add Highlight Input</button>
                        </div>
                        @error('highlights')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tags --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <label for="tags" class="input-label">Tags</label>
                        <input type="text" name="tags" value="{{ old('tags') }}"
                            class="input-box-md @error('tags') input-invalid @enderror"
                            placeholder="Enter tags" required>
                        @error('tags')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Sizes --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <label for="sizes" class="input-label">Sizes</label>
                        <div class="space-y-2">
                            <div class="space-y-2" id="sizes-inputs">

                            </div>
                            <button type="button" onclick="handleCreateSizeInput(null,null)" class="btn-secondary-md">Add Size Input</button>
                        </div>
                        @error('sizes')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Colors --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <label for="colors" class="input-label">Colors</label>
                        <div class="space-y-2">
                            <div class="space-y-2" id="colors-inputs">

                            </div>
                            <button type="button" onclick="handleCreateColorInput(null,null)" class="btn-secondary-md">Add Color Input</button>
                        </div>
                        @error('colors')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold">Availability Information</h1>
                    </div>

                    {{-- Availability --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <label for="availability" class="input-label">Availability</label>
                        <div class="space-x-3 flex">
                            <div class="input-radio">
                                <input type="radio" value="In Stock" @checked(old('availability') == "In Stock") name="availability" id="availability-in-stock" required>
                                <label for="availability-in-stock">In Stock</label>
                            </div>
                            <div class="input-radio">
                                <input type="radio" value="Out of Stock" @checked(old('availability') == "Out of Stock") name="availability" id="availability-out-of-stock" required>
                                <label for="availability-out-of-stock">Out of Stock</label>
                            </div>
                        </div>
                        @error('availability')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="md:col-span-4 sm:col-span-1">
                        <h1 class="font-semibold">Media</h1>
                    </div>

                    {{-- Thumbnail --}}
                    <div class="md:col-span-4 sm:col-span-1">
                        <label for="thumbnail" class="input-label">Thumbnail (Format: png, jpg, jpeg, webp)</label>
                        <div class="flex space-x-3 my-2">
                            <div class="input-box-dragable">
                                <input type="file" accept="image/jpeg, image/jpg, image/png, image/webp"
                                    onchange="handleThumbnailPreview(event)" name="thumbnail" required>
                                <i data-feather="upload-cloud"></i>
                                <span>Darg and Drop Image Files</span>
                            </div>
                            <img src="{{ asset('admin/images/default-thumbnail.png') }}" id="thumbnail" alt="thumbnail"
                                class="input-thumbnail-preview">
                        </div>
                        @error('thumbnail')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Product Media --}}
                    <div class="md:col-span-4 sm:col-span-1">
                        <label for="product_media" class="input-label">Media (Format: png, jpg, jpeg, webp, mp4, pdf)</label>
                        <div class="space-y-2 my-2">
                            <div class="input-box-dragable">
                                <input type="file" multiple onchange="handleMediaPreview(event)" name="product_media[]" required>
                                <i data-feather="upload-cloud"></i>
                                <span>Darg and Drop Image Files</span>
                            </div>
                            <div class="grid md:grid-cols-4 sm:grid-cols-2 gap-5" id="media-preview-div">

                            </div>
                        </div>
                        @error('product_media')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Add Product</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('product-tab').classList.add('active');

        const handleThumbnailPreview = (event) => {
            if (event.target.files.length == 0) {
                document.getElementById('thumbnail').src = "{{ asset('admin/images/default-thumbnail.png') }}";
            } else {
                document.getElementById('thumbnail').src = URL.createObjectURL(event.target.files[0])
            }
        }

        const handleMediaPreview = (event) => {
            document.getElementById('media-preview-div').replaceChildren();
            Object.values(event.target.files).forEach(file => {
                
                let parentDiv = document.createElement('div');
                parentDiv.className = "h-fit w-full flex flex-col items-center justify-center overflow-hidden border rounded-md p-2";
                
                switch (file.type) {
                    case "image/jpeg":
                    case "image/jpg":
                    case "image/png":
                    case "image/webp":
                        var element = document.createElement('img');
                        element.className = "h-auto w-wull border rounded";
                        element.src = URL.createObjectURL(file);
                        parentDiv.appendChild(element);
                        break;

                    case "video/mp4":
                        var element = document.createElement('video');
                        element.className = "h-auto w-wull border rounded";
                        element.controls = true;
                        element.src = URL.createObjectURL(file);
                        parentDiv.appendChild(element);
                        break;
                    
                    default:
                        var element = document.createElement('a');
                        element.className = "btn-secondary-md";
                        element.innerHTML = "Preview";
                        element.target = "_blank";
                        element.href = URL.createObjectURL(file);
                        parentDiv.appendChild(element);
                        break;
                }

                var name = document.createElement('p');
                name.className = "text-xs text-center mt-2 font-medium";
                name.innerHTML = file.name;
                parentDiv.appendChild(name);

                document.getElementById('media-preview-div').appendChild(parentDiv);
            });
        }

        const handleCreateHighlightInput = (highlight) => {

            let parentDiv = document.createElement('div');
            parentDiv.className = "flex space-x-2";

            let highlightInput = document.createElement('input');
            highlightInput.type = "text";
            highlightInput.className = "input-box-md w-full";
            highlightInput.name = "highlights[]";
            highlightInput.value = highlight;
            highlightInput.required = true;
            highlightInput.min = 1;
            highlightInput.max = 250;
            highlightInput.placeholder = "Enter highlight";

            let remove = document.createElement('button');
            remove.className = "btn-danger-md";
            remove.innerHTML = ' &times ';
            remove.type = "button";
            remove.onclick = (event) => { event.target.parentNode.remove(); }

            parentDiv.append(highlightInput, remove);
            document.getElementById('highlights-inputs').appendChild(parentDiv);
        }

        const handleCreateSizeInput = (value,price) => {

            let parentDiv = document.createElement('div');
            parentDiv.className = "flex space-x-2";

            let sizeValueInput = document.createElement('input');
            sizeValueInput.type = "text";
            sizeValueInput.className = "input-box-md w-full";
            sizeValueInput.name = "sizes_value[]";
            sizeValueInput.value = value;
            sizeValueInput.required = true;
            sizeValueInput.min = 1;
            sizeValueInput.max = 250;
            sizeValueInput.placeholder = "Enter size value";

            let sizePriceInput = document.createElement('input');
            sizePriceInput.type = "number";
            sizePriceInput.className = "input-box-md w-full";
            sizePriceInput.name = "sizes_price[]";
            sizePriceInput.value = price;
            sizePriceInput.required = true;
            sizePriceInput.step = "any";
            sizePriceInput.min = 0;
            sizePriceInput.max = 100000;
            sizePriceInput.placeholder = "Enter size price";

            let remove = document.createElement('button');
            remove.className = "btn-danger-md";
            remove.innerHTML = ' &times ';
            remove.type = "button";
            remove.onclick = (event) => { event.target.parentNode.remove(); }

            parentDiv.append(sizeValueInput, sizePriceInput, remove);
            document.getElementById('sizes-inputs').appendChild(parentDiv);
        }

        const handleCreateColorInput = (name,value) => {

            let parentDiv = document.createElement('div');
            parentDiv.className = "flex space-x-2";

            let colorNameInput = document.createElement('input');
            colorNameInput.type = "text";
            colorNameInput.className = "input-box-md w-full";
            colorNameInput.name = "colors_name[]";
            colorNameInput.value = name;
            colorNameInput.required = true;
            colorNameInput.min = 1;
            colorNameInput.max = 250;
            colorNameInput.placeholder = "Enter color name";

            let colorValueInput = document.createElement('input');
            colorValueInput.type = "color";
            colorValueInput.className = "p-0 h-[46px] w-[46px] border";
            colorValueInput.name = "colors_value[]";
            colorValueInput.value = value;
            colorValueInput.required = true;

            let remove = document.createElement('button');
            remove.className = "btn-danger-md";
            remove.innerHTML = ' &times ';
            remove.type = "button";
            remove.onclick = (event) => { event.target.parentNode.remove(); }

            parentDiv.append(colorNameInput, colorValueInput, remove);
            document.getElementById('colors-inputs').appendChild(parentDiv);
        }
    </script>
@endsection
