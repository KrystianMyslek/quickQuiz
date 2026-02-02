<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';
    import { trans } from 'laravel-vue-i18n';

    const menu = [
        { name: 'dashboard' },
        { name: 'category_index', admin: true },
        { name: 'quiz_index' },
        { name: 'quiz_mylist' },
        { name: 'result_index' },
    ];
</script>
    
<template>
    <Head />
        
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="flex lg:w-70 flex-col bg-slate-900 text-white bg-gradient-to-r from-slate-900 to-slate-700" >
            <div class="border-b-4 border-slate-700 p-6 text-2xl font-bold" style="text-transform: capitalize;">
                {{ $page.props.name }}
            </div>
            <nav class="flex-1 space-y-2 my-6">
                <div v-for="(item, key) in menu" :key="key">
                    <Link
                        v-if="(item.admin === undefined || item.admin === $page.props.auth.admin)"
                        :href="route(item.name)"
                        class="block px-4 py-2.5 transition duration-200 hover:bg-slate-700 "
                        :class="$page.props.component === item.name ? 'border-l-4 border-white ' : ''"
                        >
                        {{ trans("app.nav." + item.name) }}
                    </Link>
                </div>
            </nav>

            <div class="border-t-4 border-slate-700">
                <Link :href="route('logout')" method="post" class="w-full cursor-pointer py-4 transition duration-200 hover:bg-slate-700 notlink">
                    {{ trans('actions.log_out') }}
                </Link>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="main_layout [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-slate-900 [&::-webkit-scrollbar-thumb]:bg-slate-500" >
            <div v-if="$page.props.flash.message" class="mb-4">
                <p class="p-4 bg-green-100 text-sm">{{ $page.props.flash.message }}</p>
            </div>

            <slot />
        </main>
    </div>
</template>
