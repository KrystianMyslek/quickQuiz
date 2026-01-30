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
                <div class="text-2xl font-bold mb-4">
                    {{ quiz.name }} 
                    <span class="text-sm">{{ $t('app.quiz.by') }}</span>
                    {{ quiz.user.name }}
                </div>
                <div class="">
                    {{ $t('app.quiz.questions_count') }}: {{ quiz.questions_count }} 
                </div>
            </div>
    
            <div>
                <Link
                    :href="route('quiz_solve', { id: quiz.id })"
                    class="p-4 mb-4 border-1 border-slate-500 rounded-md shadow-2xl text-center align-middle text-slate-500 transition-all hover:text-white hover:bg-slate-800"
                >
                    {{ $t('actions.solve') }}
                </Link>
            </div>
        </div>
    </div>
</template>