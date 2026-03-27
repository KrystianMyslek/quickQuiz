<script setup lang="ts">
import { Quiz } from '@/types/index';
import { Link } from '@inertiajs/vue3';

defineProps({
    quiz: {
        type: Object as () => Quiz,
        required: true,
    },
});
</script>

<template>
    <div class="w-full lg:w-[50%]">
        <div class="card m-2 flex items-center justify-between text-white md:h-40">
            <div>
                <img width="100px" :src="quiz.category.image ? '../storage/' + quiz.category.image : '../storage/categories/default.png'" />
            </div>

            <div class="mx-8 h-full flex-grow">
                <div class="text-xl">
                    {{ quiz.category.name }}
                </div>
                <div class="mb-2 text-2xl font-bold">
                    {{ quiz.name }}
                </div>
                <div>
                    <span class="text-sm">{{ $t('app.quiz.by') }}</span>
                    {{ quiz.user.name }}
                </div>
                <div>
                    <span class="text-sm">{{ $t('app.quiz.questions_count') }}: {{ quiz.questions_count }} </span>
                </div>
            </div>

            <div>
                <Link
                    :href="route('quiz_solve', { id: quiz.id })"
                    class="mb-4 rounded-md border-1 border-slate-500 p-4 text-center align-middle text-slate-500 shadow-2xl transition-all hover:bg-slate-800 hover:text-white"
                >
                    {{ $t('actions.solve') }}
                </Link>
            </div>
        </div>
    </div>
</template>
