<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.manage-settings';

    protected static ?string $navigationLabel = 'Settings';

    protected static ?string $title = 'Company Settings';

    protected static ?int $navigationSort = 99;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'company_name' => Setting::getValue('company_name', 'GridForge Garage Systems'),
            'phone' => Setting::getValue('phone', '(303) 555-0147'),
            'email' => Setting::getValue('email', 'hello@gridforgegarage.com'),
            'address' => Setting::getValue('address', '2840 Blake Street, Denver, CO 80205'),
            'whatsapp' => Setting::getValue('whatsapp', '13035550147'),
            'tagline' => Setting::getValue('tagline', 'Engineered garage storage for American homes'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('company_name')->required(),
                TextInput::make('tagline'),
                TextInput::make('phone'),
                TextInput::make('email')->email(),
                TextInput::make('whatsapp')->label('WhatsApp number (digits)'),
                Textarea::make('address')->rows(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        foreach ($this->form->getState() as $key => $value) {
            Setting::setValue($key, $value);
        }

        Notification::make()->title('Settings saved')->success()->send();
    }
}
