<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>글 수정</title>
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>
  @vite(['resources/css/app.css'], ['resources/js/post.js'])
</head>

<x-app-layout>
  <div id="body" class="hidden">
    <main class="w-[1240px] m-auto">

      <form id="edit-post" method="POST" action="/posts/{{ $post -> id }}">
        @csrf
        @method('PATCH')
        <label>
          <input class="w-full h-16 border-b-2 text-3xl p-6 focus:outline-none font-bold mt-5" 
          type="text" 
          name="title"
          value={{ $post->title }}
          placeholder="제목" 
        /> 
        </label> 

        <input type="hidden" id="editor-content" name="content">
        <x-quill :value="$post->content" />

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
</html>