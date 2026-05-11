<script setup lang="ts">
defineProps({
    id: {
        type: Number,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="route('quiz_solve', { id: id })"
        class="flex items-center rounded-md border-1 border-slate-500 p-4 text-slate-500 shadow-2xl transition-all hover:bg-slate-800 hover:text-white"
    >
        {{ $t('actions.solve') }}
    </Link>
</template>
