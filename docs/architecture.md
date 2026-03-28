# Architecture

## 全体構成図

```
┌──────────────────────────────────────────────────────┐
│  ブラウザ                                              │
│                                                      │
│  React 19 + TypeScript                               │
│  (Inertia.js クライアント)                             │
└────────────────────────┬─────────────────────────────┘
                         │ HTTP (Inertia プロトコル)
                         │ (X-Inertia ヘッダー)
┌────────────────────────▼─────────────────────────────┐
│  Laravel 13 (PHP 8.3)                                │
│                                                      │
│  ┌──────────┐  ┌──────────────┐  ┌───────────────┐  │
│  │  Router  │→ │ Middleware   │→ │  Controller   │  │
│  └──────────┘  └──────────────┘  └───────┬───────┘  │
│                                          │           │
│  ┌───────────────────────────────────────▼───────┐  │
│  │  Inertia::render('page-name', $props)         │  │
│  └───────────────────────────────────────────────┘  │
│                                                      │
│  ┌──────────┐  ┌──────────────┐  ┌───────────────┐  │
│  │ Fortify  │  │   Eloquent   │  │  Feature      │  │
│  │  (Auth)  │  │   Models     │  │  Flags        │  │
│  └──────────┘  └──────────────┘  └───────────────┘  │
└──────────────────────────────────────────────────────┘
```

---

## 技術スタック

### フロントエンド

| 技術 | バージョン | 役割 |
|---|---|---|
| React | 19.2 | UI フレームワーク |
| TypeScript | 5.7 | 型安全性 |
| Inertia.js | 3.0 | Laravel ↔ React ブリッジ |
| Vite | 8.0 | バンドラー / 開発サーバー |
| Tailwind CSS | 4.0 | スタイリング |
| shadcn/ui | — | コンポーネントライブラリ |
| Radix UI | — | アクセシブルな UI プリミティブ |
| Lucide React | 0.475 | アイコン |
| Sonner | 2.0 | トースト通知 |

### バックエンド

| 技術 | バージョン | 役割 |
|---|---|---|
| Laravel | 13.0 | PHP フレームワーク |
| PHP | 8.3 | サーバーサイド言語 |
| Laravel Fortify | 1.34 | 認証スキャフォールディング |
| inertia-laravel | 3.0 | Inertia サーバーアダプター |
| laravel/wayfinder | 0.1 | フロントエンド向けルートヘルパー生成 |
| erag/laravel-lang-sync-inertia | 2.1 | i18n (言語ファイル同期) |

---

## リクエストライフサイクル

```
1. ブラウザが URL にアクセス
       ↓
2. Laravel Router がルートを解決
       ↓
3. Middleware チェーン
   - HandleAppearance       (テーマ Cookie)
   - HandleInertiaRequests  (共有 props 注入)
   - auth / verified        (認証ガード)
       ↓
4. Controller が Inertia::render() を返す
       ↓
5. 初回: Blade テンプレート (app.blade.php) + JSON props
   以降: JSON props のみ (X-Inertia ヘッダー)
       ↓
6. React の Inertia クライアントがページコンポーネントを描画
```

---

## ディレクトリ構成

```
react-starter-kit-ja/
├── app/                        # Laravel アプリケーションコード
│   ├── Actions/Fortify/        # 認証アクション (登録・パスワードリセット)
│   ├── Concerns/               # 共通バリデーションルール (トレイト)
│   ├── Http/
│   │   ├── Controllers/        # コントローラー
│   │   │   └── Settings/       # プロフィール・セキュリティ設定
│   │   ├── Middleware/         # ミドルウェア
│   │   ├── Requests/           # フォームリクエスト (バリデーション)
│   │   └── Responses/          # カスタムレスポンスクラス
│   ├── Models/                 # Eloquent モデル
│   └── Providers/              # サービスプロバイダー
│
├── bootstrap/app.php           # アプリケーション起動設定
├── config/                     # 設定ファイル群
├── database/
│   ├── migrations/             # マイグレーション
│   ├── factories/              # テスト用ファクトリー
│   └── seeders/                # シーダー
│
├── lang/                       # 言語ファイル (i18n)
│   └── ja/frontend.json        # フロントエンド向け翻訳
│
├── resources/
│   ├── css/app.css             # Tailwind CSS エントリーポイント
│   ├── js/                     # React / TypeScript ソース
│   │   ├── app.tsx             # Inertia エントリーポイント
│   │   ├── pages/              # ページコンポーネント
│   │   ├── layouts/            # レイアウトコンポーネント
│   │   ├── components/         # 再利用可能コンポーネント
│   │   ├── hooks/              # カスタムフック
│   │   ├── types/              # TypeScript 型定義
│   │   └── lib/utils.ts        # ユーティリティ関数
│   └── views/app.blade.php     # Blade テンプレート (Inertia ルート)
│
├── routes/
│   ├── web.php                 # Web ルート
│   └── settings.php            # 設定系ルート
│
├── tests/
│   ├── Feature/                # フィーチャーテスト
│   └── Unit/                   # ユニットテスト
│
├── vite.config.ts              # Vite 設定
├── tsconfig.json               # TypeScript 設定
├── package.json                # フロントエンド依存関係
└── composer.json               # バックエンド依存関係
```

---

## 設計原則

- **サーバーサイドルーティング** — URL の解決は Laravel が担当し、フロントエンドはルーティングを持たない
- **Inertia アダプター** — REST API を作らず、コントローラーが直接 React コンポーネントに props を渡す
- **機能フラグ** — `config/features.php` で機能の有効/無効を制御。フロントエンドには `SharedData.features` 経由で伝達
- **型安全** — TypeScript の strict モードで型を保証。`SharedData` 型でバックエンドとの契約を明示
- **コンポーネント分離** — `pages/`（ルーティング対象）、`layouts/`（ページ枠組み）、`components/`（再利用部品）の三層構造
