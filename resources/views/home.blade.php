<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth
        <h1>Home</h1>
        <form action="/logout" method="post">
            @csrf
            <button type="submit">logout</button>
        </form>

        <div style="border: 4px solid black;">
            <h2>Create A Post</h2>
            <form action="/create-post" method="post">
                @csrf
                <input type="text" name="title" placeholder="title">
                <input type="text" name="description" placeholder="write a description..">
                <button type="submit">Post</button>
            </form>
        </div>

        <div style="border: 4px solid black;">
            <h2>Posts</h2>
            @foreach ($posts as $post)
            <div style="background-color: gray; padding: 10px; margin: 10px;">
                <h3>{{ $post->title }} by {{ $post->user->name}}</h3>
                <p>{{ $post->description }}</p>
                <p><a href="/edit-post/{{ $post->id }}">Edit</a></p>
                <form action="/delete-post/{{ $post->id }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">Delete</button>
                </form>
            </div>
            @endforeach
        </div>

    @else
        <div style="border: 4px solid black;">
            <h2>Register</h2>
            <form action="/register" method="post">
                @csrf
                <input type="text" name="name" placeholder="name">
                <input type="text" name="email" placeholder="email">
                <input type="password" name="password" placeholder="password">
                <button type="submit">register</button>
            </form>
        </div>
        <div style="border: 4px solid black;">
            <h2>Login</h2>
            <form action="/login" method="post">
                @csrf
                <input type="text" name="loginname" placeholder="name">
                <input type="password" name="loginpassword" placeholder="password">
                <button type="submit">register</button>
            </form>
        </div>
    @endauth
</body>
</html>