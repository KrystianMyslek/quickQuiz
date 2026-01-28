<script setup lang="ts">
    import { useForm } from '@inertiajs/vue3';
    import InputForm from '../components/inputForm.vue';

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
    <form @submit.prevent="submit">
        <h1 class="text-white text-2xl mb-6">
            {{ $t('app.category.edit') }}
        </h1>

        <div class="mr-12 flex justify-between ">
            <div class="w-2/5 mb-4">
                <InputForm
                    v-model="form.name"
                    :label="$t('app.category.name')"
                    type="text"
                    :error="form.errors.name"
                />
            </div>

            <div class="align-end">
                <div class="relative h-28 w-28 overflow-hidden">
                    <label for="image" class="absolute inset-0 grid cursor-pointer content-end"> </label>
                    <input type="file" @input="change" id="image" hidden />

                    <img class="h-28 w-28 object-cover" :src="form.preview ?? `/storage/${image_path}`" />
                </div>
                <p class="error mt-2">{{ form.errors.image }}</p>
            </div>
        </div>

        <div>
            <button class="custom px-4 py-2" :disabled="form.processing">{{ $t('actions.save') }}</button>
        </div>
    </form>
</template>
