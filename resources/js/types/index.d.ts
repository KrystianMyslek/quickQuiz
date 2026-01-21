export interface Auth {
    user: User;
    admin: boolean;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    quote: { message: string; author: string };
    name: string;
    component: string;
    auth: Auth;
    locale: string;
    flash: {
        message?: string;
    };
};

export interface User {
    id: number;
    name: string;
    role: string,
    email: string;
    created_at: string;
    updated_at: string;
}
