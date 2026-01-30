<script setup lang="ts">
    import PaginationLink from '../components/paginationLink.vue';
    import IndexPos from './components/indexPos.vue';

    import { router } from '@inertiajs/vue3';
    import { Quiz } from '@/types/index';
    import { ref, watch } from 'vue';
    import { debounce } from 'lodash';

    const props = defineProps({
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

    const search = ref(props.searchTerm);
    const isSearchFocused = ref(false);

    watch(
        search,
        debounce((searchValue) => {
            router.get('', { 
                search: searchValue 
            }, {
                preserveState: true,
            });
        }, 300)
    );

</script>

<template>
    <div class="h-full flex flex-col gap-6 justify-between">
        <div class="w-full flex items-center justify-between">
            <div class="text-white ml-2">
                <div class="w-max">
                    <div class="w-full md:w-72">
                        <div class="relative h-10 w-full min-w-[200px]">
                            <div
                                class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                                </svg>
                            </div>
                            <input
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-slate-500 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                placeholder=" " 
                                @focus="isSearchFocused = true"
                                @blur="isSearchFocused = false"
                                v-model="search"
                            />
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-slate-500 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-slate-500 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-slate-500 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500"
                                v-if="isSearchFocused || search == ''"
                                v-html="$t('actions.search')"
                            >
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="h-full flex flex-wrap content-start justify-between overflow-x-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-slate-900 [&::-webkit-scrollbar-thumb]:bg-slate-500">
            <IndexPos
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