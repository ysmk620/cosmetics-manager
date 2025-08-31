@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto space-y-6">
  <h2 class="text-3xl font-bold text-center" style="color: var(--color-text)">アイテム編集</h2>

  @if(session('success'))
  <div class="p-4 card" style="color: var(--color-text)">
    {{ session('success') }}
  </div>
  @endif

  <form action="{{ route('cosmetics.update', $cosmetic) }}" method="POST"
    class="card p-6 space-y-5" style="color: var(--color-text)">
    @csrf
    @method('patch')


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
        <option value="{{ $emoji }}" {{ (old('emoji', $cosmetic->emoji) == $emoji) ? 'selected' : '' }}>{{ $emoji }}</option>
        @endforeach
      </select>
      @error('emoji')
      <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
      @enderror
    </div>

    {{-- アイテム（商品名） --}}
    <div>
      <label class="form-label">アイテム名</label>
      <input type="text" name="name" required value="{{ old('name', $cosmetic->name) }}" class="form-input">
      @error('name')
      <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
      @enderror
    </div>

    {{-- カラー・品番（統合） --}}
    <div>
      <label class="form-label">カラー・品番</label>
      <input type="text" name="color_product_code" value="{{ old('color_product_code', $cosmetic->color_product_code ?: (trim(collect([$cosmetic->color, $cosmetic->product_code])->filter()->implode(' / ')) ?: '')) }}" class="form-input" maxlength="50" placeholder="例: ピンクベージュ / #02">
      @error('color_product_code')
      <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
      @enderror
    </div>

    {{-- ブランド --}}
    <div>
      <label class="form-label">ブランド</label>
      <input type="text" name="brand" value="{{ old('brand', $cosmetic->brand) }}" class="form-input">
      @error('brand')
      <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
      @enderror
    </div>

    {{-- カテゴリ --}}
    <div>
      <label class="form-label">カテゴリ</label>
      <select name="category_id" class="form-input">
        <option value="">選択してください</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ (old('category_id', $cosmetic->category_id) == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
      </select>
      @error('category_id')
      <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
      @enderror
    </div>

    {{-- 使用期限 --}}
    <div>
      <label class="form-label">使用期限</label>
      <input type="date" name="expiration_date" value="{{ old('expiration_date', $cosmetic->expiration_date) }}" class="form-input">
      @error('expiration_date')
      <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
      @enderror
    </div>

    {{-- メモ --}}
    <div>
      <label class="form-label">メモ</label>
      <textarea name="memo" rows="3" class="form-input" maxlength="120" placeholder="メモ（最大120文字）">{{ old('memo', $cosmetic->memo) }}</textarea>
      @error('memo')
      <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
      @enderror
    </div>



    {{-- 送信ボタン --}}
    <button type="submit"
      class="btn btn-primary w-full px-6 py-3">
      更新する
    </button>
  </form>
</div>
@endsection
