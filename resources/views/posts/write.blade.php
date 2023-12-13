<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>
    @vite(['/resources/js/post.js'])
</head>

<x-app-layout>
  <div id="body" class="hidden">
    <main class="w-[1240px] m-auto">
  
      <form id="create-post" action="/posts" method="POST">
        @csrf
        <label>
          <input class="w-full h-16 border-b-2 text-3xl p-6 focus:outline-none font-bold mt-5" 
            type="text" 
            name="title" 
            placeholder="제목" 
          />
        </label> 
  
        <input type="hidden" id="editor-content" name="content">
        <x-quill />
  
        <div class="flex items-center justify-end w-full mr-3">
          <input
            type="submit" 
            value="등록"
            class="cursor-pointer border-2 p-4 rounded-md bg-blue-300 text-black hover:bg-blue-500 hover:text-white"
          />
        </div>
        
      </form>
    </main>
  </div>
</x-app-layout>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>