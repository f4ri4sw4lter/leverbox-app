import { createRouter, createWebHistory } from 'vue-router';
import TaskList from '@/components/TaskList.vue';
import TaskForm from '@/components/TaskForm.vue';

const routes = [
  { path: '/', component: TaskList },
  { path: '/crear', component: TaskForm },
  { path: '/editar/:id', component: TaskForm, props: true },
];

export const router = createRouter({
  history: createWebHistory(),
  routes,
});
