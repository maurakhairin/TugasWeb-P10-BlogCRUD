@extends('layouts.app')

@section('title', 'Daftar Postingan')

@section('content')

    <x-card title="Daftar Postingan">

        <div class="toolbar">
            <form action="{{ route('posts.index') }}" method="GET" class="search-form">
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Cari judul atau isi postingan..."
                    aria-label="Cari postingan"
                >
                <button type="submit" class="btn btn-secondary">Cari</button>

                @if ($search)
                    <a href="{{ route('posts.index') }}" class="btn btn-link">Reset</a>
                @endif
            </form>

            <a href="{{ route('posts.create') }}" class="btn btn-primary">+ Tulis Postingan</a>
        </div>

        @forelse ($posts as $post)
            <div class="post-row">

                @if ($post->image)
                    <img
                        src="{{ asset('storage/'.$post->image) }}"
                        alt="{{ $post->title }}"
                        class="post-thumb"
                    >
                @endif

                <div class="post-row-body">
                    <h3>
                        <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="post-excerpt">
                        {{ \Illuminate\Support\Str::limit(strip_tags($post->body), 120) }}
                    </p>
                    <span class="post-date">Ditulis {{ $post->created_at->diffForHumans() }}</span>
                </div>

                <div class="post-row-actions">
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-secondary btn-sm">Lihat</a>
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-secondary btn-sm">Edit</a>

                    <form
                        action="{{ route('posts.destroy', $post) }}"
                        method="POST"
                        class="inline-form"
                        onsubmit="return confirm('Yakin ingin menghapus postingan ini?');"
                    >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>

            </div>
        @empty
            <p class="empty-state">
                @if ($search)
                    Tidak ada postingan yang cocok dengan kata kunci "{{ $search }}".
                @else
                    Belum ada postingan. Yuk tulis yang pertama!
                @endif
            </p>
        @endforelse

        <div class="pagination-wrap">
            {{ $posts->links() }}
        </div>

    </x-card>

@endsection