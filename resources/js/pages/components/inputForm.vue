<script setup lang="ts">
    import { capitalize } from 'vue';

    const model = defineModel({
        type: null,
        required: true,
    });

    defineProps({
        label: {
            type: String,
            required: true,
        },
        type: {
            type: String,
            default: 'text',
        },
        labelUpperClass: {
            type: String,
            default: '',
        },  
        upperClass: {
            type: String,
            default: '',
        },  
        error: String,
    });

    const unique = `${Math.random().toString(36).substr(2, 9)}`;
</script>

<template>
    <label :for="unique" :class="`${labelUpperClass}  block text-sm/6 font-medium text-white pb-2`">
        {{ capitalize(label) }}
    </label>
    <div class="mb-2">
        <div :class="`${upperClass} flex items-center rounded-md bg-white/5 pl-3 shadow-md focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500 `" >
            <input
                :id="unique"
                :type="type"
                v-model="model"
                :placeholder="label"
                class="block min-w-0 grow bg-transparent py-1.5 pr-3 pl-1 text-base text-white placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                autocomplete="off"
                @click.stop
            />
        </div>

        <small class="text-red-600" v-if="error">{{ error }}</small>
    </div>
</template>