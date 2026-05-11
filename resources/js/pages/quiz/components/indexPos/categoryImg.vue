<script setup lang="ts">
defineProps({
    image: {
        type: String,
    },
});
</script>

<template>
    <img
        class="h-[60px] w-[60px] sm:h-[100px] sm:w-[100px] md:h-[60px] md:w-[60px] lg:h-[100px] lg:w-[100px]"
        :src="image ? '../storage/' + image : '../storage/categories/default.png'"
    />
</template>
