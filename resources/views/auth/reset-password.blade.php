<x-guest-layout>
  <div class="w-full max-w-md mx-auto mt-16 md:mt-24">
    <div class="text-center mb-6">
      <h1 class="text-3xl font-bold" style="color: var(--color-text)">CosMemo</h1>
      <p class="mt-2 text-sm" style="color: color-mix(in oklab, var(--color-text) 70%, transparent)">パスワード再設定</p>
    </div>

    <div class="bg-[color:var(--color-surface)]/80 backdrop-blur-md border border-white/30 shadow-xl rounded-2xl p-6 md:p-8">
      <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-ui.input label="メールアドレス" name="email" type="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
        <x-ui.input label="新しいパスワード" name="password" type="password" required autocomplete="new-password" />
        <x-ui.input label="新しいパスワード（確認）" name="password_confirmation" type="password" required autocomplete="new-password" />

        <x-ui.button variant="primary" type="submit" class="w-full">パスワードを更新</x-ui.button>
      </form>
    </div>
  </div>
</x-guest-layout>
