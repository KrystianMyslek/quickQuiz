<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';
    import destroyDialog from '@/pages/components/destroyDialog.vue';    
    import { ref } from 'vue';
    import { trans } from 'laravel-vue-i18n';
    
    const destroyLinkRef = ref()
    const destroyDialogRef = ref()

    defineProps({
        destroyRoute: {
            type: String,
            required: true
        },
        label: {
            type: String,
            default: () => trans('app.confirm_destroy_label')
        },
        content: {
            type: String,
            default: () => trans('app.confirm_destroy_content')
        }
    });

    const confirmedDestroy = ref(false)

    const confirmDestroy = () => {
        if (confirmedDestroy.value) {
            return true;
        } else {
            destroyDialogRef.value.openDestroyDialog(true);
            return false;
        }
    };

    const destroy = () => {
        confirmedDestroy.value = true;
        destroyLinkRef.value.$el.click();
    };
</script>

<template>

    <destroyDialog 
        ref="destroyDialogRef" 
        @confirmedDestroy="destroy" 
        :label="label" 
        :content="content" 
    />

    <Link
        ref="destroyLinkRef"
        :href="destroyRoute"
        :class="'rounded-lg text-slate-500 transition-all hover:text-white cursor-pointer ' + ( $attrs.class )"
        method="delete"
        :onBefore="() => confirmDestroy()"
    >
        {{ $t('actions.delete') }}
    </Link>

</template>
