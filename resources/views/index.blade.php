<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container {
            max-width: 1000px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .actions a, .actions button {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
        }
        .actions button {
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
            color: #fff;
            padding: 5px 10px;
            cursor: pointer;
        }
        .actions button:hover {
            background-color: #c82333;
        }
        .logout-button {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            padding: 10px 20px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        .logout-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <a href="{{ route('logout') }}" class="logout-button">Logout</a>
    <div class="container">
        <h1>Posts</h1>
        <a href="{{ route('posts.create') }}" class="create-post">Create New Post</a>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>File</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td>
                            @if ($post->image)
                                <img src="{{ asset('images/' . $post->image) }}" alt="Image" width="100">
                            @endif
                        </td>
                        <td>
                            @if ($post->file)
                                <a href="{{ asset('files/' . $post->file) }}" download>{{ $post->file }}</a>
                            @endif
                        </td>
                        <td class="actions">
                            <!-- Edit Button -->
                            <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                            <!-- Delete Button -->
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
