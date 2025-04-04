
<aside class="z-20 hidden w-64 overflow-y-auto {{$sidebarBgColor}} md:block flex-shrink-0">
    <div class="{{$sidebarBgColor}}"></div>
    <div class="py-4 {{$textColor}}">
        <a class="ml-6 text-lg font-bold {{$textColor}}" href="{{ route('dashboard') }}">
            Super Admin
        </a>

        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <x-nav-link class="{{$textColor}}" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard') ||
                    request()->routeIs('admin.hotel') ||
                    request()->routeIs('admin.shift') ||
                    request()->routeIs('admin.editroom') ||
                    request()->routeIs('admin.shiftdetail') ||
                    request()->routeIs('admin.createroom') ||
                    request()->routeIs('admin.roomdetail')">
                    <x-slot name="icon">
                        <svg class="w-5 h-5 {{$textColor}}" aria-hidden="true" fill="none" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </x-slot>
                                        <p class="{{$textColor}}">Dashboard</p>

                </x-nav-link>
            </li>

            <li class="relative px-6 py-3 {{$sidebarBgColor}}">
                <x-nav-link class="{{$textColor}}" href="/dashboard/user" :active="request()->routeIs('user.index') ||
                    request()->routeIs('user.create') ||
                    request()->routeIs('user.edit') ||
                    request()->routeIs('user.show')">
                    <x-slot name="icon">
                        <svg class="w-5 h-5 {{$textColor}}" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </x-slot >
                    <p class="{{$textColor}}">Users</p>
                </x-nav-link>
            </li>

            <li class="relative px-6 py-3">
                <x-nav-link class="{{$textColor}}" href="/dashboard/charge" :active="request()->routeIs('charge.index') ||
                    request()->routeIs('charge.create') ||
                    request()->routeIs('charge.edit')">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 {{$textColor}}">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                        </svg>

                    </x-slot>
                    <p class="{{$textColor}}">Charge Type</p>
                </x-nav-link>
            </li>

            <li class="relative px-6 py-3">
                <x-nav-link class="{{$textColor}}" href="/dashboard/platform" :active="request()->routeIs('platform.index') ||
                    request()->routeIs('platform.create') ||
                    request()->routeIs('platform.edit')">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 {{$textColor}}">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                        </svg>


                    </x-slot>
                    <p class="{{$textColor}}">Platform Fee</p>

                </x-nav-link>
            </li>

        <li class="relative px-6 py-3">
            <x-nav-link class="{{$textColor}}" href="{{ route('admin.setting.edit', ['id' => Auth::user()->id]) }}" :active="request()->routeIs('admin.setting.edit')">
                <x-slot name="icon">
                    <svg class="w-5 h-5 {{$textColor}}" aria-hidden="true" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                        </path>
                    </svg>
                </x-slot>
                <p class="{{$textColor}}">Setting</p>
            </x-nav-link>
        </li>


            


        </ul>
    </div>
</aside>
