@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto space-y-6">
  <h2 class="text-3xl font-bold text-center" style="color: var(--color-text)">アイテム登録</h2>

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

    {{-- アイテム（商品名） --}}
    <x-ui.input label="アイテム名" name="name" required />

    {{-- カラー・品番（統合） --}}
    <x-ui.input label="カラー・品番" name="color_product_code" value="{{ old('color_product_code') }}" maxlength="50" placeholder="例: ピンクベージュ / #02" />

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
    <x-ui.input label="使用期限" name="expiration_date" type="date" hint="目安・・・未開封：３年 / 開封後：６ヶ月～１年" />

    {{-- メモ --}}
    <div>
      <label class="form-label">メモ</label>
      <textarea name="memo" rows="3" class="form-input" maxlength="120" placeholder="メモ（最大120文字）">{{ old('memo') }}</textarea>
      @error('memo')
      <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
      @enderror
    </div>



    {{-- 送信ボタン --}}
    <x-ui.button variant="primary" type="submit" class="w-full">登録する</x-ui.button>
  </form>
</div>
@endsection
