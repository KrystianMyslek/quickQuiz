<script setup lang="ts">
    import QuestionPos from './components/questionPos.vue';

    defineProps({
        quiz: {
            type: Object,
            required: true
        },
        result: {
            type: Object,
            required: true
        },
        solutions: {
            type: Object,
            required: true
        }
    });

</script>

<template>
    <div class="text-white">
        <h1 class="text-3xl font-bold mb-6">{{ $t('app.result.title') }}</h1>
        <div class="mb-4">
            <span class="font-semibold">{{ $t('app.result.good_answers_count') }}:</span>
            <span class="text-2xl ml-4">{{ result.good_answers_count }} / {{ quiz.questions.length }}</span>
        </div>
        <div class="mb-4">
            <span class="font-semibold">{{ $t('app.result.achieved_score') }}:</span>
            <span class="text-2xl ml-4">{{ result.score }} / {{ quiz.questions_score }}</span>
        </div>

        <QuestionPos
            v-for="(question, index) in quiz.questions"
            :key="index"
            :question="question"
            :solution="solutions[question.id]"
        />
    </div>
</template>