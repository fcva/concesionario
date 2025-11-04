<script setup>
import { useModalStore } from '@/Stores/modalStore';

const modalStore = useModalStore()

</script>

<template>
    <Transition name="modal-transition">
        <div v-if="modalStore.isVisible" 
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300">
            <div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-white w-[95%] sm:w-4/5 md:w-3/4 lg:w-2/3 xl:w-1/2 2xl:w-[50%] max-h-[90vh] rounded-xl shadow-xl relative overflow-hidden flex flex-col">
                <slot></slot>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
    .modal-transition-enter-active,
    .modal-transition-leave-active {
        transition: opacity 0.4s;
    }
    .modal-transition-enter-from,
    .modal-transition-leave-to {
        opacity: 0;
    }
</style>