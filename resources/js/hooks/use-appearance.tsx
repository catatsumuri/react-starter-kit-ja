import { useCallback, useEffect, useMemo, useSyncExternalStore } from 'react';
import { usePage } from '@inertiajs/react';
import type { SharedData } from '@/types';

export type ResolvedAppearance = 'light' | 'dark';
export type Appearance = ResolvedAppearance | 'system';

export type UseAppearanceReturn = {
    readonly appearance: Appearance;
    readonly resolvedAppearance: ResolvedAppearance;
    readonly updateAppearance: (mode: Appearance) => void;
};

const listeners = new Set<() => void>();
let currentAppearance: Appearance = 'system';

const prefersDark = (): boolean => {
    if (typeof window === 'undefined') return false;

    return window.matchMedia('(prefers-color-scheme: dark)').matches;
};

const setCookie = (name: string, value: string, days = 365): void => {
    if (typeof document === 'undefined') return;
    const maxAge = days * 24 * 60 * 60;
    document.cookie = `${name}=${value};path=/;max-age=${maxAge};SameSite=Lax`;
};

const getStoredAppearance = (): Appearance => {
    if (typeof window === 'undefined') return 'system';

    return (localStorage.getItem('appearance') as Appearance) || 'system';
};

const isDarkMode = (appearance: Appearance): boolean => {
    return appearance === 'dark' || (appearance === 'system' && prefersDark());
};

const applyTheme = (appearance: Appearance): void => {
    if (typeof document === 'undefined') return;

    const isDark = isDarkMode(appearance);

    document.documentElement.classList.toggle('dark', isDark);
    document.documentElement.style.colorScheme = isDark ? 'dark' : 'light';
};

const subscribe = (callback: () => void) => {
    listeners.add(callback);

    return () => listeners.delete(callback);
};

const notify = (): void => listeners.forEach((listener) => listener());

const mediaQuery = (): MediaQueryList | null => {
    if (typeof window === 'undefined') return null;

    return window.matchMedia('(prefers-color-scheme: dark)');
};

const handleSystemThemeChange = (): void => {
    applyTheme(currentAppearance);
    notify();
};

export function initializeTheme(): void {
    if (typeof window === 'undefined') return;

    if (!localStorage.getItem('appearance')) {
        localStorage.setItem('appearance', 'system');
        setCookie('appearance', 'system');
    }

    currentAppearance = getStoredAppearance();
    applyTheme(currentAppearance);

    // Set up system theme change listener
    mediaQuery()?.addEventListener('change', handleSystemThemeChange);
}

export function clearAppearanceSettings(): void {
    if (typeof window === 'undefined') return;

    try {
        localStorage.removeItem('appearance');
        document.cookie = 'appearance=; path=/; max-age=0';
    } catch {
        // Ignore errors
    }

    currentAppearance = 'system';
    applyTheme('system');
    notify();
}

export function useAppearance(): UseAppearanceReturn {
    const appearance: Appearance = useSyncExternalStore(
        subscribe,
        () => currentAppearance,
        () => 'system',
    );

    // Get feature flag from Inertia page props
    const { features } = usePage<SharedData>().props;

    // If appearance feature is disabled, clear settings and force system
    useEffect(() => {
        if (!features.appearance.enabled) {
            clearAppearanceSettings();
        }
    }, [features.appearance.enabled]);

    const resolvedAppearance: ResolvedAppearance = useMemo(() => {
        // If feature is disabled, always resolve to system preference
        if (!features.appearance.enabled) {
            return isDarkMode('system') ? 'dark' : 'light';
        }

        return isDarkMode(appearance) ? 'dark' : 'light';
    }, [appearance, features.appearance.enabled]);

    const handleUpdateAppearance = useCallback(
        (mode: Appearance): void => {
            // Prevent updates when feature is disabled
            if (!features.appearance.enabled) {
                return;
            }

            currentAppearance = mode;

            // Store in localStorage for client-side persistence...
            localStorage.setItem('appearance', mode);

            // Store in cookie for SSR...
            setCookie('appearance', mode);

            applyTheme(mode);
            notify();
        },
        [features.appearance.enabled],
    );

    return {
        appearance: features.appearance.enabled ? appearance : 'system',
        resolvedAppearance,
        updateAppearance: handleUpdateAppearance,
    } as const;
}
