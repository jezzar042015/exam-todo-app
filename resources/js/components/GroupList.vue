<template>
    <div ref="scrollContainer" class="task-list">
        <div class="py-2 text-white/60">{{ label }} &bullet; {{ tasks.length }}</div>
        <div>
            <TransitionGroup name="list" tag="div" class="flex flex-col gap-2">
                <template v-for="task in visibleTasks" :key="task.id">
                    <TaskListItem :task="task" @click="emits('set-selected', task)" />
                </template>
            </TransitionGroup>
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

    const scrollContainer = ref(null);

    const visibleCount = ref(10);

    const visibleTasks = computed(() => tasks.slice(0, visibleCount.value));

    const loadMoreTasks = () => {
        visibleCount.value += 10;
    };

    useInfiniteScroll(scrollContainer, loadMoreTasks, {
        distance: 50,
    });

</script>

<style scoped>

    .list-enter-active,
    .list-leave-active
    {
        transition: all 0.2s ease;
    }

    .list-enter-from,
    .list-leave-to
    {
        opacity: 0;
        transform: translateX(30px);
    }
</style>
