# Frontend Overview

## エントリーポイント

`resources/js/app.tsx` が Inertia.js のエントリーポイントです。ページ名に応じてレイアウトを自動割り当てます。

```typescript
// レイアウト自動割り当てロジック
layout: (name) => {
    if (name === 'welcome')            return null;           // レイアウトなし
    if (name.startsWith('auth/'))      return AuthLayout;     // 認証用レイアウト
    if (name.startsWith('settings/'))  return [AppLayout, SettingsLayout]; // ネストレイアウト
    return AppLayout;                                         // デフォルト
}
```

---

## ディレクトリ構成

```
resources/js/
├── app.tsx                 # Inertia エントリーポイント・レイアウト割り当て
├── pages/                  # ページコンポーネント (Inertia がルーティング)
│   ├── welcome.tsx
│   ├── dashboard.tsx
│   ├── auth/               # 認証ページ
│   └── settings/           # 設定ページ
├── layouts/                # レイアウトラッパー
│   ├── app-layout.tsx
│   ├── auth-layout.tsx
│   ├── app/                # アプリレイアウト変種
│   ├── auth/               # 認証レイアウト変種
│   └── settings/           # 設定レイアウト
├── components/             # 再利用可能コンポーネント
│   └── ui/                 # shadcn/ui ベースの基本 UI
├── hooks/                  # カスタム React フック
├── types/                  # TypeScript 型定義
└── lib/utils.ts            # ユーティリティ (cn() など)
```

---

## 共有データ型 (SharedData)

バックエンドから全ページに渡される共有 props の型定義です。

```typescript
// resources/js/types/index.ts
type SharedData = {
    name: string;           // アプリ名
    features: Features;     // 機能フラグ
    auth: Auth;             // 認証情報
    sidebarOpen: boolean;   // サイドバー状態 (Cookie 由来)
    flash: FlashMessages;   // フラッシュメッセージ
    lang: Record<string, string>; // 翻訳文字列
}

type Auth = {
    user: User | null;
}

type User = {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    two_factor_enabled?: boolean;
    created_at: string;
    updated_at: string;
}
```

---

## スタイリング

| 技術 | 用途 |
|---|---|
| Tailwind CSS 4.0 | ユーティリティクラス |
| shadcn/ui | 高品質なコンポーネント |
| Radix UI | アクセシブルな UI プリミティブ |
| `cn()` ユーティリティ | `clsx` + `tailwind-merge` の合成 |

### ダークモード

`use-appearance` フック経由でテーマを管理します。`light` / `dark` / `system` の 3 モードに対応しています。HTML の `class` 属性を直接操作し、CSS 変数で切り替えます。

---

## i18n (国際化)

`lang/{locale}/frontend.json` の翻訳ファイルが `HandleInertiaRequests` ミドルウェア経由で共有 props に含まれます。フロントエンドでは `useLang()` フックを使って参照します。

```typescript
const { t } = useLang();
// t('auth.login') → "ログイン"
```

---

## Wayfinder (ルートヘルパー)

`laravel/wayfinder` パッケージが Vite ビルド時に Laravel ルートから TypeScript のルートヘルパーを自動生成します。

```typescript
import { route } from '@/lib/route';
// 型安全なルート生成
const url = route('profile.update');
```

詳細は各サブページを参照してください。

- [ページ一覧](./pages.md)
- [レイアウト一覧](./layouts.md)
- [コンポーネント一覧](./components.md)
- [カスタムフック](./hooks.md)
