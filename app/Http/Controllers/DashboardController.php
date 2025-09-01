<?php

namespace App\Http\Controllers;

use App\Models\Cosmetic;
use App\Models\Category;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalCount = $user->cosmetics()->count();
        $favoritesCount = $user->favoriteCosmetics()->count();
        $expiredCount = $user->cosmetics()
            ->whereNotNull('expiration_date')
            ->where('expiration_date', '<', now()->toDateString())
            ->count();
        $categoryCounts = $user->cosmetics()
            ->with('category')
            ->get()
            ->groupBy('category_id')
            ->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'name' => $group->first()->category?->name ?? '未分類'
                ];
            });

        $expiringItems = $user->cosmetics()
            ->whereNotNull('expiration_date')
            ->whereBetween('expiration_date', [
                Carbon::today(),
                Carbon::today()->addDays(30)
            ])
            ->orderBy('expiration_date', 'asc')
            ->limit(3)
            ->get()
            ->map(function ($item) {
                $item->days_until_expiry = Carbon::parse($item->expiration_date)->diffInDays(Carbon::today());
                return $item;
            });

        return view('dashboard', compact('totalCount', 'favoritesCount', 'expiredCount', 'categoryCounts', 'expiringItems'));
    }
}
