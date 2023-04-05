@extends('web.layouts.app')

@section('web-section')

{{-- Front Slider Section (Start) --}}
<section class="relative">

    @include('web.common.bottom-header')

    <div class="swiper home-front-banner">
        <div class="swiper-wrapper z-0">

            <div class="swiper-slide">
                <figure class="flex items-center justify-center">
                    <div class="absolute md:h-[750px] sm:h-[650px] w-full bg-cover bg-top bg-no-repeat" style="background-image: url('{{asset('web/images/home-front-banner/banner-1.jpg')}}')">

                    </div>
                    <div class="relative md:h-[750px] sm:h-[650px] flex items-center justify-start w-full bg-cover bg-center bg-no-repeat md:bg-transparent sm:bg-[rgba(0,59,73,0.4)]">
                        <div class="container mt-10 mb-20">
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
                    <div class="absolute md:h-[750px] sm:h-[650px] w-full bg-cover bg-top bg-no-repeat" style="background-image: url('{{asset('web/images/home-front-banner/banner-2.jpg')}}')">

                    </div>
                    <div class="relative md:h-[750px] sm:h-[650px] flex items-center justify-start w-full bg-cover bg-center bg-no-repeat md:bg-transparent sm:bg-[rgba(0,59,73,0.4)]">
                        <div class="container mt-10 mb-20">
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
                    <div class="absolute md:h-[750px] sm:h-[650px] w-full bg-cover bg-top bg-no-repeat" style="background-image: url('{{asset('web/images/home-front-banner/banner-3.jpg')}}')">

                    </div>
                    <div class="relative md:h-[750px] sm:h-[650px] flex items-center justify-start w-full bg-cover bg-center bg-no-repeat md:bg-transparent sm:bg-[rgba(0,59,73,0.4)]">
                        <div class="container mt-10 mb-20">
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
            <div class="swiper-button-next mt-[-70px] right-[110px]"></div>
            <div class="swiper-button-prev right-[110px] mt-[10px] left-auto"></div>
        </div>
    </div>
</section>
{{-- Front Slider Section (End) --}}

{{-- Section (Start) --}}
<section class="relative overflow-visible z-20">
    <div class="md:container overflow-visible md:pb-16">

        <div class="grid md:grid-cols-2 sm:grid-cols-1 shadow-xl md:mt-[-100px]">
            <figure class="md:p-16 sm:p-10 bg-white">
                <div class="flex md:flex-row sm:flex-col md:space-x-7 sm:space-x-0 md:space-y-0 sm:space-y-7">
                    <div>   
                        <div class="h-20 w-20 bg-web-ascent bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 fill-web-ascent-dark" viewBox="0 0 640 512"><path d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v320c0 26.5 21.5 48 48 48h16c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z"/></svg>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-3">
                        <h1 class="font-semibold text-4xl pb-1 text-gray-900">Transport Solutions</h1>
                        <p class="text-lg text-gray-600">Our Transport Solutions assist your business with keeping up degrees of administration</p>
                        <a href="#" class="btn-ascent-link-lg w-fit">Read more</a>
                    </div>
                </div>
            </figure>
            <figure class="md:p-16 sm:p-10 bg-web-ascent-dark">
                <div class="flex md:flex-row sm:flex-col md:space-x-7 sm:space-x-0 md:space-y-0 sm:space-y-7">
                    <div>   
                        <div class="h-20 w-20 bg-white bg-opacity-10 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 fill-web-ascent" viewBox="0 0 640 512"><path d="M504 352H136.4c-4.4 0-8 3.6-8 8l-.1 48c0 4.4 3.6 8 8 8H504c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm0 96H136.1c-4.4 0-8 3.6-8 8l-.1 48c0 4.4 3.6 8 8 8h368c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm0-192H136.6c-4.4 0-8 3.6-8 8l-.1 48c0 4.4 3.6 8 8 8H504c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm106.5-139L338.4 3.7a48.15 48.15 0 0 0-36.9 0L29.5 117C11.7 124.5 0 141.9 0 161.3V504c0 4.4 3.6 8 8 8h80c4.4 0 8-3.6 8-8V256c0-17.6 14.6-32 32.6-32h382.8c18 0 32.6 14.4 32.6 32v248c0 4.4 3.6 8 8 8h80c4.4 0 8-3.6 8-8V161.3c0-19.4-11.7-36.8-29.5-44.3z"/></svg>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-3">
                        <h1 class="font-semibold text-4xl pb-1 text-white">Transport Solutions</h1>
                        <p class="text-lg text-gray-300">Our Transport Solutions assist your business with keeping up degrees of administration</p>
                        <a href="#" class="btn-ascent-link-lg w-fit">Read more</a>
                    </div>
                </div>
            </figure>
        </div>

    </div>
</section>
{{-- Section (End) --}}

{{-- Section (Start) --}}
<section class="relative">
    <div class="container md:py-20 sm:py-10">
        <div class="grid md:grid-cols-2 sm:grid-cols-1 md:gap-16 sm:gap-10 items-center">

            <figure class="md:order-1 sm:order-2">
                <div class="space-y-5">
                    <h1 class="font-semibold md:text-5xl md:leading-snug sm:text-4xl sm:leading-snug text-web-ascent-dark"><span class="text-web-ascent">Bharat Logistics</span> <br>Around the World</h1>
                    <p class="text-lg text-gray-500 leading-normal">Transmax is the world’s driving worldwide coordinations supplier — we uphold industry and exchange the worldwide trade of merchandise through land transport.</p>
                    <p class="text-lg text-gray-500 leading-normal pb-3">Our worth added administrations guarantee the progression of products proceeds consistently and supply chains stay lean and streamlined for progress.</p>
                    <div>
                        <a href="#"><button class="btn-light-lg">Learn more about us</button></a>
                    </div>
                </div>
            </figure>

            <figure class="md:order-2 sm:order-1">
                <img src="{{asset('web/images/home-section-images/img-1.png')}}" alt="img-1" class="w-full h-auto mx-auto md:p-6 sm:p-0">
            </figure>
            
        </div>
    </div>
</section>
{{-- Section (End) --}}

{{-- Section (Start) --}}
<section class="relative bg-cover bg-center bg-no-repeat" style="background-image: url('{{asset('/web/images/home-section-images/section-bg-1.png')}}');">
    <div class="container md:py-20 sm:py-10 md:space-y-16 sm:space-y-8">

        <div>
            <h1 class="font-semibold md:text-4xl md:leading-snug sm:text-3xl sm:leading-snug text-web-ascent-dark pb-4">Explore Our <span class="text-web-ascent">Services</span></h1>
            <p class="text-base text-gray-500 leading-normal">Transmax is the world’s driving worldwide coordinations supplier <br>we uphold industry and exchange the worldwide trade of merchandise through land transport.</p>
        </div>
        
        <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-10 items-center">

            <figure class="service-card">
                <div>
                    <img src="{{asset('web/images/home-section-images/services/img-1.png')}}" alt="service-1">
                    <h1>Land Transport</h1>
                    <p>With a worldwide organization and progressed coordination arrangements, our airship cargo sending items.</p>
                    <ul>
                        <li>Part & Full Loads</li>
                        <li>Multimodal Solutions</li>
                        <li>Intermodal Solutions</li>
                    </ul>
                </div>
            </figure>

            <figure class="service-card">
                <div>
                    <img src="{{asset('web/images/home-section-images/services/img-2.png')}}" alt="service-2">
                    <h1>Air Freight</h1>
                    <p>We help transport your load anyplace on the planet, making your business run easily regardless of where products.</p>
                    <ul>
                        <li>General Air Freight Products</li>
                        <li>Charter Services</li>
                        <li>Intermodal Solutions</li>
                    </ul>
                </div>
            </figure>

            <figure class="service-card">
                <div>
                    <img src="{{asset('web/images/home-section-images/services/img-3.png')}}" alt="service-3">
                    <h1>Ocean Freight</h1>
                    <p>Sea cargo dispatches in excess of 5,500 holders per day to ports all around the globe, making us a top forwarder.</p>
                    <ul>
                        <li>Less-than-container Load</li>
                        <li>Full Container Load</li>
                        <li>Intermodal Solutions</li>
                    </ul>
                </div>
            </figure>
            
        </div>

    </div>
</section>
{{-- Section (End) --}}

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