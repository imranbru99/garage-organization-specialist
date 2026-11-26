@extends('layouts.site')

@section('title', 'Services')

@section('content')
<section>
    <div class="wrap">
        <div class="section-head">
            <div class="eyebrow" style="color:var(--amber);">Services</div>
            <h1>Garage organization services</h1>
            <p class="muted">From a single wall of tracks to a full two-car makeover — engineered for Denver homes.</p>
        </div>
        <div class="grid-2">
            @foreach ([
                ['wall-track-systems', 'Wall Track & Slatwall Systems', 'https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=1000&q=80', 'Modular steel tracks and slatwall that turn blank walls into adjustable storage.'],
                ['overhead-racks', 'Overhead Storage Racks', 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?auto=format&fit=crop&w=1000&q=80', 'Ceiling platforms that reclaim floor space without blocking doors.'],
                ['custom-cabinets', 'Custom Garage Cabinets', 'https://images.unsplash.com/photo-1615874959474-d609969a20ed?auto=format&fit=crop&w=1000&q=80', 'Locked cabinets and workbench runs built for Front Range climates.'],
                ['full-garage-makeovers', 'Full Garage Makeovers', 'https://images.unsplash.com/photo-1504148455328-c376907d081c?auto=format&fit=crop&w=1000&q=80', 'End-to-end planning, zones, storage, and professional install.'],
            ] as [$slug, $title, $img, $summary])
                <a class="post-card" href="{{ route('services.show', $slug) }}">
                    <img src="{{ $img }}" alt="{{ $title }}">
                    <div class="body">
                        <h3>{{ $title }}</h3>
                        <p class="muted">{{ $summary }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
