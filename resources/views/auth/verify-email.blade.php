<x-guest-layout>
  <div class="w-full max-w-md">
    <div class="text-center mb-6">
      <h1 class="text-3xl font-bold" style="color: var(--color-text)">CosMemo</h1>
      <p class="mt-2 text-sm" style="color: color-mix(in oklab, var(--color-text) 70%, transparent)">メールアドレスの確認</p>
    </div>

    <div class="bg-[color:var(--color-surface)]/80 backdrop-blur-md border border-white/30 shadow-xl rounded-2xl p-6 md:p-8">
      <p class="text-sm mb-4" style="color: color-mix(in oklab, var(--color-text) 80%, transparent)">
        ご登録のメールアドレスに確認用リンクを送信しました。メールのリンクをクリックして認証を完了してください。届いていない場合は、再送信できます。
      </p>

      @if (session('status') == 'verification-link-sent')
        <p class="mb-4 text-sm" style="color: color-mix(in oklab, var(--color-text) 80%, transparent)">確認メールを再送しました。</p>
      @endif

      <div class="flex items-center justify-between gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
          @csrf
          <x-ui.button variant="primary" type="submit">確認メールを再送</x-ui.button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="underline text-sm" style="color: color-mix(in oklab, var(--color-text) 70%, transparent)">
            ログアウト
          </button>
        </form>
      </div>
    </div>
  </div>
</x-guest-layout>
