<x-guest-layout>
  <div class="w-full max-w-lg mx-auto mt-16 md:mt-24">
    <div class="text-center mb-6">
      <h1 class="text-3xl font-bold" style="color: var(--color-text)">CosMemo</h1>
      <p class="mt-2 text-sm" style="color: color-mix(in oklab, var(--color-text) 70%, transparent)">新規登録</p>
    </div>

    <div class="bg-[color:var(--color-surface)]/80 backdrop-blur-md border border-white/30 shadow-xl rounded-2xl p-6 md:p-8">
      <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <x-ui.input label="お名前" name="name" type="text" required autofocus autocomplete="name" />
        <x-ui.input label="メールアドレス" name="email" type="email" required autocomplete="username" />
        <x-ui.input label="パスワード" name="password" type="password" required autocomplete="new-password" />
        <x-ui.input label="パスワード（確認）" name="password_confirmation" type="password" required autocomplete="new-password" />

        <x-ui.button variant="primary" type="submit" class="w-full">登録する</x-ui.button>

        <p class="text-center text-sm" style="color: color-mix(in oklab, var(--color-text) 70%, transparent)">
          すでに登録済みの方は
          <a href="{{ route('login') }}" class="underline">ログイン</a>
        </p>
      </form>
    </div>
  </div>
</x-guest-layout>
