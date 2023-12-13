<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>
  <title>게시글 상세보기</title>
  @vite(['/resources/css/app.css'])
  @vite ('/resources/js/detail.js')

<x-app-layout>
  <div id="body" class="hidden">
    {{-- 헤더 --}}
    <div class="w-[1240px] h-72  m-auto flex justify-center items-end">
      <img src="https://cdn.pixabay.com/photo/2014/09/24/16/28/bricks-459299_1280.jpg" id="img" class="w-[1240px] h-72 object-cover absolute z-1" />
      <div id="info-box" class="w-[48rem] h-48 bg-white flex flex-col p-10 rounded-t-md relative">

        {{-- 제목 --}}
        <div id="title" class="w-full h-16 flex items-center text-3xl font-semibold">
          {{ $post -> title }}
        </div>

        {{-- 정보 --}}
        <div class="flex mt-8 items-center absolute bottom-4">
          <div class="h-4 flex items-center mr-2 font-medium">
            {{ $post -> user -> name }}
          </div>
          <p> · </p>
          <div class="h-4 flex items-center ml-2 text-xs text-gray-500">
            {{ $post -> created_at }}
          </div>
        </div>

        {{-- 수정, 삭제 --}}
        @if(Auth::check())
          @if(Auth::user() -> id == $post -> user_id)
            <div class="flex justify-end items-center absolute bottom-5 right-10">
              <div class="mr-4 text-sm font-light">
                <form id="edit-form" action="/posts/{{$post -> id}}/edit" method="get">
                  <button type="submit">수정</button>
                </form>
              </div>
              <div class="text-sm font-light">
                <form method="post" id="deleteForm">
                  @csrf
                  @method('DELETE')
                  <button id="deleteButton">삭제</button>
                </form>
              </div>
            </div>
          @endif
        @endif
        
      </div>
    </div>

    {{-- 글 내용 --}}
    <main class="container w-[48rem] m-auto">
      <div id="content" class="p-5 whitespace-pre-wrap break-words"> 
        {!! $post->content !!}
      </div>
    </main>

    {{-- 댓글 --}}
    <div class="w-[48rem] m-auto pb-20">
      {{-- 댓글 버튼 --}}
      <button 
        id="comment-button" 
        class="w-32 h-12 text-black border border-gray-400 rounded-lg flex items-center justify-center"
      >
        댓글  
        <div class="ml-2">{{ count($post->comments) }}</div>
      </button>

      {{-- 댓글 본 내용 --}}
      <div id="comment-box" class="w-full hidden mt-10">
        {{-- 헤더 --}}
        <div class="h-16 flex items-center pb-4 border-b-2">
          <div class="ml-4 font-semibold">댓글</div> <div class="ml-2">{{ count($post->comments) }}</div>
        </div>
        
        {{-- 바디 --}}
        <div class="w-full h-full ">
          

          @if(count($post->comments) > 0)
            @foreach($post->comments as $comment)

              <div class="w-full items-start border-b-2 my-4 relative">

                {{-- 유저 정보 --}}
                <div class="w-full pt-4 px-2 flex">
                  <div class="w-10 h-10 rounded-full bg-gray-400 mr-2">
                    <img src={{ $comment -> user -> profile_photo_path }} class="w-10 h-10 rounded-full" />
                  </div>
                  
                  <div class="flex flex-col">
                    <div class="flex items-center text-sm font-semibold text-gray-500">
                      {{ $comment -> user -> name }}
                    </div>
                    <div class="flex items-center text-xs text-gray-400">
                      {{ $comment -> created_at }}
                    </div>
                  </div>
                </div>

                {{-- 댓글 내용 --}}
                <div>
                  <div id="comment-content-{{ $comment -> id }}" class="w-full pt-4 px-4 pb-7">
                    {{ $comment->content }}
                  </div>
                  {{-- 수정 --}}
                  <form
                    action="/comments/{{ $comment -> id }}"
                    method="post"
                    id="edit-form-buton-{{ $comment -> id }}" 
                    class="hidden"
                  >
                  @csrf
                  @method('PATCH')
                    <textarea
                      id="edit-content-{{ $comment -> id }}"
                      name="content"
                      class="edit-content w-full h-24 border-0 outline-none resize-none bg-transparent mt-2 p-4 focus:ring-0"
                      placeholder="댓글을 입력하세요."
                    ></textarea>
                    <div class="flex w-full justify-end items-center p-2 border-t-2">
                      <button class="w-1/12 h-10 ml-2 bg-gray-400 rounded-lg text-white">수정</button>
                    </div>
                  </form>
                </div>

                {{-- 수정, 삭제 --}}
                @if(Auth::check())
                  @if(Auth::user() -> id == $comment -> user_id)
                    <div class="absolute top-4 right-4 flex items-center">

                      <button id="edit-button" class="text-xs text-gray-400 mr-4" data-comment-id="{{ $comment -> id }}">
                        수정
                      </button>
                      
                      <form id="comment_delete" method="post" action="/comments/{{ $comment -> id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-gray-400">삭제</button>
                      </form>

                    </div>
                  @endif
                @endif

              </div>

            @endforeach
          @else
            <div class="flex items-center justify-center my-24">
              작성된 댓글이 없습니다.
            </div>
          @endif
        </div>

        {{-- 작성부분 --}}
        <div class="w-full flex items-center justify-center">
          <form action="/posts/{{ $post -> id }}/comments" method="post" class="border w-full border-gray-400">
            @csrf
            
            @if(Auth::check())
              <div class="flex px-4 pt-5 items-center">
                <div class="w-10 h-10 rounded-full bg-gray-400 mr-4">
                  <img src={{ Auth::user() -> profile_photo_path }} class="w-10 h-10 rounded-full" />
                </div>
                {{ Auth::user() -> name  }}
              </div>


              <div>
                <textarea
                  name="content" 
                  id="content"
                  cols="40"
                  class="w-full h-24 border-0 outline-none resize-none bg-transparent mt-2 p-4 focus:ring-0"
                  placeholder="댓글을 입력하세요."
                ></textarea>
              </div>

              <div class="flex w-full justify-end items-center p-2 border-t-2">
                <button type="submit" class="w-1/12 h-10 ml-2 bg-gray-400 rounded-lg text-white">등록</button>
              </div>
            @endif

            @if(!Auth::check())
              <div id="to-login" class="flex px-4 py-10 items-center cursor-pointer">
                로그인 후 댓글을 작성할 수 있습니다.
              </div>
            @endif

          </form>
        </div>

      </div>
      
    </div>

  </div>
</x-app-layout>

  <script>
    const deleteButton = document.querySelector('#deleteButton');
    const deleteForm = document.querySelector('#deleteForm');
    
    deleteForm?.addEventListener('submit', (e) => {
      e.preventDefault();
      const confirmDelete = confirm('정말 삭제하시겠습니까?');
      if(confirmDelete) {
        deleteForm.submit();
      } else {
        return;
      }
    })

    const commentDelete = document.querySelectorAll('#comment_delete');
    commentDelete.forEach((item) => {
      item.addEventListener('submit', (e) => {
        e.preventDefault();
        const confirmDelete = confirm('정말 삭제하시겠습니까?');
        if(confirmDelete) {
          item.submit();
        } else {
          return;
        }
      })
    })

  </script>


</html>