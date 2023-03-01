<figure class="md:border sm:border-b md:rounded-lg overflow-clip md:shadow-md hover:shadow-lg transition duration-300 ease-in-out hover:ease-in-out">
    <img src="{{asset('web/images/products/product-1.jpg')}}" alt="product-1">
    <div class="md:p-4 sm:p-3 space-y-1">
        <p class="md:text-sm sm:text-xs text-slate-600">Mens Clothing</p>
        <p class="font-semibold md:text-lg sm:text-sm">Green Plain T-Shirt for Mens</p>
        <div class="md:flex sm:hidden space-x-2">
            <div class="flex items-center">
                <i data-feather="star" class="md:h-[18px] md:w-[18px] sm:h-3 sm:w-3 stroke-orange-500 fill-orange-500"></i>
                <i data-feather="star" class="md:h-[18px] md:w-[18px] sm:h-3 sm:w-3 stroke-orange-500 fill-orange-500"></i>
                <i data-feather="star" class="md:h-[18px] md:w-[18px] sm:h-3 sm:w-3 stroke-orange-500 fill-orange-500"></i>
                <i data-feather="star" class="md:h-[18px] md:w-[18px] sm:h-3 sm:w-3 stroke-orange-500 fill-orange-500"></i>
                <i data-feather="star" class="md:h-[18px] md:w-[18px] sm:h-3 sm:w-3 stroke-gray-400 fill-gray-400"></i>
            </div>
            <p class="md:text-base sm:text-xs text-slate-600">4.0</p>
        </div>
    </div>
    <div class="md:p-4 sm:p-3 border-t">
        <div class="grid md:grid-cols-2">
            <div>
                <h1 >
                    <span class="font-semibold md:text-lg sm:text-base">{{env('APP_CURRENCY')}}450.00</span>
                    <span class="line-through text-sm text-slate-600">{{env('APP_CURRENCY')}}450.00</span>
                </h1>
                <h1 class="font-normal text-slate-600 text-xs">You save {{env('APP_CURRENCY')}}300</h1>
            </div>
            <div class="md:block sm:hidden">
                <button class="btn-primary-md w-full flex items-center justify-center"><span>Add to Cart</span>
                <i data-feather="shopping-cart" class="h-4 w-4 ml-1"></i></button>
            </div>
        </div>
    </div>
</figure>