<x-guest-layout>
  <!-- Hero  -->
  <div class="min-h-[calc(100svh-80px)] md:min-h-[calc(100svh-96px)] flex items-center">
    <section class="container-page text-center py-24 md:py-32">
      <h1 class="text-6xl md:text-7xl font-bold tracking-tight" style="color: var(--color-text)">CosMemo</h1>
      <p class="mt-8 md:mt-8 text-base md:text-lg" style="color: color-mix(in oklab, var(--color-text) 80%, transparent)">
        コスメの情報を一箇所に。<br class="hidden sm:block">楽しく、効率的にコスメの整理整頓。
      </p>
      <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-3 max-w-xl mx-auto">
        @if (Route::has('register'))
        <x-ui.button variant="primary" as="a" href="{{ route('register') }}" class="w-full">新規登録</x-ui.button>
        @endif
        @if (Route::has('login'))
        <x-ui.button variant="ghost" as="a" href="{{ route('login') }}" class="w-full border" style="border-color: color-mix(in oklab, var(--color-text) 55%, transparent)">ログイン</x-ui.button>
        @endif
      </div>
    </section>
  </div>

  <!-- About -->
  <section id="about" class="mt-8 md:mt-8 py-24 md:py-28 bg-[color:var(--bg-app)] border-t" style="border-color: var(--color-line)">
    <div class="container-page">
      <h2 class="text-2xl md:text-3xl font-semibold mb-6 flex justify-center">
        <span class="inline-block rounded-full px-6 py-2 shadow-md text-base md:text-lg" style="background-color: var(--color-subtle); color: var(--color-surface)">アプリ概要</span>
      </h2>
      <p class="mx-auto max-w-[62ch] md:max-w-[68ch] leading-relaxed text-center text-lg md:text-xl" style="color: color-mix(in oklab, var(--color-text) 80%, transparent); text-wrap: balance; text-wrap: pretty;">
        CosMemo は、コスメの情報を記録・可視化できるアプリケーションです。</p>
      <p class="mx-auto max-w-[62ch] md:max-w-[68ch] leading-relaxed text-center text-lg md:text-xl" style="color: color-mix(in oklab, var(--color-text) 80%, transparent); text-wrap: balance; text-wrap: pretty;">
       開封日・使用期限・品番などをひとまとめに管理し、必要な情報にすぐアクセスできます。</p>


      <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        <div class="relative overflow-hidden p-5 md:p-6 rounded-2xl bg-[color:var(--color-surface)] border border-[color:var(--color-line)] shadow-md">
          <div class="absolute top-0 inset-x-0 h-1 bg-[color:var(--color-primary)]"></div>
          <h3 class="text-xl md:text-2xl font-semibold mb-1 flex items-center gap-2" style="color: var(--color-text)">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 7.125L16.875 4.5" />
            </svg>
            <span>コスメ管理</span>
          </h3>
          <p class="text-base md:text-lg" style="color: color-mix(in oklab, var(--color-text) 75%, transparent)">登録・閲覧・編集・削除で手早く整理。</p>
        </div>
        <div class="relative overflow-hidden p-5 md:p-6 rounded-2xl bg-[color:var(--color-surface)] border border-[color:var(--color-line)] shadow-md">
          <div class="absolute top-0 inset-x-0 h-1 bg-[color:var(--color-primary)]"></div>
          <h3 class="text-xl md:text-2xl font-semibold mb-1 flex items-center gap-2" style="color: var(--color-text)">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l3 3" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>期限ハイライト</span>
          </h3>
          <p class="text-base md:text-lg" style="color: color-mix(in oklab, var(--color-text) 75%, transparent)">使用期限が近い/過ぎたアイテムを可視化。</p>
        </div>
        <div class="relative overflow-hidden p-5 md:p-6 rounded-2xl bg-[color:var(--color-surface)] border border-[color:var(--color-line)] shadow-md">
          <div class="absolute top-0 inset-x-0 h-1 bg-[color:var(--color-primary)]"></div>
          <h3 class="text-xl md:text-2xl font-semibold mb-1 flex items-center gap-2" style="color: var(--color-text)">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
            <span>お気に入り</span>
          </h3>
          <p class="text-base md:text-lg" style="color: color-mix(in oklab, var(--color-text) 75%, transparent)">よく使うコスメをブックマーク。</p>
        </div>
        <div class="relative overflow-hidden p-5 md:p-6 rounded-2xl bg-[color:var(--color-surface)] border border-[color:var(--color-line)] shadow-md">
          <div class="absolute top-0 inset-x-0 h-1 bg-[color:var(--color-primary)]"></div>
          <h3 class="text-xl md:text-2xl font-semibold mb-1 flex items-center gap-2" style="color: var(--color-text)">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h18M3 9.75h18M3 15h10.5M3 19.5h6" />
            </svg>
            <span>検索・ダッシュボード</span>
          </h3>
          <p class="text-base md:text-lg" style="color: color-mix(in oklab, var(--color-text) 75%, transparent)">検索・フィルタと統計で素早く把握。</p>
        </div>
      </div>
    </div>
  </section>
</x-guest-layout>
