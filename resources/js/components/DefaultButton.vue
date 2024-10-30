<template>
    <button class="bg-white/10 hover:bg-white/20 py-3 px-8 text-sm rounded-sm transition-colors duration-200">
        <div class="flex justify-center gap-3">
            <span> {{ label }} </span>
        </div>
    </button>
</template>

<script setup lang="ts">
    const { label } = defineProps<{
        label: string
    }>()
</script>
