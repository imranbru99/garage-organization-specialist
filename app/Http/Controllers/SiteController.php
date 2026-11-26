<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\KnowledgeArticle;
use App\Models\Post;
use App\Services\AiService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        $posts = Post::query()->where('is_published', true)->latest('published_at')->take(3)->get();

        return view('pages.home', compact('posts'));
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function services(): View
    {
        return view('services.index');
    }

    public function serviceShow(string $slug): View
    {
        $services = $this->serviceCatalog();
        abort_unless(isset($services[$slug]), 404);

        return view('services.show', [
            'slug' => $slug,
            'service' => $services[$slug],
            'services' => $services,
        ]);
    }

    public function blog(): View
    {
        $posts = Post::query()->where('is_published', true)->latest('published_at')->paginate(9);

        return view('blog.index', compact('posts'));
    }

    public function blogShow(string $slug): View
    {
        $post = Post::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('blog.show', compact('post'));
    }

    public function knowledge(): View
    {
        $articles = KnowledgeArticle::query()->where('is_published', true)->orderBy('sort_order')->get()->groupBy('category');

        return view('kb.index', compact('articles'));
    }

    public function knowledgeShow(string $slug): View
    {
        $article = KnowledgeArticle::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('kb.show', compact('article'));
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'subject' => ['nullable', 'string', 'max:160'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::query()->create($data);

        return back()->with('success', 'Thanks — GridForge received your message and will reply within one business day.');
    }

    public function chat(Request $request, AiService $ai)
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        return response()->json([
            'reply' => $ai->chat($data['message']),
        ]);
    }

    protected function serviceCatalog(): array
    {
        return [
            'wall-track-systems' => [
                'title' => 'Wall Track & Slatwall Systems',
                'image' => 'https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=1400&q=80',
                'summary' => 'Modular steel tracks and slatwall that turn blank garage walls into adjustable storage.',
                'body' => 'We design load-rated wall grids for bikes, tools, yard gear, and seasonal bins. Tracks are leveled, anchored into studs, and finished with matching hooks, baskets, and cabinets.',
            ],
            'overhead-racks' => [
                'title' => 'Overhead Storage Racks',
                'image' => 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?auto=format&fit=crop&w=1400&q=80',
                'summary' => 'Ceiling-mounted racks that reclaim floor space without blocking garage doors.',
                'body' => 'Our overhead platforms are engineered around door tracks, openers, and vehicle clearance. Ideal for holiday totes, camping kits, and rarely used bulk items.',
            ],
            'custom-cabinets' => [
                'title' => 'Custom Garage Cabinets',
                'image' => 'https://images.unsplash.com/photo-1615874959474-d609969a20ed?auto=format&fit=crop&w=1400&q=80',
                'summary' => 'Locked cabinets and workbench runs built for Front Range temperature swings.',
                'body' => 'Moisture-resistant boxes, soft-close hardware, and durable finishes keep chemicals, sports gear, and tools out of sight while looking intentional next to drywall or epoxy floors.',
            ],
            'full-garage-makeovers' => [
                'title' => 'Full Garage Makeovers',
                'image' => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?auto=format&fit=crop&w=1400&q=80',
                'summary' => 'End-to-end planning: declutter strategy, zones, storage, lighting, and install.',
                'body' => 'From measurement to final walkthrough, GridForge maps vehicle lanes, kids zones, hobby benches, and storage walls so the garage works as hard as the rest of your home.',
            ],
        ];
    }
}
