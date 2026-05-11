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

export type User = {
    id: number;
    name: string;
    role: string;
    email: string;
    created_at: string;
    updated_at: string;
};

export type Category = {
    id: number;
    name: string;
    image?: string;
};

export type Quiz = {
    id: number;
    category: Category;
    name: string;
    user: User;
    created_at: string;
    updated_at: string;
    questions_count?: number;
    questions_sum_score?: number;
    questions: Array<Question>;
    result?: Result;
    rating_avg_score?: number;
};

export type Question = {
    id: number;
    content: string;
    answers: Array<Answer>;
    time_to_answer: number;
    score: number;
    good_answer: Answer;
};

export type Answer = {
    id: number;
    content: string;
};

export type Solve = {
    question_id: number;
    user_answer_id: number;
};

export type Result = {
    id: number;
    quiz_id: number;
    user_id: number;
    created_at: string;
    score: number;
    good_answers_count: number;
    quiz?: Quiz;
    solutions?: Record<Solution>;
};

export type Solution = {
    id: number;
    result_id: number;
    question_id: number;
    user_answer_id: number;
};

export type Rating = {
    id: number;
    quiz_id: number;
    user_id: number;
    score: number;
};
