# Feature Flags

## 概要

このアプリケーションはランタイムで機能の有効・無効を制御するための**機能フラグシステム**を備えています。

- バックエンド設定: `config/features.php`
- フロントエンドへの伝達: `HandleInertiaRequests` ミドルウェアの共有 props (`SharedData.features`)
- ルートの保護: 各機能専用のミドルウェアが 404 を返す

---

## 機能フラグ一覧

### `registration.enabled`

| 項目 | 内容 |
|---|---|
| **説明** | 新規ユーザー登録の許可 |
| **デフォルト** | `true` |
| **無効時の挙動** | `GET /register`, `POST /register` が 404 を返す |
| **ミドルウェア** | `EnsureRegistrationIsEnabled` |

```php
// config/features.php
'registration' => [
    'enabled' => env('REGISTRATION_ENABLED', true),
],
```

---

### `two_factor_authentication.enabled`

| 項目 | 内容 |
|---|---|
| **説明** | 二要素認証 (2FA) の利用許可 |
| **デフォルト** | `true` |
| **無効時の挙動** | 2FA 関連のルートが 404。セキュリティ設定ページで 2FA UI が非表示 |
| **ミドルウェア** | `EnsureTwoFactorAuthenticationIsEnabled` |

---

### `flash_toast.enabled`

| 項目 | 内容 |
|---|---|
| **説明** | フラッシュメッセージをトースト通知で表示 |
| **デフォルト** | `true` |
| **無効時の挙動** | `useFlashToast()` フックが動作しない |
| **フロントエンド** | `useFlashToast()` フック内でチェック |

---

### `appearance.enabled`

| 項目 | 内容 |
|---|---|
| **説明** | 外観設定 (ライト・ダーク・システムテーマ) の許可 |
| **デフォルト** | `true` |
| **無効時の挙動** | `GET /settings/appearance` が 404 を返す。ナビゲーションから非表示 |
| **ミドルウェア** | `EnsureAppearanceIsEnabled` |

---

### `account_deletion.enabled`

| 項目 | 内容 |
|---|---|
| **説明** | アカウント削除機能の許可 |
| **デフォルト** | `true` |
| **無効時の挙動** | `DELETE /settings/profile` が 404 を返す。設定ページで削除ボタンが非表示 |
| **ミドルウェア** | `EnsureAccountDeletionIsEnabled` |

---

## フロントエンドでの利用

```typescript
import { usePage } from '@inertiajs/react';
import type { SharedData } from '@/types';

const { features } = usePage<SharedData>().props;

// 条件付きレンダリング
{features.account_deletion.enabled && (
    <DeleteUser />
)}

{features.appearance.enabled && (
    <NavItem href="/settings/appearance">外観</NavItem>
)}
```

---

## 環境変数での制御

`.env` ファイルで各機能フラグを制御できます。

```dotenv
REGISTRATION_ENABLED=false
TWO_FACTOR_AUTH_ENABLED=true
FLASH_TOAST_ENABLED=true
APPEARANCE_ENABLED=true
ACCOUNT_DELETION_ENABLED=false
```

> 環境変数名は `config/features.php` の `env()` 呼び出しに依存します。実際のキー名はそちらを参照してください。

---

## テスト

機能フラグはテストでオーバーライドできます。

```php
// テスト内でフラグを無効化
Config::set('features.registration.enabled', false);

$response = $this->get('/register');
$response->assertStatus(404);
```

詳細は `tests/Feature/AppearanceFeatureFlagTest.php` などを参照してください。
