@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto space-y-6">
  <h2 class="text-3xl font-bold text-center" style="color: var(--color-text)">コスメ登録</h2>

  @if(session('success'))
  <div class="p-4 card" style="color: var(--color-text)">
    {{ session('success') }}
  </div>
  @endif

  <form action="{{ route('cosmetics.store') }}" method="POST" class="card p-6 space-y-5">
    @csrf


    {{-- 絵文字 --}}
    @php
    $emojiOptions = [
    '🦄','💅','🎠','🎨','🧸','🖌️','🎂','🍬',
    '🍊','🍒','🍎','🍓','🌻','🌷','🌹','🎁',
    '💄','🌸','🎀','✨'
    ];
    @endphp

    <div>
      <label for="emoji" class="form-label">イメージ</label>
      <select name="emoji" id="emoji" class="form-input">
        <option value="">選択してください</option>
        @foreach ($emojiOptions as $emoji)
        <option value="{{ $emoji }}">{{ $emoji }}</option>
        @endforeach
      </select>
      @error('emoji')
      <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
      @enderror
    </div>

    {{-- 商品名 --}}
    <x-ui.input label="商品名" name="name" required />

    {{-- ブランド --}}
    <x-ui.input label="ブランド" name="brand" />

    {{-- カテゴリ --}}
    <div>
      <label class="form-label">カテゴリ</label>
      <select name="category_id" class="form-input">
        <option value="">選択してください</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
      @error('category_id')
      <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
      @enderror
    </div>

    {{-- 使用期限 --}}
    <x-ui.input label="使用期限" name="expiration_date" type="date" />



    {{-- 送信ボタン --}}
    <x-ui.button variant="primary" type="submit" class="w-full">登録する</x-ui.button>
  </form>
</div>
@endsection
