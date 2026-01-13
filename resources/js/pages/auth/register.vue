<script setup lang="ts">
    import layout from '@/layouts/empty_layout.vue';
    import registerInput from '@/pages/auth/component/register_input.vue';
    import { useForm } from '@inertiajs/vue3';

    defineOptions({
        layout,
    });

    const form = useForm({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
    });

    const submit = () => {
        form.post('/register');
    };
</script>

<template>
    <div class="mx-auto flex max-w-4xl items-center bg-white p-4 md:min-h-screen">
        <div class="grid items-center overflow-hidden rounded-xl [box-shadow:0_2px_10px_-3px_rgba(14,14,14,0.3)] md:grid-cols-3">
            <div
                class="flex min-h-full flex-col justify-center space-y-8 bg-gradient-to-r from-slate-900 to-slate-700 px-4 py-4 max-md:order-1 max-md:mt-16 md:space-y-16 lg:px-8"
            >
                <div>
                    <h3 class="text-lg text-white">Utwórz konto</h3>
                    <p class="mt-3 text-[13px] leading-relaxed text-slate-300">
                        Witam na mojej stronie. Utwórz konto, aby rozpocząć korzystanie z wszystkich funkcji dostępnych dla zarejestrowanych użytkowników.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg text-white">Proste i bezpieczna rejestracja</h3>
                    <p class="mt-3 text-[13px] leading-relaxed text-slate-300">
                        Moja rejestracja jest szybka i bezpieczna. Wystarczy podać kilka podstawowych informacji, a Twoje dane będą chronione zgodnie z najwyższymi standardami bezpieczeństwa.
                    </p>
                </div>
            </div>

            <form @submit.prevent="submit" class="mx-auto w-full max-w-lg px-6 py-6 sm:px-14 md:col-span-2">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-slate-900">Zarejestruj się teraz</h1>
                </div>
                
                <div class="space-y-6">
                    <registerInput label="Imię" v-model="form.name" svg="name" :error="form.errors.name" />
                    <registerInput label="Email" type="email" v-model="form.email" svg="email" :error="form.errors.email" />
                    <registerInput label="Hasło" type="password" v-model="form.password" svg="password" :error="form.errors.password" />
                    <registerInput label="Powtórz hasło" type="password" v-model="form.password_confirmation" svg="password" placeholder="Powtórz hasło" />

                    <!-- <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-slate-300 rounded" />
                        <label for="remember-me" class="ml-3 block text-sm text-slate-600">
                            I accept the <a href="javascript:void(0);" class="text-blue-600 font-medium hover:underline ml-1">Terms and Conditions</a>
                        </label>
                    </div> -->
                </div>

                <div class="mt-8">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full cursor-pointer rounded-md bg-slate-800 px-4 py-2.5 text-sm tracking-wider text-white hover:bg-slate-900 focus:outline-none"
                    >
                        Utwórz konto
                    </button>
                </div>
                <p class="mt-6 text-center text-sm text-slate-600">
                    Masz już konto? <a :href="route('login')" class="ml-1 font-medium text-blue-600 hover:underline">Zaloguj się</a>
                </p>
            </form>
        </div>
    </div>
</template>
