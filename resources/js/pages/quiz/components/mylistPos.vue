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
    <div class="card flex items-center justify-between mb-4 text-white h-40">
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
            </div>
            <div class="">
                {{ $t('app.quiz.questions_count') }}: {{ quiz.questions_count }} 
            </div>
        </div>

        <div class="flex flex-col">
            <Link
                :href="route('quiz_edit', { id: quiz.id })"
                class="p-2 rounded-lg text-center align-middle text-slate-500 transition-all hover:text-white"
            >
                {{ $t('actions.edit') }}
            </Link>
            <DestroyLink
                :label="$t('app.quiz.confirm_destroy_label')"
                :content="$t('app.quiz.confirm_destroy_content')"
                :destroyRoute="route('quiz_destroy', { id: quiz.id })"
                class="p-2"
            />
        </div>
    </div>
</template>