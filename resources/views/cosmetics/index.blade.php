@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <h2 class="text-3xl font-bold" style="color: var(--color-text)">コスメ一覧</h2>

    @if(session('success'))
    <div class="p-4 bg-primary/30 text-text rounded-lg shadow">
        {{ session('success') }}
    </div>
    @endif

    {{-- フィルタフォーム --}}
    <form action="{{ route('cosmetics.index') }}" method="GET" class="card p-4 grid gap-3 md:grid-cols-3" style="color: var(--color-text)">
        <div class="md:col-span-1">
            <label for="q" class="form-label">キーワード（名前/ブランド）</label>
            <input id="q" name="q" type="text" value="{{ request('q') }}" placeholder="例: リップ or CHANEL" class="form-input" />
        </div>
        <div class="md:col-span-1">
            <label for="category_id" class="form-label">カテゴリ</label>
            <select id="category_id" name="category_id" class="form-input">
                <option value="">すべて</option>
                @isset($categories)
                @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category_id')==$category->id)>
                    {{ $category->name }}
                </option>
                @endforeach
                @endisset
            </select>
        </div>
        <div class="flex items-end gap-4 md:col-span-1">
            <label class="inline-flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="favorites" value="1" {{ !empty($favoritesOnly) ? 'checked' : '' }}>
                <span>お気に入りのみ</span>
            </label>
            <x-ui.button type="submit" variant="primary">検索</x-ui.button>
            <a href="{{ route('cosmetics.index') }}" class="px-4 py-2 rounded-md border border-gray-300" style="color: var(--color-text)">クリア</a>
        </div>
    </form>

    <div class="overflow-x-auto card">
        <table class="min-w-full table-auto" style="color: var(--color-text)">
            <thead class="bg-[color:var(--color-secondary)]">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium"> </th>
                    <th class="px-6 py-3 text-left text-sm font-medium">アイテム名</th>
                    <th class="px-6 py-3 text-left text-sm font-medium w-36">ブランド</th>
                    <th class="px-6 py-3 text-left text-sm font-medium w-36">カテゴリ</th>
                    <th class="px-6 py-3 text-left text-sm font-medium w-36">使用期限</th>
                    <th class="px-6 py-3 text-left text-sm font-medium"> </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($cosmetics as $cosmetic)
                @php
                $isExpired = $cosmetic->expiration_date
                && $cosmetic->expiration_date < now()->toDateString();
                    $nowFav = isset($favoritedIds) && in_array($cosmetic->id, $favoritedIds, true);
                    @endphp

                    <tr class="transition cursor-pointer even:bg-[color:var(--color-secondary)]/30 hover:bg-[color:var(--color-secondary)]/40" onclick="window.location='{{ route('cosmetics.show', $cosmetic) }}'">
                        <td class="px-6 py-4 whitespace-nowrap text-center text-2xl">
                            @if ($cosmetic->emoji)
                            {{ $cosmetic->emoji }}
                            @else
                            <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $cosmetic->name }}</td>
                        <td class="px-6 py-4">{{ $cosmetic->brand }}</td>
                        <td class="px-6 py-4">{{ $cosmetic->category->name ?? '未設定' }}</td>
                        <td class="px-6 py-4 {{ $isExpired ? 'text-red-600 font-semibold' : '' }}">
                            {{ $cosmetic->expiration_date }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-center w-12">
                            <form method="POST" action="{{ route('cosmetics.favorite', $cosmetic) }}">
                                @csrf
                                @method('PATCH')
                                <button
                                    type="submit"
                                    aria-label="お気に入りを切り替え"
                                    aria-pressed="{{ $nowFav ? 'true' : 'false' }}"
                                    class="p-1 rounded-full hover:scale-105 transition"
                                    title="{{ $nowFav ? 'お気に入り解除' : 'お気に入り登録' }}"
                                    onclick="event.stopPropagation();">
                                    @if($nowFav)
                                        <svg viewBox="0 0 24 24" class="w-8 h-8 text-red-500" aria-hidden="true">
                                            <path fill="currentColor" d="M11.645 20.91l-.007-.003C7.63 18.716 4.5 16.27 4.5 12.75A4.5 4.5 0 0 1 12 9a4.5 4.5 0 0 1 7.5 3.75c0 3.52-3.13 5.966-7.138 8.157l-.007.003a.75.75 0 0 1-.71 0z" />
                                        </svg>
                                    @else
                                        <svg viewBox="0 0 24 24" class="w-6 h-6" aria-hidden="true">
                                            <path fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" vector-effect="non-scaling-stroke" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.936 0-3.622 1.126-4.312 2.733-.69-1.607-2.376-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 11.25 9 11.25s9-4.03 9-11.25z" />
                                        </svg>
                                    @endif
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            条件に一致するアイテムがありません。
                        </td>
                    </tr>
                    @endforelse
            </tbody>
        </table>
    </div>

    {{-- ページネーション --}}
    <div class="mt-4" style="color: var(--color-text)">
        {{ $cosmetics->links() }}
    </div>
</div>
@endsection
