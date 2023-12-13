@props (['value'])

<head>
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<div id="editor" style="height: 500px;">
  {!! $value ?? $slot !!}
</div>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@vite(['/resources/js/post.js'])