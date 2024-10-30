<template>
    <div ref="container" :class="classes" @click="showOptions = true">
        {{ task.statusDisplay }}
        <div v-if="showOptions" class="absolute bg-white/15 p-0 left-full ml-1 rounded-sm">
            <ul>
                <li v-for="status in filteredStatuses" :key="status.value" @click.stop="updateStatus(status.value)"
                    class="whitespace-nowrap py-2 px-3 hover:bg-white/35">
                    {{ status.display }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed, ref } from 'vue';
import { onClickOutside } from '@vueuse/core';
import { StatusOptions, Task } from '../types/task';
import { useTasksStore } from '../stores/tasks';

const { task } = defineProps<{ task: Task }>();
const taskStore = useTasksStore();
const showOptions = ref(false);
const container = ref(null);

onClickOutside(container, () => {
    showOptions.value = false;
});

const filteredStatuses = computed(() =>
    taskStore.statusOptions.filter(status => status.value !== task.status)
);

const classes = computed(() =>
    'relative text-xs text-gray-800 cursor-pointer py-1 px-3 min-w-24 h-8 rounded-sm self-start flex items-center justify-center ' + task.status
);

const updateStatus = async (status: StatusOptions) => {
    if (taskStore.selected) {
        taskStore.selected.status = status;
        taskStore.updateStatus(status, taskStore.selected.id);
    }
    showOptions.value = false;
};
</script>

<style scoped>
    .not-started { background-color: #555555; color: #ffffffd2; }
    .in-progress { background-color: #b39c1f; color: #ffffff; }
    .completed { background-color: #007e36; color: #d8d8d8; }
    .on-hold { background-color: #FF8C00; color: #ffffff; }
</style>
