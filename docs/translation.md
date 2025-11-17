# 翻訳キー一覧

このドキュメントでは、各ファイルで使用されている翻訳キーを管理します。

## 翻訳システムについて

- 翻訳関数: `useLang()` フックから取得する `__()` 関数
- 翻訳ファイル: `lang/ja.json` および `lang/ja/*.json`
- 使用方法: `__('翻訳キー')` で翻訳テキストを取得

## ページファイル別翻訳キー

### 認証関連ページ

#### `/resources/js/pages/auth/login.tsx`

| 翻訳キー | 使用箇所 | 説明 | starter-kits.json |
|---------|---------|------|------------------|
| `Log in to your account` | AuthLayout title | ページタイトル | ✓ 存在 |
| `Enter your email and password below to log in` | AuthLayout description | ページ説明文 | ✓ 存在 |
| `Log in` | Head title, Button | ページタイトル、ログインボタン | ✓ 存在 |
| `Email Address` | Label | メールアドレスラベル | ✓ 存在 |
| `Password` | Label, Input placeholder | パスワードラベル、プレースホルダー | ✓ 存在 |
| `Forgot your password?` | TextLink | パスワード再設定リンク | ✓ 存在 |
| `Remember me` | Label | ログイン状態保持のチェックボックス | ✓ 存在 |
| `Don't have an account?` | Text | アカウント未登録の案内文 | ✓ 存在 |
| `Sign up` | TextLink | 新規登録リンク | ✓ 存在 |

#### `/resources/js/pages/auth/forgot-password.tsx`

| 翻訳キー | 使用箇所 | 説明 | starter-kits.json |
|---------|---------|------|------------------|
| `Forgot password` | AuthLayout title, Head title | ページタイトル | ✓ 存在 |
| `Enter your email to receive a password reset link` | AuthLayout description | ページ説明文 | ✓ 存在 |
| `Email Address` | Label | メールアドレスラベル | ✓ 存在 |
| `Email password reset link` | Button | パスワード再設定リンク送信ボタン | ✓ 存在 |
| `Or, return to` | Text | ログインページへの案内文 | ✓ 存在 |
| `log in` | TextLink | ログインリンク | ✓ 存在 |

#### `/resources/js/pages/auth/register.tsx`

| 翻訳キー | 使用箇所 | 説明 | starter-kits.json |
|---------|---------|------|------------------|
| `Create an account` | AuthLayout title | ページタイトル | ✓ 存在 |
| `Enter your details below to create your account` | AuthLayout description | ページ説明文 | ✓ 存在 |
| `Register` | Head title | ページタイトル | ✓ 存在 |
| `Name` | Label | 名前ラベル | ✓ 存在 |
| `Full name` | Input placeholder | 名前プレースホルダー | ✓ 存在 |
| `Email address` | Label | メールアドレスラベル | ✓ 存在 |
| `Password` | Label, Input placeholder | パスワードラベル、プレースホルダー | ✓ 存在 |
| `Confirm password` | Label, Input placeholder | パスワード確認ラベル、プレースホルダー | ✓ 存在 |
| `Create account` | Button | アカウント作成ボタン | ✓ 存在 |
| `Already have an account?` | Text | ログイン案内文 | ✓ 存在 |
| `Log in` | TextLink | ログインリンク | ✓ 存在 |

#### `/resources/js/pages/auth/verify-email.tsx`

| 翻訳キー | 使用箇所 | 説明 | starter-kits.json |
|---------|---------|------|------------------|
| 未実装 | - | 未日本語化 | - |

#### `/resources/js/pages/auth/reset-password.tsx`

| 翻訳キー | 使用箇所 | 説明 | starter-kits.json |
|---------|---------|------|------------------|
| 未実装 | - | 未日本語化 | - |

#### `/resources/js/pages/auth/confirm-password.tsx`

| 翻訳キー | 使用箇所 | 説明 | starter-kits.json |
|---------|---------|------|------------------|
| 未実装 | - | 未日本語化 | - |

#### `/resources/js/pages/auth/two-factor-challenge.tsx`

| 翻訳キー | 使用箇所 | 説明 | starter-kits.json |
|---------|---------|------|------------------|
| 未実装 | - | 未日本語化 | - |

### 設定関連ページ

#### `/resources/js/pages/settings/profile.tsx`

| 翻訳キー | 使用箇所 | 説明 | starter-kits.json |
|---------|---------|------|------------------|
| 未実装 | - | 未日本語化 | - |

#### `/resources/js/pages/settings/password.tsx`

| 翻訳キー | 使用箇所 | 説明 | starter-kits.json |
|---------|---------|------|------------------|
| 未実装 | - | 未日本語化 | - |

#### `/resources/js/pages/settings/appearance.tsx`

| 翻訳キー | 使用箇所 | 説明 | starter-kits.json |
|---------|---------|------|------------------|
| 未実装 | - | 未日本語化 | - |

#### `/resources/js/pages/settings/two-factor.tsx`

| 翻訳キー | 使用箇所 | 説明 | starter-kits.json |
|---------|---------|------|------------------|
| 未実装 | - | 未日本語化 | - |

### その他のページ

#### `/resources/js/pages/dashboard.tsx`

| 翻訳キー | 使用箇所 | 説明 | starter-kits.json |
|---------|---------|------|------------------|
| 未実装 | - | 未日本語化 | - |

#### `/resources/js/pages/welcome.tsx`

| 翻訳キー | 使用箇所 | 説明 | starter-kits.json |
|---------|---------|------|------------------|
| 未実装 | - | 未日本語化 | - |

## 翻訳キー重複チェック

以下の翻訳キーは複数のファイルで使用されています：

| 翻訳キー | 使用ファイル | starter-kits.json |
|---------|------------|------------------|
| `Email Address` | login.tsx (Label), forgot-password.tsx (Label) | ✓ 存在 |
| `Email address` | register.tsx (Label) | ✓ 存在 |
| `Password` | login.tsx (Label, placeholder), register.tsx (Label, placeholder) | ✓ 存在 |
| `Log in` | login.tsx (ボタン、タイトル), register.tsx (リンク) | ✓ 存在 |
| `log in` | forgot-password.tsx (リンクテキスト) | ✓ 存在 |

## 今後の作業

- [x] register.tsx の日本語化
- [ ] verify-email.tsx の日本語化
- [ ] reset-password.tsx の日本語化
- [ ] confirm-password.tsx の日本語化
- [ ] two-factor-challenge.tsx の日本語化
- [ ] settings/profile.tsx の日本語化
- [ ] settings/password.tsx の日本語化
- [ ] settings/appearance.tsx の日本語化
- [ ] settings/two-factor.tsx の日本語化
- [ ] dashboard.tsx の日本語化
- [ ] welcome.tsx の日本語化

## 翻訳ファイルの場所

- メインの翻訳ファイル: `lang/ja.json` - Laravel関連のエラーメッセージなど
- スターターキット用: `lang/ja/starter-kits.json` - UIコンポーネント向けの翻訳（99キー）

## 注意事項

- 現在、login.tsx、forgot-password.tsx、register.tsxで使用されているすべての翻訳キーは`lang/ja/starter-kits.json`に存在します
- 新しいページを日本語化する際は、まず`starter-kits.json`に必要なキーが存在するか確認してください
- キーが存在しない場合は、`starter-kits.json`に追加する必要があります
