# Getting Started

## 必要要件

| ツール | バージョン |
|---|---|
| PHP | 8.3 以上 |
| Composer | 2.x |
| Node.js | 20 以上 |
| npm | 10 以上 |

> Docker を利用する場合は [Laravel Sail](https://laravel.com/docs/sail) が同梱されています。

---

## インストール手順

### 1. 依存関係のインストール

```bash
composer install
npm install
```

### 2. 環境設定

```bash
cp .env.example .env
php artisan key:generate
```

`.env` を編集して DB / メールなどを設定します。

```dotenv
APP_NAME="React Starter Kit"
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# DB_DATABASE=/absolute/path/to/database.sqlite

MAIL_MAILER=log
```

### 3. データベースのセットアップ

```bash
touch database/database.sqlite   # SQLite 使用時
php artisan migrate
```

---

## 開発サーバーの起動

フロントエンド（Vite）とバックエンド（Laravel）を同時に起動します。

```bash
# ターミナル 1: Vite 開発サーバー
npm run dev

# ターミナル 2: Laravel サーバー
php artisan serve
```

または `package.json` の `dev` スクリプトで concurrently を使う場合:

```bash
npm run dev
```

ブラウザで `http://localhost:8000` を開いてください。

---

## ビルド

### 本番ビルド

```bash
npm run build
```

### SSR ビルド

```bash
npm run build:ssr
```

---

## Sail (Docker) を使う場合

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm run dev
```

---

## 利用可能な npm スクリプト

| コマンド | 説明 |
|---|---|
| `npm run dev` | Vite 開発サーバー起動 |
| `npm run build` | 本番ビルド |
| `npm run build:ssr` | SSR 本番ビルド |

## 利用可能な Artisan コマンド

| コマンド | 説明 |
|---|---|
| `php artisan migrate` | マイグレーション実行 |
| `php artisan migrate:fresh --seed` | DB リセット + シーダー |
| `php artisan test` | PHPUnit テスト実行 |
| `./vendor/bin/pint` | PHP コードスタイル修正 |
