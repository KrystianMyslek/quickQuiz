<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';
    import { Quiz } from '@/types/index';

    defineProps({
        result: {
            type: Object as () => { 
                id: number;
                score: number;
                good_answers_count: number;
                quiz: Quiz;
            },
            required: true
        },
    });
</script>

<template>
    <div class="w-full lg:w-[50%]">
        <div class="card m-2 flex items-center justify-between text-white h-w40">
            <div>
                <img
                    width="100px"
                    :src="result.quiz.category.image ? '../storage/' + result.quiz.category.image : '../storage/categories/default.png'"
                />
            </div>

            <div class="h-full flex-grow mx-8 overflow-hidden">
                <div class="text-xl ">
                    {{ result.quiz.category.name }}
                </div>
                <div class="text-2xl font-bold mb-1">
                    {{ result.quiz.name }}
                </div>
                <div>
                    {{ $t('app.result.good_answers_count') }}: {{ result.good_answers_count }} / {{ result.quiz.questions_count }}
                </div>
                <div>
                    {{ $t('app.result.achieved_score') }}: {{ result.score }} / {{ result.quiz.questions_sum_score }}
                </div>
            </div>

            <div>
                <Link
                    :href="route('result_solution', { id: result.id })"
                    class="p-4 mb-4 border-1 border-slate-500 rounded-md shadow-2xl text-center align-middle text-slate-500 transition-all hover:text-white hover:bg-slate-800"
                >
                    {{ $t('actions.result') }}
                </Link>
            </div>
        </div>
    </div>
</template>