<template>
    <div :class="mainClasses">
        <div class="w-5 h-5 border rounded-full"></div>
        <div>
            <div class="">{{ task.title }}</div>
            <div class="text-sm text-white/45">{{ task.description }}</div>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { computed } from 'vue';
    import { Task } from '../types/task';
    import { useTasksStore } from '../stores/tasks';

    const { task } = defineProps<{
        task: Task
    }>()

    const taskStore = useTasksStore()

    const mainClasses = computed(() => {
        let bg = 'bg-white/10 hover:bg-white/20'

        if (taskStore.selected && taskStore.selected.id == task.id) {
            bg = 'bg-yellow-600/90'
        }
        return 'px-4 py-3 rounded-md cursor-pointer flex gap-5 items-center transition-color duration-100 ' + bg
    })


</script>
