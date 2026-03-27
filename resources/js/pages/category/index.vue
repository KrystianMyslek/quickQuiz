<script setup lang="ts">
import tablePos from '@/pages/category/components/tablePos.vue';
import { Category } from '@/types';
import { Link } from '@inertiajs/vue3';
import PaginationLink from '../components/paginationLink.vue';
import SearchInput from '../components/searchInput.vue';

defineProps({
    categories: {
        type: Object as () => {
            data: Array<Category>;
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
            <SearchInput route="" :searchTerm="searchTerm" />

            <Link :href="route('category_create')" class="custom px-4 py-2">
                {{ $t('actions.create') }}
            </Link>
        </div>

        <div
            class="h-full overflow-x-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:bg-slate-500 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-slate-900"
        >
            <table class="w-full">
                <thead class="border-b text-white">
                    <tr>
                        <th class="py-3">{{ $t('app.id') }}</th>
                        <th></th>
                        <th>{{ $t('app.category.name') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tablePos v-for="category in categories.data" :key="category.id" :category="category" />
                </tbody>
            </table>
        </div>

        <div class="w-full">
            <PaginationLink :paginator="categories" class="mb-3" />
        </div>
    </div>
</template>
