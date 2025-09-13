<x-guest-layout>
  <div class="w-full max-w-md mx-auto mt-16 md:mt-24">
    <div class="text-center mb-6">
      <h1 class="text-3xl font-bold" style="color: var(--color-text)">CosMemo</h1>
      <p class="mt-2 text-sm" style="color: color-mix(in oklab, var(--color-text) 70%, transparent)">パスワード確認</p>
    </div>

    <div class="bg-[color:var(--color-surface)]/80 backdrop-blur-md border border-white/30 shadow-xl rounded-2xl p-6 md:p-8">
      <p class="text-sm mb-4" style="color: color-mix(in oklab, var(--color-text) 80%, transparent)">続行するにはパスワードの確認が必要です。</p>

      <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <x-ui.input label="パスワード" name="password" type="password" required autocomplete="current-password" />

        <button type="submit" class="btn btn-primary w-full">確認する</button>
      </form>
    </div>
  </div>
</x-guest-layout>
