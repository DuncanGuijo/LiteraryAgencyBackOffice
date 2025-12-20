import { createRouter, createWebHistory } from 'vue-router';
import BooksList from '@/domains/books/views/BooksList.vue';
// import AuthorsList from '@/domains/authors/views/AuthorsList.vue';
import AgenciesList from '@/domains/agencies/views/AgenciesList.vue';
import GenresList from '@/domains/genres/views/GenresList.vue';
import Login from '@/domains/users/views/Login.vue';

const routes = [
  { 
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/',
    redirect: '/books',
  },
  {
    path: '/books',
    name: 'BooksList',
    component: BooksList,
  },
/*   {
    path: '/authors',
    name: 'AuthorsList',
    component: AuthorsList,
  }, */
  {
    path: '/agencies',
    name: 'AgenciesList',
    component: AgenciesList,
  },
  {
    path: '/genres',
    name: 'GenresList',
    component: GenresList,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
