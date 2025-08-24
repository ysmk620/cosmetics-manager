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
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="flex items-end gap-2 md:col-span-1">
            <x-ui.button type="submit" variant="primary">検索</x-ui.button>
            <a href="{{ route('cosmetics.index') }}" class="px-4 py-2 rounded-md border border-gray-300" style="color: var(--color-text)">クリア</a>
        </div>
    </form>

    <div class="overflow-x-auto card">
        <table class="min-w-full table-auto" style="color: var(--color-text)">
            <thead class="bg-[color:var(--color-secondary)]">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium">  </th>
                    <th class="px-6 py-3 text-left text-sm font-medium">アイテム名</th>
                    <th class="px-6 py-3 text-left text-sm font-medium w-36">ブランド</th>
                    <th class="px-6 py-3 text-left text-sm font-medium w-36">カテゴリ</th>
                    <th class="px-6 py-3 text-left text-sm font-medium w-36">使用期限</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($cosmetics as $cosmetic)
                @php
                $isExpired = $cosmetic->expiration_date
                && $cosmetic->expiration_date < now()->toDateString();
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
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
