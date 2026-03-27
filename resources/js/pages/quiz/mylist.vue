<script setup lang="ts">
import PaginationLink from '../components/paginationLink.vue';
import SearchInput from '../components/searchInput.vue';
import ListPos from './components/mylistPos.vue';

import { Quiz } from '@/types/index';
import { Link } from '@inertiajs/vue3';

defineProps({
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
            <SearchInput route="mylist" :searchTerm="searchTerm" />

            <Link :href="route('quiz_create')" class="custom px-4 py-2">
                {{ $t('actions.create') }}
            </Link>
        </div>

        <div
            class="flex h-full flex-wrap content-start justify-between overflow-x-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:bg-slate-500 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-slate-900"
        >
            <ListPos v-for="quiz in quizes.data" :key="quiz.id" :quiz="quiz" />
        </div>

        <div class="mx-4">
            <PaginationLink :paginator="quizes" class="mb-3" />
        </div>
    </div>
</template>
