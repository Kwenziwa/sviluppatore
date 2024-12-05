<?php

namespace App\Filament\Widgets;

use App\Models\ClassMethod;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatusCounts extends BaseWidget
{
    protected function getStats(): array
    {
        $data = ClassMethod::all();
        return [
            Stat::make('Started', $data->where('status', 'started')->count())
                ->description('Total Started Methods')
                ->color('blue')
                ->icon('heroicon-o-play'),

            Stat::make('Completed', $data->where('status', 'completed')->count())
                ->description('Total Completed Methods')
                ->color('green')
                ->icon('heroicon-o-check-circle'),

            Stat::make('Failed', $data->where('status', 'failed')->count())
                ->description('Total Failed Methods')
                ->color('danger')
                ->icon('heroicon-o-x-circle'),
        ];
    }
}
