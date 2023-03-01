
{{-- Desktop Header (Start) --}}
<header class="relative z-50 shadow-lg md:block sm:hidden">
    <nav class="bg-black">
        <div class="container py-2">
            <div class="flex items-center justify-center">
                <p class="text-xs text-white">USE ABCDEF Coupon code and get 20% OFF on first order</p>
            </div>
        </div>
    </nav>
    <nav class="border-b">
        <div class="container py-5">
            <div class="grid grid-cols-2 items-center">
                <div class="grid grid-cols-2 gap-7 items-center">
                    <a href="{{ route('main') }}" class="text-2xl">
                        <span class="text-black font-bold">Laravel </span>
                        <span class="text-web-ascent font-bold"> Ecommerce</span>
                    </a>
                    <div class="flex items-center justify-between w-full">
                        <input type="text" class="input-box-md w-full" placeholder="Search products">
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-end space-x-7">
                        <a href="#" class="header-icon-link">
                            <div>
                                <span>2</span>
                                <i data-feather="heart"></i>
                            </div>
                            <div>
                                <p>My Wishlist</p>
                                <p>No items in wishlist</p>
                            </div>
                        </a>
                        <a href="#" class="header-icon-link">
                            <div>
                                <i data-feather="shopping-bag"></i>
                            </div>
                            <div>
                                <p>My Cart</p>
                                <p>No items in cart</p>
                            </div>
                        </a>
                        <div class="relative dropdown" x-data="{
                            open: false,
                            toggle() {
                                if (this.open) {
                                    return this.close()
                                }
                                this.$refs.button.focus()
                                this.open = true
                            },
                            close(focusAfter) {
                                if (!this.open) return
                                this.open = false
                                focusAfter && focusAfter.focus()
                            }
                        }"
                            x-on:keydown.escape.prevent.stop="close($refs.button)"
                            x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                            x-id="['profile-dropdown-button']">
                            <a href="#" class="header-icon-link" x-ref="button" x-on:click="toggle()" x-tra :class=" open ? 'active' : '' ">
                                <div>
                                    <i data-feather="user"></i>
                                </div>
                                <div>
                                    <p>My Account</p>
                                    <p>Login to continue</p>
                                </div>
                            </a>
                            <div class="dropdown-content" x-ref="panel" x-show="open" x-transition.origin.top.right
                                x-on:click.outside="close($refs.button)" :id="$id('profile-dropdown-button')"
                                style="display: none;">
                                <a href="#"><i class="h-4 w-4 mr-2 stroke-[2.5px]" data-feather="user"></i>
                                    Account Dashboard</a>
                                <a href="#"><i class="h-4 w-4 mr-2 stroke-[2.5px]"
                                        data-feather="bell"></i>Notifications</a>
                                <a href="#"><i class="h-4 w-4 mr-2 stroke-[2.5px]"
                                        data-feather="shopping-cart"></i> My Orders</a>
                                <a href="#"><i class="h-4 w-4 mr-2 stroke-[2.5px]"
                                        data-feather="headphones"></i>Customer Support</a>
                                <a href="#"><i class="h-4 w-4 mr-2 stroke-[2.5px]"
                                        data-feather="log-out"></i>Logout</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </nav>
    <nav class="border-b">
        <div class="container">
            <ul class="flex items-center">
                <li><a href="#" class="header-link">Mens Clothing</a></li>
                <li><a href="#" class="header-link">Womens Clothing</a></li>
                <li><a href="#" class="header-link">Kids Clothing</a></li>
            </ul>
        </div>
    </nav>
</header>
{{-- Desktop Header (End) --}}


{{-- Desktop Header (Start) --}}
<header class="relative z-50 shadow-lg md:hidden sm:block">
    <nav class="border-b">
        <div class="container py-5">
            <div class="grid grid-cols-2 items-center">
                <div class="grid grid-cols-2 gap-7 items-center">
                    <a href="{{ route('main') }}" class="text-xl whitespace-nowrap">
                        <span class="text-black font-bold">Laravel </span>
                        <span class="text-web-ascent font-bold"> Ecommerce</span>
                    </a>
                </div>
                <div>
                    <div class="flex items-center justify-end space-x-3">
                        <a href="#" class="header-icon-link">
                            <div>
                                <span>2</span>
                                <i data-feather="heart"></i>
                            </div>
                        </a>
                        <a href="#" class="header-icon-link">
                            <div>
                                <i data-feather="shopping-bag"></i>
                            </div>
                            <div>
                        </a>
                        <div class="relative dropdown" x-data="{
                            open: false,
                            toggle() {
                                if (this.open) {
                                    return this.close()
                                }
                                this.$refs.button.focus()
                                this.open = true
                            },
                            close(focusAfter) {
                                if (!this.open) return
                                this.open = false
                                focusAfter && focusAfter.focus()
                            }
                        }"
                            x-on:keydown.escape.prevent.stop="close($refs.button)"
                            x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                            x-id="['profile-dropdown-button']">
                            <a href="#" class="header-icon-link" x-ref="button" x-on:click="toggle()" x-tra :class=" open ? 'active' : '' ">
                                <div>
                                    <i data-feather="user"></i>
                                </div>
                            </a>
                            <div class="dropdown-content" x-ref="panel" x-show="open" x-transition.origin.top.right
                                x-on:click.outside="close($refs.button)" :id="$id('profile-dropdown-button')"
                                style="display: none;">
                                <a href="#"><i class="h-4 w-4 mr-2 stroke-[2.5px]" data-feather="user"></i>
                                    Account Dashboard</a>
                                <a href="#"><i class="h-4 w-4 mr-2 stroke-[2.5px]"
                                        data-feather="bell"></i>Notifications</a>
                                <a href="#"><i class="h-4 w-4 mr-2 stroke-[2.5px]"
                                        data-feather="shopping-cart"></i> My Orders</a>
                                <a href="#"><i class="h-4 w-4 mr-2 stroke-[2.5px]"
                                        data-feather="headphones"></i>Customer Support</a>
                                <a href="#"><i class="h-4 w-4 mr-2 stroke-[2.5px]"
                                        data-feather="log-out"></i>Logout</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </nav>
    <nav class="border-b">
        <div class="container py-5">
            <input type="text" class="input-box-md w-full" placeholder="Search products">
        </div>
    </nav>
</header>
{{-- Desktop Header (End) --}}