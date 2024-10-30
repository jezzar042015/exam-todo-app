<template>
    <div ref="scrollContainer" class="task-list">
        <div class="py-2 text-white/60">{{ label }} &bullet; {{ tasks.length }}</div>
        <div class="flex flex-col gap-2">
            <template v-for="task in visibleTasks" :key="task.id">
                <TaskListItem :task="task" @click="emits('set-selected', task)" />
            </template>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { ref, computed } from 'vue';
    import { useInfiniteScroll } from '@vueuse/core';
    import { Task } from '../types/task';
    import TaskListItem from './TaskListItem.vue';

    const { tasks, label } = defineProps<{
        tasks: Task[];
        label: string;
    }>();

    const emits = defineEmits(['set-selected']);

    // Set up the scroll container reference
    const scrollContainer = ref(null);

    // Set the number of tasks initially visible
    const visibleCount = ref(10);

    // Computed property for the currently visible tasks
    const visibleTasks = computed(() => tasks.slice(0, visibleCount.value));

    // Load more tasks when reaching the end of the scrollable container
    const loadMoreTasks = () => {
        // Increase visible count by 10 or any number you prefer
        visibleCount.value += 10;
    };

    // Set up infinite scroll on the scroll container
    useInfiniteScroll(scrollContainer, loadMoreTasks, {
        distance: 50, // Trigger when 50px from the bottom
    });

</script>

