# Pages

`resources/js/pages/` 以下のコンポーネントが Inertia.js によってルーティングされるページです。  
コントローラーの `Inertia::render('ページ名', $props)` に対応します。

---

## 公開ページ

### `welcome.tsx`

- **ルート**: `GET /`
- **レイアウト**: なし (スタンドアロン)
- **内容**: 公開ランディングページ。ログイン・登録へのリンクを表示。認証済みの場合はダッシュボードリンク。

---

## 認証済みページ

### `dashboard.tsx`

- **ルート**: `GET /dashboard`
- **ミドルウェア**: `auth`, `verified`
- **レイアウト**: `AppLayout`
- **内容**: 認証済みユーザーのダッシュボード。プレースホルダーグリッドを表示。

---

## 認証ページ (`auth/`)

認証ページはすべて `AuthLayout` を使用します。

| ファイル | ルート | 説明 |
|---|---|---|
| `auth/login.tsx` | `GET /login` | メール・パスワードでのログインフォーム |
| `auth/register.tsx` | `GET /register` | 名前・メール・パスワードの登録フォーム |
| `auth/forgot-password.tsx` | `GET /forgot-password` | パスワードリセットリクエストフォーム |
| `auth/reset-password.tsx` | `GET /reset-password` | パスワードリセット完了フォーム |
| `auth/verify-email.tsx` | `GET /email/verify` | メール認証待ち画面 |
| `auth/confirm-password.tsx` | `GET /confirm-password` | センシティブ操作前のパスワード確認 |
| `auth/two-factor-challenge.tsx` | `GET /two-factor-challenge` | 2FA OTP 入力画面 |

---

## 設定ページ (`settings/`)

設定ページはすべて `AppLayout` + `SettingsLayout` のネストレイアウトを使用します。

### `settings/profile.tsx`

- **ルート**: `GET /settings/profile`
- **ミドルウェア**: `auth`
- **内容**:
  - 名前・メールアドレスの編集フォーム
  - メール認証状態の表示
  - アカウント削除 (`DeleteUser` コンポーネント、フラグ制御)

### `settings/security.tsx`

- **ルート**: `GET /settings/security`
- **ミドルウェア**: `auth`, `password.confirm`
- **内容**:
  - パスワード変更フォーム
  - 2FA の有効化・無効化 (`TwoFactorSetupModal`)
  - リカバリーコードの表示 (`TwoFactorRecoveryCodes`)

### `settings/appearance.tsx`

- **ルート**: `GET /settings/appearance`
- **ミドルウェア**: `auth`
- **フラグ**: `appearance.enabled`
- **内容**: ライト・ダーク・システムのテーマ切り替え (`AppearanceTabs`)

---

## Props の受け取り方

各ページは Inertia の `usePage()` フックまたはコンポーネント props として Laravel から渡されたデータを受け取ります。

```typescript
// 例: settings/profile.tsx
interface Props {
    mustVerifyEmail: boolean;
    status?: string;
}

export default function ProfilePage({ mustVerifyEmail, status }: Props) {
    const { auth } = usePage<SharedData>().props;
    // ...
}
```
