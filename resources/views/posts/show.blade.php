@extends('layouts.app')

@section('title', $post->title)

@section('content')

    <x-card>

        @if ($post->image)
            <img
                src="{{ asset('storage/'.$post->image) }}"
                alt="{{ $post->title }}"
                class="post-cover"
            >
        @endif

        <h1 class="post-title">{{ $post->title }}</h1>
        <p class="post-date">Ditulis {{ $post->created_at->diffForHumans() }}</p>

        @if ($post->created_at != $post->updated_at)
            <p class="post-date-updated">Diperbarui {{ $post->updated_at->diffForHumans() }}</p>
        @endif

        <div class="post-body">
            {!! nl2br(e($post->body)) !!}
        </div>

        <div class="form-actions">
            <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>

    </x-card>

@endsection