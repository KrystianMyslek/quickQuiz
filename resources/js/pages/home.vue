<script setup lang="ts">
    import layout from '@/layouts/empty_layout.vue';
    import { Link } from '@inertiajs/vue3';

    defineOptions({
        layout,
    });
</script>

<template>
    <div class="md:h-screen w-full bg-gradient-to-r from-slate-900 to-slate-700">
        <div class="h-full flex flex-col ">
            <div class="flex flex-row-reverse">
                <Link
                    :href="route('register')"
                    class="button my-6 ml-3 mr-6 p-10 py-4"
                >
                    <span>{{ $t('actions.register') }}</span>
                </Link>
                <Link
                    :href="route('login')"
                    class="button my-6 ml-6 mr-3 p-10 py-4"
                >
                    <span>{{ $t('actions.log_in') }}</span>
                </Link>
            </div>
            <div class="grow font-bold text-white grid-cols-2 px-4 md:px-20 md:grid" >
                <div class="flex flex-col justify-between">
                    <div class="text-4xl ext-center my-10">
                        {{ $t('app.welcome') }}
                    </div>
                    <div class="text-2xl" >
                        {{ $t('app.welcome_text') }}
                    </div>
                    <div class="text-center my-10 grid grid-cols-2 md:flex justify-center items-center">
                        <div class="md:w-1/4 my-6 mx-3 rounded-lg border-2 border-slate-500 bg-slate-800 py-4 text-white transition duration-200">
                            <div>-</div>
                            <div>{{ $t('app.home_stats.categories') }}</div>
                        </div>
                        <div class="md:w-1/4 my-6 mx-3 rounded-lg border-2 border-slate-500 bg-slate-800 py-4 text-white transition duration-200">
                            <div>-</div>
                            <div>{{ $t('app.home_stats.quizzes') }}</div>
                        </div>
                        <div class="md:w-1/4 my-6 mx-3 rounded-lg border-2 border-slate-500 bg-slate-800 py-4 text-white transition duration-200">
                            <div>-</div>
                            <div>{{ $t('app.home_stats.questions') }}</div>
                        </div>
                        <div class="md:w-1/4 my-6 mx-3 rounded-lg border-2 border-slate-500 bg-slate-800 py-4 text-white transition duration-200">
                            <div>-</div>
                            <div>{{ $t('app.home_stats.users') }}</div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <img src="quiz.png" alt="Quiz Image" class="mx-auto">
                </div>
            </div>
        </div>
    </div>
</template>
