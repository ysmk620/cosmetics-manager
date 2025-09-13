<section>
    <header class="mb-4">
        <h2 class="text-lg font-semibold" style="color: var(--color-text)">パスワードの更新</h2>
        <p class="mt-1 text-sm" style="color: color-mix(in oklab, var(--color-text) 75%, transparent)">安全のため、十分に強力なパスワードを設定してください。</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <x-ui.input label="現在のパスワード" name="current_password" type="password" autocomplete="current-password" />
        <x-ui.input label="新しいパスワード" name="password" type="password" autocomplete="new-password" />
        <x-ui.input label="新しいパスワード（確認）" name="password_confirmation" type="password" autocomplete="new-password" />

        @if ($errors->updatePassword->any())
            <p class="text-sm text-red-600">入力内容をご確認ください。</p>
        @endif

        <div class="flex items-center gap-3">
            <button type="submit" class="btn btn-primary">保存</button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm" style="color: color-mix(in oklab, var(--color-text) 80%, transparent)">保存しました。</p>
            @endif
        </div>
    </form>
</section>
