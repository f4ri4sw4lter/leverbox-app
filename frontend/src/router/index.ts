import { createRouter, createWebHistory } from 'vue-router';
import TareaLista from '@/components/TareaLista.vue';
import TareaForm from '@/components/TareaForm.vue';
import TareaVista from '@/components/TareaVista.vue';

const routes = [
  { path: '/', component: TareaLista },
  { path: '/crear', component: TareaForm },
  { path: '/ver/:id', component: TareaVista, props: true },
  { path: '/editar/:id', component: TareaForm, props: true },
];

export const router = createRouter({
  history: createWebHistory(),
  routes,
});
