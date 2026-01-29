<script setup lang="ts">
    import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';
    import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline';
    import { ref } from 'vue';

    const open = ref(false);

    const openDestroyDialog = (value : boolean) => {
        open.value = value
    }

    defineProps({
        label: {
            type: String,
            required: true,
        },
        content: {
            type: String,
            required: true,
        },
    });

    defineExpose({ openDestroyDialog })
</script>

<template>
    <TransitionRoot as="template" :show="open">
        <Dialog class="relative z-10" @close="openDestroyDialog(false)">
            <TransitionChild
                as="template"
                enter="ease-out duration-300"
                enter-from="opacity-0"
                enter-to=""
                leave="ease-in duration-200"
                leave-from=""
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-gray-900/50 transition-opacity"></div>
            </TransitionChild>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild
                        as="template"
                        enter="ease-out duration-300"
                        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to=" translate-y-0 sm:scale-100"
                        leave="ease-in duration-200"
                        leave-from=" translate-y-0 sm:scale-100"
                        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    >
                        <DialogPanel
                            class="relative transform overflow-hidden rounded-lg bg-gray-800 text-left shadow-xl outline -outline-offset-1 outline-white/10 transition-all sm:my-8 sm:w-full sm:max-w-lg"
                        >
                            <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div
                                        class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-500/10 sm:mx-0 sm:size-10"
                                    >
                                        <ExclamationTriangleIcon class="size-6 text-red-400" aria-hidden="true" />
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <DialogTitle as="h3" class="text-base font-semibold text-white">{{ label }}</DialogTitle>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-400">{{ content }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-700/25 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button
                                    type="button"
                                    class="bg-red-500 hover:bg-red-400 inline-flex w-full justify-center rounded-md px-3 py-2 text-sm font-semibold text-white sm:ml-3 sm:w-auto cursor-pointer"
                                    @click="openDestroyDialog(false); $emit('confirmedDestroy')"
                                >
                                    {{ $t('actions.delete') }}
                                </button>
                                <button
                                    type="button"
                                    @click="openDestroyDialog(false)"
                                    ref="cancelButtonRef"
                                    class="inline-flex w-full justify-center rounded-md bg-slate-500 px-3 py-2 text-sm font-semibold text-white hover:bg-slate-400 sm:ml-3 sm:w-auto cursor-pointer"
                                >
                                    {{ $t('actions.cancel') }}
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
