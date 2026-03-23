<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';
import { ref } from 'vue';

const menu = [
    { name: 'dashboard' },
    { name: 'category_index', admin: true },
    { name: 'quiz_index' },
    { name: 'quiz_mylist' },
    { name: 'result_index' },
];

const page = usePage();
const show_flash = ref(!!page.props.flash.message);

if (show_flash.value) {
    setTimeout(() => {
        show_flash.value = false;
    }, 3000);
}
</script>

<template>
    <Head />

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="flex flex-col bg-slate-900 bg-gradient-to-r from-slate-900 to-slate-700 text-white lg:w-70">
            <div class="border-b-4 border-slate-700 p-6 text-2xl font-bold" style="text-transform: capitalize">
                {{ $page.props.name }}
            </div>
            <nav class="my-6 flex-1 space-y-2">
                <div v-for="(item, key) in menu" :key="key">
                    <Link
                        v-if="item.admin === undefined || item.admin === $page.props.auth.admin"
                        :href="route(item.name)"
                        class="block px-4 py-2.5 transition duration-200 hover:bg-slate-700"
                        :class="$page.props.component === item.name ? 'border-l-4 border-white' : ''"
                    >
                        {{ trans('app.nav.' + item.name) }}
                    </Link>
                </div>
            </nav>

            <div class="border-t-4 border-slate-700">
                <Link :href="route('logout')" method="post" class="notlink w-full cursor-pointer py-4 transition duration-200 hover:bg-slate-700">
                    {{ trans('actions.log_out') }}
                </Link>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main
            class="main_layout [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:bg-slate-500 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-slate-900"
        >
            <div v-if="show_flash" class="mb-4">
                <p class="bg-green-100 p-4 text-sm">{{ $page.props.flash.message }}</p>
            </div>

            <slot />
        </main>
    </div>
</template>
