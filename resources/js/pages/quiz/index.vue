<script setup lang="ts">
import { Category, Quiz } from '@/types/index';
import { Link } from '@inertiajs/vue3';
import PaginationLink from '../components/paginationLink.vue';
import SearchInput from '../components/searchInput.vue';
import CategorySearch from './components/categorySearch.vue';
import IndexPos from './components/indexPos.vue';

defineProps({
    guest: {
        type: Boolean,
        required: false,
        default: false,
    },
    quizes: {
        type: Object as () => {
            data: Array<Quiz>;
            links: Array<{
                url: string;
                label: string;
                active: boolean;
            }>;
            from: number;
            to: number;
            total: number;
        },
        required: true,
    },
    categories: {
        type: Array<Category>,
        required: true,
    },
    selectedCategories: {
        type: String,
        required: false,
        default: '',
    },
    searchTerm: {
        type: String,
        required: false,
        default: '',
    },
});
</script>

<template>
    <div class="flex h-full flex-col justify-between gap-6">
        <div v-if="guest" class="flex w-full items-center justify-end">
            <Link :href="route('register')" class="custom my-3 mr-6 p-10 py-4 md:my-0">
                <span>{{ $t('actions.register') }}</span>
            </Link>
            <Link :href="route('login')" class="custom my-3 p-10 py-4 md:my-0">
                <span>{{ $t('actions.log_in') }}</span>
            </Link>
        </div>
        <div class="flex w-full flex-col">
            <SearchInput route="" :searchTerm="searchTerm" />
            <CategorySearch route="" :categories="categories" :selectedCategories="selectedCategories" />
        </div>
        <div
            class="flex h-full flex-wrap content-start justify-start overflow-x-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:bg-slate-500 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-slate-900"
        >
            <IndexPos v-for="quiz in quizes.data" :key="quiz.id" :quiz="quiz" />
        </div>

        <div class="mx-4">
            <PaginationLink :paginator="quizes" class="mb-3" />
        </div>
    </div>
</template>
