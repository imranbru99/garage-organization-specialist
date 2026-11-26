<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GridForge Garage Systems') — Denver Garage Organization</title>
    <meta name="description" content="@yield('meta', 'GridForge Garage Systems designs and installs custom garage storage, overhead racks, and cabinets across Denver and the Front Range.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&family=Oswald:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #12171C;
            --steel: #1F2A33;
            --amber: #D97706;
            --amber-bright: #F59E0B;
            --teal: #0F766E;
            --mist: #E7EEF2;
            --fog: #F4F7F9;
            --muted: #64748B;
            --white: #FFFFFF;
            --shadow: 0 24px 60px rgba(18, 23, 28, 0.18);
            --font-display: "Oswald", sans-serif;
            --font-body: "Figtree", sans-serif;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            font-family: var(--font-body);
            color: var(--ink);
            background:
                radial-gradient(circle at 12% -10%, rgba(217,119,6,.18), transparent 42%),
                radial-gradient(circle at 90% 8%, rgba(15,118,110,.12), transparent 36%),
                linear-gradient(180deg, #F7FAFC 0%, #EEF3F6 48%, #F7FAFC 100%);
            line-height: 1.6;
        }
        a { color: inherit; text-decoration: none; }
        img { max-width: 100%; display: block; }
        .wrap { width: min(1120px, calc(100% - 2rem)); margin-inline: auto; }
        .site-header {
            position: sticky; top: 0; z-index: 40;
            backdrop-filter: blur(14px);
            background: rgba(18, 23, 28, 0.88);
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .nav {
            display: flex; align-items: center; justify-content: space-between;
            gap: 1rem; padding: .95rem 0;
        }
        .brand {
            font-family: var(--font-display);
            letter-spacing: .04em;
            text-transform: uppercase;
            color: var(--white);
            font-size: 1.25rem;
            display: flex; align-items: baseline; gap: .35rem;
        }
        .brand span { color: var(--amber-bright); }
        .nav-links { display: flex; flex-wrap: wrap; gap: .9rem 1.15rem; align-items: center; }
        .nav-links a { color: #D7DEE5; font-size: .92rem; font-weight: 500; }
        .nav-links a:hover { color: var(--amber-bright); }
        .btn {
            display: inline-flex; align-items: center; justify-content: center;
            gap: .4rem; border: 0; cursor: pointer;
            border-radius: 999px; padding: .78rem 1.25rem;
            font-weight: 700; font-size: .95rem;
            transition: transform .2s ease, background .2s ease, box-shadow .2s ease;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary { background: linear-gradient(135deg, var(--amber), var(--amber-bright)); color: #1A1205; box-shadow: 0 10px 28px rgba(217,119,6,.35); }
        .btn-ghost { background: transparent; color: var(--white); border: 1px solid rgba(255,255,255,.28); }
        .btn-dark { background: var(--ink); color: var(--white); }
        .hero {
            position: relative; min-height: min(92vh, 780px);
            display: grid; align-items: end;
            color: var(--white);
            overflow: hidden;
            background: #0C1014;
        }
        .hero-media {
            position: absolute; inset: 0;
            background:
                linear-gradient(90deg, rgba(12,16,20,.88) 0%, rgba(12,16,20,.55) 42%, rgba(12,16,20,.28) 100%),
                url('https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=1800&q=80') center/cover no-repeat;
            transform: scale(1.04);
            animation: drift 18s ease-in-out infinite alternate;
        }
        @keyframes drift { from { transform: scale(1.04) translateY(0); } to { transform: scale(1.08) translateY(-1.5%); } }
        .hero-copy { position: relative; z-index: 1; padding: 7rem 0 4.5rem; width: min(700px, 100%); }
        .eyebrow {
            display: inline-block; margin-bottom: .85rem;
            color: var(--amber-bright); font-weight: 700; letter-spacing: .12em;
            text-transform: uppercase; font-size: .78rem;
        }
        h1, h2, h3 { font-family: var(--font-display); letter-spacing: .02em; line-height: 1.1; margin: 0 0 .75rem; }
        h1 { font-size: clamp(2.8rem, 7vw, 5rem); text-transform: uppercase; }
        h2 { font-size: clamp(2rem, 4vw, 3rem); text-transform: uppercase; }
        h3 { font-size: 1.45rem; }
        .lede { font-size: 1.1rem; color: #D5DCE3; max-width: 36rem; margin-bottom: 1.5rem; }
        .cta-row { display: flex; flex-wrap: wrap; gap: .8rem; }
        section { padding: 4.5rem 0; }
        .section-head { max-width: 40rem; margin-bottom: 2rem; }
        .muted { color: var(--muted); }
        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; }
        .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
        .service-tile {
            position: relative; overflow: hidden; min-height: 280px;
            border-radius: 1.1rem; color: white;
            isolation: isolate;
            transition: transform .25s ease;
        }
        .service-tile:hover { transform: translateY(-4px); }
        .service-tile img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: -2; }
        .service-tile::after {
            content: ""; position: absolute; inset: 0; z-index: -1;
            background: linear-gradient(180deg, rgba(18,23,28,.15), rgba(18,23,28,.88));
        }
        .service-tile .inner { position: absolute; left: 0; right: 0; bottom: 0; padding: 1.25rem; }
        .panel {
            background: rgba(255,255,255,.72);
            border: 1px solid rgba(31,42,51,.08);
            border-radius: 1.2rem;
            padding: 1.4rem;
            box-shadow: var(--shadow);
        }
        .dashboard-preview {
            display: grid; grid-template-columns: 1.1fr .9fr; gap: 1rem;
            background: linear-gradient(145deg, #182129, #24313B);
            color: white; border-radius: 1.4rem; padding: 1.4rem;
            box-shadow: var(--shadow);
        }
        .dash-stat { background: rgba(255,255,255,.06); border-radius: 1rem; padding: 1rem; }
        .dash-stat strong { display: block; font-size: 1.7rem; font-family: var(--font-display); color: var(--amber-bright); }
        .bars { display: flex; align-items: end; gap: .45rem; height: 120px; margin-top: 1rem; }
        .bars span {
            flex: 1; border-radius: .4rem .4rem 0 0;
            background: linear-gradient(180deg, var(--amber-bright), var(--teal));
            animation: rise 1.4s ease both;
        }
        @keyframes rise { from { transform: scaleY(.2); transform-origin: bottom; opacity: .4; } to { transform: scaleY(1); opacity: 1; } }
        .about-band {
            display: grid; grid-template-columns: 1.05fr .95fr; gap: 2rem; align-items: center;
        }
        .about-band img { width: 100%; height: 420px; object-fit: cover; border-radius: 1.4rem; }
        form.stack { display: grid; gap: .85rem; }
        label { font-weight: 600; font-size: .92rem; }
        input, textarea, select {
            width: 100%; border: 1px solid #CBD5E1; border-radius: .8rem;
            padding: .85rem 1rem; font: inherit; background: white;
        }
        textarea { min-height: 140px; resize: vertical; }
        .flash {
            background: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0;
            padding: .9rem 1rem; border-radius: .9rem; margin-bottom: 1rem;
        }
        .site-footer {
            background: var(--ink); color: #C9D2DA; padding: 3rem 0 2rem; margin-top: 2rem;
        }
        .footer-grid { display: grid; grid-template-columns: 1.4fr 1fr 1fr; gap: 1.5rem; }
        .site-footer a:hover { color: var(--amber-bright); }
        .whatsapp {
            position: fixed; right: 1.1rem; bottom: 1.1rem; z-index: 50;
            width: 58px; height: 58px; border-radius: 50%;
            display: grid; place-items: center;
            background: #25D366; color: white; font-weight: 800;
            box-shadow: 0 12px 30px rgba(37,211,102,.45);
            animation: pulse 2.4s ease-in-out infinite;
        }
        @keyframes pulse { 0%,100% { transform: scale(1); } 50% { transform: scale(1.06); } }
        .chat-widget {
            position: fixed; left: 1.1rem; bottom: 1.1rem; z-index: 50; width: min(340px, calc(100vw - 2rem));
        }
        .chat-toggle {
            background: var(--teal); color: white; border: 0; border-radius: 999px;
            padding: .8rem 1.1rem; font-weight: 700; cursor: pointer; box-shadow: var(--shadow);
        }
        .chat-panel {
            display: none; margin-bottom: .7rem; background: white; border-radius: 1rem;
            overflow: hidden; box-shadow: var(--shadow); border: 1px solid #E2E8F0;
        }
        .chat-panel.open { display: block; animation: slideUp .25s ease; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        .chat-head { background: var(--steel); color: white; padding: .85rem 1rem; font-weight: 700; }
        .chat-log { height: 220px; overflow: auto; padding: .9rem; background: var(--fog); font-size: .92rem; }
        .chat-log .bot, .chat-log .user { margin-bottom: .65rem; padding: .65rem .75rem; border-radius: .75rem; max-width: 90%; }
        .chat-log .bot { background: white; border: 1px solid #E2E8F0; }
        .chat-log .user { background: #FEF3C7; margin-left: auto; }
        .chat-form { display: flex; gap: .4rem; padding: .65rem; }
        .chat-form input { flex: 1; }
        .prose { max-width: 48rem; }
        .prose p { margin: 0 0 1rem; }
        .card-list { display: grid; gap: 1rem; }
        .post-card, .kb-card {
            background: rgba(255,255,255,.8); border-radius: 1rem; overflow: hidden;
            border: 1px solid rgba(31,42,51,.08); box-shadow: 0 10px 30px rgba(18,23,28,.06);
        }
        .post-card img { height: 180px; width: 100%; object-fit: cover; }
        .post-card .body, .kb-card { padding: 1.1rem 1.2rem; }
        @media (max-width: 900px) {
            .grid-3, .grid-2, .about-band, .dashboard-preview, .footer-grid { grid-template-columns: 1fr; }
            .about-band img { height: 280px; }
            .nav-links { display: none; }
            .hero-copy { padding-top: 5.5rem; }
        }
    </style>
    @stack('head')
</head>
<body>
<header class="site-header">
    <div class="wrap nav">
        <a class="brand" href="{{ route('home') }}">Grid<span>Forge</span></a>
        <nav class="nav-links">
            <a href="{{ route('services.index') }}">Services</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('blog.index') }}">Blog</a>
            <a href="{{ route('kb.index') }}">Knowledge Base</a>
            <a href="{{ route('contact') }}">Contact</a>
            <a href="/admin" class="btn btn-ghost" style="padding:.55rem 1rem;">ERP Login</a>
        </nav>
        <a class="btn btn-primary" href="{{ route('contact') }}">Free Assessment</a>
    </div>
</header>

<main>@yield('content')</main>

<footer class="site-footer">
    <div class="wrap footer-grid">
        <div>
            <div class="brand" style="margin-bottom:.6rem;">Grid<span>Forge</span> Garage Systems</div>
            <p>Custom garage organization for Denver and the Front Range — wall systems, overhead racks, cabinets, and full makeovers.</p>
        </div>
        <div>
            <h3 style="color:white;">Visit</h3>
            <p>2840 Blake Street<br>Denver, CO 80205<br>(303) 555-0147</p>
        </div>
        <div>
            <h3 style="color:white;">Explore</h3>
            <p><a href="{{ route('services.index') }}">Services</a><br>
            <a href="{{ route('kb.index') }}">Knowledge Base</a><br>
            <a href="{{ route('contact') }}">Contact</a></p>
        </div>
    </div>
</footer>

<a class="whatsapp" href="https://wa.me/13035550147" target="_blank" rel="noopener" aria-label="WhatsApp">WA</a>

<div class="chat-widget">
    <div id="chat-panel" class="chat-panel">
        <div class="chat-head">GridForge Assistant</div>
        <div id="chat-log" class="chat-log">
            <div class="bot">Ask about wall systems, overhead racks, pricing ranges, or prep for install day.</div>
        </div>
        <form id="chat-form" class="chat-form">
            <input id="chat-input" type="text" placeholder="Type a question..." required>
            <button class="btn btn-primary" type="submit" style="padding:.7rem 0.9rem;">Send</button>
        </form>
    </div>
    <button class="chat-toggle" id="chat-toggle" type="button">Chat with AI</button>
</div>

<script>
(() => {
    const toggle = document.getElementById('chat-toggle');
    const panel = document.getElementById('chat-panel');
    const form = document.getElementById('chat-form');
    const input = document.getElementById('chat-input');
    const log = document.getElementById('chat-log');
    toggle.addEventListener('click', () => panel.classList.toggle('open'));
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = input.value.trim();
        if (!message) return;
        log.insertAdjacentHTML('beforeend', `<div class="user"></div>`);
        log.lastElementChild.textContent = message;
        input.value = '';
        const res = await fetch('{{ route('ai.chat') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ message })
        });
        const data = await res.json();
        log.insertAdjacentHTML('beforeend', `<div class="bot"></div>`);
        log.lastElementChild.textContent = data.reply || 'Sorry, try again.';
        log.scrollTop = log.scrollHeight;
    });
})();
</script>
@stack('scripts')
</body>
</html>
