<script setup lang="ts">
import { Solution } from '@/types/index';
import { Link } from '@inertiajs/vue3';
import QuestionPos from './components/questionPos.vue';

defineProps({
    guest: {
        type: Boolean,
        required: false,
        default: false,
    },
    result: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="text-white">
        <h1 class="mb-6 text-3xl font-bold">{{ $t('app.result.title') }}</h1>
        <div class="mb-4">
            <span class="font-semibold">{{ $t('app.result.good_answers_count') }}:</span>
            <span class="ml-4 text-2xl">{{ result.good_answers_count }} / {{ result.quiz.questions_count }}</span>
        </div>
        <div class="mb-4">
            <span class="font-semibold">{{ $t('app.result.achieved_score') }}:</span>
            <span class="ml-4 text-2xl">{{ result.score }} / {{ result.quiz.questions_sum_score }}</span>
        </div>

        <QuestionPos
            v-for="(question, index) in result.quiz.questions"
            :key="index"
            :question="question"
            :solution="result.solutions.find((s: Solution) => s.question_id === question.id)"
        />

        <Link :href="route('quiz_index')" class="custom mt-6! p-4!">
            <span>{{ $t('actions.back_to_list') }}</span>
        </Link>
    </div>
</template>
