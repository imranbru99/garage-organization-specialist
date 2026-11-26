@extends('layouts.site')

@section('title', $post->title)

@section('content')
<section>
    <div class="wrap prose">
        <div class="eyebrow" style="color:var(--teal);">Blog</div>
        <h1>{{ $post->title }}</h1>
        <p class="muted">{{ optional($post->published_at)->toFormattedDateString() }}</p>
        @if ($post->cover_image)
            <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" style="border-radius:1.2rem;margin:1.2rem 0;width:100%;max-height:420px;object-fit:cover;">
        @endif
        <div>{!! nl2br(e($post->body)) !!}</div>
    </div>
</section>
@endsection
