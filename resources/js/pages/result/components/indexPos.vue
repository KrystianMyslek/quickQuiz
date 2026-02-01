<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';
    import { Quiz } from '@/types/index';

    defineProps({
        quiz: {
            type: Object as () => Quiz,
            required: true
        },
    });
</script>

<template>
    <div class="w-[50%]">
        <div class="card m-2 flex items-center justify-between text-white h-40">
            <div>
                <img
                    width="100px"
                    :src="quiz.category.image ? '../storage/' + quiz.category.image : '../storage/categories/default.png'"
                />
            </div>

            <div class="h-full flex-grow ml-8">
                <div class="text-xl ">
                    {{ quiz.category.name }}
                </div>
                <div class="text-2xl font-bold mb-1">
                    {{ quiz.name }}
                </div>
                <div>
                    {{ $t('app.result.good_answers_count') }}: {{ quiz.result?.good_answers_count }} / {{ quiz.questions_count }}
                </div>
                <div>
                    {{ $t('app.result.achieved_score') }}: {{ quiz.result?.score }} / {{ quiz.questions_score }}
                </div>
            </div>

            <div>
                <Link
                    :href="route('result_solution', { id: quiz.result?.id })"
                    class="p-4 mb-4 border-1 border-slate-500 rounded-md shadow-2xl text-center align-middle text-slate-500 transition-all hover:text-white hover:bg-slate-800"
                >
                    {{ $t('actions.result') }}
                </Link>
            </div>
        </div>
    </div>
</template>