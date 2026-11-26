<x-filament-panels::page>
    <div class="grid gap-6 lg:grid-cols-2">
        <x-filament::section>
            <form wire:submit="generate" class="space-y-4">
                {{ $this->form }}
                <div class="flex flex-wrap gap-3">
                    <x-filament::button type="submit">Generate content</x-filament::button>
                    <x-filament::button color="gray" wire:click="troubleshoot" type="button">Troubleshoot</x-filament::button>
                </div>
            </form>
        </x-filament::section>

        <x-filament::section heading="Automation suggestions">
            <ul class="list-disc space-y-2 pl-5 text-sm">
                @foreach ($suggestions as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </x-filament::section>
    </div>

    @if ($result)
        <x-filament::section heading="AI output" class="mt-6">
            <pre class="whitespace-pre-wrap text-sm">{{ $result }}</pre>
        </x-filament::section>
    @endif
</x-filament-panels::page>
