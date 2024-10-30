<template>
    <div class="flex gap-3 justify-between pt-3 pb-1">
        <button @click="showUpdateForm" class="bg-white/10 py-3 flex-1 text-sm rounded-sm">
            <div class="flex justify-center gap-3">
                <span class="h-5 w-5 opacity-95">
                    <UpdateIcon />
                </span>
                <span> Update</span>
            </div>
        </button>
        <button @click="askDeleteConfirmation"
            class="bg-white/10 py-3 flex-1 text-sm rounded-sm hover:bg-red-600 transition-colors duration-200">
            <div class="flex justify-center gap-3">
                <span class="h-5 w-5 opacity-95">
                    <TrashIcon />
                </span>
                <span> Delete</span>
            </div>
        </button>
    </div>

    <teleport to='#app'>
        <TaskForm :mode="'update'" v-if="showForm" @close="closeUpdateForm" @save="saveUpdates" />
    </teleport>

    <teleport to='#app'>
        <Confirmation :confirm-button="true" :confirm-display="'Delete'" :cancel-button="true"
            :cancel-display="'Cancel'" :title="'Confirm Deletion'"
            :message="'Are you sure to premanently delete this task?'" v-if="showConfirmation"
            @confirm="confirmedDelete" @close-me="showConfirmation = false" />
    </teleport>
</template>

<script setup lang="ts">
    import UpdateIcon from './icons/Update.vue';
    import TrashIcon from './icons/Trash.vue';
    import TaskForm from './TaskForm.vue';
    import Confirmation from './Confirmation.vue';
    import { ref } from 'vue';
    import { useTasksStore } from '../stores/tasks';
    import { Task } from '../types/task';

    const showConfirmation = ref(false)
    const showForm = ref(false)
    const taskStore = useTasksStore()

    const askDeleteConfirmation = () => {
        showConfirmation.value = true
    }

    const showUpdateForm = () => {
        showForm.value = true
    }

    const closeUpdateForm = () => {
        showForm.value = false
    }

    const saveUpdates = async (task: Task, statusDisplay: string) => {
        if (taskStore.selected) {
            taskStore.selected.title = task.title
            taskStore.selected.description = task.description
            taskStore.selected.status = task.status
            task.id = taskStore.selected.id
            await taskStore.update(task)
        }

        showForm.value = false
    }

    const confirmedDelete = async () => {
        await taskStore.trash(taskStore.selected as Task)
        taskStore.selected = null
        await taskStore.fetchList()
        showConfirmation.value = false
    }
</script>
