<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';
    import DestroyLink from '@/pages/components/destroyLink.vue';
    import { Quiz } from '@/types/index';

    defineProps({
        quiz: {
            type: Object as () => Quiz,
            required: true
        },
    });
</script>

<template>
    <div class="w-full lg:w-[50%]">
        <div class="card m-2 flex items-center justify-between text-white h-40">
            <div>
                <img
                    width="100px"
                    :src="quiz.category.image ? '../storage/' + quiz.category.image : '../storage/categories/default.png'"
                />
            </div>

            <div class="h-full flex-grow mx-8 overflow-hidden">
                <div class="text-xl ">
                    {{ quiz.category.name }}
                </div>
                <div class="text-2xl font-bold mb-4">
                    {{ quiz.name }}
                </div>
                <div class="">
                    {{ $t('app.quiz.questions_count') }}: {{ quiz.questions_count }} 
                </div>
            </div>

            <div class="flex flex-col">
                <Link
                    :href="route('quiz_edit', { id: quiz.id })"
                    class="px-4 py-2 mb-4 border-1 border-slate-500 rounded-md shadow-2xl text-center align-middle text-slate-500 transition-all hover:text-white hover:bg-slate-800"
                >
                    {{ $t('actions.edit') }}
                </Link>
                <DestroyLink
                    :label="$t('app.quiz.confirm_destroy_label')"
                    :content="$t('app.quiz.confirm_destroy_content')"
                    :destroyRoute="route('quiz_destroy', { id: quiz.id })"
                    class="px-4 py-2 border-1 border-slate-500 rounded-md shadow-2xl text-center align-middle text-slate-500 transition-all hover:text-white hover:bg-slate-800"
                />
            </div>
        </div>
    </div>
</template>