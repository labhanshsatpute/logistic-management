@extends('admin.layouts.app')

@section('panel-header')
    <div>
        <h1 class="panel-title">Publish Newsletter</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.view.dashboard') }}">Admin</a></li>
            <li><i data-feather="chevron-right"></i></li>
            <li><a href="{{ route('admin.view.newsletter.publish') }}">Publish Newsletter</a></li>
        </ul>
    </div>
@endsection

@section('panel-body')
    <form action="{{route('admin.handle.newsletter.publish')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <figure class="panel-card">
            <div class="panel-card-header">
                <div>
                    <h1 class="panel-card-title">Add Information</h1>
                    <p class="panel-card-description">Please fill the required fields</p>
                </div>
                <div>
                    <a href="{{ route('admin.view.newsletter.mail.list') }}" class="btn-primary-md">Newsletter Mails</a>
                </div>
            </div>
            <div class="panel-card-body">
                <div class="grid md:grid-cols-4 sm:grid-cols-1 md:gap-7 sm:gap-5">

                    {{-- Title --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <label for="title" class="input-label">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="input-box-md @error('title') input-invalid @enderror" placeholder="Enter title" required>
                        @error('title')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Link --}}
                    <div class="flex flex-col md:col-span-2 sm:col-span-1">
                        <label for="link" class="input-label">Link</label>
                        <input type="url" name="link" value="{{ old('link') }}"
                            class="input-box-md @error('link') input-invalid @enderror" placeholder="Enter link">
                        @error('link')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Summary --}}
                    <div class="flex flex-col md:col-span-4 sm:col-span-1">
                        <label for="summary" class="input-label">Summary</label>
                        <input type="text" name="summary" value="{{old('summary')}}" class="input-box-md @error('summary') input-invalid @enderror" placeholder="Enter summary">
                        @error('summary')<span class="input-error">{{ $message }}</span>@enderror
                    </div>

                    {{-- Description --}}
                    <div class="flex flex-col md:col-span-4 sm:col-span-1">
                        <label for="description" class="input-label">Description</label>
                        <div class="space-y-2">

                            <div class="flex space-x-2">
                                <button class="btn-primary-sm" type="button" onclick="format('bold')"><b>B</b></button>
                                <button class="btn-primary-sm" type="button" onclick="format('italic')"><i>I</i></button>
                                <button class="btn-primary-sm" type="button" onclick="format('insertunorderedlist')"><i data-feather="list" class="h-3 w-3"></i></button>
                            </div>
                            <div onkeyup="handleConvertHTML()" class="input-box-md @error('description') input-invalid @enderror" contenteditable="true"  id="html-editor">
                                {{old('description')}}
                            </div>
                            <input type="text" name="description" id="description" value="{{old('description')}}" hidden>
                        </div>
                        <script>
                            function format(command, value) {
                                document.execCommand(command, false, value);
                            }
                            function handleConvertHTML() {
                                document.getElementById('description').value = document.getElementById('html-editor').innerHTML;
                            }
                        </script>     
                        @error('description')<span class="input-error">{{ $message }}</span>@enderror
                    </div>

                </div>
            </div>
            <div class="panel-card-footer">
                <button type="submit" class="btn-primary-md md:w-fit sm:w-full">Send Newsletter</button>
            </div>
        </figure>
    </form>
@endsection

@section('panel-script')
    <script>
        document.getElementById('newsletter-tab').classList.add('active');
    </script>
@endsection
