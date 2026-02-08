import * as React from 'react';
import { Eye, EyeOff } from 'lucide-react';
import { cn } from '@/lib/utils';
import { Input } from '@/components/ui/input';
import { usePage } from '@inertiajs/react';
import type { SharedData } from '@/types';

export type PasswordInputProps = Omit<React.ComponentProps<'input'>, 'type'> & {
    showToggle?: boolean;
};

const PasswordInput = React.forwardRef<HTMLInputElement, PasswordInputProps>(
    ({ className, showToggle, ...props }, ref) => {
        const { features } = usePage<SharedData>().props;
        const [showPassword, setShowPassword] = React.useState(false);

        // showToggle未指定時は機能フラグを使用、明示指定時は上書き
        const shouldShowToggle = showToggle ?? features.password_visibility_toggle.enabled;

        if (!shouldShowToggle) {
            return <Input type="password" className={className} ref={ref} {...props} />;
        }

        return (
            <div className="relative">
                <Input
                    type={showPassword ? 'text' : 'password'}
                    className={cn('pr-10', className)}
                    ref={ref}
                    {...props}
                />
                <button
                    type="button"
                    onClick={() => setShowPassword(!showPassword)}
                    className="absolute right-0 top-0 flex h-9 w-10 items-center justify-center text-muted-foreground transition-colors hover:text-foreground"
                    tabIndex={-1}
                    aria-label={showPassword ? 'Hide password' : 'Show password'}
                >
                    {showPassword ? <EyeOff className="h-4 w-4" /> : <Eye className="h-4 w-4" />}
                </button>
            </div>
        );
    }
);

PasswordInput.displayName = 'PasswordInput';

export { PasswordInput };
