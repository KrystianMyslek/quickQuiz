<script setup lang="ts">
    import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
    import { ChevronUpIcon } from '@heroicons/vue/20/solid'

    const props =defineProps({
        question: {
            type: Object,
            required: true
        },
        solution: {
            type: Object,
            required: true
        }
    });

    const defaultOpen = (props.question.good_answer_id != props.solution.answer_id);
</script>

<template>
    <div class="border border-slate-500 rounded-md mb-4">
        <Disclosure v-slot="{ open }" :defaultOpen="defaultOpen" >
            <DisclosureButton
                class="flex w-full items-center justify-between rounded-md bg-slate-800 px-4 py-2 text-white hover:bg-slate-700 cursor-pointer"
                >
                    <span>{{ question.content }}</span>
                <ChevronUpIcon
                    :class="open ? 'rotate-180 transform' : ''"
                    class="h-5 w-5"
                />
            </DisclosureButton>
            <DisclosurePanel class="px-4 pb-2 pt-4 text-sm">
                <div 
                    v-if="solution.answer_id == null" 
                    class="mb-4 text-center text-red-600 font-bold"
                >
                    {{ $t('app.result.no_answer_given') }}
                </div>
                <div 
                    v-for="(answer, index) in question.answers" 
                    :key="index" 
                    class="w-1/2 inline-block"
                >
                    <div
                        class="p-6 m-2 border-1 rounded-md shadow-2xl text-center"
                        :class="{
                            'font-bold': answer.is_correct,
                            'border-green-600': answer.id == question.good_answer_id,
                            'border-red-600': answer.id == solution.answer_id && answer.id != question.good_answer_id,
                        }"
                    >
                        {{ answer.content }}
                    </div>
                </div>
            </DisclosurePanel>
        </Disclosure>
    </div>
</template>