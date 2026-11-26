<x-filament-panels::page>
    <form wire:submit="save" class="max-w-2xl space-y-4">
        {{ $this->form }}
        <x-filament::button type="submit">Save settings</x-filament::button>
    </form>
</x-filament-panels::page>
