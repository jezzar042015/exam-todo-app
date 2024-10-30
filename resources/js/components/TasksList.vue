<template>
    <div class="text-white py-10 pl-10 pr-5 flex flex-col h-full">
        <div class="pb-6 flex justify-between items-center gap-10">
            <div class="text-3xl font-bold">
                To Do Items
            </div>
            <div class="flex-1 flex px-5">
                <input class="flex-1 bg-transparent border-b border-b-white/30 text-xs text py-1 px-2 outline-none"
                    type="search" placeholder="Search..." v-model="taskStore.filter">
            </div>
            <div>
                <DefaultButton label="Create Task" @click="showCreateForm" />
            </div>
        </div>
        <div class="overflow-y-auto flex-1 pr-3">
            <div class="flex flex-col gap-2">
                <GroupList v-if="taskStore.groups['not-started'].length > 0" label="Not Started"
                    :tasks="taskStore.groups['not-started']" @set-selected="setSelected" />

                <GroupList v-if="taskStore.groups['in-progress'].length > 0" label="In Progress"
                    :tasks="taskStore.groups['in-progress']" @set-selected="setSelected" />

                <GroupList v-if="taskStore.groups['on-hold'].length > 0" label="On Hold"
                    :tasks="taskStore.groups['on-hold']" @set-selected="setSelected" />

                <GroupList v-if="taskStore.groups['completed'].length > 0" label="Completed"
                    :tasks="taskStore.groups['completed']" @set-selected="setSelected" />
            </div>

            <NoTasks v-if="taskStore.tasks.length == 0" />
            <NoTasksFound v-if="taskStore.totalDisplayedItems == 0 && taskStore.tasks.length > 0" />
        </div>
    </div>
    <teleport to="#app">
        <TaskForm :mode="'new'" v-if="createForm" @close="closeCreateForm" @save="createTask" />
    </teleport>
</template>

<script setup lang="ts">
    import { useTasksStore } from '../stores/tasks';
    import { Task } from '../types/task';
    import { ref } from 'vue';
    import DefaultButton from './DefaultButton.vue';
    import TaskForm from './TaskForm.vue';
    import GroupList from './GroupList.vue';
    import NoTasks from './alerts/NoTasks.vue';
    import NoTasksFound from './alerts/NoTasksFound.vue';

    const taskStore = useTasksStore()
    const createForm = ref(false)

    const showCreateForm = () => {
        createForm.value = true
    }

    const closeCreateForm = () => {
        createForm.value = false
    }

    const createTask = async (task: Task) => {
        await taskStore.create(task)
        await taskStore.fetchList()
        createForm.value = false
    }

    const setSelected = (task: Task) => {
        taskStore.selected = task
    }
</script>
