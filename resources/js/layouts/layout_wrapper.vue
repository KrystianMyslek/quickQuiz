<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import guestLayout from '../layouts/guest_layout.vue';
import mainLayout from '../layouts/main_layout.vue';

const page = usePage();
const layout = page.props.auth.user ? mainLayout : guestLayout;
</script>

<template>
    <component :is="layout">
        <slot />
    </component>
</template>
