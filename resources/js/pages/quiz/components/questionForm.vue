<script setup lang="ts">
    import InputForm from '@/pages/components/inputForm.vue';
    import TextareaForm from '@/pages/components/textareaForm.vue';

    import { Answer } from '@/types';
    import { trans } from 'laravel-vue-i18n';

    import { Disclosure, DisclosureButton, DisclosurePanel, RadioGroup, RadioGroupOption } from '@headlessui/vue'
    import { ChevronUpIcon } from '@heroicons/vue/20/solid'

    const content = defineModel(
        'content', {
            type: String,
            required: true,
        }
    );

    const answers = defineModel(
        'answers', {
            type: Array as () => Array<Answer>,
            required: true,
        },
    );

    const timeToAnswer = defineModel(
        'timeToAnswer', {
            type: Number,
            required: true,
        }
    );

    const score = defineModel(
        'score', {
            type: Number || null,
            required: true,
        }
    );
    
    const goodAnswer = defineModel(
        'goodAnswer', {
            type: Number,
            required: true,
        }
    );

    defineProps({
        index: {
            type: Number,
            required: true
        },
        errors: {
            type: Object
        },
        defaultOpen: {
            type: Boolean,
            default: true,
        },
    });

</script>

<template>
    <div class="border border-slate-500 rounded-md mb-4">
        <Disclosure v-slot="{ open }" :defaultOpen=defaultOpen >
            <DisclosureButton
                class="flex w-full items-center justify-between rounded-md bg-slate-800 px-4 py-2 text-white hover:bg-slate-700 cursor-pointer"
                >
                    <span>{{ content }}</span>
                <ChevronUpIcon
                    :class="open ? 'rotate-180 transform' : ''"
                    class="h-5 w-5"
                />
            </DisclosureButton>
            <DisclosurePanel class="px-4 pb-2 pt-4 text-sm text-gray-500">
                <div class="flex justify-between">
                    <div class="flex-grow mr-8">
                        <TextareaForm
                            upperClass="w-full mb-4"
                            v-model="content"
                            :label="trans('app.question.content')"
                            :rows="4"
                            v-if="errors" :error="errors[`questions.${index}.content`]"
                        />
                    </div>
                    <div>
                        <InputForm
                            upperClass="w-full mb-4"
                            v-model="timeToAnswer"
                            :label="trans('app.question.time_to_answer')"
                            type="number"
                            v-if="errors" :error="errors[`questions.${index}.time_to_answer`]"
                        />
                        
                        <InputForm
                            upperClass="w-full mb-4"
                            v-model="score"
                            :label="trans('app.question.score')"
                            type="number"
                            v-if="errors" :error="errors[`questions.${index}.score`]"
                        />
                    </div>
                </div>

                <div class="w-full">
                    <small class="text-red-600" v-if="errors">{{ errors[`questions.${index}.good_answer.id`] }}</small>

                    <RadioGroup 
                        v-model="goodAnswer"
                    >
                        <RadioGroupOption
                            as="template"
                            v-for="(answer, answerIndex) in answers" 
                            :key="answer.id"
                            :value="answer.id ? answer.id : answerIndex"
                            v-slot="{ checked }"
                        >
                            <div class="w-1/2 inline-block">
                                <div class="m-2">
                                    <div :class="[
                                        checked 
                                        ? 'bg-slate-800 text-white shadow-md' 
                                        : 'bg-transparent hover:bg-slate-700',
                                    ]"
                                        class="relative flex rounded-lg p-5 pr-0"
                                        >
                                        <div class="text-sm w-10/12">
                                            <InputForm
                                                upperClass="w-full"
                                                v-model="answer.content"
                                                :label="trans('app.answer.content')"
                                                v-if="errors" :error="errors[`questions.${index}.answers.${answerIndex}.content`]"
                                            />
                                        </div>
                                        <div v-show="checked" class="shrink-0 text-white w-2/12 items-center justify-center flex">
                                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                                                <circle cx="12" cy="12" r="12" fill="#0f0" fill-opacity="0.2" />
                                                <path d="M7 13l3 3 7-7" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </RadioGroupOption>
                    </RadioGroup>
                </div>
            </DisclosurePanel>
        </Disclosure>
    </div>
</template>