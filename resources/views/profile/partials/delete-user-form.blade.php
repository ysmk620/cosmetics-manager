<section class="space-y-4">
    <header>
        <h2 class="text-lg font-semibold" style="color: var(--color-text)">アカウント削除</h2>
        <p class="mt-1 text-sm" style="color: color-mix(in oklab, var(--color-text) 75%, transparent)">この操作は取り消せません。データを事前にバックアップしてください。</p>
    </header>

    <x-ui.button variant="secondary"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >アカウントを削除</x-ui.button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 space-y-4">
            @csrf
            @method('delete')

            <h2 class="text-base font-semibold" style="color: var(--color-text)">本当に削除しますか？</h2>
            <p class="text-sm" style="color: color-mix(in oklab, var(--color-text) 75%, transparent)">確認のため、パスワードを入力してください。</p>

            <x-ui.input name="password" type="password" :label="__('パスワード')" />

            @if ($errors->userDeletion->has('password'))
                <p class="text-sm text-red-600">{{ $errors->userDeletion->first('password') }}</p>
            @endif

            <div class="flex justify-end gap-3">
                <button type="button" class="btn btn-ghost" x-on:click="$dispatch('close')">キャンセル</button>
                <x-ui.button class="ms-3" variant="primary">削除する</x-ui.button>
            </div>
        </form>
    </x-modal>
</section>
