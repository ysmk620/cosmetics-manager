<nav class="w-full sticky top-0 z-50 shadow-md" style="background-color: var(--color-subtle); color: var(--color-surface)">
  <div class="container-page py-4 flex items-center justify-between">
    <a href="{{ auth()->check() ? route('cosmetics.index') : url('/') }}" class="flex items-center gap-2 text-2xl md:text-3xl font-semibold tracking-tight" style="color: var(--color-surface)">
      <img src="{{ asset('rougeicon-white.svg') }}?v={{ filemtime(public_path('rougeicon-white.svg')) }}" alt="CosMemo icon" class="h-7 w-7 md:h-8 md:w-8" />
      <span>CosMemo</span>
    </a>

    @auth
      <!-- Authenticated: desktop links -->
      <div class="hidden md:flex items-center gap-4">
        <a href="{{ route('dashboard') }}"
           class="px-3 py-2 rounded-md transition hover:bg-white/10 {{ request()->routeIs('dashboard') ? 'bg-white/20 opacity-100' : 'opacity-90 hover:opacity-100' }}"
           style="color: var(--color-surface)" @if(request()->routeIs('dashboard')) aria-current="page" @endif>ダッシュボード</a>
        @php
          $isCosmeticsList = request()->routeIs('cosmetics.index') || request()->routeIs('cosmetics.show') || request()->routeIs('cosmetics.edit');
        @endphp
        <a href="{{ route('cosmetics.index') }}"
           class="px-3 py-2 rounded-md transition hover:bg-white/10 {{ $isCosmeticsList ? 'bg-white/20 opacity-100' : 'opacity-90 hover:opacity-100' }}"
           style="color: var(--color-surface)" @if($isCosmeticsList) aria-current="page" @endif>一覧</a>
        <a href="{{ route('cosmetics.create') }}"
           class="px-3 py-2 rounded-md transition hover:bg-white/10 {{ request()->routeIs('cosmetics.create') ? 'bg-white/20 opacity-100' : 'opacity-90 hover:opacity-100' }}"
           style="color: var(--color-surface)" @if(request()->routeIs('cosmetics.create')) aria-current="page" @endif>登録</a>

        <!-- Account dropdown (like Breeze) -->
        <div class="relative" x-data="{ open: false }" @keydown.escape.window="open = false">
          <button @click="open = !open" aria-haspopup="menu" :aria-expanded="open" aria-label="アカウント情報"
                  class="inline-flex items-center px-2 py-2 rounded-md transition hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/40"
                  style="color: var(--color-surface)">
            <span class="sr-only">アカウント情報</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25a8.25 8.25 0 1115 0v.75H4.5v-.75z" />
            </svg>
          </button>

          <div x-cloak x-show="open" x-transition @click.outside="open=false"
               class="absolute right-0 top-full mt-2 min-w-44 rounded-2xl border p-2 shadow-lg backdrop-blur-md z-50"
               style="background-color: color-mix(in oklab, var(--color-surface) 95%, transparent); border-color: color-mix(in oklab, var(--color-surface) 40%, transparent)">
            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md hover:bg-black/5 transition" style="color: var(--color-text)">アカウント</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full text-left block px-3 py-2 rounded-md hover:bg-black/5 transition" style="color: var(--color-text)">ログアウト</button>
            </form>
          </div>
        </div>
      </div>
      <!-- Authenticated: mobile menu -->
      <div x-data="{ open: false }" class="md:hidden relative">
        <button @click="open = !open" class="btn hover:bg-white/10 transition" aria-label="メニュー切替" style="color: var(--color-surface)">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
        <div x-cloak x-show="open" @click.outside="open=false" class="absolute right-4 top-full mt-2 min-w-48 rounded-2xl border p-4 shadow-xl backdrop-blur-md" style="background-color: color-mix(in oklab, var(--color-surface) 95%, transparent); border-color: color-mix(in oklab, var(--color-surface) 40%, transparent)">
          <a href="{{ route('dashboard') }}"
             class="block px-3 py-2 rounded-md transition hover:bg-black/5 {{ request()->routeIs('dashboard') ? 'bg-black/10 font-medium' : '' }}"
             style="color: var(--color-text)" @if(request()->routeIs('dashboard')) aria-current="page" @endif>ホーム</a>
          @php
            $isCosmeticsListMobile = request()->routeIs('cosmetics.index') || request()->routeIs('cosmetics.show') || request()->routeIs('cosmetics.edit');
          @endphp
          <a href="{{ route('cosmetics.index') }}"
             class="block px-3 py-2 rounded-md transition hover:bg-black/5 {{ $isCosmeticsListMobile ? 'bg-black/10 font-medium' : '' }}"
             style="color: var(--color-text)" @if($isCosmeticsListMobile) aria-current="page" @endif>一覧</a>
          <a href="{{ route('cosmetics.create') }}"
             class="block px-3 py-2 rounded-md transition hover:bg-black/5 {{ request()->routeIs('cosmetics.create') ? 'bg-black/10 font-medium' : '' }}"
             style="color: var(--color-text)" @if(request()->routeIs('cosmetics.create')) aria-current="page" @endif>登録</a>
          <a href="{{ route('profile.edit') }}"
             class="block px-3 py-2 rounded-md transition hover:bg-black/5 {{ request()->routeIs('profile.edit') ? 'bg-black/10 font-medium' : '' }}"
             style="color: var(--color-text)" @if(request()->routeIs('profile.edit')) aria-current="page" @endif>アカウント</a>
          <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full text-left block px-3 py-2 rounded-md hover:bg-black/5 transition" style="color: var(--color-text)">ログアウト</button>
          </form>
        </div>
      </div>
    @endauth

    @guest
      <div x-data="{ open: false }" class="md:hidden">
        <button @click="open = !open" class="btn hover:bg-white/10 transition" aria-label="メニュー切替" style="color: var(--color-surface)">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
        <div x-cloak x-show="open" @click.outside="open=false" class="absolute right-6 mt-2 min-w-44 rounded-xl border p-2 shadow-lg backdrop-blur-sm" style="background-color: var(--color-subtle); border-color: color-mix(in oklab, var(--color-surface) 20%, transparent)">
          <a href="{{ url('/#about') }}" class="block px-3 py-2 rounded-md transition hover:bg-white/10 {{ request()->is('/') ? 'bg-white/20 font-medium' : '' }}" style="color: var(--color-surface)" @if(request()->is('/')) aria-current="page" @endif>アプリ概要</a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md transition hover:bg-white/10 {{ request()->routeIs('register') ? 'bg-white/20 font-medium' : '' }}" style="color: var(--color-surface)" @if(request()->routeIs('register')) aria-current="page" @endif>新規登録</a>
          @endif
          @if (Route::has('login'))
            <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md transition hover:bg-white/10 {{ request()->routeIs('login') ? 'bg-white/20 font-medium' : '' }}" style="color: var(--color-surface)" @if(request()->routeIs('login')) aria-current="page" @endif>ログイン</a>
          @endif
        </div>
      </div>

      <div class="hidden md:flex items-center gap-6">
        <a href="{{ url('/#about') }}" class="px-2 py-1 rounded-md transition hover:bg-white/10 {{ request()->is('/') ? 'bg-white/20 opacity-100' : 'opacity-90 hover:opacity-100' }}" style="color: var(--color-surface)" @if(request()->is('/')) aria-current="page" @endif>アプリ概要</a>
        @if (Route::has('register'))
          <a href="{{ route('register') }}" class="px-2 py-1 rounded-md transition hover:bg-white/10 {{ request()->routeIs('register') ? 'bg-white/20 opacity-100' : 'opacity-90 hover:opacity-100' }}" style="color: var(--color-surface)" @if(request()->routeIs('register')) aria-current="page" @endif>新規登録</a>
        @endif
        @if (Route::has('login'))
          <a href="{{ route('login') }}" class="px-2 py-1 rounded-md transition hover:bg-white/10 {{ request()->routeIs('login') ? 'bg-white/20 opacity-100' : 'opacity-90 hover:opacity-100' }}" style="color: var(--color-surface)" @if(request()->routeIs('login')) aria-current="page" @endif>ログイン</a>
        @endif
      </div>
    @endguest
  </div>
</nav>
