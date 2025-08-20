<x-guest-layout>
  <div class="w-full max-w-md mx-auto mt-16 md:mt-24">
    <div class="text-center mb-6">
      <h1 class="text-3xl font-bold" style="color: var(--color-text)">CosMemo</h1>
      <p class="mt-2 text-sm" style="color: color-mix(in oklab, var(--color-text) 70%, transparent)">パスワード再設定</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="bg-[color:var(--color-surface)]/80 backdrop-blur-md border border-white/30 shadow-xl rounded-2xl p-6 md:p-8">
      <p class="text-sm mb-4" style="color: color-mix(in oklab, var(--color-text) 80%, transparent)">
        ご登録のメールアドレスを入力してください。パスワード再設定用のリンクをお送りします。
      </p>

      <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <x-ui.input label="メールアドレス" name="email" type="email" required autofocus />

        <x-ui.button variant="primary" type="submit" class="w-full">再設定リンクを送信</x-ui.button>

        <p class="text-center text-sm" style="color: color-mix(in oklab, var(--color-text) 70%, transparent)">
          <a href="{{ route('login') }}" class="underline">ログイン画面に戻る</a>
        </p>
      </form>
    </div>
  </div>
</x-guest-layout>
