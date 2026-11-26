@extends('layouts.site')

@section('title', 'Knowledge Base')

@section('content')
<section>
    <div class="wrap">
        <div class="section-head">
            <div class="eyebrow" style="color:var(--amber);">Knowledge Base</div>
            <h1>Guides, issues & admin manual</h1>
            <p class="muted">Practical garage organization help plus ERP how-tos for GridForge staff.</p>
        </div>
        @foreach ($articles as $category => $items)
            <h2 style="margin-top:2rem;">{{ str_replace('_', ' ', ucfirst($category)) }}</h2>
            <div class="card-list" style="margin-top:1rem;">
                @foreach ($items as $article)
                    <a class="kb-card" href="{{ route('kb.show', $article->slug) }}">
                        <h3>{{ $article->title }}</h3>
                        <p class="muted" style="margin:0;">{{ $article->summary }}</p>
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
</section>
@endsection
