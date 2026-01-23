<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';
    import destroyDialog from '@/pages/components/destroyDialog.vue';    
    import { ref } from 'vue';

    const destroyLinkRef = ref()
    const destroyDialogRef = ref()

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

    const destroy = () => {
        destroyLinkRef.value?.$el.click();
    };
</script>

<template>

    <destroyDialog 
        ref="destroyDialogRef" 
        @confirmedDestroy="destroy" 
        :label="$t('app.category.confirm_destroy_label')" 
        :content="$t('app.category.confirm_destroy_content')" 
    />

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
            <button 
                @click="destroyDialogRef.openDestroyDialog(true)"
                class="notlink rounded-lg text-center align-middle text-slate-500 transition-all hover:text-white" 
            >
                {{ $t('actions.delete') }}
            </button>
            <Link
                ref="destroyLinkRef"
                :href="route('category_destroy', { id: category.id })"
                method="delete"
                class="hidden"
            >
            </Link>
        </td>
    </tr>
</template>