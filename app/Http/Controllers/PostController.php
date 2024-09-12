<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    // Menampilkan daftar post
    public function index()
    {
        $posts = Post::all();
        return view('index', compact('posts'));
    }

    // Menampilkan formulir untuk menambah post
    public function create()
    {
        return view('create');
    }

    // Menyimpan data post
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xlsx,xls,txt|max:2048',
        ]);

        $post = new Post();
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('files'), $fileName);
            $post->file = $fileName;
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post berhasil disimpan!');
    }

    // Menampilkan formulir untuk mengedit post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('edit', compact('post'));
    }

    // Mengupdate data post
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xlsx,xls,txt|max:2048',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image) {
                File::delete(public_path('images/' . $post->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($post->file) {
                File::delete(public_path('files/' . $post->file));
            }

            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('files'), $fileName);
            $post->file = $fileName;
        }

        $post->save();

        // Redirect back to posts list with success message
        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui!');
    }

    // Menghapus post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Hapus gambar jika ada
        if ($post->image) {
            File::delete(public_path('images/' . $post->image));
        }

        // Hapus file jika ada
        if ($post->file) {
            File::delete(public_path('files/' . $post->file));
        }

        $post->delete();

        // Redirect back to posts list with success message
        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus!');
    }
}
