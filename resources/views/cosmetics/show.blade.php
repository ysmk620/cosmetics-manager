@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-bold" style="color: var(--color-text)">アイテム詳細</h2>
        <a href="{{ route('cosmetics.index') }}" class="btn btn-secondary">
            ← 一覧に戻る
        </a>
    </div>

    @php
    $isExpired = $cosmetic->expiration_date && $cosmetic->expiration_date < now()->toDateString();
    @endphp

    <div class="card p-8" style="color: var(--color-text)">
        @if($isExpired)
        <div class="mb-6 p-4 rounded-lg border" style="background: color-mix(in oklab, red 12%, white); border-color: color-mix(in oklab, red 40%, var(--color-line));">
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
                <div class="text-8xl mb-4 text-gray-400"> </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="form-label">アイテム名</label>
                        <div class="p-4 rounded-lg border" style="background-color: color-mix(in oklab, white 80%, transparent); border-color: var(--color-line);">
                            <span class="text-lg">{{ $cosmetic->name }}</span>
                        </div>
                    </div>

                    <div>
                        <label class="form-label">ブランド</label>
                        <div class="p-4 rounded-lg border" style="background-color: color-mix(in oklab, white 80%, transparent); border-color: var(--color-line);">
                            <span class="text-lg">{{ $cosmetic->brand ?: '未設定' }}</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="form-label">カテゴリ</label>
                        <div class="p-4 rounded-lg border" style="background-color: color-mix(in oklab, white 80%, transparent); border-color: var(--color-line);">
                            <span class="text-lg">{{ $cosmetic->category->name ?? '未設定' }}</span>
                        </div>
                    </div>

                    <div>
                        <label class="form-label">使用期限</label>
                        <div class="p-4 rounded-lg border {{ $isExpired ? 'border-red-300 bg-red-50' : '' }}" style="background-color: color-mix(in oklab, white 80%, transparent); border-color: var(--color-line);">
                            <span class="text-lg {{ $isExpired ? 'text-red-600 font-semibold' : '' }}">
                                {{ $cosmetic->expiration_date ?: '未設定' }}
                            </span>
                        </div>
                        @if($cosmetic->expiration_date)
                            <div class="mt-2 text-lg text-center">
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
                        @endif
                    </div>
                </div>
            </div>
        </div>

            <div class="mt-8 flex justify-center gap-4">
                <a href="{{ route('cosmetics.edit', $cosmetic) }}" class="btn btn-primary inline-flex items-center px-6 py-3 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    このアイテムを編集
                </a>

                <form method="post" action="{{route('cosmetics.destroy',$cosmetic)}}" class="inline"
                      onsubmit="return confirm('本当にこのアイテムを削除しますか？この操作は取り消せません。')">
                    @csrf
                    @method("delete")
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-red-500 text-white font-medium rounded-xl hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-500/20 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 border border-red-400/50">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        このアイテムを削除
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
