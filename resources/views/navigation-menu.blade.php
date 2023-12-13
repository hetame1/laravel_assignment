<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14 items-center">

            <div class="flex-1 justify-end">
                <div class="text-3xl font-bold font-sans italic">
                    <div id="home-page" class="cursor-pointer">라라벨 게시판</div>
                </div>
            </div>

            <nav class="flex items-center justify-center flex-1">
                <div class="m-2">
                  <div id="main-page" class="cursor-pointer">홈</div>
                </div>
            </nav>

            @if(Auth::check())
            <div class="sm:flex flex-1 justify-end items-center">
                {{-- 글 작성 --}}
                <div class="m-2">
                  <div id="write-page" class="cursor-pointer">글 작성</div>
                </div>

                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            {{ Auth::user()->currentTeam->name }}
                        </button>
                    </div>  
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-dropdown align="right" width="48">

                        {{-- 로그인 정보 --}}
                        <x-slot name="trigger">
                            {{-- 이미지가 있으면 --}}
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        {{-- 드롭다운 메뉴 --}}
                        <x-slot name="content">
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <div 
                                id="profile-page" 
                                class="cursor-pointer block w-full px-4 py-2 text-left text-m leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                            >
                                profile
                            </div>

                            <!-- 로그아웃 -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>

                    </x-dropdown>
                </div>
            </div>
            @else
            <div class="flex items-center justify-end flex-1">
                <div class="m-2">
                  <a href="/login">로그인</a>
                </div>
                <div class="m-2">
                  <a href="/register">회원가입</a>
                </div>
            </div>
            @endif

        </div>
    </div>
    
</nav>
