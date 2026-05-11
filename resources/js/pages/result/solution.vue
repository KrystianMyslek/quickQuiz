<script setup lang="ts">
import { Rating, Result, Solution } from '@/types/index';
import { Link } from '@inertiajs/vue3';
import QuestionPos from './components/questionPos.vue';
import RatingForm from './components/ratingForm.vue';
import Title from './components/title.vue';

defineProps({
    guest: {
        type: Boolean,
        required: false,
        default: false,
    },
    result: {
        type: Object as () => Result & Required<Pick<Result, 'quiz'>> & Required<Pick<Result, 'solutions'>>,
        required: true,
    },
    rating: {
        type: Object as () => Rating,
        required: false,
        default: null,
    },
});
</script>

<template>
    <div class="text-white">
        <div class="mr-20 flex justify-between">
            <Title :result="result" />
            <RatingForm v-if="!guest" :result="result" :rating="rating" />
        </div>

        <QuestionPos
            v-for="(question, index) in result.quiz?.questions"
            :key="index"
            :question="question"
            :solution="result.solutions.find((s: Solution) => s.question_id === question.id)"
        />

        <Link :href="route('quiz_index')" class="custom mt-6! p-4!">
            <span>{{ $t('actions.back_to_list') }}</span>
        </Link>
    </div>
</template>
