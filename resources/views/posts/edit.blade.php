@extends('layouts.app')

@section('title', 'Edit Postingan')

@section('content')

    <x-card title="Edit Postingan">

        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $post->title) }}"
                    class="form-control @error('title') is-invalid @enderror"
                >
                @error('title')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="body">Isi Postingan</label>
                <textarea
                    id="body"
                    name="body"
                    rows="8"
                    class="form-control @error('body') is-invalid @enderror"
                >{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Gambar Sampul</label>

                @if ($post->image)
                    <div class="current-image">
                        <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}">
                        <p class="hint-text">Gambar saat ini. Upload file baru untuk menggantinya.</p>
                    </div>
                @endif

                <input
                    type="file"
                    id="image"
                    name="image"
                    class="form-control @error('image') is-invalid @enderror"
                >
                <p class="hint-text">Format JPG, JPEG, atau PNG. Maksimal 2MB. Kosongkan kalau tidak diganti.</p>
                @error('image')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Perbarui Postingan</button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>

    </x-card>

@endsection