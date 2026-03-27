<script setup lang="ts">
import layout from '@/layouts/empty_layout.vue';
import { Link } from '@inertiajs/vue3';

defineOptions({
    layout,
});

defineProps({
    categories_count: {
        type: Number,
        required: true,
    },
    quizzes_count: {
        type: Number,
        required: true,
    },
    questions_count: {
        type: Number,
        required: true,
    },
    users_count: {
        type: Number,
        required: true,
    },
});
</script>

<template>
    <div class="w-full bg-gradient-to-r from-slate-900 to-slate-700 md:h-screen">
        <div class="flex h-full flex-col">
            <div class="mx-4 my-6 text-center md:mx-20 md:flex md:justify-between">
                <div class="flex-row">
                    <Link :href="route('quiz_index')" class="home_button">
                        <span>{{ $t('actions.solve_as_guest') }}</span>
                    </Link>
                </div>
                <div class="flex-row md:flex">
                    <Link :href="route('register')" class="home_button md:mr-4">
                        <span>{{ $t('actions.register') }}</span>
                    </Link>
                    <Link :href="route('login')" class="home_button">
                        <span>{{ $t('actions.log_in') }}</span>
                    </Link>
                </div>
            </div>
            <div class="mx-4 grow grid-cols-2 font-bold text-white md:mx-20 md:grid">
                <div class="flex flex-col justify-between">
                    <div class="ext-center my-10 text-4xl">
                        {{ $t('app.welcome') }}
                    </div>
                    <div class="text-2xl">
                        {{ $t('app.welcome_text') }}
                    </div>
                    <div class="my-10 grid grid-cols-2 items-center justify-center text-center md:flex">
                        <div class="mx-3 my-6 rounded-lg border-2 border-slate-500 bg-slate-800 py-4 text-white transition duration-200 md:w-1/4">
                            <div>{{ categories_count }}</div>
                            <div>{{ $t('app.home_stats.categories') }}</div>
                        </div>
                        <div class="mx-3 my-6 rounded-lg border-2 border-slate-500 bg-slate-800 py-4 text-white transition duration-200 md:w-1/4">
                            <div>{{ quizzes_count }}</div>
                            <div>{{ $t('app.home_stats.quizzes') }}</div>
                        </div>
                        <div class="mx-3 my-6 rounded-lg border-2 border-slate-500 bg-slate-800 py-4 text-white transition duration-200 md:w-1/4">
                            <div>{{ questions_count }}</div>
                            <div>{{ $t('app.home_stats.questions') }}</div>
                        </div>
                        <div class="mx-3 my-6 rounded-lg border-2 border-slate-500 bg-slate-800 py-4 text-white transition duration-200 md:w-1/4">
                            <div>{{ users_count }}</div>
                            <div>{{ $t('app.home_stats.users') }}</div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <img src="quiz.png" alt="Quiz Image" class="mx-auto" />
                </div>
            </div>
        </div>
    </div>
</template>
