<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';
    import { trans } from 'laravel-vue-i18n';

    const menu = [
        { name: 'dashboard' },
    ];
</script>

<template>
    <Head :title="$page.component.slice($page.component.indexOf('/')+1).toUpperCase()" />
    
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="flex w-70 flex-col bg-slate-900 text-white bg-gradient-to-r from-slate-900 to-slate-700" >
            <div class="border-b-4 border-slate-700 p-6 text-2xl font-bold">{{ $page.props.name }}</div>

            <nav class="flex-1 space-y-2 my-6">
                <Link
                    v-for="(item, key) in menu"
                    :key="key"
                    :href="route(item.name)"
                    class="block px-4 py-2.5 transition duration-200 hover:bg-slate-700 "
                    :class="$page.component === item.name ? 'border-l-4 border-white ' : ''"
                >
                    {{ trans("app.nav." + item.name) }}
                </Link>
            </nav>

            <div class="border-t-4 border-slate-700">
                <Link :href="route('logout')" method="post" class="w-full cursor-pointer py-4 transition duration-200  hover:bg-slate-700">
                    {{ trans('actions.log_out') }}
                </Link>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto p-10">
            <slot />
        </main>
    </div>
</template>
