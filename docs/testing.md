# Testing

## テスト構成

テストには **PHPUnit 12** を使用します。`phpunit.xml` で設定されています。

```
tests/
├── Feature/
│   ├── Auth/                             # 認証フィーチャーテスト
│   │   ├── AuthenticationTest.php        # ログイン・ログアウト
│   │   ├── RegistrationTest.php          # ユーザー登録
│   │   ├── PasswordResetTest.php         # パスワードリセット
│   │   ├── PasswordConfirmationTest.php  # パスワード確認
│   │   ├── EmailVerificationTest.php     # メール認証
│   │   ├── VerificationNotificationTest.php
│   │   └── TwoFactorChallengeTest.php    # 2FA チャレンジ
│   ├── Settings/
│   │   ├── ProfileUpdateTest.php         # プロフィール更新
│   │   ├── SecurityTest.php              # セキュリティ設定 (パスワード・2FA)
│   │   ├── AppearanceFeatureFlagTest.php # 外観設定の機能フラグ
│   │   └── AccountDeletionFeatureFlagTest.php
│   ├── DashboardTest.php                 # ダッシュボードアクセス
│   ├── FeatureFlagsSharedWithInertiaTest.php
│   └── ExampleTest.php
└── Unit/
    └── ExampleTest.php
```

---

## テストの実行

```bash
# 全テスト実行
php artisan test

# または直接 PHPUnit で
./vendor/bin/phpunit

# 特定のテストスイートのみ
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit

# 特定のファイルのみ
php artisan test tests/Feature/Auth/AuthenticationTest.php

# フィルタリング
php artisan test --filter=test_users_can_login
```

---

## テスト環境

`phpunit.xml` でテスト専用の環境変数が設定されています。

```xml
<env name="APP_ENV"       value="testing"/>
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE"   value=":memory:"/>
<env name="CACHE_DRIVER"  value="array"/>
<env name="SESSION_DRIVER" value="array"/>
<env name="QUEUE_CONNECTION" value="sync"/>
<env name="MAIL_MAILER"   value="array"/>
```

インメモリ SQLite を使用するため、テストは高速に実行されます。

---

## テストの書き方

### 基本パターン

```php
<?php

use App\Models\User;

class AuthenticationTest extends TestCase
{
    public function test_users_can_login(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email'    => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
```

### Inertia ページのテスト

```php
public function test_dashboard_is_displayed(): void
{
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertOk()
             ->assertInertia(fn ($page) => $page->component('dashboard'));
}
```

### 機能フラグのテスト

```php
public function test_registration_is_disabled_when_flag_is_off(): void
{
    Config::set('features.registration.enabled', false);

    $response = $this->get('/register');
    $response->assertStatus(404);
}
```

---

## テストユーティリティ

### ユーザーファクトリー

```php
// デフォルトユーザー (メール未認証)
$user = User::factory()->create();

// メール認証済みユーザー
$user = User::factory()->create([
    'email_verified_at' => now(),
]);

// メール未認証ユーザー (明示的)
$user = User::factory()->unverified()->create();

// 複数作成
$users = User::factory()->count(5)->create();
```

### 認証済み状態でのリクエスト

```php
$this->actingAs($user)->get('/dashboard');
$this->actingAs($user)->post('/settings/profile', [...]);
```

---

## コードカバレッジ

```bash
# HTML レポート生成 (Xdebug または PCOV が必要)
php artisan test --coverage-html coverage/

# ターミナル出力
php artisan test --coverage
```

---

## 静的解析・コードスタイル

```bash
# PHP コードスタイル修正 (Laravel Pint)
./vendor/bin/pint

# ドライラン (変更なし確認)
./vendor/bin/pint --test

# フロントエンド Lint
npm run lint

# フロントエンドフォーマット
npm run format
```
