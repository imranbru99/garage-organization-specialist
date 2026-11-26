<?php

namespace App\Filament\Pages;

use App\Services\AiService;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AiStudio extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static string $view = 'filament.pages.ai-studio';

    protected static ?string $navigationLabel = 'AI Studio';

    protected static ?string $title = 'AI Content & Automation';

    protected static ?int $navigationSort = 90;

    public ?array $data = [];

    public string $result = '';

    public array $suggestions = [];

    public function mount(AiService $ai): void
    {
        $this->form->fill([
            'type' => 'blog',
            'topic' => 'overhead garage racks for two-car homes',
            'issue' => '',
        ]);
        $this->suggestions = $ai->automationSuggestions();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('type')->options([
                    'blog' => 'Blog draft',
                    'description' => 'Service / product description',
                    'email' => 'Customer email',
                ])->required(),
                TextInput::make('topic')->required()->label('Topic'),
                Textarea::make('issue')->label('Troubleshooting question')->rows(3),
            ])
            ->statePath('data');
    }

    public function generate(AiService $ai): void
    {
        $state = $this->form->getState();
        $this->result = $ai->generate($state['type'] ?? 'blog', $state['topic'] ?? 'garage organization');
        Notification::make()->title('AI content generated')->success()->send();
    }

    public function troubleshoot(AiService $ai): void
    {
        $state = $this->form->getState();
        $this->result = $ai->troubleshoot($state['issue'] ?: 'How do I schedule a garage install job?');
        Notification::make()->title('Troubleshooting reply ready')->success()->send();
    }
}
