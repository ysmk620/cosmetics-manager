@extends('layouts.app')

@section('content')
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- 総アイテム数カード -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.5 2.5L19 4"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        総アイテム数
                                    </dt>
                                    <dd class="text-3xl font-bold text-gray-900">
                                        {{ $totalCount }}点
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('cosmetics.index') }}" class="text-sm text-pink-600 hover:text-pink-500">
                                アイテム一覧を見る →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- カテゴリ分布カード -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">カテゴリ分布</h3>
                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="mt-4 space-y-2 max-h-48 overflow-y-auto">
                            @forelse($categoryCounts as $categoryId => $data)
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-700">{{ $data['name'] }}</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $data['count'] }}点</span>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">まだアイテムが登録されていません</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- 期限間近アイテムカード -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">期限間近のアイテム</h3>
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="mt-4 space-y-3">
                            @forelse($expiringItems as $item)
                                <div class="flex justify-between items-center p-3 bg-orange-50 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">
                                            @if($item->emoji)
                                                {{ $item->emoji }}
                                            @endif
                                            {{ $item->name }}
                                        </p>
                                        @if($item->brand)
                                            <p class="text-xs text-gray-500">{{ $item->brand }}</p>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-orange-600">
                                            あと{{ $item->days_until_expiry }}日
                                        </p>
                                        <a href="{{ route('cosmetics.show', $item) }}" class="text-xs text-orange-500 hover:text-orange-700">
                                            詳細 →
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">期限間近のアイテムはありません</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- アイテム追加CTAカード -->
                <div class="bg-gradient-to-r from-pink-500 to-purple-600 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <svg class="w-12 h-12 text-white mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-white mb-2">新しいアイテムを追加</h3>
                        <p class="text-pink-100 text-sm mb-4">お気に入りのコスメアイテムを登録しましょう</p>
                        <a href="{{ route('cosmetics.create') }}" class="inline-flex items-center px-4 py-2 bg-white text-pink-600 text-sm font-medium rounded-lg hover:bg-pink-50 transition-colors duration-200">
                            アイテムを追加する
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
