<template>
    <div class="text-white px-10 pb-10 pt-24 h-full">
        <div v-if="taskStore.selected" class="flex flex-col justify-between h-3/4">
            <div class="flex flex-col h-full">
                <div class="pb-4">
                    <div class="uppercase text-white/60">
                        Task
                    </div>
                    <div class="font-semibold text-2xl py-1">
                        {{ taskStore.selected.title }}
                    </div>
                </div>
                <div class="pb-4">
                    <div class="text-white/60 text-xs">
                        Description
                    </div>
                    <div class="py-1 text-white/90 min-h-28">
                        {{ taskStore.selected.description }}
                    </div>
                </div>

                <div class="flex">
                    <StatusChip v-if="taskStore.selected" :task="taskStore.selected" />
                </div>

                <div class="pt-40">
                    <StatusActions />
                </div>

            </div>

        </div>

        <template v-else>
            <NonSelected v-if="taskStore.tasks.length > 0" />
        </template>

    </div>
</template>

<script setup lang="ts">
    import { useTasksStore } from '../stores/tasks';
    import StatusChip from './StatusChip.vue';
    import StatusActions from './StatusActions.vue';
    import NonSelected from './alerts/NonSelected.vue';

    const taskStore = useTasksStore()
</script>
