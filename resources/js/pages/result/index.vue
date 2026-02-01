<script setup lang="ts">
    import indexPos from './components/indexPos.vue';
    import PaginationLink from '../components/paginationLink.vue';
    import SearchInput from '../components/searchInput.vue';

    import { Link } from '@inertiajs/vue3';
    import { Quiz } from '@/types/index';

    defineProps({
        quizes: {
            type: Object as () => { 
                data: Array<Quiz>;
                links: Array<{ 
                    url: string; 
                    label: string; 
                    active: boolean 
                }>;
                from: number;
                to: number;
                total: number;
            },
            required: true
        },
        searchTerm: {
            type: String,
            required: false,
            default: ''
        }
    });

</script>

<template>
    <div class="h-full flex flex-col gap-6 justify-between">
        <div class="w-full flex items-center justify-between">
            <SearchInput
                route="result"
                :searchTerm="searchTerm"
            />

            <div class="mr-2">
                <Link
                    :href="route('quiz_create')"
                    class="custom px-4 py-2"
                >
                    {{ $t('actions.create') }}
                </Link>
            </div>
        </div>

        <div class="h-full flex flex-wrap content-start justify-between overflow-x-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-slate-900 [&::-webkit-scrollbar-thumb]:bg-slate-500">
            <indexPos
                v-for="quiz in quizes.data"
                :key="quiz.id"
                :quiz="quiz"
            />
        </div>

        <div class="mx-4">
            <PaginationLink 
                :paginator="quizes" 
                class="mb-3"
            />
        </div>
    </div>
</template>