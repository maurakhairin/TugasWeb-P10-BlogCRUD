<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $posts = Post::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('body', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('posts.index', [
            'posts'  => $posts,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'title.required' => 'Judul wajib diisi.',
            'title.max'      => 'Judul maksimal 255 karakter.',
            'body.required'  => 'Isi postingan wajib diisi.',
            'image.image'    => 'File yang diupload harus berupa gambar.',
            'image.mimes'    => 'Gambar harus berformat jpg, jpeg, atau png.',
            'image.max'      => 'Ukuran gambar maksimal 2MB.',
        ]);

        try {
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('posts', 'public');
            }

            Post::create($validated);

            return redirect()
                ->route('posts.index')
                ->with('success', 'Postingan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan postingan. Silakan coba lagi.');
        }
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'title.required' => 'Judul wajib diisi.',
            'title.max'      => 'Judul maksimal 255 karakter.',
            'body.required'  => 'Isi postingan wajib diisi.',
            'image.image'    => 'File yang diupload harus berupa gambar.',
            'image.mimes'    => 'Gambar harus berformat jpg, jpeg, atau png.',
            'image.max'     => 'Ukuran gambar maksimal 2MB.',
        ]);

        try {
            if ($request->hasFile('image')) {
                if ($post->image) {
                    Storage::disk('public')->delete($post->image);
                }

                $validated['image'] = $request->file('image')->store('posts', 'public');
            } else {
                unset($validated['image']);
            }

            $post->update($validated);

            return redirect()
                ->route('posts.index')
                ->with('success', 'Postingan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui postingan. Silakan coba lagi.');
        }
    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();

            return redirect()
                ->route('posts.index')
                ->with('success', 'Postingan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->route('posts.index')
                ->with('error', 'Gagal menghapus postingan.');
        }
    }
}