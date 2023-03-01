@extends('admin.layouts.app')

@section('panel-header')
<div>
    <h1 class="panel-title">Child Categories</h1>
    <ul class="breadcrumb">
        <li><a href="{{route('admin.view.dashboard')}}">Admin</a></li>
        <li><i data-feather="chevron-right"></i></li>
        <li><a href="{{route('admin.view.child.category.list')}}">Child Categories</a></li>
    </ul>
</div>
@endsection

@section('panel-body')
    <div class="space-x-3">
        <a href="{{route('admin.view.parent.category.list')}}" class="font-medium bg-transparent border-2 text-white border-white px-4 py-2 rounded-full text-sm">Parent Category</a>
        <a href="{{route('admin.view.child.category.list')}}" class="font-medium bg-white border-2 text-black border-white px-4 py-2 rounded-full text-sm">Child Category</a>
    </div>
    <div class="grid md:grid-cols-3 sm:grid-cols-1 md:gap-10 sm:gap-5">

        @foreach ($child_categories as $child_category)
        <figure class="panel-card">
            <div class="h-[200px] w-full bg-cover bg-center flex items-center justify-center" style="background-image: linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)),url('{{asset('storage/'.$child_category->cover_image)}}');">
                <img src="{{asset('storage/'.$child_category->thumbnail)}}" alt="thumbnail" class="h-[100px] w-[100px] rounded-full border bg-white">
            </div>
            <div class="space-y-5 p-7">
                <div class="space-y-2">
                    <div class="flex items-start justify-between">
                        <h1 class="font-semibold text-2xl">{{$child_category->name}}</h1>
                        <label class="relative cursor-pointer">
                            <input onchange="handleUpdateStatus({{$child_category->id}})" @checked($child_category->status) type="checkbox" class="sr-only peer">
                            <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2.5px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-admin-ascent"></div>
                        </label>
                    </div>
                    <p class="text-sm text-slate-500">{{$child_category->summary}}</p>
                </div>
                <div>
                    <a href="{{route('admin.view.child.category.update',['id' => $child_category->id])}}">
                    <button type="button" class="btn-primary-md w-full"><i data-feather="edit" class="h-4 w-4 opacity-50 absolute mr-auto"></i>Edit Information</button></a>
                </div>
            </div>
        </figure>
        @endforeach

        <figure class="panel-card">
            <div class="space-y-5 p-7">
                <div class="space-y-2">
                    <h1 class="font-bold text-2xl">Add Category</h1>
                    <p class="text-sm text-slate-500">Create a new child category</p>
                </div>
                <div>
                    <a href="{{route('admin.view.child.category.create')}}">
                    <button type="button" class="btn-primary-md w-full">Create Child Categry</button></a>
                </div>
            </div>
        </figure>

    </div>
@endsection

@section('panel-script')
<script>
    document.getElementById('category-tab').classList.add('active');

    const handleUpdateStatus = (id) => {
        fetch("{{route('admin.handle.child.category.status')}}",{
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id, _token: "{{csrf_token()}}" })
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