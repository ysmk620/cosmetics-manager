<?php

namespace App\Http\Controllers;

use App\Models\Cosmetic;
use Illuminate\Http\Request;
use App\Models\Category;

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
            'category_id' => 'required|exists:categories,id',
            'expiration_date' => 'nullable|date',
            'emoji'=> 'nullable|string|max:4',
        ]);

        $validated['user_id'] = auth()->id();
        Cosmetic::create($validated);

        return redirect()->route('cosmetics.create')->with('success', 'コスメを登録しました');
    }

    public function index()
    {
        try {
            $cosmetics = auth()->user()->cosmetics()->with('category')->get();
            return view('cosmetics.index', compact('cosmetics'));
        } catch (\Exception $e) {
            logger('Cosmetics index error: ' . $e->getMessage());
            return response('Server Error: ' . $e->getMessage(), 500);
        }
    }

    public function show(Cosmetic $cosmetic)
    {
        if ($cosmetic->user_id !== auth()->id()) {
            abort(403, 'このコスメにアクセスする権限がありません。');
        }

        $cosmetic->load('category');
        return view('cosmetics.show', compact('cosmetic'));
    }

}
