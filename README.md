# アプリ名（未定）

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-Database-336791?style=flat-square&logo=postgresql)
![TailwindCSS](https://img.shields.io/badge/Tailwind-CSS-38B2AC?style=flat-square&logo=tailwind-css)

[URL(デプロイ後)](#)

## 目次

- [サービス概要](#サービス概要)
- [スクリーンショット](#スクリーンショット)
- [主要機能](#主要機能)
- [使用技術](#使用技術)
- [データベース設計](#データベース設計)
---

## サービス概要

**「コスメの整理整頓を楽しく、効率的に」**

ユーザーが所持するコスメの情報（カテゴリ・ブランド・使用期限など）を記録・可視化できる Web アプリです。

**解決する課題:**

-   **「いつ開封したのか忘れた」** → 古いコスメを使い続けてしまう
-   **「こんな色持ってたかも」** → 似たような色のコスメを買ってしまう
-   **「いつも使ってる品番はなんだっけ」** → リピートして購入したいときに困る

このようなことを防ぎ、整理整頓をサポートします。

**MVP 版からの進化**: [初期 MVP](https://github.com/ysmk620/mvp-app)で検証した基本機能をベースに、ユーザビリティとデザインを向上させたポートフォリオ版です。

## スクリーンショット

### メイン画面(ダッシュボード)

_実装完了後に追加予定_

### コスメ登録画面

![コスメ登録画面](screenshots/register.png)

### コスメ一覧画面

![コスメ一覧画面](screenshots/list.png)


## 主要機能
-   **コスメCRUD**: 登録・閲覧・編集・削除の完全な管理機能
-   **期限切れハイライト**: 使用期限が近い・過ぎたアイテムの視覚的警告
-   **お気に入り機能**: よく使うコスメのブックマーク・専用表示
-   **ダッシュボード**: 統計情報・期限アラート・使用状況の一覧表示
-   **検索・フィルタ**: 商品名・ブランド・カテゴリによる効率的な絞り込み
-   **ユーザー認証**: 個人データ保護とマルチユーザー対応

## 使用技術

### バックエンド

-   **Laravel 12**
-   **PHP 8.2+**
-   **PostgreSQL**

### フロントエンド

-   **Blade + Vite**
-   **Tailwind CSS 4**

### 開発環境

-   **Docker + Laravel Sail**
-   **Composer**
-   **npm**

## データベース設計

### ER図

![データベースER図](screenshots/er-diagram.png)


