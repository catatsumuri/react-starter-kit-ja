import { usePage } from '@inertiajs/react';
import { useEffect } from 'react';
import { toast } from 'sonner';
import type { SharedData } from '@/types';

export function useFlashToast() {
    const { flash, features } = usePage<SharedData>().props;

    useEffect(() => {
        // Check if flash toast feature is enabled
        if (!features.flash_toast.enabled) {
            return;
        }

        if (flash.success) {
            toast.success(flash.success);
        }
        if (flash.error) {
            toast.error(flash.error);
        }
        if (flash.info) {
            toast.info(flash.info);
        }
        if (flash.warning) {
            toast.warning(flash.warning);
        }
        if (flash.message) {
            toast(flash.message);
        }
    }, [flash, features.flash_toast.enabled]);
}
