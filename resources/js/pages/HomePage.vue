<template>
    <div class="h-full w-full bg-black/90 grid grid-cols-3 max-w-screen-xl m-auto">
        <div class="col-span-2 h-full overflow-hidden">
            <TasksList />
        </div>
        <div class="col-span-1 bg-white/5 h-full overflow-hidden">
            <TaskDetail />
        </div>
    </div>
</template>

<script setup lang="ts">
    import { onMounted } from 'vue';
    import { useTasksStore } from '../stores/tasks';
    import TasksList from '../components/TasksList.vue';
    import TaskDetail from '../components/TaskDetail.vue';

    const tasksStore = useTasksStore()
    onMounted(async () => {
        await tasksStore.fetchList()
    })
</script>

<style>
    #app
    {
        height: 100vh;
        width: 100vw;
        overflow-y: hidden;
        position: relative;
        background-color: rgba(0, 0, 0, 0.904);
    }

    ::-webkit-scrollbar
    {
        width: 6px;
    }

    ::-webkit-scrollbar-thumb
    {
        background: #474747ea;
        border-radius: 7px;
    }
</style>