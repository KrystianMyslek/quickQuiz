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

export interface Category {
    id: number;
    name: string;
    image?: string;
}

export interface Quiz {
    id: number;
    category: Category
    name: string;
    user_id: User;
    created_at: string;
    updated_at: string;
    questions_count?: number;
}

export interface Question {
    id: number;
    content: string;
}

export interface Answer {
    id: number;
    content: string;
}