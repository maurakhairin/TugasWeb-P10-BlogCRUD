@extends('layouts.app')

@section('title', 'Tulis Postingan Baru')

@section('content')

    <x-card title="Tulis Postingan Baru">

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Judul</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
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
                >{{ old('body') }}</textarea>
                @error('body')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Gambar Sampul (opsional)</label>
                <input
                    type="file"
                    id="image"
                    name="image"
                    class="form-control @error('image') is-invalid @enderror"
                >
                <p class="hint-text">Format JPG, JPEG, atau PNG. Maksimal 2MB.</p>
                @error('image')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Postingan</button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>

    </x-card>

@endsection