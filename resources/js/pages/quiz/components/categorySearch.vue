<script setup lang="ts">
import { Category } from '@/types';
import { router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const { categories, route, selectedCategories } = defineProps({
    categories: {
        type: Array<Category>,
        required: true,
    },
    route: {
        type: String,
        required: true,
    },
    selectedCategories: {
        type: String,
        required: false,
        default: '',
    },
});

const selected_categories = ref(selectedCategories !== '' ? selectedCategories.split(',').map(Number) : []);

const toggleCategory = (categoryId: number) => {
    selected_categories.value = selected_categories.value.includes(categoryId)
        ? selected_categories.value.filter((id) => id !== categoryId)
        : [...selected_categories.value, categoryId];
};

watch(selected_categories, () => {
    router.get(
        route,
        {
            selected_categories: selected_categories.value.join(','),
            page: 1,
        },
        {
            preserveState: true,
        },
    );
});
</script>

<template>
    <div class="mt-4 flex flex-wrap gap-4">
        <button
            v-for="category in categories"
            :key="category.id"
            class="custom bg-slate-700! text-slate-400! hover:bg-slate-900!"
            :class="selected_categories.includes(category.id) ? 'bg-slate-800! text-white!' : ''"
            @click="() => toggleCategory(category.id)"
        >
            {{ category.name }}
        </button>
    </div>
</template>
