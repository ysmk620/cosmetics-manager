<x-app-layout>
  <div class="space-y-8">
    <h1 class="text-3xl font-bold" style="color: var(--color-text)">アカウント情報</h1>

    <div class="grid gap-6 lg:grid-cols-2">
      <div class="card p-6">
        @include('profile.partials.update-profile-information-form')
      </div>

      <div class="card p-6">
        @include('profile.partials.update-password-form')
      </div>

      <div class="card p-6 lg:col-span-2">
        @include('profile.partials.delete-user-form')
      </div>
    </div>
  </div>
</x-app-layout>
