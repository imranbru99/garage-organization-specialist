@extends('layouts.site')

@section('title', 'GridForge Garage Systems')
@section('meta', 'Engineered garage storage, overhead racks, and custom cabinets for Denver homes.')

@section('content')
<section class="hero">
    <div class="hero-media" aria-hidden="true"></div>
    <div class="wrap hero-copy">
        <div class="eyebrow">Denver Garage Organization</div>
        <h1>GridForge Garage Systems</h1>
        <p class="lede">Precision wall tracks, overhead racks, and cabinetry that reclaim your floor — designed for American two-car lives and Front Range weather.</p>
        <div class="cta-row">
            <a class="btn btn-primary" href="{{ route('contact') }}">Book a free assessment</a>
            <a class="btn btn-ghost" href="{{ route('services.index') }}">Explore services</a>
        </div>
    </div>
</section>

<section>
    <div class="wrap">
        <div class="section-head">
            <div class="eyebrow" style="color:var(--teal);">Services</div>
            <h2>Storage that earns its keep</h2>
            <p class="muted">One job per garage zone — vehicle lane clear, walls working, ceiling carrying the bulk.</p>
        </div>
        <div class="grid-3">
            @foreach ([
                ['wall-track-systems', 'Wall Track Systems', 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?auto=format&fit=crop&w=900&q=80'],
                ['overhead-racks', 'Overhead Racks', 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?auto=format&fit=crop&w=900&q=80'],
                ['custom-cabinets', 'Custom Cabinets', 'https://images.unsplash.com/photo-1615874959474-d609969a20ed?auto=format&fit=crop&w=900&q=80'],
            ] as [$slug, $title, $img])
                <a class="service-tile" href="{{ route('services.show', $slug) }}">
                    <img src="{{ $img }}" alt="{{ $title }}">
                    <div class="inner">
                        <h3>{{ $title }}</h3>
                        <p style="margin:0;opacity:.9;">See details →</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section style="padding-top:0;">
    <div class="wrap about-band">
        <div>
            <div class="eyebrow" style="color:var(--amber);">About GridForge</div>
            <h2>Built for real Colorado garages</h2>
            <p class="muted">We measure studs, door tracks, opener clearance, and how your family actually uses the space — then install systems that survive snow gear, mountain bikes, and weekend projects.</p>
            <p class="muted">Every proposal includes a fixed scope, load ratings, and a prep checklist so install day stays clean and fast.</p>
            <a class="btn btn-dark" href="{{ route('about') }}">Our story</a>
        </div>
        <img src="https://images.unsplash.com/photo-1504148455328-c376907d081c?auto=format&fit=crop&w=1200&q=80" alt="Organized garage workshop tools">
    </div>
</section>

<section>
    <div class="wrap">
        <div class="section-head">
            <div class="eyebrow" style="color:var(--teal);">ERP preview</div>
            <h2>Operations dashboard</h2>
            <p class="muted">The same Filament ERP your crew uses for jobs, inventory, invoices, and AI assist.</p>
        </div>
        <div class="dashboard-preview">
            <div>
                <div class="grid-2" style="margin-bottom:1rem;">
                    <div class="dash-stat"><strong>24</strong>Active installs</div>
                    <div class="dash-stat"><strong>$86k</strong>Collected MTD</div>
                </div>
                <div class="bars" aria-hidden="true">
                    <span style="height:45%"></span>
                    <span style="height:70%"></span>
                    <span style="height:55%"></span>
                    <span style="height:88%"></span>
                    <span style="height:62%"></span>
                    <span style="height:76%"></span>
                </div>
            </div>
            <div class="panel" style="background:rgba(255,255,255,.08);color:#E2E8F0;box-shadow:none;border-color:rgba(255,255,255,.08);">
                <h3 style="color:white;">Today’s schedule</h3>
                <p>08:30 — Measure, Highlands Ranch</p>
                <p>11:00 — Overhead rack install, Lakewood</p>
                <p>14:30 — Cabinet delivery, Boulder</p>
                <a class="btn btn-primary" href="/admin" style="margin-top:.5rem;">Open admin</a>
            </div>
        </div>
    </div>
</section>

<section style="padding-top:0;">
    <div class="wrap">
        <div class="section-head">
            <div class="eyebrow" style="color:var(--amber);">From the shop</div>
            <h2>Knowledge & blog</h2>
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
        <div style="margin-top:1.5rem;">
            <a class="btn btn-dark" href="{{ route('contact') }}">Talk to GridForge</a>
        </div>
    </div>
</section>
@endsection
