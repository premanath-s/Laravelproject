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
        try {
            // Use cached queries with timeout to prevent hanging
            $totalOrders = cache()->remember('admin_total_orders', 300, function () {
                return Order::limit(1000)->count();
            });
            
            $totalProducts = cache()->remember('admin_total_products', 300, function () {
                return Product::limit(1000)->count();
            });
            
            $totalUsers = cache()->remember('admin_total_users', 300, function () {
                return User::limit(1000)->count();
            });
            
            $revenue = cache()->remember('admin_total_revenue', 300, function () {
                return Order::where('status', 'completed')->limit(1000)->sum('total');
            });
        } catch (\Exception $e) {
            // If queries fail, return default values
            $totalOrders = 0;
            $totalProducts = 0;
            $totalUsers = 0;
            $revenue = 0;
        }

        return [
            Stat::make('Total Orders', $totalOrders)
                ->description('Total orders placed')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('info')
                ->extraAttributes([
                    'class' => 'bg-blue-100/70 dark:bg-blue-900/10 border-blue-200 dark:border-blue-800 shadow-sm',
                ]),
            Stat::make('Total Products', $totalProducts)
                ->description('Active catalog items')
                ->descriptionIcon('heroicon-m-tag')
                ->chart([2, 5, 3, 8, 4, 10, 6])
                ->color('success')
                ->extraAttributes([
                    'class' => 'bg-emerald-100/70 dark:bg-emerald-900/10 border-emerald-200 dark:border-emerald-800 shadow-sm',
                ]),
            Stat::make('Total Users', $totalUsers)
                ->description('Registered customers')
                ->descriptionIcon('heroicon-m-users')
                ->chart([1, 4, 2, 7, 5, 9, 8])
                ->color('warning')
                ->extraAttributes([
                    'class' => 'bg-amber-100/70 dark:bg-amber-900/10 border-amber-200 dark:border-amber-800 shadow-sm',
                ]),
            Stat::make('Total Revenue', '₹' . number_format($revenue, 2))
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
