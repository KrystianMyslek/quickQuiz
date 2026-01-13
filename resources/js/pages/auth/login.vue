<script setup lang="ts">
    import layout from '@/layouts/empty_layout.vue';
    import registerInput from '@/pages/auth/component/register_input.vue';
    import { useForm } from '@inertiajs/vue3';

    defineOptions({
        layout,
    });

    const form = useForm({
        email: null,
        password: null,
    });

    const submit = () => {
        form.post('/login');
    };
</script>

<template>
    <div class="mx-auto flex max-w-xl items-center bg-white p-4 md:min-h-screen">
        <div class="grid items-center overflow-hidden rounded-xl [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] w-full">
            <form @submit.prevent="submit" class="mx-auto w-full max-w-lg px-6 py-6 sm:px-14 md:col-span-2">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-slate-900">Zaloguj się</h1>
                </div>

                <div class="space-y-6">
                    <registerInput label="Email" type="email" v-model="form.email" svg="email" :error="form.errors.email" />
                    <registerInput label="Hasło" type="password" v-model="form.password" svg="password" :error="form.errors.password" />
                </div>

                <div class="mt-8">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full cursor-pointer rounded-md bg-slate-800 px-4 py-2.5 text-sm tracking-wider text-white hover:bg-slate-900 focus:outline-none"
                    >
                        Zaloguj się
                    </button>
                </div>
                <p class="mt-6 text-center text-sm text-slate-600">
                    Nie masz konta? <a :href="route('register')" class="ml-1 font-medium text-blue-600 hover:underline">Zarejestruj się</a>
                </p>
            </form>
        </div>
    </div>
</template>
