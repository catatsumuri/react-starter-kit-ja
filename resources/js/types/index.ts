export type * from './auth';
export type * from './navigation';
export type * from './ui';

import type { Auth } from './auth';

export type Features = {
    registration: {
        enabled: boolean;
    };
    two_factor_authentication: {
        enabled: boolean;
    };
    password_visibility_toggle: {
        enabled: boolean;
    };
    flash_toast: {
        enabled: boolean;
    };
    appearance: {
        enabled: boolean;
    };
    account_deletion: {
        enabled: boolean;
    };
};

export type FlashMessages = {
    success?: string;
    error?: string;
    info?: string;
    warning?: string;
    message?: string;
};

export type SharedData = {
    name: string;
    features: Features;
    auth: Auth;
    sidebarOpen: boolean;
    flash: FlashMessages;
    [key: string]: unknown;
};
