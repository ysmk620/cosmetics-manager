@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <h2 class="text-3xl font-bold" style="color: var(--color-text)">コスメ一覧</h2>

    @if(session('success'))
    <div class="p-4 bg-primary/30 text-text rounded-lg shadow">
        {{ session('success') }}
    </div>
    @endif

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
                @foreach ($cosmetics as $cosmetic)
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
                    @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
