# Hooks

`resources/js/hooks/` 以下のカスタム React フック一覧です。

---

## `useAppearance()`

テーマ（外観）の管理フック。

```typescript
import { useAppearance } from '@/hooks/use-appearance';

const { appearance, updateAppearance } = useAppearance();
// appearance: 'light' | 'dark' | 'system'
// updateAppearance('dark');
```

**動作:**
- 選択したテーマを `localStorage` と Cookie に保存
- `system` を選択した場合は `prefers-color-scheme` メディアクエリに追従
- HTML の `class` 属性 (`dark`) を直接操作

---

## `useFlashToast()`

Laravel フラッシュメッセージをトースト通知として表示するフック。

```typescript
import { useFlashToast } from '@/hooks/use-flash-toast';

// コンポーネント内で呼び出すだけで自動動作
useFlashToast();
```

**動作:**
- `SharedData.flash` の `success` / `error` / `info` / `warning` を監視
- `features.flash_toast.enabled` が true の場合のみ動作
- Sonner の `toast()` でトースト表示

---

## `useTwoFactorAuth()`

2FA のセットアップと管理フック。

```typescript
import { useTwoFactorAuth } from '@/hooks/use-two-factor-auth';

const {
    qrCode,
    setupKey,
    recoveryCodes,
    confirmTwoFactor,
    disableTwoFactor,
} = useTwoFactorAuth();
```

**動作:**
- QR コードと設定キーの取得
- リカバリーコードの取得・再生成
- 2FA の有効化確認・無効化

---

## `useLang()`

国際化 (i18n) 翻訳フック。

```typescript
import { useLang } from '@/hooks/useLang';

const { t } = useLang();
const label = t('auth.email'); // → "メールアドレス"
```

**動作:**
- `SharedData.lang` (Laravel の `lang/{locale}/frontend.json`) を参照
- キーが存在しない場合はキー文字列をそのまま返す

---

## `useCurrentUrl()`

現在の URL を返すフック。ナビゲーションのアクティブ状態判定に使用。

```typescript
import { useCurrentUrl } from '@/hooks/use-current-url';

const currentUrl = useCurrentUrl();
const isActive = currentUrl.startsWith('/settings');
```

---

## `useMobile()`

モバイルビューポートかどうかを判定するフック。

```typescript
import { useMobile } from '@/hooks/use-mobile';

const isMobile = useMobile();
```

**動作:**
- `window.matchMedia('(max-width: 768px)')` を監視
- ウィンドウリサイズに反応してリアルタイムで更新

---

## `useInitials()`

ユーザー名からイニシャルを生成するフック。

```typescript
import { useInitials } from '@/hooks/use-initials';

const getInitials = useInitials();
const initials = getInitials('山田 太郎'); // → "山太"
```

---

## `useClipboard()`

クリップボードへのコピーユーティリティフック。

```typescript
import { useClipboard } from '@/hooks/use-clipboard';

const { copy, copied } = useClipboard();
// copy('テキスト') でコピー
// copied が true の間はコピー完了状態
```

---

## `useMobileNavigation()`

モバイルナビゲーションの開閉状態管理フック。

```typescript
import { useMobileNavigation } from '@/hooks/use-mobile-navigation';

const { open, setOpen } = useMobileNavigation();
```
