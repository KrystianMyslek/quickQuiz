<script setup lang="ts">
    import QuestionSolve from './components/questionSolve.vue';

    import { Quiz, Solve } from '@/types/index';
    import { useForm } from '@inertiajs/vue3';
    import { ref } from 'vue';

    import layout from '@/layouts/empty_layout.vue';

    defineOptions({
        layout,
    });

    const props = defineProps({
        quiz: {
            type: Object as () => Quiz,
            required: true
        }
    });

    let question_index = 0;
    const active_question = ref(props.quiz.questions[0]);

    const form = useForm({
        solve: Array<Solve>(),
    });

    const submit = () => {
        form.post(route('quiz_verification', { id: props.quiz.id }));
    };
    
    const nextQuestion = (answer_id: number) => {
        form.solve.push(<Solve>{
            question_id: active_question.value.id,
            user_answer_id: answer_id,
        });
        
        question_index += 1;
        if (question_index >= props.quiz.questions.length) {
            submit();
            return;
        }
        
        active_question.value = props.quiz.questions[question_index];
    };  

</script>

<template>
    <div class="h-screen main_layout [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-track]:rounded-full [&::-webkit-scrollbar-track]:bg-slate-900 [&::-webkit-scrollbar-thumb]:bg-slate-500">
        <QuestionSolve
            :key="active_question.id"
            :question="active_question"
            :question_index="question_index"
            :onNextQuestion="nextQuestion"
        />
    </div>
</template>