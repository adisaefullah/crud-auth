<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            box-sizing: border-box; /* Include padding and border in element's total width and height */
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"],
        textarea,
        input[type="file"] {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box; /* Include padding and border in element's total width and height */
        }
        textarea {
            resize: vertical;
            height: 150px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .alert {
            color: red;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid red;
            border-radius: 5px;
            background-color: #fdd;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Post</h1>

        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>
            
            <label for="content">Content:</label>
            <textarea name="content" id="content" required>{{ old('content', $post->content) }}</textarea>

            @if ($post->image)
                <p>Current Image:</p>
                <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" width="150">
            @endif

            <label for="image">Change Image (optional):</label>
            <input type="file" name="image" id="image" accept="image/*">

            @if ($post->file)
                <p>Current File: <a href="{{ asset('files/' . $post->file) }}" download>Download</a></p>
            @endif

            <label for="file">Change File (optional):</label>
            <input type="file" name="file" id="file" accept=".pdf,.doc,.docx,.xlsx,.xls,.txt">

            <button type="submit">Update Post</button>
        </form>

        <a href="{{ route('posts.index') }}" class="back-link">Back to Posts</a>
    </div>
</body>
</html>
