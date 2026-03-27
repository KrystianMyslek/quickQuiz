<script setup lang="ts">
import PaginationLink from '../components/paginationLink.vue';
import SearchInput from '../components/searchInput.vue';
import indexPos from './components/indexPos.vue';

import { Quiz } from '@/types/index';

defineProps({
    results: {
        type: Object as () => {
            data: Array<{
                id: number;
                score: number;
                good_answers_count: number;
                quiz: Quiz;
            }>;
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
    searchTerm: {
        type: String,
        required: false,
        default: '',
    },
});
</script>

<template>
    <div class="flex h-full flex-col justify-between gap-6">
        <div class="flex w-full items-center justify-between">
            <SearchInput route="result" :searchTerm="searchTerm" />
        </div>

        <div
            class="flex h-full flex-wrap content-start justify-between overflow-x-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:bg-slate-500 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-slate-900"
        >
            <indexPos v-for="result in results.data" :key="result.id" :result="result" />
        </div>

        <div class="mx-4">
            <PaginationLink :paginator="results" class="mb-3" />
        </div>
    </div>
</template>
