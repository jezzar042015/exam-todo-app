import { createRouter, createWebHistory } from 'vue-router'

import WelcomePage from '../pages/WelcomePage.vue'
import TasksList from '../pages/TasksList.vue'
import TaskDetail from '../pages/TaskDetail.vue'
import TaskForm from '../pages/TaskForm.vue'

const routes = [
    { path: '/', component: WelcomePage },
    { path: '/tasks', component: TasksList },
    { path: '/tasks/:id', component: TaskDetail },
    { path: '/task/form', component: TaskForm },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;