<x-guest-layout>
  <div class="w-full max-w-md mx-auto mt-16 md:mt-24">
    <div class="text-center mb-6">
      <h1 class="text-3xl font-bold" style="color: var(--color-text)">CosMemo</h1>
      <p class="mt-2 text-sm" style="color: color-mix(in oklab, var(--color-text) 70%, transparent)">ログイン</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="bg-[color:var(--color-surface)]/80 backdrop-blur-md border border-white/30 shadow-xl rounded-2xl p-6 md:p-8">
      <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <x-ui.input label="メールアドレス" name="email" type="email" required autofocus autocomplete="username" />
        <x-ui.input label="パスワード" name="password" type="password" required autocomplete="current-password" />

        <div class="flex items-center justify-between">
          <label for="remember_me" class="inline-flex items-center gap-2" style="color: color-mix(in oklab, var(--color-text) 80%, transparent)">
            <input id="remember_me" type="checkbox" name="remember" class="rounded border-[color:var(--color-line)]" />
            <span class="text-sm">ログイン状態を保持</span>
          </label>
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="underline text-sm" style="color: color-mix(in oklab, var(--color-text) 70%, transparent)">パスワードをお忘れですか？</a>
          @endif
        </div>

        <x-ui.button variant="primary" type="submit" class="w-full">ログイン</x-ui.button>

        <p class="text-center text-sm" style="color: color-mix(in oklab, var(--color-text) 70%, transparent)">
          アカウント未作成の方は
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="underline">新規登録</a>
          @endif
        </p>
      </form>
    </div>
  </div>
</x-guest-layout>
