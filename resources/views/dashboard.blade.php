@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <h1 class="text-3xl font-bold" style="color: var(--color-text)">ダッシュボード</h1>

    <!-- 総アイテム数（トップにコンパクト表示） -->
    <div class="card p-4">
        <div class="flex items-center gap-3">
            <div class="flex-shrink-0 rounded-xl p-1.5" style="background: color-mix(in oklab, var(--color-secondary) 70%, transparent); color: var(--color-subtle)">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.5 2.5L19 4" />
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs opacity-80" style="color: var(--color-text)">総アイテム数</p>
                <p class="text-2xl font-bold leading-tight" style="color: var(--color-text)">{{ $totalCount }}点</p>
            </div>
            <div class="shrink-0">
                <a href="{{ route('cosmetics.index') }}" class="underline text-sm" style="color: var(--color-subtle)">一覧を見る</a>
            </div>
        </div>
    </div>

    <!-- カテゴリ分布（総アイテム数の下） -->
    <div class="card p-4 md:p-5">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold" style="color: var(--color-text)">カテゴリ分布</h3>
                <svg class="w-6 h-6" style="color: var(--color-subtle)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <div class="mt-4">
                @if($categoryCounts->count() > 0)
                    <div class="flex flex-col md:flex-row md:items-start gap-4">
                        <div class="w-full md:w-1/2 flex justify-center md:justify-start">
                            <div class="w-full max-w-[260px] md:max-w-[300px] aspect-square">
                                <canvas id="catChart"></canvas>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="space-y-1.5 max-h-48 overflow-y-auto pr-2">
                                @foreach($categoryCounts as $categoryId => $data)
                                    <div class="flex justify-between items-center py-1 border-b" style="border-color: var(--color-line)">
                                        <span class="text-xs sm:text-sm" style="color: color-mix(in oklab, var(--color-text) 80%, transparent)">{{ $data['name'] }}</span>
                                        <span class="text-xs sm:text-sm font-medium" style="color: var(--color-text)">{{ $data['count'] }}点</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-sm" style="color: color-mix(in oklab, var(--color-text) 70%, transparent)">まだアイテムが登録されていません</p>
                @endif
            </div>
    </div>

    <!-- 残りのカードは2カラム -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- 期限間近アイテムカード -->
        <div class="card p-6">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold" style="color: var(--color-text)">期限間近のアイテム</h3>
                <svg class="w-6 h-6" style="color: var(--color-subtle)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="mt-4 space-y-3">
                @forelse($expiringItems as $item)
                    <div class="flex justify-between items-center p-3 rounded-xl border" style="background: color-mix(in oklab, var(--color-secondary) 35%, transparent); border-color: var(--color-line)">
                        <div>
                            <p class="text-sm font-medium" style="color: var(--color-text)">
                                @if($item->emoji)
                                    {{ $item->emoji }}
                                @endif
                                {{ $item->name }}
                            </p>
                            @if($item->brand)
                                <p class="text-xs" style="color: color-mix(in oklab, var(--color-text) 70%, transparent)">{{ $item->brand }}</p>
                            @endif
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold" style="color: var(--color-subtle)">あと{{ $item->days_until_expiry }}日</p>
                            <a href="{{ route('cosmetics.show', $item) }}" class="text-xs underline" style="color: var(--color-subtle)">詳細 →</a>
                        </div>
                    </div>
                @empty
                    <p class="text-sm" style="color: color-mix(in oklab, var(--color-text) 70%, transparent)">期限間近のアイテムはありません</p>
                @endforelse
            </div>
        </div>

        <!-- アイテム追加CTAカード -->
        <div class="card p-6 text-center" style="background: var(--color-subtle); color: var(--color-surface)">
            <svg class="w-12 h-12 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <h3 class="text-lg font-semibold mb-2">新しいアイテムを追加</h3>
            <p class="opacity-90 text-sm mb-4">お気に入りのコスメアイテムを登録しましょう</p>
            <x-ui.button as="a" href="{{ route('cosmetics.create') }}" variant="secondary">アイテムを追加する</x-ui.button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const cat = @json($categoryCounts->values());
  const ctx = document.getElementById('catChart')?.getContext('2d');
  if (ctx) {
    const palette = ['#CDA987', '#E6D6C6', '#F1E5D8', '#D1B398', '#B89274', '#8B6B56', '#F5EDE4', '#EADCCF'];
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: cat.map(c => c.name),
        datasets: [{
          data: cat.map(c => c.count),
          backgroundColor: cat.map((_, i) => palette[i % palette.length]),
          borderColor: '#ffffff',
          borderWidth: 2,
        }]
      },
      options: {
        plugins: {
          legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 10 } } }
        },
        responsive: true,
        maintainAspectRatio: false,
        cutout: '60%',
      }
    });
  }
</script>
@endpush
