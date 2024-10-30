import { defineStore } from 'pinia';
import { computed, ref, watch } from 'vue';
import { StatusOptions, Task } from '../types/task';
import { useAxios } from '../composobles/useAxios';


export const useTasksStore = defineStore('tasks', () => {
    const { get, post, put, del } = useAxios();
    const tasks = ref<Task[]>([]);
    const filter = ref('')

    const statusOptions = ref<{
        value: StatusOptions,
        display: string,
    }[]>([
        { value: 'not-started', display: 'Not Started' },
        { value: 'in-progress', display: 'In Progress' },
        { value: 'completed', display: 'Completed' },
        { value: 'on-hold', display: 'On Hold' },
    ])

    const groups = computed(() => {
        const grouped: Record<StatusOptions, Task[]> = {
            'not-started': [],
            'in-progress': [],
            'on-hold': [],
            'completed': [],
        }

        tasks.value.forEach(task => {
            if (filter.value) {
                const kw = filter.value.toLowerCase()
                const find = task.title.toLowerCase() + (task.description ?? "").toLowerCase()

                if (find.includes(kw))
                    grouped[task.status].push(task);

            } else {
                grouped[task.status].push(task);
            }
        });

        for (const status in grouped) {
            grouped[status as StatusOptions].sort((a, b) => {
                if (!a.created_at) return 1; // Place null dates at the end
                if (!b.created_at) return -1;
                return new Date(b.created_at).getTime() - new Date(a.created_at).getTime();
            });
        }

        return grouped;
    })

    const totalDisplayedItems = computed(() => {
        return groups.value.completed.length + groups.value['in-progress'].length + groups.value['not-started'].length + groups.value['on-hold'].length
    })

    const selected = ref<Task | null>(null)

    const fetchList = async () => {
        try {
            const response = await get('/tasks');
            tasks.value = response.data;
        } catch (error) {
            console.error('Error fetching tasks:', error);
        }
    };

    const create = async (task: Omit<Task, 'id' | 'created_at' | 'updated_at'>) => {
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

    const updateStatus = async (status: StatusOptions, id: number) => {
        try {
            await put(`/tasks-status/${id}`, { status });

            const index = tasks.value.findIndex(t => t.id === id);
            if (index !== -1) {
                tasks.value[index].status = status;
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

    watch(
        () => selected.value?.status,
        (n) => {
            if (!n || !selected.value) return
            const stat = statusOptions.value.find(s => s.value === n)
            if (stat) {
                selected.value.statusDisplay = stat.display
            }
        }
    )

    return {
        tasks, selected, groups, filter, totalDisplayedItems, statusOptions,
        fetchList,
        create,
        update,
        updateStatus,
        trash,
    };
});
