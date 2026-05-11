<script setup lang="ts">
import { Quiz } from '@/types/index';
import Button from './indexPos/button.vue';
import CategoryImg from './indexPos/categoryImg.vue';
import Details from './indexPos/details.vue';
import Title from './indexPos/title.vue';

defineProps({
    quiz: {
        type: Object as () => Quiz,
        required: true,
    },
});
</script>

<template>
    <div class="w-full md:w-[50%] 2xl:w-[32%]">
        <div class="card m-2 text-white sm:hidden md:block lg:hidden">
            <div class="mb-2 flex w-full">
                <CategoryImg :image="quiz.category.image" />
                <Title class="ml-4" :quiz="quiz" />
            </div>

            <div class="flex">
                <Details :quiz="quiz" />
                <Button :id="quiz.id" />
            </div>
        </div>

        <div class="card m-2 hidden items-center justify-between text-white sm:flex md:hidden lg:flex">
            <CategoryImg :image="quiz.category.image" />
            <div class="mb-2 ml-4 flex w-full flex-grow flex-col">
                <Title :quiz="quiz" />
                <Details :quiz="quiz" />
            </div>

            <Button :id="quiz.id" />
        </div>
    </div>
</template>
