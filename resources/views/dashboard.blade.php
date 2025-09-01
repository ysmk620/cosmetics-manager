@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <h1 class="text-3xl font-bold" style="color: var(--color-text)">ダッシュボード</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- 総アイテム数 -->
        <a href="{{ route('cosmetics.index') }}" class="card p-3 text-center block transition transform hover:shadow-2xl hover:-translate-y-0.5 hover:brightness-110 active:translate-y-0 focus:outline-none focus:ring-4 focus:ring-[color:var(--color-primary)]/40">
            <div class="flex flex-col items-center gap-1">
                <svg class="w-8 h-8 md:w-9 md:h-9" viewBox="0 0 24 24" aria-hidden="true" style="color: var(--color-subtle)">
                    <rect x="4.5" y="4.5" width="7" height="7" rx="1.5" fill="currentColor" />
                    <rect x="12.5" y="4.5" width="7" height="7" rx="1.5" fill="currentColor" />
                    <rect x="4.5" y="12.5" width="7" height="7" rx="1.5" fill="currentColor" />
                    <rect x="12.5" y="12.5" width="7" height="7" rx="1.5" fill="currentColor" />
                </svg>
                <p class="text-sm md:text-base font-medium opacity-80" style="color: var(--color-text)">総アイテム数</p>
                <p class="text-4xl md:text-5xl font-extrabold tracking-tight leading-none" style="color: var(--color-text)">{{ $totalCount }}</p>
            </div>
        </a>

        <!-- お気に入り数 -->
        <a href="{{ route('cosmetics.index', ['favorites' => 1]) }}" class="card p-3 text-center block transition transform hover:shadow-2xl hover:-translate-y-0.5 hover:brightness-110 active:translate-y-0 focus:outline-none focus:ring-4 focus:ring-[color:var(--color-primary)]/40">
            <div class="flex flex-col items-center gap-1">
                <svg viewBox="0 0 24 24" class="w-9 h-9 md:w-11 md:h-11" aria-hidden="true" style="color: var(--color-subtle)">
                    <path fill="currentColor" d="M11.645 20.91l-.007-.003C7.63 18.716 4.5 16.27 4.5 12.75A4.5 4.5 0 0 1 12 9a4.5 4.5 0 0 1 7.5 3.75c0 3.52-3.13 5.966-7.138 8.157l-.007.003a.75.75 0 0 1-.71 0z" />
                </svg>
                <p class="text-sm md:text-base font-medium opacity-80" style="color: var(--color-text)">お気に入り</p>
                <p class="text-4xl md:text-5xl font-extrabold tracking-tight leading-none" style="color: var(--color-text)">{{ $favoritesCount }}</p>
            </div>
        </a>

        <!-- 期限切れ数 -->
        <a href="{{ route('cosmetics.index', ['expired' => 1]) }}" class="card p-3 text-center block transition transform hover:shadow-2xl hover:-translate-y-0.5 hover:brightness-110 active:translate-y-0 focus:outline-none focus:ring-4 focus:ring-[color:var(--color-primary)]/40">
            <div class="flex flex-col items-center gap-1">
                <svg viewBox="0 0 24 24" class="w-8 h-8 md:w-9 md:h-9" aria-hidden="true" style="color: var(--color-subtle)">
                    <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.8" />
                    <path d="M12 7v5l3 3" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-sm md:text-base font-medium opacity-80" style="color: var(--color-text)">期限切れ</p>
                <p class="text-4xl md:text-5xl font-extrabold tracking-tight leading-none" style="color: var(--color-text)">{{ $expiredCount }}</p>
            </div>
        </a>
    </div>

    <!-- カテゴリ分布 -->
    <div class="card p-4 md:p-5" x-data="{ open: true }">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold" style="color: var(--color-text)">カテゴリ分布</h3>
            <button @click="open = !open" class="inline-flex items-center justify-center rounded-lg px-2 py-1 hover:bg-black/5 transition"
                    aria-expanded="true" aria-controls="catSection" style="color: var(--color-subtle)">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 9l6 6 6-6"/></svg>
            </button>
        </div>
        <div id="catSection" class="mt-4" x-show="open" x-transition>
            @if($categoryCounts->count() > 0)
                <div class="flex flex-col md:flex-row md:items-start gap-4">
                    <div class="w-full md:w-1/2 flex justify-center md:justify-center">
                        <div class="w-full max-w-[260px] md:max-w-[320px] aspect-square">
                            <canvas id="catChart"></canvas>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <div id="catLegend" class="grid grid-cols-1 sm:grid-cols-2 gap-y-1 gap-x-2 max-h-48 overflow-y-auto pr-1">
                        </div>
                    </div>
                </div>
            @else
                <p class="text-sm" style="color: color-mix(in oklab, var(--color-text) 70%, transparent)">まだアイテムが登録されていません</p>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- 期限間近アイテムカード -->
        <div class="card p-6">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold" style="color: var(--color-text)">期限間近のアイテム</h3>
            </div>
            <div class="mt-4 space-y-3">
                @forelse($expiringItems as $item)
                    <a href="{{ route('cosmetics.show', $item) }}"
                       class="flex justify-between items-center p-3 rounded-xl border transition block cursor-pointer hover:shadow-md hover:-translate-y-0.5 hover:brightness-105 focus:outline-none focus:ring-2 focus:ring-[color:var(--color-primary)]/40"
                       style="background: color-mix(in oklab, var(--color-secondary) 35%, transparent); border-color: var(--color-line)">
                        <div>
                            <p class="text-sm font-medium" style="color: var(--color-text)">
                                @if($item->emoji)
                                    {{ $item->emoji }}
                                @endif
                                {{ $item->name }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold" style="color: var(--color-subtle)">あと{{ $item->days_until_expiry }}日</p>
                        </div>
                    </a>
                @empty
                    <p class="text-sm" style="color: color-mix(in oklab, var(--color-text) 70%, transparent)">期限間近のアイテムはありません</p>
                @endforelse
            </div>
        </div>

        <!-- アイテム追加CTAカード -->
        <a href="{{ route('cosmetics.create') }}" class="card p-6 text-center block transition transform hover:shadow-2xl hover:-translate-y-0.5 hover:brightness-110 active:translate-y-0 focus:outline-none focus:ring-4"
            style="background: var(--color-subtle); color: var(--color-surface)">
            <svg class="w-12 h-12 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <h3 class="text-lg font-semibold mb-2">新しいアイテムを追加</h3>
            <p class="opacity-90 text-sm">お気に入りのコスメアイテムを登録しましょう</p>
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
  // カテゴリ分布: 遅延ロード + 凡例描画
  const cat = @json($categoryCounts->values());
  const palette = ['#CDA987', '#E6D6C6', '#F1E5D8', '#D1B398', '#B89274', '#8B6B56', '#F5EDE4', '#EADCCF'];

  function ensureChartJs() {
    return new Promise((resolve) => {
      if (window.Chart) return resolve(window.Chart);
      const s = document.createElement('script');
      s.src = 'https://cdn.jsdelivr.net/npm/chart.js';
      s.defer = true;
      s.onload = () => resolve(window.Chart);
      document.head.appendChild(s);
    });
  }

  function renderLegend(colors) {
    const legend = document.getElementById('catLegend');
    if (!legend) return;
    legend.innerHTML = '';
    cat.forEach((c, i) => {
      const row = document.createElement('div');
      row.className = 'grid grid-cols-[1fr_auto] items-center gap-x-1.5 py-0.5 border-b';
      row.style.borderColor = 'var(--color-line)';

      const left = document.createElement('div');
      left.className = 'flex items-center gap-2 min-w-0';
      const dot = document.createElement('span');
      dot.className = 'inline-block w-4 h-4 rounded-full flex-shrink-0';
      dot.style.backgroundColor = colors[i % colors.length];
      const label = document.createElement('span');
      label.className = 'text-sm md:text-base truncate';
      label.style.color = 'color-mix(in oklab, var(--color-text) 80%, transparent)';
      label.textContent = c.name;
      left.append(dot, label);

      const right = document.createElement('span');
      right.className = 'text-right text-sm md:text-base font-semibold tabular-nums';
      right.style.color = 'var(--color-text)';
      right.textContent = `${c.count}点`;

      row.append(left, right);
      legend.appendChild(row);
    });
  }

  function initCatChart() {
    const el = document.getElementById('catChart');
    if (!el) return;
    ensureChartJs().then(() => {
      const ctx = el.getContext('2d');
      const colors = cat.map((_, i) => palette[i % palette.length]);
      renderLegend(colors);
      new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: cat.map(c => c.name),
          datasets: [{
            data: cat.map(c => c.count),
            backgroundColor: colors,
            borderColor: '#ffffff',
            borderWidth: 2,
          }]
        },
        options: {
          plugins: { legend: { display: false } },
          responsive: true,
          maintainAspectRatio: false,
          cutout: '60%',
        }
      });
    });
  }

  // 可視時に初期化
  const target = document.getElementById('catSection');
  if (target) {
    const io = new IntersectionObserver((entries, obs) => {
      entries.forEach(e => {
        if (e.isIntersecting) { initCatChart(); obs.disconnect(); }
      });
    }, { rootMargin: '0px 0px -20% 0px' });
    io.observe(target);
  } else {
    // フォールバック
    document.addEventListener('DOMContentLoaded', initCatChart);
  }
</script>
@endpush
