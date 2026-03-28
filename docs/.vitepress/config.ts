import { defineConfig } from 'vitepress';

export default defineConfig({
    title: 'React Starter Kit',
    description: 'Laravel + Inertia + React スターターキット ドキュメント',
    base: '/react-starter-kit-ja/',
    lang: 'ja',

    themeConfig: {
        nav: [
            { text: 'ホーム', link: '/' },
            { text: 'はじめに', link: '/getting-started' },
            { text: 'アーキテクチャ', link: '/architecture' },
        ],

        sidebar: [
            {
                text: 'はじめに',
                items: [
                    { text: '概要', link: '/' },
                    { text: 'セットアップ', link: '/getting-started' },
                    { text: 'アーキテクチャ', link: '/architecture' },
                ],
            },
            {
                text: 'フロントエンド',
                items: [
                    { text: '概要', link: '/frontend/overview' },
                    { text: 'ページ', link: '/frontend/pages' },
                    { text: 'レイアウト', link: '/frontend/layouts' },
                    { text: 'コンポーネント', link: '/frontend/components' },
                    { text: 'フック', link: '/frontend/hooks' },
                ],
            },
            {
                text: 'バックエンド',
                items: [
                    { text: '概要', link: '/backend/overview' },
                    { text: 'ルーティング', link: '/backend/routing' },
                    { text: '認証', link: '/backend/authentication' },
                    { text: 'モデル & マイグレーション', link: '/backend/models' },
                    { text: '機能フラグ', link: '/backend/feature-flags' },
                ],
            },
            {
                text: 'テスト',
                items: [{ text: 'テスト', link: '/testing' }],
            },
        ],

        socialLinks: [
            { icon: 'github', link: 'https://github.com/catatsumuri/react-starter-kit-ja' },
        ],

        footer: {
            message: 'MIT License',
            copyright: 'Laravel React Starter Kit (Japanese)',
        },

        editLink: {
            pattern:
                'https://github.com/catatsumuri/react-starter-kit-ja/edit/main/docs/:path',
            text: 'このページを GitHub で編集',
        },

        search: {
            provider: 'local',
        },
    },
});
