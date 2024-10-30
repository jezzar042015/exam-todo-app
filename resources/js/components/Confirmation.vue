<template>
    <ModalBackground>
        <div class="h-1/5 w-1/3 bg-zinc-800 rounded-sm text-white py-6 px-8 flex flex-col justify-between">
            <div class="text-white/60">
                {{ title }}
            </div>
            <div class="text-lg">
                {{ message }}
            </div>
            <div class="flex gap-2 justify-end">
                <button v-if="confirmButton" @click="emits('confirm')"
                    class="bg-white/10 py-3 px-8 text-sm rounded-sm transition-colors duration-200">
                    <div class="flex justify-center gap-3">
                        <span> {{ confirmDisplay }}</span>
                    </div>
                </button>

                <button v-if="cancelButton" @click="emits('close-me')"
                    class="bg-white/10 py-3 px-8 text-sm rounded-sm transition-colors duration-200">
                    <div class="flex justify-center gap-3">
                        <span> {{ cancelDisplay }}</span>
                    </div>
                </button>
            </div>
        </div>
    </ModalBackground>
</template>

<script setup lang="ts">
    import ModalBackground from './ModalBackground.vue';

    const {
        title,
        message,
        confirmButton = true,
        confirmDisplay = "Confirm",
        cancelButton = true,
        cancelDisplay = "Cancel"
    } = defineProps<{
        title: string | null
        message: string | null
        confirmButton?: boolean
        confirmDisplay?: string | null
        cancelButton?: boolean
        cancelDisplay?: string | null
    }>()

    const emits = defineEmits(['confirm', 'close-me'])
</script>
