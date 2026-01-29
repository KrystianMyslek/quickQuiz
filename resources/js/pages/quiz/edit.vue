<script setup lang="ts">
    import { Category, Question, Answer, Quiz } from '@/types/index';
    import { useForm } from '@inertiajs/vue3';
    import TextForm from '../components/inputForm.vue';
    import SelectForm from '../components/selectForm.vue';
    import QuestionForm from './components/questionForm.vue';
    import { ref } from 'vue';

    const props = defineProps({
        quiz: {
            type: Object as () => Quiz,
            required: true
        },
        categories: {
            type: Array<Category>,
            required: true
        },
        defaultOpen: {
            type: Boolean,
            default: false,
        },
    });

    const defaultOpen = ref(props.defaultOpen);

    const form = useForm({
        name: props.quiz.name,
        category: props.quiz.category,
        questions: props.quiz.questions,
    });

    const submit = () => {
        form.post(route('quiz_update', { id: props.quiz.id }));
    };
    
    const addQuestion = () => {
        form.questions.push(<Question>{
            content: "",
            answers: Array<Answer>(),
            time_to_answer: 20,
            score: 1,
            good_answer: <Answer>{
                id: 0
            },
        });

        const q_id = form.questions.length - 1;

        form.questions[q_id].answers.push(<Answer>{ content: "" });
        form.questions[q_id].answers.push(<Answer>{ content: "" });
        form.questions[q_id].answers.push(<Answer>{ content: "" });
        form.questions[q_id].answers.push(<Answer>{ content: "" });

        defaultOpen.value = true;
    };  

</script>

<template>
    <form @submit.prevent="submit" >
        <h1 class="text-white text-2xl mb-6">
            {{ $t('app.quiz.edit') }}
        </h1>

        <div class="mr-12 flex justify-between">
            <div class="w-2/5 mb-4">
                <TextForm
                    v-model="form.name"
                    :label="$t('app.quiz.name')"
                    type="text"
                    :error="form.errors.name"
                />
            </div>
            <div class="w-2/5 mb-4">
                <SelectForm
                    v-model="form.category"
                    :options="categories"
                    :label="$t('app.quiz.category')"
                    type="text"
                    :error="form.errors.category"
                />
            </div>
        </div>

        <small class="text-red-600" v-if="form.errors.questions">{{ form.errors.questions }}</small>

        <div class="w-full">
            <QuestionForm 
                v-for="(question, index) in form.questions" 
                :key="index"
                v-model:content="question.content"
                v-model:answers="question.answers"
                v-model:time-to-answer="question.time_to_answer"
                v-model:score="question.score"
                v-model:good-answer="question.good_answer.id"
                :index="index"
                :errors="form.errors"
                :defaultOpen="defaultOpen"
                />
        </div>

        <button class="custom mt-3 px-4 py-2" :disabled="form.processing" @click.prevent="addQuestion" >{{ $t('actions.add_question') }}</button>
        
        <div class="mt-6">
            <button class="custom px-4 py-2" :disabled="form.processing">{{ $t('actions.save') }}</button>
        </div>
    </form>
</template>
