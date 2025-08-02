# コスメ管理アプリ（MVP）


## 概要
化粧品の在庫管理と使用期限チェックができるWebアプリケーションです。
このプロジェクトはMVP開発を目的に作成しました。今後ポートフォリオとしてブラッシュアップしていく予定です。


## 主な機能

- ✨ **コスメ登録・管理**: 商品名、ブランド、カテゴリ、使用期限を記録
- 🎨 **絵文字アイコン**: 各コスメに絵文字を設定して視覚的に管理
- ⏰ **期限切れアラート**: 使用期限が過ぎたアイテムを赤色でハイライト表示
- 📝 **カテゴリ分類**: コスメをカテゴリごとに整理

## 技術スタック

### バックエンド
- **Laravel 12**
- **PHP 8.2+**
- **PostgreSQL**

### フロントエンド
- **Blade テンプレート**
- **Tailwind CSS 4**
- **Vite**

### 開発環境
- **Docker**
- **Laravel Sail**
- **Composer**
- **npm**

## セットアップ

### 必要な環境
- Docker Desktop
- PHP 8.2+ (ローカル開発の場合)
- Composer
- Node.js & npm

### インストール手順

1. **リポジトリのクローン**
```bash
git clone [repository-url]
cd mvp-app
```

2. **依存関係のインストール**
```bash
composer install
npm install
```

3. **環境設定**
```bash
cp .env.example .env
php artisan key:generate
```

4. **データベースの初期化**
```bash
php artisan migrate
php artisan db:seed
```

5. **開発サーバーの起動**
```bash
composer run dev
```

または個別に実行:
```bash
php artisan serve
npm run dev
```

## 使用方法

1. ブラウザで `http://localhost:8000` にアクセス
2. 「新しいコスメを追加」から商品情報を登録
3. 絵文字を選択して視覚的にアイテムを識別
4. 一覧画面で使用期限をチェック

## プロジェクト構造

```
├── app/                    # アプリケーションロジック
│   ├── Http/Controllers/   # コントローラー
│   └── Models/            # Eloquentモデル
├── database/              # マイグレーション・シーダー
├── resources/             # ビュー・アセット
│   ├── views/            # Bladeテンプレート
│   └── css/              # スタイルシート
├── routes/                # ルート定義
└── public/                # 静的ファイル
```

## 今後の機能拡張予定

- [ ] ユーザー認証・アカウント管理
- [ ] コスメの写真アップロード機能
- [ ] 使用頻度の記録・分析
- [ ] 期限切れ通知機能
- [ ] お気に入り・評価システム
- [ ] データのエクスポート機能
- [ ] モバイルサイズへの対応
