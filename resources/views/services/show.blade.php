@extends('layouts.site')

@section('title', $service['title'])

@section('content')
<section>
    <div class="wrap about-band">
        <div>
            <div class="eyebrow" style="color:var(--teal);">Service</div>
            <h1>{{ $service['title'] }}</h1>
            <p class="muted">{{ $service['summary'] }}</p>
            <p>{{ $service['body'] }}</p>
            <a class="btn btn-primary" href="{{ route('contact') }}">Request a quote</a>
        </div>
        <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}">
    </div>
</section>
@endsection
