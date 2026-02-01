<script setup lang="ts">
    import { Question } from '@/types/index';
    import { RadioGroup, RadioGroupOption } from '@headlessui/vue'
    import { ref, onUnmounted } from 'vue';

    const emit = defineEmits(['next-question', 'update:modelValue'])

    const props = defineProps({
        question: {
            type: Object as () => Question,
            required: true
        }
    });

    const count = ref(props.question.time_to_answer)
    const timer = setInterval(() => {
        if (count.value > 0) count.value--
        else {
            clearInterval(timer);
            emit('next-question', 0);
        }
    }, 1000)
    

    onUnmounted(() => clearInterval(timer))
</script>

<template>
    <div class="text-white">
        <div class="flex">
            <div class="flex-1 border-1 border-slate-500 rounded-md shadow-2xl mb-6 text-2xl p-8">
                {{ question.content }}
            </div>
            <div class="ml-8 w-24 border-1 border-slate-500 rounded-full shadow-2xl mb-6 text-5xl justify-center items-center flex">
                {{ count }}
            </div>
        </div>
        <RadioGroup
            class="flex flex-wrap content-start justify-between text-center"
        >
            <RadioGroupOption
                as="template"
                v-for="(answer) in question.answers" 
                :key="answer.id"
                :value="answer.id"
                @click="$emit('next-question', answer.id)"
            >
                <div class="w-[50%]">
                    <div class="border-1 border-slate-500 rounded-md shadow-2xl m-4 px-5 py-12 hover:bg-slate-800 cursor-pointer">
                        {{ answer.content }}
                    </div>
                </div>
            </RadioGroupOption>
        </RadioGroup>
    </div>
</template>