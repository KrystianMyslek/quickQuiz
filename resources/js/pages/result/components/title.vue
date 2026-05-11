<script setup lang="ts">
import { Result } from '@/types/index';

defineProps({
    result: {
        type: Object as () => Result & Required<Pick<Result, 'quiz'>>,
        required: true,
    },
});
</script>

<template>
    <div>
        <h1 class="mb-6 text-3xl font-bold">{{ $t('app.result.title') }}</h1>
        <div class="mb-4">
            <span class="font-semibold">{{ $t('app.result.good_answers_count') }}:</span>
            <span class="ml-4 text-2xl">{{ result.good_answers_count }} / {{ result.quiz.questions_count }}</span>
        </div>
        <div class="mb-4">
            <span class="font-semibold">{{ $t('app.result.achieved_score') }}:</span>
            <span class="ml-4 text-2xl">{{ result.score }} / {{ result.quiz.questions_sum_score }}</span>
        </div>
    </div>
</template>
