@extends('web.layouts.app')

@section('web-section')
<section class="relative">

    @include('web.common.bottom-header')

    <div class="swiper home-front-banner">
        <div class="swiper-wrapper z-0">

            <div class="swiper-slide">
                <figure class="flex items-center justify-center">
                    <div class="absolute h-[650px] w-full bg-cover bg-center bg-no-repeat" style="background-image: url('{{asset('web/images/home-front-banner/banner-1.jpg')}}')">

                    </div>
                    <div class="relative h-[650px] flex items-center justify-start w-full bg-cover bg-center bg-no-repeat md:backdrop-blur-0 sm:backdrop-blur-sm">
                        <div class="container mt-10">
                            <div class="md:w-6/12 sm:w-full space-y-6 md:text-left sm:text-center">
                                <h1 class="font-bold md:text-6xl sm:text-4xl md:leading-tight sm:leading-snug text-white">Flexible Logistics & Cargo for Business</h1>
                                <p class="md:text-lg sm:text-sm text-white md:leading-loose sm:leading-relaxed pb-3 font-extralight">We carry clearness to intricacy, separating basic subtleties from confounded data to make modern, direct arrangements. </p>
                                <div class="md:space-x-10 sm:space-x-0 md:space-y-0 sm:space-y-5 flex md:flex-row sm:flex-col items-center justify-start">
                                    <button class="btn-ascent-lg flex items-center justify-center">Explore more <i data-feather="arrow-right" class="h-4 w-4 ml-2"></i></button>
                                    <a href="#" class="btn-ascent-link-lg">Speak With Expert</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </figure>
            </div>

            <div class="swiper-slide">
                <figure class="flex items-center justify-center">
                    <div class="absolute h-[650px] w-full bg-cover bg-center bg-no-repeat" style="background-image: url('{{asset('web/images/home-front-banner/banner-2.jpg')}}')">

                    </div>
                    <div class="relative h-[650px] flex items-center justify-start w-full bg-cover bg-center bg-no-repeat md:backdrop-blur-0 sm:backdrop-blur-sm">
                        <div class="container mt-10">
                            <div class="md:w-6/12 sm:w-full space-y-6 md:text-left sm:text-center">
                                <h1 class="font-bold md:text-6xl sm:text-4xl md:leading-tight sm:leading-snug text-white">Simple & Smart Warehousing Solution</h1>
                                <p class="md:text-lg sm:text-sm text-white md:leading-loose sm:leading-relaxed pb-3 font-extralight">We carry clearness to intricacy, separating basic subtleties from confounded data to make modern, direct arrangements. </p>
                                <div class="md:space-x-10 sm:space-x-0 md:space-y-0 sm:space-y-5 flex md:flex-row sm:flex-col items-center justify-start">
                                    <button class="btn-ascent-lg flex items-center justify-center">Explore more <i data-feather="arrow-right" class="h-4 w-4 ml-2"></i></button>
                                    <a href="#" class="btn-ascent-link-lg">Speak With Expert</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </figure>
            </div>

            <div class="swiper-slide">
                <figure class="flex items-center justify-center">
                    <div class="absolute h-[650px] w-full bg-cover bg-center bg-no-repeat" style="background-image: url('{{asset('web/images/home-front-banner/banner-3.jpg')}}')">

                    </div>
                    <div class="relative h-[650px] flex items-center justify-start w-full bg-cover bg-center bg-no-repeat md:backdrop-blur-0 sm:backdrop-blur-sm">
                        <div class="container mt-10">
                            <div class="md:w-6/12 sm:w-full space-y-6 md:text-left sm:text-center">
                                <h1 class="font-bold md:text-6xl sm:text-4xl md:leading-tight sm:leading-snug text-white">Logistics Solutions Around the World</h1>
                                <p class="md:text-lg sm:text-sm text-white md:leading-loose sm:leading-relaxed pb-3 font-extralight">We carry clearness to intricacy, separating basic subtleties from confounded data to make modern, direct arrangements. </p>
                                <div class="md:space-x-10 sm:space-x-0 md:space-y-0 sm:space-y-5 flex md:flex-row sm:flex-col items-center justify-start">
                                    <button class="btn-ascent-lg flex items-center justify-center">Explore more <i data-feather="arrow-right" class="h-4 w-4 ml-2"></i></button>
                                    <a href="#" class="btn-ascent-link-lg">Speak With Expert</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </figure>
            </div>

        </div>
        <div class="md:block sm:hidden">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>
@endsection

@section('web-script')
    <script>
        let homeBannerCarousel = new Swiper(".home-front-banner", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            grabCursor: true,
            effect: "creative",
            creativeEffect: {
                prev: {
                shadow: true,
                translate: ["-20%", 0, -1],
                },
                next: {
                translate: ["100%", 0, 0],
                },
            },
            loop: true,
            speed: 1000,
            autoplay: true,
            autoplaySpeed: 2000,
            pagination: {
                el: ".swiper-pagination",
            },
        });
    </script>
@endsection