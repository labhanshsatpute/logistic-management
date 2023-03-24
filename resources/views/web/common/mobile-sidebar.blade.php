<aside class="sidebar" id="sidebar">
    <div class="p-7 pt-[149px]">
        <ul class="flex flex-col justify-center" x-data="{selected:null}">
            
            @foreach (DB::table('parent_categories')->get() as $key => $parent_category)
            <li class="relative border-b">
                @if (DB::table('child_categories')->where('parent_category_id',$parent_category->id)->count() != 0)
                <button type="button" class="w-full py-5 text-left"
                    @click="selected !== {{$key}} ? selected = {{$key}} : selected = null">
                    <div class="flex items-center justify-between font-medium text-base">
                       {{$parent_category->name}}
                        <div x-bind:style="selected == {{$key}} ? 'rotate: 180deg' : 'rotate: 0deg'">
                            <i data-feather="chevron-down"></i>
                        </div>
                    </div>
                </button>
                <div class="relative overflow-hidden transition-all max-h-0 duration-500" style=""
                    x-ref="container{{$key}}"
                    x-bind:style="selected == {{$key}} ? 'max-height: ' + $refs.container{{$key}}.scrollHeight + 'px' : ''">
                    <div class="pb-5">
                        <ul class="space-y-4">
                            @foreach (DB::table('child_categories')->where('parent_category_id',$parent_category->id)->get() as $child_category)
                            <li><a href="{{route('view.child.category',['slug' => $child_category->slug])}}">{{ucwords(strtolower($child_category->name))}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @else 
                <a href="{{route('view.parent.category',['slug' => $parent_category->slug])}}">
                    <button class="w-full py-5 text-left">
                        <div class="flex items-center justify-between font-medium text-base">
                            {{$parent_category->name}}
                        </div>
                    </button>
                </a>
                @endif
            </li>
            @endforeach

            <li class="border-b">
                <a href="{{route('view.track.order')}}">
                    <button class="w-full py-5 text-left">
                        <div class="flex items-center justify-between font-medium text-base">
                            Track Order
                        </div>
                    </button>
                </a>
            </li>

            <li class="border-b">
                <a href="{{route('view.customer.support')}}">
                    <button class="w-full py-5 text-left">
                        <div class="flex items-center justify-between font-medium text-base">
                            Customer Support
                        </div>
                    </button>
                </a>
            </li>

            <li class="border-b">
                <a href="{{route('view.dashboard')}}">
                    <button class="w-full py-5 text-left">
                        <div class="flex items-center justify-between font-medium text-base">
                            My Acoount
                        </div>
                    </button>
                </a>
            </li>

            <li class="border-b">
                    <div class="w-full py-5 text-left">
                        <div class="flex items-center justify-between font-medium text-base">
                            Download The App
                        </div>
                    </div>
                    <ul class="grid grid-cols-2 gap-5">
                        <div>
                            <a href="{{route('view.ios.app')}}"><img src="{{asset('web/images/footer/appstore.webp')}}" alt="appstore" class="h-auto w-full"></a>
                        </div>
                        <div>
                            <a target="_blank" href="https://play.google.com/store/apps/details?id=com.tafaari.android"><img src="{{asset('web/images/footer/playstore.webp')}}" alt="playstore" class="h-auto w-full"></a>
                        </div>
                    </ul>
            </li>

            <li class="border-b">
                    <div class="w-full py-5 text-left">
                        <div class="text-gray-600 text-xs">
                            Copyright © {{date('Y')}} Tafaari. All rights reserved by Tcongs Infotech
                        </div>
                    </div>
            </li>
            
        </ul>
    </div>
</aside>