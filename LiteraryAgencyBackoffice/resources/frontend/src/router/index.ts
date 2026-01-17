import { createRouter, createWebHistory } from 'vue-router';

import AppLayout from '@/layouts/AppLayout.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';

import BooksList from '@/domains/books/views/BooksList.vue';
import AgenciesList from '@/domains/agencies/views/AgenciesList.vue';
import GenresList from '@/domains/genres/views/GenresList.vue';

import Login from '@/domains/users/views/Login.vue';
import Register from '@/domains/users/views/Register.vue';

const routes = [
  {
    path: '/auth',
    component: AuthLayout,
    children: [
      { path: 'login', name: 'Login', component: Login },
      { path: 'register', name: 'Register', component: Register },
    ],
  },

  {
    path: '/',
    component: AppLayout,
    children: [
      { path: '', redirect: '/books' },
      { path: 'books', name: 'BooksList', component: BooksList },
      { path: 'agencies', name: 'AgenciesList', component: AgenciesList },
      { path: 'genres', name: 'GenresList', component: GenresList },
    ],
  },

  { path: '/:pathMatch(.*)*', redirect: '/auth/login' },
];

export default createRouter({
  history: createWebHistory(),
  routes,
});
