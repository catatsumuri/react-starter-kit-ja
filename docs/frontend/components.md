# Components

`resources/js/components/` 以下の再利用可能なコンポーネント一覧です。

---

## アプリシェル / ナビゲーション

| コンポーネント | ファイル | 説明 |
|---|---|---|
| `AppShell` | `app-shell.tsx` | `SidebarProvider` と `Toaster` を含む最外殻 |
| `AppSidebar` | `app-sidebar.tsx` | 折りたたみ可能なサイドバー |
| `AppHeader` | `app-header.tsx` | パンくずリスト + ユーザーメニューのヘッダー |
| `AppContent` | `app-content.tsx` | メインコンテンツエリア |
| `NavMain` | `nav-main.tsx` | サイドバーのメインナビゲーションアイテム |
| `NavUser` | `nav-user.tsx` | ユーザードロップダウン (設定・ログアウト) |
| `NavFooter` | `nav-footer.tsx` | サイドバー下部のフッターナビゲーション |
| `Breadcrumbs` | `breadcrumbs.tsx` | パンくずナビゲーション |

---

## ユーザー関連

| コンポーネント | ファイル | 説明 |
|---|---|---|
| `UserInfo` | `user-info.tsx` | 名前・メール・アバターを表示 |
| `UserMenuContent` | `user-menu-content.tsx` | ユーザードロップダウンのメニュー内容 |
| `DeleteUser` | `delete-user.tsx` | アカウント削除の確認モーダル |

---

## 認証 / セキュリティ

| コンポーネント | ファイル | 説明 |
|---|---|---|
| `TwoFactorSetupModal` | `two-factor-setup-modal.tsx` | QR コード表示と 2FA セットアップモーダル |
| `TwoFactorRecoveryCodes` | `two-factor-recovery-codes.tsx` | リカバリーコード一覧とコピーボタン |

---

## 外観

| コンポーネント | ファイル | 説明 |
|---|---|---|
| `AppearanceTabs` | `appearance-tabs.tsx` | ライト / ダーク / システムのテーマ切り替えタブ |

---

## フォーム補助

| コンポーネント | ファイル | 説明 |
|---|---|---|
| `InputError` | `input-error.tsx` | フォームのインラインエラーメッセージ |
| `PasswordInput` | `password-input.tsx` | 表示/非表示トグル付きパスワード入力 |
| `Heading` | `heading.tsx` | セクション見出しコンポーネント |
| `TextLink` | `text-link.tsx` | スタイル付きテキストリンク |
| `AlertError` | `alert-error.tsx` | エラーアラートバナー |

---

## UI ライブラリ (`components/ui/`)

[shadcn/ui](https://ui.shadcn.com/) ベースの基本 UI コンポーネント群です。  
Radix UI のプリミティブをベースに Tailwind CSS でスタイリングされています。

| コンポーネント | 説明 |
|---|---|
| `Button` | ボタン (variant: default / outline / ghost など) |
| `Input` | テキスト入力フィールド |
| `Label` | フォームラベル |
| `Card`, `CardHeader`, `CardContent` | カードコンテナ |
| `Dialog` | モーダルダイアログ |
| `Sidebar` | サイドバープリミティブ |
| `DropdownMenu` | ドロップダウンメニュー |
| `Select` | セレクトボックス |
| `Sheet` | スライドオーバー (モバイル向け) |
| `Alert` | アラートバナー |
| `Badge` | バッジラベル |
| `Breadcrumb` | パンくずプリミティブ |
| `Checkbox` | チェックボックス |
| `Toggle` | トグルボタン |
| `Avatar` | アバター画像 |
| `Separator` | 区切り線 |
| `Skeleton` | ローディングスケルトン |
| `Spinner` | スピナーアイコン |
| `Sonner` | トースト通知 (Toaster) |
| `InputOTP` | OTP 入力 (2FA 向け) |
| `Tooltip` | ツールチップ |
| `NavigationMenu` | ナビゲーションメニュー |
| `Collapsible` | 折りたたみコンポーネント |

---

## 使用例

```tsx
import { Button } from '@/components/ui/button';
import { InputError } from '@/components/input-error';
import { PasswordInput } from '@/components/password-input';

export default function Example() {
    return (
        <form>
            <PasswordInput id="password" />
            <InputError message="パスワードが間違っています" />
            <Button type="submit">送信</Button>
        </form>
    );
}
```
