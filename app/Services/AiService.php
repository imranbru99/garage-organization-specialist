<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiService
{
    protected array $faq = [
        'services' => 'GridForge Garage Systems designs and installs custom garage storage: wall-mounted track systems, overhead racks, freestanding cabinets, slatwall panels, bike lifts, and epoxy-compatible floor layouts across the Denver metro and Front Range.',
        'pricing' => 'Most single-car upgrades start around $1,800–$3,500. Two-car full remodels typically range $4,500–$12,000 depending on cabinetry, overhead racks, and labor. Free on-site assessments include a fixed proposal.',
        'timeline' => 'Design and measure take 3–7 days. Standard installs finish in 1–2 days. Custom cabinetry adds 2–4 weeks of fabrication.',
        'warranty' => 'Hardware and cabinetry carry a 5-year workmanship warranty. Manufacturer warranties on tracks, racks, and finishes are passed through to the homeowner.',
        'areas' => 'We serve Denver, Aurora, Lakewood, Boulder, Highlands Ranch, Castle Rock, and nearby Front Range communities.',
        'prep' => 'Clear floor paths and park vehicles outside the day of install. We can arrange a paid declutter haul-away if needed before layout work begins.',
        'materials' => 'We use powder-coated steel tracks, heavy-duty overhead racks rated 250–600 lb, moisture-resistant cabinet boxes, and adjustable shelving for seasonal gear.',
    ];

    public function chat(string $message): string
    {
        $message = trim($message);
        if ($message === '') {
            return 'Ask anything about garage storage, installs, pricing ranges, or prep — I’m the GridForge assistant.';
        }

        if ($key = config('services.openai.key')) {
            try {
                $response = Http::withToken($key)
                    ->timeout(20)
                    ->post('https://api.openai.com/v1/chat/completions', [
                        'model' => config('services.openai.model', 'gpt-4o-mini'),
                        'messages' => [
                            [
                                'role' => 'system',
                                'content' => 'You are the helpful assistant for GridForge Garage Systems, a Denver garage organization company. Be concise, practical, and US-focused. Context: '.json_encode($this->faq),
                            ],
                            ['role' => 'user', 'content' => $message],
                        ],
                        'temperature' => 0.4,
                    ]);

                if ($response->successful()) {
                    return (string) data_get($response->json(), 'choices.0.message.content', $this->demoReply($message));
                }
            } catch (\Throwable) {
                // Fall through to demo knowledge base.
            }
        }

        return $this->demoReply($message);
    }

    public function generate(string $type, string $topic): string
    {
        $prompt = match ($type) {
            'blog' => "Write a short SEO blog post outline and intro about: {$topic}",
            'description' => "Write a product/service description for garage organization: {$topic}",
            'email' => "Write a customer follow-up email about: {$topic}",
            default => "Write helpful garage organization content about: {$topic}",
        };

        if (config('services.openai.key')) {
            return $this->chat($prompt);
        }

        return $this->demoContent($type, $topic);
    }

    public function automationSuggestions(): array
    {
        return [
            'Auto-send prep checklists 48 hours before install appointments.',
            'Flag jobs with estimated value over $7,500 for manager design review.',
            'Reorder slatwall panels when stock drops below 12 panels.',
            'Generate blog drafts from completed job titles weekly.',
            'SMS customers after payment for a Google review request.',
        ];
    }

    public function troubleshoot(string $issue): string
    {
        return $this->chat('Troubleshoot this garage organization / ERP issue: '.$issue);
    }

    protected function demoReply(string $message): string
    {
        $hay = Str::lower($message);

        foreach ([
            'price' => 'pricing',
            'pricing' => 'pricing',
            'cost' => 'pricing',
            'quote' => 'pricing',
            'how long' => 'timeline',
            'timeline' => 'timeline',
            'schedule' => 'timeline',
            'warrant' => 'warranty',
            'area' => 'areas',
            'serve' => 'areas',
            'denver' => 'areas',
            'prep' => 'prep',
            'clear' => 'prep',
            'material' => 'materials',
            'rack' => 'materials',
            'service' => 'services',
            'install' => 'services',
            'cabinet' => 'services',
        ] as $needle => $key) {
            if (Str::contains($hay, $needle)) {
                return $this->faq[$key];
            }
        }

        return $this->faq['services'].' For a free assessment in the Denver area, use the contact form or WhatsApp — typical projects start near $1,800.';
    }

    protected function demoContent(string $type, string $topic): string
    {
        return match ($type) {
            'blog' => "## {$topic}\n\nHomeowners across Denver are reclaiming garage floors with zone-based layouts: vehicle lane, sports wall, seasonal overhead, and a workbench corner. Start with a tape measure and load ratings — then build vertical.\n\n### Outline\n1. Audit what you keep\n2. Choose wall vs overhead storage\n3. Plan clearances for doors and vehicles\n4. Install in phases if budget is staged",
            'description' => "GridForge {$topic}: heavy-duty, powder-coated storage engineered for Front Range garages. Adjustable, moisture-aware, and installed by our Denver crew with a 5-year workmanship warranty.",
            'email' => "Hi there,\n\nThanks for considering GridForge Garage Systems for {$topic}. Attached is your layout concept and fixed proposal. Reply with a preferred install window and we will lock your crew.\n\n— GridForge Team",
            default => "Demo AI content for {$topic}. Add OPENAI_API_KEY for live generation.",
        };
    }
}
