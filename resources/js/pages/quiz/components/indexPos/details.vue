<script setup lang="ts">
import { Quiz } from '@/types';

const { quiz } = defineProps({
    quiz: {
        type: Object as () => Quiz,
        required: true,
    },
});

const stars = quiz.rating_avg_score ? parseInt(quiz.rating_avg_score.toFixed(0)) : null;
</script>

<template>
    <div class="flex w-full flex-col items-start justify-center">
        <span class="text-sm">{{ $t('app.quiz.by') }} {{ quiz.user.name }}</span>
        <span class="text-sm">{{ $t('app.quiz.questions_count') }}: {{ quiz.questions_count }} </span>
    </div>
    <div v-if="stars" class="mt-2 flex">
        <div v-for="value in stars" :key="`star-${value}`" class="text-3xl">★</div>
    </div>
</template>
