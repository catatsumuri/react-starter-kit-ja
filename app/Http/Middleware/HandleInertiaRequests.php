<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        [$message, $author] = str(Inspiring::quotes()->random())->explode('-');

        // Load JSON translations with priority (later files override earlier ones)
        $locale = app()->getLocale();
        $jsonTranslations = $this->loadJsonTranslations($locale, [
            "{$locale}.json",           // Base Laravel translations
            "{$locale}/starter-kits.json", // Starter kit translations (higher priority)
        ]);

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'quote' => ['message' => trim($message), 'author' => trim($author)],
            'auth' => [
                'user' => $request->user(),
            ],
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
            'jsonLang' => $jsonTranslations,
        ];
    }

    /**
     * Load multiple JSON translation files with priority.
     * Later files in the array override translations from earlier files.
     */
    protected function loadJsonTranslations(string $locale, array $files): array
    {
        $translations = [];

        foreach ($files as $file) {
            $path = lang_path($file);

            if (file_exists($path)) {
                $content = json_decode(file_get_contents($path), true);
                if (is_array($content)) {
                    // Merge with later files overriding earlier ones
                    $translations = array_merge($translations, $content);
                }
            }
        }

        return $translations;
    }
}
