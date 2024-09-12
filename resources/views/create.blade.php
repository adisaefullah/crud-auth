<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
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
        input[type="text"],
        textarea,
        input[type="file"] {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
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
        <h1>Create New Post</h1>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="content" placeholder="Content" required></textarea>
            <input type="file" name="image" accept="image/*">
            <input type="file" name="file" accept=".pdf,.docx,.doc,.xlsx,.xls,.txt">
            <button type="submit">Submit</button>
        </form>
        <a href="{{ route('posts.index') }}" class="back-link">Back to List</a>
    </div>
</body>
</html>
