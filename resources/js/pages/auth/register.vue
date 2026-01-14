<script setup lang="ts">
    import layout from '@/layouts/empty_layout.vue';
    import registerInput from '@/pages/auth/component/register_input.vue';
    import { useForm } from '@inertiajs/vue3';
    // import { wTrans } from 'laravel-vue-i18n';

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
                    <h3 class="text-lg text-white">{{ $t('app.register.create_account_label') }}</h3>
                    <p class="mt-3 text-[13px] leading-relaxed text-slate-300">
                        {{ $t('app.register.create_account_text') }}
                    </p>
                </div>
                <div>
                    <h3 class="text-lg text-white">{{ $t('app.register.safety_label') }}</h3>
                    <p class="mt-3 text-[13px] leading-relaxed text-slate-300">
                        {{ $t('app.register.safety_text') }}
                    </p>
                </div>
            </div>

            <form @submit.prevent="submit" class="mx-auto w-full max-w-lg px-6 py-6 sm:px-14 md:col-span-2">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-slate-900">{{ $t('app.register.title') }}</h1>
                </div>
                
                <div class="space-y-6">
                    <registerInput :label="$t('app.register.name')" v-model="form.name" svg="name" :error="form.errors.name" :placeholder="$t('app.register.name')" />
                    <registerInput :label="$t('app.register.email')" type="email" v-model="form.email" svg="email" :error="form.errors.email" :placeholder="$t('app.register.email')" />
                    <registerInput :label="$t('app.register.password')" type="password" v-model="form.password" svg="password" :error="form.errors.password" :placeholder="$t('app.register.password')" />
                    <registerInput :label="$t('app.register.password_confirmation')" type="password" v-model="form.password_confirmation" svg="password" :placeholder="$t('app.register.password')" />
                </div>

                <div class="mt-8">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full cursor-pointer rounded-md bg-slate-800 px-4 py-2.5 text-sm tracking-wider text-white hover:bg-slate-900 focus:outline-none"
                    >
                        {{ $t('app.register.create_account_label') }}
                    </button>
                </div>
                <p class="mt-6 text-center text-sm text-slate-600">
                    {{ $t('app.register.already_have_account') }} <a :href="route('login')" class="ml-1 font-medium text-blue-600 hover:underline">{{ $t('actions.log_in') }}</a>
                </p>
            </form>
        </div>
    </div>
</template>
