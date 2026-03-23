<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

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
        <main
            class="main_layout [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:bg-slate-500 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-slate-900"
        >
            <div v-if="show_flash" class="mb-4">
                <p class="bg-green-100 p-4 text-sm">{{ $page.props.flash.message }}</p>
            </div>

            <div class="px-4 md:px-20">
                <slot />
            </div>
        </main>
    </div>
</template>
