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

        $locale = $request->user()?->locale ?? app()->getLocale();
        $lang = $this->loadTranslations($locale);

        if (empty($lang)) {
            $lang = $this->loadTranslations(config('app.fallback_locale'));
        }

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'quote' => ['message' => trim($message), 'author' => trim($author)],
            'auth' => [
                'user' => $request->user(),
            ],
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
            'locale' => $locale,
            'lang' => $lang,
        ];
    }

    /**
     * Load available translation files for the provided locale.
     */
    protected function loadTranslations(?string $locale): array
    {
        if ($locale === null) {
            return [];
        }

        $files = [
            lang_path("{$locale}.json"),
            lang_path("{$locale}/starter-kit.json"),
        ];

        $translations = [];

        foreach ($files as $file) {
            if (! is_file($file)) {
                continue;
            }

            $contents = file_get_contents($file);
            $decoded = json_decode($contents, true);

            if (is_array($decoded)) {
                $translations = [...$translations, ...$decoded];
            }
        }

        return $translations;
    }
}
