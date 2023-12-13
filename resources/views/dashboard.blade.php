<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- Scripts -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>
    @vite(['resources/css/app.css'], ['/resources/js/app.js'])
</head>

<x-app-layout>
    <div id="body" class="hidden">
        <main class="w-[1240px] m-auto flex justify-center mt-6">
            <div class="grid grid-cols-3 gap-14">
                @if($posts->count() > 0)
                   @foreach($posts as $post)
                   <article class="flex flex-col shadow w-80 h-64 cursor-pointer bg-white" id="box" data-post-id="{{ $post->id }}">
                     <div class="flex flex-col justify-between p-6 h-full">
                         <div class="text-3xl font-bold pb-4">{{ $post -> title }}</div>
                         <div>
                            <div class="flex items-center">
                                <div class="text-xs font-bold uppercase mr-4">{{ $post -> created_at }}</div>
                            </div>
    
                             <div class="text-xs pb-3 text-gray-400 mt-2">
                                 By <a href="#" class="font-semibold hover:text-gray-800">{{ $post -> user -> name }}</a> 
                             </div>
    
                             <div 
                                class="pb-4 w-full h-6 overflow-hidden overflow-ellipsis whitespace-nowrap"
                             >
                             {!! $post->content !!}
                            </div>
                         </div>
                     </div>
                   </article>
                   @endforeach
                @endif
            </div>
        </main>
    </div>
</x-app-layout>


