# Models & Migrations

## User モデル

**ファイル**: `app/Models/User.php`

### フィールド

| カラム | 型 | 説明 |
|---|---|---|
| `id` | bigint (unsigned) | 主キー |
| `name` | string | 表示名 |
| `email` | string (unique) | メールアドレス |
| `email_verified_at` | timestamp (nullable) | メール認証日時 |
| `password` | string | ハッシュ化パスワード |
| `two_factor_secret` | text (nullable) | 2FA TOTP シークレット |
| `two_factor_recovery_codes` | text (nullable) | 2FA リカバリーコード (JSON) |
| `two_factor_confirmed_at` | timestamp (nullable) | 2FA 確認日時 |
| `remember_token` | string (nullable) | ログイン状態保持トークン |
| `created_at` | timestamp | 作成日時 |
| `updated_at` | timestamp | 更新日時 |

### 定義

```php
class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at'       => 'datetime',
        'password'                => 'hashed',
        'two_factor_confirmed_at' => 'datetime',
    ];
}
```

---

## マイグレーション

### `0001_01_01_000000_create_users_table`

```
users テーブル
  - id, name, email, email_verified_at, password, remember_token, timestamps

password_reset_tokens テーブル
  - email (primary key), token, created_at

sessions テーブル
  - id, user_id (nullable, indexed), ip_address, user_agent
  - payload, last_activity (indexed)
```

### `0001_01_01_000001_create_cache_table`

```
cache テーブル
  - key (primary key), value, expiration

cache_locks テーブル
  - key (primary key), owner, expiration
```

### `0001_01_01_000002_create_jobs_table`

```
jobs テーブル
  - id, queue (indexed), payload, attempts, reserved_at
  - available_at, created_at

job_batches テーブル
  - id, name, total_jobs, pending_jobs, failed_jobs
  - failed_job_ids, options, cancelled_at, created_at, finished_at

failed_jobs テーブル
  - id, uuid (unique), connection, queue, payload, exception, failed_at
```

### `2025_08_14_170933_add_two_factor_columns_to_users_table`

```php
$table->text('two_factor_secret')->nullable()->after('password');
$table->text('two_factor_recovery_codes')->nullable()->after('two_factor_secret');
$table->timestamp('two_factor_confirmed_at')->nullable()->after('two_factor_recovery_codes');
```

---

## データベース設定

デフォルトでは **SQLite** を使用します。

```dotenv
# .env
DB_CONNECTION=sqlite
# DB_DATABASE=/absolute/path/to/database.sqlite
```

テスト環境 (`phpunit.xml`) では **インメモリ SQLite** を使用します。

```xml
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

---

## ファクトリー

```php
// database/factories/UserFactory.php
User::factory()->create([
    'name'  => 'Test User',
    'email' => 'test@example.com',
]);

// メール認証済みユーザー
User::factory()->create(['email_verified_at' => now()]);

// メール未認証ユーザー
User::factory()->unverified()->create();
```
