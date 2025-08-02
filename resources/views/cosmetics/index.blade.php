@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <h2 class="text-3xl font-bold text-primary">コスメ一覧</h2>

    @if(session('success'))
    <div class="p-4 bg-primary/30 text-text rounded-lg shadow">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto bg-white/60 backdrop-blur-sm rounded-2xl shadow-lg">
        <table class="min-w-full divide-y divide-gray-200 table-auto">
            <thead class="bg-secondary/80">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-text text-opacity-80">  </th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-text text-opacity-80">商品名</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-text text-opacity-80 w-36">ブランド</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-text text-opacity-80 w-36">カテゴリ</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-text text-opacity-80 w-36">使用期限</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($cosmetics as $cosmetic)
                @php
                $isExpired = $cosmetic->expiration_date
                && $cosmetic->expiration_date < now()->toDateString();
                    @endphp

                    <tr class="transition {{ $isExpired? 'bg-red-100 hover:bg-red-200': 'hover:bg-secondary/30' }}">
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
                        <td class="px-6 py-4
                 {{ $isExpired ? 'text-red-600 font-semibold' : '' }}">
                            {{ $cosmetic->expiration_date }}
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection