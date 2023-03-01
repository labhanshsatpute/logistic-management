@extends('web.layouts.app')

@section('web-section')
<section>
    <div class="md:container py-20">

        <div class="grid md:grid-cols-4 sm:grid-cols-2 md:gap-5 md:divide-x-0 sm:divide-x md:divide-y-0 sm:divide-y">
            
            <x-ProductCard />
            
            <x-ProductCard />
            
            <x-ProductCard />
            
            <x-ProductCard />

        </div>

    </div>
</section>
@endsection