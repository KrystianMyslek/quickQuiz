<script setup lang="ts">
    defineProps({
        paginator: {
            type: Object,
            required: true,
        },
    });

    const makeLabel = (label: string) => {
        if (label.includes('&laquo;')) {
            return '<<';
        } else if (label.includes('&raquo;')) {
            return '>>';
        } else {
            return label;
        }
    };
</script>

<template>
    <div v-if="paginator.last_page > 1" class="flex justify-between items-center">
        <div class="flex items-center overflow-hidden rounded-md shadow-lg bg-gradient-to-r from-slate-700 to-slate-800">
            <div v-for="link in paginator.links" :key="link.url">
                <component
                    :is="link.url ? 'Link' : 'span'"
                    :href="link.url"
                    class="grid h-12 w-12 place-items-center" 
                    :class="{
                        'hover:bg-slate-700 text-slate-500': link.url,
                        'text-black cursor-not-allowed': !link.url,
                        'font-bold text-white': link.active,
                    }"
                >
                    {{ makeLabel(link.label) }}
                </component>
            </div>
        </div>

        <p class="text-slate-600">{{ paginator.from }}&nbsp; - &nbsp;{{ paginator.to }} &nbsp; {{ $t('actions.of') }} &nbsp; {{ paginator.total }}</p>
    </div>
</template>
