<?php

namespace App\Http\Controllers;

use App\Models\Cosmetic;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CosmeticController extends Controller
{

    public function create()
    {
        $categories = Category::orderBy('sort_order', 'asc')->get();
        return view('cosmetics.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'color_product_code' => 'nullable|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'expiration_date' => 'nullable|date',
            'memo' => 'nullable|string|max:120',
            'emoji' => 'nullable|string|max:4',
        ]);

        $validated['user_id'] = auth()->id();
        Cosmetic::create($validated);

        return redirect()->route('cosmetics.create')->with('success', 'アイテムを登録しました');
    }

    public function index(Request $request)
    {
        try {
            $query = auth()->user()->cosmetics()->with('category');

            // キーワード検索（名前/ブランド）
            $keyword = trim((string) $request->input('q'));
            if ($keyword !== '') {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'ILIKE', "%{$keyword}%")
                        ->orWhere('brand', 'ILIKE', "%{$keyword}%");
                });
            }

            // カテゴリ絞り込み
            if ($categoryId = $request->input('category_id')) {
                $query->where('category_id', $categoryId);
            }

            // お気に入り絞り込み
            $favoritesOnly = $request->boolean('favorites');
            if ($favoritesOnly) {
                $query->whereExists(function ($q) {
                    $q->selectRaw('1')
                        ->from('favorites as f')
                        ->whereColumn('f.cosmetic_id', 'cosmetics.id')
                        ->where('f.user_id', auth()->id());
                });
            }

            // 期限切れのみ
            $expiredOnly = $request->boolean('expired');
            if ($expiredOnly) {
                $query->whereNotNull('expiration_date')
                      ->where('expiration_date', '<', now()->toDateString());
            }

            //プルダウン用
            $categories = Category::orderBy('sort_order', 'asc')->get();

            // ページネーション
            $cosmetics = $query->orderBy('id', 'desc')->paginate(15)->withQueryString();

            // 画面で♡状態を即判定できるよう ID 配列を渡す
            $favoritedIds = DB::table('favorites')
                ->where('user_id', auth()->id())
                ->pluck('cosmetic_id')
                ->toArray();

            return view('cosmetics.index', compact('cosmetics', 'categories', 'favoritesOnly', 'favoritedIds'));
        } catch (\Exception $e) {
            logger('Cosmetics index error: ' . $e->getMessage());
            return response('Server Error: ' . $e->getMessage(), 500);
        }
    }

    public function show(Cosmetic $cosmetic)
    {
        if ($cosmetic->user_id !== auth()->id()) {
            abort(403, 'このアイテムにアクセスする権限がありません。');
        }

        $cosmetic->load('category');
        return view('cosmetics.show', compact('cosmetic'));
    }

    public function destroy(Cosmetic $cosmetic)
    {
        if ($cosmetic->user_id !== auth()->id()) {
            abort(403, 'このアイテムを削除する権限がありません。');
        }

        $cosmetic->delete();
        return redirect()->route('cosmetics.index')->with('success', 'アイテムを削除しました');
    }

    public function edit(Cosmetic $cosmetic)
    {
        if ($cosmetic->user_id !== auth()->id()) {
            abort(403, 'このアイテムを編集する権限がありません。');
        }

        $categories = Category::orderBy('sort_order', 'asc')->get();
        return view('cosmetics.edit', compact('cosmetic', 'categories'));
    }

    public function update(Request $request, Cosmetic $cosmetic)
    {
        if ($cosmetic->user_id !== auth()->id()) {
            abort(403, 'このアイテムを更新する権限がありません。');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'color_product_code' => 'nullable|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'expiration_date' => 'nullable|date',
            'memo' => 'nullable|string|max:120',
            'emoji' => 'nullable|string|max:4',
        ]);

        $cosmetic->update($validated);

        return redirect()->route('cosmetics.index')->with('success', 'アイテムを更新しました');
    }

    public function toggleFavorite(Cosmetic $cosmetic)
    {
        abort_if($cosmetic->user_id !== auth()->id(), 403);

        $relation = auth()->user()->favoriteCosmetics();

        $result = $relation->toggle($cosmetic->id);
        $isFavorite = !empty($result['attached']);

        if (request()->wantsJson()) {
            return response()->json(['ok' => true, 'is_favorite' => $isFavorite]);
        }

        return back()->with('success', 'お気に入りを更新しました');
    }
}
