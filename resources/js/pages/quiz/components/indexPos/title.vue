<script setup lang="ts">
import { Quiz } from '@/types';

defineProps({
    quiz: {
        type: Object as () => Quiz,
        required: true,
    },
});
</script>

<template>
    <div class="flex w-full items-end">
        <div class="text-xl lg:mb-2">{{ quiz.category.name }}:</div>
        <div class="ml-2 text-2xl font-bold lg:mb-2">
            {{ quiz.name }}
        </div>
    </div>
</template>
