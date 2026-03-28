# React Starter Kit (Laravel + Inertia + React)

このスターターキットは **Laravel 13** バックエンドと **React 19** フロントエンドを **Inertia.js** でつなぐ、本番運用に対応したフルスタックアプリケーションのひな形です。

## 特徴

| カテゴリ | 詳細 |
|---|---|
| **バックエンド** | Laravel 13 / PHP 8.3 |
| **フロントエンド** | React 19 / TypeScript 5.7 |
| **ブリッジ** | Inertia.js 3.0 (SPA ライクな UX を SSR なしで実現) |
| **スタイリング** | Tailwind CSS 4.0 / shadcn/ui / Radix UI |
| **認証** | Laravel Fortify (登録・ログイン・パスワードリセット・メール認証・2FA) |
| **テスト** | PHPUnit 12 (フィーチャー + ユニット) |

## コンセプト

- **サーバー側ルーティング** — Laravel のルーターとコントローラーをそのまま活用
- **クライアント側 React** — ページ遷移を JavaScript で行い、SPA 的な UX を提供
- **Inertia.js ブリッジ** — フル API 層なしで両者を結合
- **機能フラグ** — 登録・2FA・外観設定などをランタイムで ON/OFF 可能

## ドキュメント構成

```
docs/
├── index.md                    # このページ
├── getting-started.md          # セットアップ & 開発手順
├── architecture.md             # アーキテクチャ全体像
├── frontend/
│   ├── overview.md             # フロントエンド概要
│   ├── pages.md                # ページコンポーネント一覧
│   ├── layouts.md              # レイアウト一覧
│   ├── components.md           # 共通コンポーネント一覧
│   └── hooks.md                # カスタムフック一覧
├── backend/
│   ├── overview.md             # バックエンド概要
│   ├── routing.md              # ルーティング
│   ├── authentication.md       # 認証システム
│   ├── models.md               # モデル & マイグレーション
│   └── feature-flags.md        # 機能フラグ
└── testing.md                  # テスト
```

## クイックスタート

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```

詳細は [Getting Started](./getting-started.md) を参照してください。
