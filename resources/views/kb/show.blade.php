@extends('layouts.site')

@section('title', $article->title)

@section('content')
<section>
    <div class="wrap prose">
        <div class="eyebrow" style="color:var(--teal);">{{ ucfirst($article->category) }}</div>
        <h1>{{ $article->title }}</h1>
        <p class="muted">{{ $article->summary }}</p>
        <div>{!! nl2br(e($article->body)) !!}</div>
        <p style="margin-top:2rem;"><a class="btn btn-dark" href="{{ route('kb.index') }}">Back to knowledge base</a></p>
    </div>
</section>
@endsection
