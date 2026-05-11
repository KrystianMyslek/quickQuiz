<script setup lang="ts">
import { Rating, Result } from '@/types';
import axios from 'axios';
import { ref } from 'vue';

const props = defineProps({
    result: {
        type: Object as () => Result & Required<Pick<Result, 'quiz'>>,
        required: true,
    },
    rating: {
        type: Object as () => Rating,
        required: false,
        default: null,
    },
});
const rating = ref(props.rating);
const hover = ref(false);
const hoverStar = ref(0);

const rate = async () => {
    try {
        const response = await axios.post(route('quiz_rate', { id: props.result.quiz.id }), {
            score: hoverStar.value,
        });

        if (response.status === 200) {
            rating.value = response.data.rating;
        }
    } catch (err) {
        console.error(err);
    }
};
</script>
<template>
    <div>
        <h1 class="mb-6 text-3xl font-bold">{{ $t('app.result.rating') }}</h1>
        <div class="flex cursor-pointer">
            <div
                v-for="score in 5"
                :key="`star-${score}`"
                @mouseenter="
                    hover = true;
                    hoverStar = score;
                "
                @mouseleave="
                    hover = false;
                    hoverStar = 0;
                "
                @click.prevent="rate"
                class="text-3xl"
            >
                {{ hover && hoverStar >= score ? '★' : rating && rating.score >= score ? '★' : '☆' }}
            </div>
        </div>
    </div>
</template>
