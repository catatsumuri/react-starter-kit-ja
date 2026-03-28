# Layouts

`resources/js/layouts/` 以下のレイアウトコンポーネントです。  
`app.tsx` のレイアウト割り当てロジックにより、ページ名に応じて自動的に適用されます。

---

## アプリレイアウト

### `app-layout.tsx`

認証済みページの標準レイアウト。内部で `AppSidebarLayout` を使います。

```
AppLayout
  └─ AppSidebarLayout
       ├─ AppShell (SidebarProvider + Toaster)
       │    ├─ AppSidebar (ナビゲーション)
       │    └─ SidebarInset
       │         ├─ AppHeader (パンくず + ユーザーメニュー)
       │         └─ AppContent (メインコンテンツ)
       └─ {children}
```

**子レイアウト:**

| ファイル | 説明 |
|---|---|
| `app/app-sidebar-layout.tsx` | サイドバー + ヘッダー + コンテンツの 3 カラム構成 |
| `app/app-header-layout.tsx` | ヘッダーのみ (サイドバーなし) の構成 |

---

## 認証レイアウト

### `auth-layout.tsx`

認証ページ用のレイアウト。デフォルトは `AuthSimpleLayout` を使います。

**子レイアウト:**

| ファイル | 説明 |
|---|---|
| `auth/auth-simple-layout.tsx` | 中央寄せのシンプルなレイアウト |
| `auth/auth-card-layout.tsx` | カードコンテナ付きレイアウト |
| `auth/auth-split-layout.tsx` | 左右分割レイアウト (画像 + フォーム) |

---

## 設定レイアウト

### `settings/layout.tsx`

設定ページ用のネストレイアウト。`AppLayout` の中に組み込まれます。

```
AppLayout
  └─ SettingsLayout
       ├─ 設定ナビゲーション (プロフィール / セキュリティ / 外観)
       └─ {children} (各設定ページ)
```

設定タブのナビゲーション項目:

| タブ | ルート | 機能フラグ |
|---|---|---|
| プロフィール | `/settings/profile` | — |
| セキュリティ | `/settings/security` | — |
| 外観 | `/settings/appearance` | `appearance.enabled` |

---

## レイアウトのネスト

```typescript
// app.tsx でのネスト例
if (name.startsWith('settings/')) {
    return [AppLayout, SettingsLayout];
}
```

Inertia.js の persistent layout 機能により、ページ遷移時もレイアウトが再マウントされずに保たれます。
