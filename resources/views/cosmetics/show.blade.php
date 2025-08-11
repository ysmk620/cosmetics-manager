@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-bold text-primary">アイテム詳細</h2>
        <a href="{{ route('cosmetics.index') }}" class="bg-secondary text-text px-4 py-2 rounded-lg hover:bg-secondary/80 transition">
            ← 一覧に戻る
        </a>
    </div>

    @php
    $isExpired = $cosmetic->expiration_date && $cosmetic->expiration_date < now()->toDateString();
    @endphp

    <div class="bg-white/60 backdrop-blur-sm rounded-2xl shadow-lg p-8">
        @if($isExpired)
        <div class="mb-6 p-4 bg-red-100 border border-red-300 rounded-lg">
            <div class="flex items-center">
                <span class="text-red-600 text-xl mr-2">⚠️</span>
                <span class="text-red-800 font-semibold">使用期限が切れています</span>
            </div>
        </div>
        @endif

        <div class="space-y-6">
            <div class="text-center">
                @if ($cosmetic->emoji)
                <div class="text-8xl mb-4">{{ $cosmetic->emoji }}</div>
                @else
                <div class="text-8xl mb-4 text-gray-400">💄</div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">アイテム名</label>
                        <div class="bg-white/80 p-4 rounded-lg border">
                            <span class="text-lg text-text">{{ $cosmetic->name }}</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">ブランド</label>
                        <div class="bg-white/80 p-4 rounded-lg border">
                            <span class="text-lg text-text">{{ $cosmetic->brand ?: '未設定' }}</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">カテゴリ</label>
                        <div class="bg-white/80 p-4 rounded-lg border">
                            <span class="text-lg text-text">{{ $cosmetic->category->name ?? '未設定' }}</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">使用期限</label>
                        <div class="bg-white/80 p-4 rounded-lg border {{ $isExpired ? 'border-red-300 bg-red-50' : '' }}">
                            <span class="text-lg {{ $isExpired ? 'text-red-600 font-semibold' : 'text-text' }}">
                                {{ $cosmetic->expiration_date ?: '未設定' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            @if($cosmetic->expiration_date)
            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <div class="text-sm text-gray-600">
                    @php
                    $expirationDate = \Carbon\Carbon::parse($cosmetic->expiration_date)->startOfDay();
                    $daysUntilExpiration = now()->startOfDay()->diffInDays($expirationDate, false);
                    @endphp
                    @if($isExpired)
                    <span class="text-red-600 font-medium">
                        使用期限を{{ abs(floor($daysUntilExpiration)) }}日過ぎています
                    </span>
                    @elseif($daysUntilExpiration <= 30)
                    <span class="text-orange-600 font-medium">
                        使用期限まで残り{{ floor($daysUntilExpiration) }}日です
                    </span>
                    @else
                    <span class="text-green-600">
                        使用期限まで{{ floor($daysUntilExpiration) }}日あります
                    </span>
                    @endif
                </div>
            </div>
            @endif
        </div>
        <div class="mt-8 pt-6 border-t border-accent/50">
            <form method="post" action="{{route('cosmetics.destroy',$cosmetic)}}" class="flex justify-center"
                  onsubmit="return confirm('本当にこのアイテムを削除しますか？この操作は取り消せません。')">
                @csrf
                @method("delete")
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-red-500 text-white font-medium rounded-xl hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-primary/20 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 border border-primary/30">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    このアイテムを削除
                </button>
            </form>
        </div>
    </div>
</div>
@endsection