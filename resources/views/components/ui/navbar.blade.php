<nav class="w-full sticky top-0 z-50 shadow-md" style="background-color: var(--color-subtle); color: var(--color-surface)">
  <div class="container-page py-4 flex items-center justify-between">
    <a href="{{ url('/') }}" class="text-2xl md:text-3xl font-semibold tracking-tight" style="color: var(--color-surface)">CosMemo</a>

    <div x-data="{ open: false }" class="md:hidden">
      <button @click="open = !open" class="btn hover:bg-white/10 transition" aria-label="メニュー切替" style="color: var(--color-surface)">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
      <div x-show="open" @click.outside="open=false" class="absolute right-6 mt-2 min-w-44 rounded-xl border p-2 shadow-lg backdrop-blur-sm" style="background-color: var(--color-subtle); border-color: color-mix(in oklab, var(--color-surface) 20%, transparent)">
        <a href="{{ url('/#about') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition" style="color: var(--color-surface)">アプリ概要</a>
        @if (Route::has('register'))
          <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition" style="color: var(--color-surface)">新規登録</a>
        @endif
        @if (Route::has('login'))
          <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 transition" style="color: var(--color-surface)">ログイン</a>
        @endif
      </div>
    </div>

    <div class="hidden md:flex items-center gap-6">
      <a href="{{ url('/#about') }}" class="opacity-90 hover:opacity-100 px-2 py-1 rounded-md transition hover:bg-white/10" style="color: var(--color-surface)">アプリ概要</a>
      @if (Route::has('register'))
        <a href="{{ route('register') }}" class="opacity-90 hover:opacity-100 px-2 py-1 rounded-md transition hover:bg-white/10" style="color: var(--color-surface)">新規登録</a>
      @endif
      @if (Route::has('login'))
        <a href="{{ route('login') }}" class="opacity-90 hover:opacity-100 px-2 py-1 rounded-md transition hover:bg-white/10" style="color: var(--color-surface)">ログイン</a>
      @endif
    </div>
  </div>
</nav>
