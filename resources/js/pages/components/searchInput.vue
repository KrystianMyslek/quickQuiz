<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { debounce } from 'lodash';
import { ref, watch } from 'vue';

const { searchTerm, route } = defineProps({
    searchTerm: {
        type: String,
        required: true,
    },
    route: {
        type: String,
        required: true,
    },
});

const search = ref(searchTerm);
const isSearchFocused = ref(false);

watch(
    search,
    debounce((searchValue) => {
        router.get(
            route,
            {
                search: searchValue,
                page: 1,
            },
            {
                preserveState: true,
            },
        );
    }, 100),
);
</script>

<template>
    <div class="text-white">
        <div class="w-max">
            <div class="w-full md:w-72">
                <div class="relative h-10 w-full">
                    <div class="text-blue-gray-500 absolute top-2/4 right-3 grid h-5 w-5 -translate-y-2/4 place-items-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            aria-hidden="true"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                            ></path>
                        </svg>
                    </div>
                    <input
                        class="peer border-blue-gray-200 text-blue-gray-700 placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 disabled:bg-blue-gray-50 h-full w-full rounded-[7px] border bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal outline-0 transition-all placeholder-shown:border focus:border-2 focus:border-slate-500 focus:border-t-transparent focus:outline-0 disabled:border-0"
                        placeholder=" "
                        @focus="isSearchFocused = true"
                        @blur="isSearchFocused = false"
                        v-model="search"
                    />
                    <label
                        class="before:content[' '] after:content[' '] before:border-blue-gray-200 after:border-blue-gray-200 peer-placeholder-shown:text-blue-gray-500 peer-disabled:peer-placeholder-shown:text-blue-gray-500 pointer-events-none absolute -top-1.5 left-0 flex h-full w-full truncate !overflow-visible text-[11px] leading-tight font-normal text-gray-500 transition-all select-none peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-slate-500 peer-disabled:text-transparent before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:transition-all peer-placeholder-shown:before:border-transparent peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-slate-500 peer-disabled:before:border-transparent after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:transition-all peer-placeholder-shown:after:border-transparent peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-slate-500 peer-disabled:after:border-transparent"
                        v-if="isSearchFocused || !search"
                        v-html="$t('actions.search')"
                    >
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>
