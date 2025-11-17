# React Starter Kit 日本語化状況

このドキュメントでは、各ファイルで使用されている翻訳キーと日本語化の状態を管理します。

## 翻訳状況一覧

### 認証関連ページ

#### resources/js/pages/auth/login.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| Log in to your account | ✓ | ✓ | ログインにあなたのアカウント |
| Enter your email and password below to log in | ✓ | ✓ | メールアドレスとパスワードを入力してログインしてください |
| Log in | ✓ | ✓ | ログイン |
| Email Address | ✓ | ✓ | メールアドレス |
| Password | ✓ | ✓ | パスワード |
| Forgot your password? | ✓ | ✓ | パスワードをお忘れですか？ |
| Remember me | ✓ | ✓ | ログイン状態を保持する |
| Don't have an account? | ✓ | ✓ | アカウントをお持ちでない方 |
| Sign up | ✓ | ✓ | 新規登録 |

#### resources/js/pages/auth/forgot-password.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| Forgot password | ✓ | ✓ | パスワードを忘れた方 |
| Enter your email to receive a password reset link | ✓ | ✓ | パスワード再設定リンクを受け取るためにメールアドレスを入力してください |
| Email Address | ✓ | ✓ | メールアドレス |
| Email password reset link | ✓ | ✓ | パスワード再設定リンクを送信 |
| Or, return to | ✓ | ✓ | または、こちらに戻る |
| log in | ✓ | ✓ | ログイン |

#### resources/js/pages/auth/register.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| Create an account | ✓ | ✓ | アカウントを作成 |
| Enter your details below to create your account | ✓ | ✓ | アカウント作成のために以下の情報を入力してください |
| Register | ✓ | ✓ | 登録 |
| Name | ✓ | ✓ | 氏名 |
| Full name | ✓ | ✓ | フルネーム |
| Email address | ✓ | ✓ | メールアドレス |
| Password | ✓ | ✓ | パスワード |
| Confirm password | ✓ | ✓ | パスワード（確認用） |
| Create account | ✓ | ✓ | アカウントを作成 |
| Already have an account? | ✓ | ✓ | 既にアカウントをお持ちですか？ |
| Log in | ✓ | ✓ | ログイン |

#### resources/js/pages/auth/confirm-password.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| Confirm your password | ✗ | - | タイトル（キー未定義） |
| This is a secure area of the application. Please confirm your password before continuing. | ✓ | ✓ | これはアプリケーションの保護された領域です。続行する前にパスワードを確認してください。 |
| Password | ✓ | ✓ | パスワード |
| Confirm password | ✓ | ✓ | パスワード（確認用） |

#### resources/js/pages/auth/verify-email.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| 未調査 | - | - | 未着手 |

#### resources/js/pages/auth/reset-password.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| 未調査 | - | - | 未着手 |

#### resources/js/pages/auth/two-factor-challenge.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| 未調査 | - | - | 未着手 |

### ウェルカムページ

#### resources/js/pages/welcome.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| Dashboard | ✓ | ✓ | ダッシュボード |
| Log in | ✓ | ✓ | ログイン |
| Register | ✓ | ✓ | 登録 |
| Documentation | ✓ | ✓ | ドキュメント |
| Let's get started | ✗ | - | キー未定義のため英語のまま |
| Read the | ✗ | - | キー未定義のため英語のまま |
| to get started with your Laravel application. | ✗ | - | キー未定義のため英語のまま |

### 設定関連ページ

#### resources/js/layouts/settings/layout.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| Settings | ✓ | ✓ | 設定 |
| Manage your profile and account settings | ✓ | ✓ | プロフィールとアカウント設定を管理 |
| Profile | ✓ | ✓ | プロフィール |
| Password | ✓ | ✓ | パスワード |
| Two-Factor Auth | ✓ | ✓ | 二要素認証 |
| Appearance | ✓ | ✓ | 外観 |
| Profile settings | ✗ | - | パンくずリスト（キー未定義） |
| Password settings | ✗ | - | パンくずリスト（キー未定義） |

#### resources/js/pages/settings/profile.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| Profile information | ✗ | - | タイトル（キー未定義） |
| Update your name and email address | ✓ | ✓ | 氏名とメールアドレスを更新 |
| Name | ✓ | ✓ | 氏名 |
| Full name | ✓ | ✓ | フルネーム |
| Email address | ✓ | ✓ | メールアドレス |
| Your email address is unverified. | ✓ | ✓ | メールアドレスが未認証です。 |
| Click here to re-send the verification email. | ✓ | ✓ | 確認メールの再送はこちら |
| A new verification link has been sent to your email address. | ✓ | ✓ | 確認メールを送信しました。 |
| Save | ✓ | ✓ | 保存 |
| Saved. | ✓ | ✓ | 保存が完了しました。 |
| Profile settings | ✗ | - | パンくずリスト、タイトル（キー未定義） |

#### resources/js/pages/settings/password.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| Update password | ✓ | ✓ | パスワードを更新 |
| Ensure your account is using a long, random password to stay secure | ✓ | ✓ | アカウントの安全性を保つため、長くランダムなパスワードを使用してください |
| Current password | ✓ | ✓ | 現在のパスワード |
| New password | ✓ | ✓ | 新しいパスワード |
| Confirm password | ✓ | ✓ | パスワード（確認用） |
| Save password | ✗ | - | ボタン（そのまま英語） |
| Saved. | ✓ | ✓ | 保存が完了しました。 |
| Password settings | ✗ | - | パンくずリスト、タイトル（キー未定義） |

#### resources/js/pages/settings/appearance.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| Appearance settings | ✗ | - | タイトル、パンくずリスト（キー未定義） |
| Update your account's appearance settings | ✓ | ✓ | アカウントの外観設定を更新 |

#### resources/js/pages/settings/two-factor.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| Two Factor Authentication | ✓ | ✓ | 二要素認証 |
| Manage your two-factor authentication settings | ✓ | ✓ | 二要素認証の設定を管理 |
| Enabled | ✓ | ✓ | 有効 |
| Disabled | ✓ | ✓ | 無効 |
| With two-factor authentication enabled, you will be prompted for a secure, random pin during login, which you can retrieve from the TOTP-supported application on your phone. | ✓ | ✓ | 二要素認証が有効な場合、ログイン時にセキュアでランダムなPINの入力を求められます。このPINはスマートフォンのTOTP対応アプリから取得できます。 |
| When you enable two-factor authentication, you will be prompted for a secure pin during login. This pin can be retrieved from a TOTP-supported application on your phone. | ✓ | ✓ | 二要素認証を有効にすると、ログイン時にセキュアなPINの入力を求められます。このPINはスマートフォンのTOTP対応アプリから取得できます。 |
| Disable 2FA | ✓ | ✓ | 二要素認証を無効化 |
| Enable 2FA | ✓ | ✓ | 二要素認証を有効化 |
| Continue Setup | ✗ | - | キー未定義のため英語のまま |
| Two-Factor Authentication | ✗ | - | パンくずリスト、タイトル（キー未定義） |

### コンポーネント

#### resources/js/components/app-sidebar.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| Dashboard | ✓ | ✓ | ダッシュボード |
| Repository | ✓ | ✓ | リポジトリ |
| Documentation | ✓ | ✓ | ドキュメント |

#### resources/js/components/app-header.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| Dashboard | ✓ | ✓ | ダッシュボード |
| Repository | ✓ | ✓ | リポジトリ |
| Documentation | ✓ | ✓ | ドキュメント |

#### resources/js/components/nav-main.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| Platform | ✓ | ✓ | プラットフォーム |

#### resources/js/components/user-menu-content.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| Settings | ✓ | ✓ | 設定 |
| Log out | ✓ | ✓ | ログアウト |

#### resources/js/components/delete-user.tsx

| 翻訳キー | JSONキー存在 | 日本語化 | 備考 |
|---------|------------|---------|------|
| Delete account | ✓ | ✓ | アカウントを削除 |
| Delete your account and all of its resources | ✓ | ✓ | アカウントと全てのリソースを削除 |
| Warning | ✗ | - | キー未定義のため英語のまま |
| Please proceed with caution, this cannot be undone. | ✗ | - | キー未定義のため英語のまま |
| Are you sure you want to delete your account? | ✓ | ✓ | アカウントを削除しますか？ |
| Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account. | ✓ | ✓ | アカウントを削除すると、全てのデータが完全に削除されます。よろしければパスワードを入力してください。 |
| Password | ✓ | ✓ | パスワード |
| Cancel | ✓ | ✓ | キャンセル |

## 未翻訳キー（starter-kits.jsonに存在しないキー）

以下のテキストは翻訳キーが定義されていないため、英語のまま残されています：

### タイトル・見出し系
- `Confirm your password` (confirm-password.tsx)
- `Profile information` (profile.tsx)
- `Profile settings` (profile.tsx - breadcrumb, Head title)
- `Password settings` (password.tsx - breadcrumb, Head title)
- `Appearance settings` (appearance.tsx - title, breadcrumb, Head title)
- `Two-Factor Authentication` (two-factor.tsx - breadcrumb, Head title)

### ボタン・リンク系
- `Save password` (password.tsx)
- `Continue Setup` (two-factor.tsx)

### メッセージ系
- `Warning` (delete-user.tsx)
- `Please proceed with caution, this cannot be undone.` (delete-user.tsx)
- `Let's get started` (welcome.tsx)
- `Read the` (welcome.tsx)
- `to get started with your Laravel application.` (welcome.tsx)

## 完了状況

### 完了済み ✓
- resources/js/pages/auth/login.tsx
- resources/js/pages/auth/forgot-password.tsx
- resources/js/pages/auth/register.tsx
- resources/js/pages/auth/confirm-password.tsx（部分的）
- resources/js/pages/welcome.tsx（部分的）
- resources/js/layouts/settings/layout.tsx
- resources/js/pages/settings/profile.tsx（部分的）
- resources/js/pages/settings/password.tsx
- resources/js/pages/settings/appearance.tsx（部分的）
- resources/js/pages/settings/two-factor.tsx（部分的）
- resources/js/components/app-sidebar.tsx
- resources/js/components/app-header.tsx
- resources/js/components/nav-main.tsx
- resources/js/components/user-menu-content.tsx
- resources/js/components/delete-user.tsx（部分的）

### 未着手
- resources/js/pages/auth/verify-email.tsx
- resources/js/pages/auth/reset-password.tsx
- resources/js/pages/auth/two-factor-challenge.tsx
- resources/js/pages/dashboard.tsx
- その他のコンポーネント

## 翻訳ファイルの場所

- Laravel エラーメッセージ: `lang/ja.json`
- UIコンポーネント: `lang/ja/starter-kits.json`

## 注意事項

- 現在の方針: `lang/ja/starter-kits.json`に既に存在するキーのみを日本語化
- 新規キーの追加は行わない
- キーが存在しないテキストは英語のまま残す
