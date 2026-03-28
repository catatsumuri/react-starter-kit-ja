# Backend Overview

## 構成

バックエンドは **Laravel 13** (PHP 8.3) で構築されており、主に以下の役割を担います。

1. **ルーティング** — URL → コントローラーの解決
2. **認証** — Laravel Fortify による認証フロー
3. **ビジネスロジック** — コントローラー / アクション
4. **Inertia レスポンス** — React コンポーネントへの props 受け渡し
5. **機能フラグ** — ランタイムでの機能 ON/OFF

---

## ディレクトリ構成

```
app/
├── Actions/
│   └── Fortify/
│       ├── CreateNewUser.php                     # ユーザー登録処理
│       ├── ResetUserPassword.php                 # パスワードリセット処理
│       └── RedirectIfTwoFactorAuthenticatable.php # 2FA リダイレクト
│
├── Concerns/
│   ├── PasswordValidationRules.php              # パスワードバリデーションルール (トレイト)
│   └── ProfileValidationRules.php               # プロフィールバリデーションルール (トレイト)
│
├── Http/
│   ├── Controllers/
│   │   └── Settings/
│   │       ├── ProfileController.php            # プロフィール設定
│   │       └── SecurityController.php           # セキュリティ設定 (パスワード・2FA)
│   ├── Middleware/
│   │   ├── HandleAppearance.php                 # テーマ Cookie 管理
│   │   ├── HandleInertiaRequests.php            # Inertia 共有 props
│   │   ├── EnsureRegistrationIsEnabled.php      # 登録機能フラグ確認
│   │   ├── EnsureTwoFactorAuthenticationIsEnabled.php
│   │   ├── EnsureAppearanceIsEnabled.php
│   │   └── EnsureAccountDeletionIsEnabled.php
│   ├── Requests/
│   │   └── Settings/
│   │       ├── ProfileUpdateRequest.php         # プロフィール更新バリデーション
│   │       ├── ProfileDeleteRequest.php         # アカウント削除バリデーション
│   │       ├── PasswordUpdateRequest.php        # パスワード変更バリデーション
│   │       └── TwoFactorAuthenticationRequest.php
│   └── Responses/
│       ├── LoginResponse.php                    # ログイン成功フラッシュメッセージ
│       ├── TwoFactorEnabledResponse.php
│       ├── TwoFactorDisabledResponse.php
│       └── RecoveryCodesGeneratedResponse.php
│
├── Models/
│   └── User.php                                 # ユーザーモデル
│
└── Providers/
    ├── AppServiceProvider.php                   # アプリ設定・依存登録
    └── FortifyServiceProvider.php               # Fortify 設定・ビュー登録
```

---

## 主要なコントローラー

### `ProfileController`

| メソッド | HTTP | ルート | 説明 |
|---|---|---|---|
| `edit()` | GET | `/settings/profile` | プロフィール設定ページ表示 |
| `update()` | PATCH | `/settings/profile` | 名前・メール更新 |
| `destroy()` | DELETE | `/settings/profile` | アカウント削除 |

### `SecurityController`

| メソッド | HTTP | ルート | 説明 |
|---|---|---|---|
| `edit()` | GET | `/settings/security` | セキュリティ設定ページ表示 |
| `update()` | PUT | `/settings/password` | パスワード更新 |

> `SecurityController::edit()` には `password.confirm` ミドルウェアが適用されています。

---

## ミドルウェア

### `HandleInertiaRequests`

すべての Inertia リクエストに共有 props を注入します。

```php
return array_merge(parent::share($request), [
    'name'        => config('app.name'),
    'features'    => config('features'),
    'auth'        => ['user' => $request->user()],
    'sidebarOpen' => (bool) $request->cookie('sidebar_state', true),
    'flash'       => [
        'success' => $request->session()->get('success'),
        'error'   => $request->session()->get('error'),
        // ...
    ],
    'lang'        => $this->loadTranslations(),
]);
```

### `HandleAppearance`

`appearance` Cookie を読み取り、HTML レスポンスにテーマ情報を付与します。

### 機能フラグミドルウェア

各機能フラグに対応するミドルウェアが、フラグが無効の場合に 404 を返します。

---

## サービスプロバイダー

### `AppServiceProvider`

- 本番環境でのパスワード要件設定 (12文字以上・大小英数字・記号)
- `Carbon::useImmutable()` — 日付の immutable 化
- 本番環境での破壊的 DB コマンド無効化

### `FortifyServiceProvider`

- Fortify のビュー登録 (Inertia::render を返す)
- 認証アクションのバインディング
- カスタムレスポンスクラスの登録
- ログイン / 2FA のレート制限設定

---

## 関連ページ

- [ルーティング](./routing.md)
- [認証システム](./authentication.md)
- [モデル & マイグレーション](./models.md)
- [機能フラグ](./feature-flags.md)
