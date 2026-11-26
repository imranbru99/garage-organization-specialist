<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\WorkOrder;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $openJobs = WorkOrder::query()->whereNotIn('status', ['completed', 'cancelled'])->count();
        $revenue = Payment::query()->sum('amount');
        $outstanding = Invoice::query()->selectRaw('COALESCE(SUM(total - amount_paid), 0) as balance')->value('balance');

        return [
            Stat::make('Active Jobs', (string) $openJobs)
                ->description('Open garage installs')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('warning'),
            Stat::make('Customers', (string) Customer::query()->count())
                ->description('Homeowners on file')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
            Stat::make('Collected', '$'.number_format((float) $revenue, 2))
                ->description('Payments received')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('primary'),
            Stat::make('Outstanding', '$'.number_format((float) $outstanding, 2))
                ->description('Invoice balance due')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('danger'),
        ];
    }
}
