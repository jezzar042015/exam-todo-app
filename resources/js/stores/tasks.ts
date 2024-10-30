import { defineStore } from 'pinia';
import { ref } from 'vue';
import { Task } from '../types/task';
import { useAxios } from '../composobles/useAxios';


export const useTasksStore = defineStore('tasks', () => {
    const tasks = ref<Task[]>([]);
    const { get, post, put, del } = useAxios();

    const fetchList = async () => {
        try {
            const response = await get('/tasks');
            tasks.value = response.data;
        } catch (error) {
            console.error('Error fetching tasks:', error);
        }
    };

    const create = async (task: Omit<Task, 'id'>) => {
        try {
            const response = await post('/tasks', task);
            tasks.value.push(response.data);
        } catch (error) {
            console.error('Error creating task:', error);
        }
    };

    const update = async (task: Task) => {
        try {
            const response = await put(`/tasks/${task.id}`, task);
            const index = tasks.value.findIndex(t => t.id === task.id);
            if (index !== -1) {
                tasks.value[index] = response.data;
            }
        } catch (error) {
            console.error('Error updating task:', error);
        }
    };

    const trash = async (task: Task) => {
        try {
            await del(`/tasks/${task.id}`);
            tasks.value = tasks.value.filter(t => t.id !== task.id);
        } catch (error) {
            console.error('Error deleting task:', error);
        }
    };

    return {
        tasks,
        fetchList,
        create,
        update,
        trash,
    };
});
