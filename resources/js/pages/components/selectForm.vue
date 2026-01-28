<script setup lang="ts">
    import { Listbox, ListboxButton, ListboxOptions, ListboxOption } from '@headlessui/vue'
    import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
    import { capitalize } from 'vue';

    const model = defineModel({
        type: Number,
        required: true,
    });

    defineProps({
        options: {
            type: Object,
            required: true,
        },
        label: {
            type: String,
            required: true,
        },
        type: {
            type: String,
            default: 'text',
        },
        error: String,
    });
</script>

<template>

    <label for="name" class="block text-sm/6 font-medium text-white pb-2">
        {{ capitalize(label) }}
    </label>
    <div>
        <Listbox v-model="model">
            <div class="relative">
                <ListboxButton
                    class="relative w-full cursor-default rounded-md text-white bg-white/5 py-2 pl-3 pr-10 text-left shadow-md sm:text-sm"
                >
                    <span class="block truncate">
                        {{ model ? options.find((c: any) => c.id === model)?.name : $t('app.quiz.select_category') }}
                    </span>
                    <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2" >
                        <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                    </span>
                </ListboxButton>

                <transition
                    leave-active-class="transition duration-100 ease-in"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <ListboxOptions
                        class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                        style="z-index: 1;"
                    >
                        <ListboxOption
                            v-slot="{ active, selected }"
                            v-for="option in options"
                            :key="option.id"
                            :value="option.id"
                            as="template"
                        >
                            <li :class="[active ? 'bg-slate-100 text-slate-900' : 'text-gray-900', 'relative cursor-default select-none py-2 pl-10 pr-4']" >
                                <span :class="[selected ? 'font-medium' : 'font-normal', 'block truncate']" >
                                    {{ option.name }}
                                </span>
                                <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-600" >
                                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                </span>
                            </li>
                        </ListboxOption>
                    </ListboxOptions>
                </transition>
            </div>
        </Listbox>
        <small class="text-red-600" v-if="error">{{ error }}</small>
    </div>
</template>