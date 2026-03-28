# Authentication

## 概要

認証は **Laravel Fortify 1.34** を使用して実装されています。Fortify はバックエンドの認証ロジックを提供し、ビュー (フロントエンド) は Inertia.js 経由で React コンポーネントが担当します。

---

## 対応している認証機能

| 機能 | 説明 | 機能フラグ |
|---|---|---|
| ユーザー登録 | 名前・メール・パスワードで新規登録 | `registration.enabled` |
| ログイン | メール・パスワードでログイン | — |
| ログアウト | セッション破棄 | — |
| パスワードリセット | メールでリセットリンク送信 | — |
| メール認証 | 登録後のメールアドレス確認 | — |
| パスワード確認 | センシティブ操作前の再確認 | — |
| 二要素認証 (2FA) | TOTP アプリとリカバリーコード | `two_factor_authentication.enabled` |

---

## 認証フロー

### 通常ログイン

```
POST /login
  ↓
Fortify の LoginPipeline
  ↓
RedirectIfTwoFactorAuthenticatable
  ├─ 2FA 有効 → GET /two-factor-challenge
  └─ 2FA 無効 → LoginResponse → redirect to /dashboard (flash: success)
```

### ユーザー登録

```
POST /register
  ↓
CreateNewUser アクション
  ├─ バリデーション (name, email, password)
  ├─ User::create()
  └─ redirect to /dashboard
```

### パスワードリセット

```
POST /forgot-password  →  メール送信
GET  /reset-password/{token}  →  フォーム表示
POST /reset-password  →  ResetUserPassword アクション  →  redirect to /login
```

### 二要素認証 (2FA) セットアップ

```
POST /user/two-factor-authentication  →  2FA 有効化 (secret 生成)
GET  /user/two-factor-qr-code         →  QR コード取得
POST /user/confirmed-two-factor-authentication  →  OTP 確認 → 有効化完了
GET  /user/two-factor-recovery-codes  →  リカバリーコード取得
```

---

## 認証ガード (ミドルウェア)

| ミドルウェア | 説明 |
|---|---|
| `auth` | 認証必須。未認証の場合は `/login` にリダイレクト |
| `verified` | メール認証必須。未認証の場合は `/email/verify` にリダイレクト |
| `password.confirm` | 直近のパスワード確認必須 (3 時間有効) |
| `guest` | 未認証ユーザーのみ (ログイン済みはリダイレクト) |

---

## Fortify アクション

### `CreateNewUser` (`app/Actions/Fortify/CreateNewUser.php`)

```php
Validator::make($input, [
    'name'     => ['required', 'string', 'max:255'],
    'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
    'password' => ['required', 'confirmed', Password::defaults()],
]);
```

### `ResetUserPassword` (`app/Actions/Fortify/ResetUserPassword.php`)

```php
Validator::make($input, [
    'password' => ['required', 'confirmed', Password::defaults()],
]);
```

---

## パスワード要件

`AppServiceProvider` でパスワードのデフォルト要件を設定しています。

| 環境 | 要件 |
|---|---|
| **本番** | 12文字以上、大文字・小文字・数字・記号を各1文字以上含む |
| **開発** | Laravel デフォルト (8文字以上) |

---

## カスタムレスポンス

Fortify のデフォルトレスポンスをオーバーライドしてフラッシュメッセージを追加しています。

| クラス | 説明 |
|---|---|
| `LoginResponse` | ログイン成功時に `success` フラッシュ |
| `TwoFactorEnabledResponse` | 2FA 有効化時に `success` フラッシュ |
| `TwoFactorDisabledResponse` | 2FA 無効化時に `success` フラッシュ |
| `RecoveryCodesGeneratedResponse` | リカバリーコード再生成時に `success` フラッシュ |

---

## セキュリティ対策

| 対策 | 詳細 |
|---|---|
| パスワードハッシュ | Bcrypt (Laravel デフォルト) |
| CSRF 保護 | Laravel のデフォルト CSRF ミドルウェア |
| レート制限 | ログイン 5回/分、2FA 10回/分 |
| セッション管理 | IP アドレス・ユーザーエージェントを `sessions` テーブルに記録 |
| Cookie 暗号化 | `appearance` と `sidebar_state` を除く全 Cookie を暗号化 |
| 2FA シークレット非公開 | `two_factor_secret` は User モデルの `$hidden` に含まれる |

---

## User モデルの 2FA トレイト

```php
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use TwoFactorAuthenticatable;

    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at'        => 'datetime',
        'password'                 => 'hashed',
        'two_factor_confirmed_at'  => 'datetime',
    ];
}
```
