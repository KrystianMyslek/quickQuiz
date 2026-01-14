<script setup lang="ts">
    import { capitalize, defineAsyncComponent } from 'vue';
    import default_Svg from './svg/name.vue';

    const model = defineModel({
        type: null,
        required: true,
    });

    const props = defineProps({
        label: {
            type: String,
            required: true
        },
        type: {
            type: String,
            required: false,
            default: 'text'
        },
        svg: {
            type: String,
            required: true
        },
        placeholder: {
            type: String,
            required: false,
            default: "",
        },
        error: String
    });

    const Svg = defineAsyncComponent({
        loader: () => import(`./svg/${props.svg.toLowerCase()}.vue`),
        errorComponent: default_Svg
    });
</script>

<template>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-900">{{ capitalize(label) }}</label>
        <div class="relative flex items-center">
            <input
                :type="type"
                v-model="model"
                class="w-full rounded-md border border-slate-300 bg-white py-2.5 pr-8 pl-4 text-sm text-slate-900 outline-blue-500"
                :placeholder="$t('actions.enter') + ' ' + placeholder"
            />
            <component :is="Svg" />
        </div>
        <p class="text-red-500" v-if="error">{{ error }}</p>
    </div>
</template>