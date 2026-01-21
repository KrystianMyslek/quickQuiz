<script setup lang="ts">
    import { useForm } from '@inertiajs/vue3';

    const props = defineProps({
        category: {
            type: Object as () => {
                id: number;
                name: string;
                image?: string;
            },
            required: true
        },
    });

    const image_path = props.category.image ?? 'categories/default.png';

    const form = useForm({
        name: props.category.name,
        image: null as File | null,
        preview: null as string | null,
    });

    const change = (e: Event) => {
        if (!(e.target instanceof HTMLInputElement) || !e.target.files) {
            return;
        }

        form.image = e.target.files[0];
        form.preview = URL.createObjectURL(e.target.files[0]);
    };

    const submit = () => {
        form.post(route('category_update', { id: props.category.id }));
    };

</script>

<template>
    <h1 class="text-white text-2xl my-6">{{ $t('app.category.edit') }}</h1>

    <form @submit.prevent="submit">
        <div class="mr-12 flex justify-between ">
            <div class="w-full">
                <label for="name" class="block text-sm/6 font-medium text-white pb-2">
                    {{ $t('app.category.name') }}
                </label>
                <div>
                    <div class="flex items-center rounded-md bg-white/5 pl-3 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-slate-500" >
                        <input
                            id="name"
                            type="text"
                            v-model="form.name"
                            :placeholder="$t('app.category.name')"
                            class="block min-w-0 grow bg-transparent py-1.5 pr-3 pl-1 text-base text-white placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                        />
                    </div>

                    <small class="text-red-600" v-if="form.errors.name">{{ form.errors.name }}</small>
                </div>
            </div>

            <div class="mx-12">
                <div class="relative h-28 w-28 overflow-hidden">
                    <label for="image" class="absolute inset-0 grid cursor-pointer content-end"> </label>
                    <input type="file" @input="change" id="image" hidden />

                    <img class="h-28 w-28 object-cover" :src="form.preview ?? `/storage/${image_path}`" />
                </div>
                <p class="error mt-2">{{ form.errors.image }}</p>
            </div>
        </div>

        <div>
            <button class="px-4 py-2" :disabled="form.processing">{{ $t('actions.save') }}</button>
        </div>
    </form>
</template>
