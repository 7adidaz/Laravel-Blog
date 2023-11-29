<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1> Edit Post </h1>
    <form action="/edit-post/{{ $post->id }}" method="post">
        @csrf
        @method('put')
        <input type="text" name="title" placeholder="title" value="{{ $post->title }}">
        <input type="text" name="description" placeholder="write a description.." value="{{ $post->description }}">
        <button type="submit">Post</button>
    </form>
</body>
</html>