@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <h2 class="text-3xl font-bold" style="color: var(--color-text)">アイテム一覧</h2>

    @if(session('success'))
    <div class="p-4 card" style="color: var(--color-text)">
        {{ session('success') }}
    </div>
    @endif

    {{-- フィルタフォーム --}}
    <form action="{{ route('cosmetics.index') }}" method="GET"
        class="card p-4 grid gap-4 md:grid-cols-4 items-center"
        style="color: var(--color-text)">

        {{-- キーワード --}}
        <div>
            <label for="q" class="form-label">キーワード（アイテム名/ブランド）</label>
            <input id="q" name="q" type="text" value="{{ request('q') }}"
                placeholder="例: リップ or CHANEL"
                class="form-input w-full" />
        </div>

        {{-- カテゴリ --}}
        <div>
            <label for="category_id" class="form-label">カテゴリ</label>
            <select id="category_id" name="category_id" class="form-input w-full">
                <option value="">すべて</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category_id')==$category->id)>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- チェックボックス（横並び） --}}
        <div class="self-center">
            <label class="inline-flex items-center gap-2 cursor-pointer text-sm md:text-base mr-4">
                <input type="checkbox" name="favorites" value="1" {{ !empty($favoritesOnly) ? 'checked' : '' }}
                    class="scale-125 accent-[color:var(--color-primary)]">
                <span>お気に入りのみ</span>
            </label>
            <label class="inline-flex items-center gap-2 cursor-pointer text-sm md:text-base">
                <input type="checkbox" name="expired" value="1" {{ !empty($expiredOnly) ? 'checked' : '' }}
                    class="scale-125 accent-[color:var(--color-primary)]">
                <span>期限切れのみ</span>
            </label>
        </div>

        {{-- ボタン --}}
        <div class="flex gap-2 self-center">
            <x-ui.button type="submit" variant="primary" class="w-full">検索</x-ui.button>
            <x-ui.button as="a" variant="ghost" href="{{ route('cosmetics.index') }}"
                class="w-full border border-[color:var(--color-line)]">クリア</x-ui.button>
        </div>
    </form>




    {{-- カードグリッド --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse ($cosmetics as $cosmetic)
        @php
        $isExpired = $cosmetic->expiration_date && $cosmetic->expiration_date < now()->toDateString();
            $expirationDate = $cosmetic->expiration_date ? \Carbon\Carbon::parse($cosmetic->expiration_date)->startOfDay() : null;
            $daysUntil = $expirationDate ? now()->startOfDay()->diffInDays($expirationDate, false) : null;
            $nowFav = isset($favoritedIds) && in_array($cosmetic->id, $favoritedIds, true);
            @endphp

            <div class="relative card p-5 transition cursor-pointer hover:shadow-xl" style="color: var(--color-text)"
                onclick="window.location='{{ route('cosmetics.show', $cosmetic) }}'">
                {{-- お気に入りトグル（右上） --}}
                <div class="absolute top-2 right-2">
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
                            <svg viewBox="0 0 24 24" class="w-7 h-7 text-red-500" aria-hidden="true">
                                <path fill="currentColor" d="M11.645 20.91l-.007-.003C7.63 18.716 4.5 16.27 4.5 12.75A4.5 4.5 0 0 1 12 9a4.5 4.5 0 0 1 7.5 3.75c0 3.52-3.13 5.966-7.138 8.157l-.007.003a.75.75 0 0 1-.71 0z" />
                            </svg>
                            @else
                            <svg viewBox="0 0 24 24" class="w-6 h-6" aria-hidden="true">
                                <path fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" vector-effect="non-scaling-stroke" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.936 0-3.622 1.126-4.312 2.733-.69-1.607-2.376-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 11.25 9 11.25s9-4.03 9-11.25z" />
                            </svg>
                            @endif
                        </button>
                    </form>
                </div>

                {{-- アイコン --}}
                <div class="text-center mt-2 mb-4">
                    @if ($cosmetic->emoji)
                    <div class="text-6xl md:text-7xl leading-none">{{ $cosmetic->emoji }}</div>
                    @else
                    <div class="text-6xl md:text-7xl leading-none text-gray-300">💠</div>
                    @endif
                </div>

                {{-- テキスト情報 --}}
                <div class="space-y-2">
                    <div class="text-lg font-bold tracking-wide truncate">{{ $cosmetic->name }}</div>

                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs border"
                            style="background: color-mix(in oklab, var(--color-secondary) 55%, white); border-color: var(--color-line); color: var(--color-text);">
                            {{ $cosmetic->category->name ?? '未設定' }}
                        </span>
                    </div>

                    <div class="text-xs">
                        @if ($cosmetic->expiration_date)
                        @if ($isExpired)
                        <span class="text-red-600 font-medium">使用期限 {{ $cosmetic->expiration_date }}（期限切れ）</span>
                        @elseif ($daysUntil !== null && $daysUntil <= 30)
                            <span class="text-orange-600 font-medium">使用期限 {{ $cosmetic->expiration_date }}（あと{{ floor($daysUntil) }}日）</span>
                            @else
                            <span class="text-green-600">使用期限 {{ $cosmetic->expiration_date }}</span>
                            @endif
                            @else
                            <span class="text-[color:var(--color-subtle)]">使用期限 未設定</span>
                            @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="sm:col-span-2 lg:col-span-3">
                <div class="p-8 card text-center text-gray-500">条件に一致するアイテムがありません。</div>
            </div>
            @endforelse
    </div>

    {{-- ページネーション --}}
    <div class="mt-4" style="color: var(--color-text)">
        {{ $cosmetics->links() }}
    </div>
</div>
@endsection
