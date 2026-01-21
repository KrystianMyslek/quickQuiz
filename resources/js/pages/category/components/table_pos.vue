<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';

    defineProps({
        category: {
            type: Object as () => {
                id: number;
                name: string;
                image?: string;
            },
            required: true
        },
    });

</script>

<template>
    <ConfirmDialog group="headless">
        <template #container="{ message, acceptCallback, rejectCallback }">
            <div class="flex flex-col items-center p-8 bg-surface-0 dark:bg-surface-900 rounded">
                <div class="rounded-full bg-primary text-primary-contrast inline-flex justify-center items-center h-24 w-24 -mt-20">
                    <i class="pi pi-question !text-4xl"></i>
                </div>
                <span class="font-bold text-2xl block mb-2 mt-6">{{ message.header }}</span>
                <p class="mb-0">{{ message.message }}</p>
                <div class="flex items-center gap-2 mt-6">
                    <Button label="Save" @click="acceptCallback" class="w-32"></Button>
                    <Button label="Cancel" variant="outlined" @click="rejectCallback" class="w-32"></Button>
                </div>
            </div>
        </template>
    </ConfirmDialog>

    <tr class="border-b text-white border-slate-500">
        <td class="w-1 px-5 py-3 ">{{ category.id }}</td>
        <td class="w-12">
            <img
                width="40px"
                :src="category.image ? 'storage/' + category.image : 'storage/categories/default.png'"
            />
        </td>
        <td class="px-4 py-2">{{ category.name }}</td>
        <td class="px-4 py-2 w-16">
            <Link
                :href="route('category_edit', { id: category.id })"
                class="mr-3 rounded-lg text-center align-middle text-slate-500 transition-all hover:text-white"
            >
                {{ $t('actions.edit') }}
            </Link>
            <Link
                :href="route('category_destroy', { id: category.id })"
                class="notlink rounded-lg text-center align-middle text-slate-500 transition-all hover:text-white"
                method="delete"
            >
                {{ $t('actions.delete') }}
            </Link>
        </td>
    </tr>
</template>