<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Orders', Order::count())
                ->description('Total orders placed')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('info')
                ->extraAttributes([
                    'class' => 'bg-blue-100/70 dark:bg-blue-900/10 border-blue-200 dark:border-blue-800 shadow-sm',
                ]),
            Stat::make('Total Products', Product::count())
                ->description('Active catalog items')
                ->descriptionIcon('heroicon-m-tag')
                ->chart([2, 5, 3, 8, 4, 10, 6])
                ->color('success')
                ->extraAttributes([
                    'class' => 'bg-emerald-100/70 dark:bg-emerald-900/10 border-emerald-200 dark:border-emerald-800 shadow-sm',
                ]),
            Stat::make('Total Users', User::count())
                ->description('Registered customers')
                ->descriptionIcon('heroicon-m-users')
                ->chart([1, 4, 2, 7, 5, 9, 8])
                ->color('warning')
                ->extraAttributes([
                    'class' => 'bg-amber-100/70 dark:bg-amber-900/10 border-amber-200 dark:border-amber-800 shadow-sm',
                ]),
            Stat::make('Total Revenue', '₹' . number_format(Order::where('status', 'completed')->sum('total'), 2))
                ->description('Revenue from completed orders')
                ->descriptionIcon('heroicon-m-banknotes')
                ->chart([10, 20, 15, 30, 25, 40, 35])
                ->color('success')
                ->extraAttributes([
                    'class' => 'bg-indigo-100/70 dark:bg-indigo-900/10 border-indigo-200 dark:border-indigo-800 shadow-sm',
                ]),
        ];
    }
}
