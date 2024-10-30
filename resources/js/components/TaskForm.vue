<template>
    <ModalBackground>
        <div
            class="h-3/5 w-2/5 bg-zinc-800 rounded-md text-white py-6 px-8 flex flex-col justify-between shadow-lg shadow-white/5">
            <div>
                <div class="uppercase">
                    {{ titleDisplay }}
                </div>
                <div class="flex flex-col gap-5 pt-6">
                    <div class="flex flex-col gap-3">
                        <label for="task-title" class="text-white/55">Title</label>
                        <input id="task-title" type="text" v-model="model.title" class="bg-white/5 p-2">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="task-description" class="text-white/55">Description</label>
                        <textarea id="task-description" rows="3" v-model="model.description" class="bg-white/5 p-2">
                        </textarea>
                    </div>

                    <div class="flex flex-col gap-3">
                        <label for="task-title" class="text-white/55">Status</label>
                        <div class="flex gap-2">
                            <button v-for="status in taskStore.statusOptions" :key="status.value"
                                @click="setStatus(status.value)" :class="setStatusClass(status.value)">
                                <div class="flex justify-center gap-3">
                                    <span> {{ status.display }} </span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-2 justify-end">
                <DefaultButton v-show="validConfirm" :label="confirmDisplay" @click="save" />
                <DefaultButton label="Discard" @click="emits('close')" />
            </div>
        </div>
    </ModalBackground>
</template>

<script setup lang="ts">
    import { computed, onMounted, ref } from 'vue';
    import { StatusOptions, Task } from '../types/task';
    import { useTasksStore } from '../stores/tasks';
    import ModalBackground from './ModalBackground.vue';
    import DefaultButton from './DefaultButton.vue';

    const { mode } = defineProps<{
        mode: 'new' | 'update'
    }>()
    const taskStore = useTasksStore()
    const emits = defineEmits(['save', 'close'])

    const confirmDisplay = computed(() => {
        return mode == 'new' ? 'Add Task' : 'Save Changes'
    })

    const titleDisplay = computed(() => {
        return mode == 'new' ? 'New Task' : 'Update Task'
    })

    // status handling
    const setStatus = (status: StatusOptions) => {
        model.value.status = status
    }

    const setStatusClass = (status: StatusOptions) => {
        return 'bg-white/10 py-2 px-4 text-sm rounded-sm transition-colors duration-200 transition-all duration-100 ' +
            (model.value.status === status ? '' : 'opacity-20');
    };

    // model used for form binding
    const model = ref<
        Omit<Task, 'id' | 'statusDisplay' | 'created_at' | 'updated_at'>
    >({
        title: '',
        description: '',
        status: 'not-started',
    })

    const validConfirm = computed(() => {
        return model.value.title.length > 0
    })

    const save = async () => {
        emits('save', model.value)
    }

    onMounted(() => {
        if (mode == 'update' && taskStore.selected) {
            model.value.title = taskStore.selected.title
            model.value.description = taskStore.selected.description
            model.value.status = taskStore.selected.status ?? 'in-progress'
        }
    })

</script>
