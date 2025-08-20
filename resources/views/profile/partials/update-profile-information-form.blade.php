<section>
    <header class="mb-4">
        <h2 class="text-lg font-semibold" style="color: var(--color-text)">プロフィール情報</h2>
        <p class="mt-1 text-sm" style="color: color-mix(in oklab, var(--color-text) 75%, transparent)">アカウント名とメールアドレスを更新できます。</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <x-ui.input label="お名前" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />

        <x-ui.input label="メールアドレス" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm" style="color: color-mix(in oklab, var(--color-text) 80%, transparent)">
                    メールアドレスは未確認です。
                    <button form="send-verification" class="underline">確認メールを再送する</button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm" style="color: color-mix(in oklab, var(--color-text) 80%, transparent)">確認メールを再送しました。</p>
                @endif
            </div>
        @endif

        <div class="flex items-center gap-3">
            <x-ui.button variant="primary" type="submit">保存</x-ui.button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm" style="color: color-mix(in oklab, var(--color-text) 80%, transparent)">保存しました。</p>
            @endif
        </div>
    </form>
</section>
