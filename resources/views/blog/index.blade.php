@extends('layouts.site')

@section('title', 'Blog')

@section('content')
<section>
    <div class="wrap">
        <div class="section-head">
            <div class="eyebrow" style="color:var(--amber);">Blog</div>
            <h1>Garage organization insights</h1>
        </div>
        <div class="grid-3">
            @foreach ($posts as $post)
                <article class="post-card">
                    @if ($post->cover_image)
                        <img src="{{ $post->cover_image }}" alt="{{ $post->title }}">
                    @endif
                    <div class="body">
                        <h3><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
                        <p class="muted">{{ $post->excerpt }}</p>
                    </div>
                </article>
            @endforeach
        </div>
        <div style="margin-top:1.5rem;">{{ $posts->links() }}</div>
    </div>
</section>
@endsection
