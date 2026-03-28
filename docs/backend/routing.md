# Routing

## Web ルート (`routes/web.php`)

```php
Route::get('/', WelcomePage::class)->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', DashboardPage::class)->name('dashboard');
});

require __DIR__.'/settings.php';
```

| HTTP | パス | コンポーネント / コントローラー | ミドルウェア | 名前 |
|---|---|---|---|---|
| GET | `/` | `welcome` (Inertia) | — | `home` |
| GET | `/dashboard` | `dashboard` (Inertia) | `auth`, `verified` | `dashboard` |

---

## 設定ルート (`routes/settings.php`)

```php
Route::middleware('auth')->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('settings/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::middleware('verified')->group(function () {
        Route::delete('settings/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('settings/security',   [SecurityController::class, 'edit'])->name('security.edit');
        Route::put('settings/password',   [SecurityController::class, 'update'])->name('user-password.update');
        Route::get('settings/appearance', fn() => Inertia::render('settings/appearance'))
                                                         ->name('appearance.edit');
    });
});
```

| HTTP | パス | コントローラー | ミドルウェア | 名前 |
|---|---|---|---|---|
| GET | `/settings` | redirect → `/settings/profile` | `auth` | — |
| GET | `/settings/profile` | `ProfileController@edit` | `auth` | `profile.edit` |
| PATCH | `/settings/profile` | `ProfileController@update` | `auth` | `profile.update` |
| DELETE | `/settings/profile` | `ProfileController@destroy` | `auth`, `verified` | `profile.destroy` |
| GET | `/settings/security` | `SecurityController@edit` | `auth`, `verified` | `security.edit` |
| PUT | `/settings/password` | `SecurityController@update` | `auth`, `verified` | `user-password.update` |
| GET | `/settings/appearance` | Inertia render | `auth`, `verified` | `appearance.edit` |

---

## Fortify ルート (自動登録)

`FortifyServiceProvider` により自動登録される認証ルートです。

| HTTP | パス | 説明 |
|---|---|---|
| GET | `/login` | ログインページ |
| POST | `/login` | ログイン処理 |
| POST | `/logout` | ログアウト |
| GET | `/register` | 登録ページ |
| POST | `/register` | ユーザー登録 |
| GET | `/forgot-password` | パスワードリセットリクエストページ |
| POST | `/forgot-password` | リセットメール送信 |
| GET | `/reset-password/{token}` | パスワードリセットページ |
| POST | `/reset-password` | パスワードリセット実行 |
| GET | `/email/verify` | メール認証待ちページ |
| GET | `/email/verify/{id}/{hash}` | メール認証確認 |
| POST | `/email/verification-notification` | 認証メール再送 |
| GET | `/confirm-password` | パスワード確認ページ |
| POST | `/confirm-password` | パスワード確認 |
| GET | `/two-factor-challenge` | 2FA チャレンジページ |
| POST | `/two-factor-challenge` | 2FA 認証 |
| POST | `/user/two-factor-authentication` | 2FA 有効化 |
| DELETE | `/user/two-factor-authentication` | 2FA 無効化 |
| GET | `/user/two-factor-recovery-codes` | リカバリーコード取得 |
| POST | `/user/two-factor-recovery-codes` | リカバリーコード再生成 |

---

## レート制限

| エンドポイント | 制限 |
|---|---|
| `POST /login` | 5 回 / 分 |
| `POST /two-factor-challenge` | 10 回 / 分 |

---

## Wayfinder (フロントエンド向けルートヘルパー)

`laravel/wayfinder` により、ビルド時にルート定義から TypeScript ヘルパーが自動生成されます。

```typescript
// 生成されたヘルパーの使用例
import { route } from '@/actions/Settings/ProfileController';

const updateUrl = route.update(); // → '/settings/profile'
```

`vite.config.ts` の `wayfinder({ formVariants: true })` オプションにより、フォームの HTTP メソッドバリアント付きで生成されます。
