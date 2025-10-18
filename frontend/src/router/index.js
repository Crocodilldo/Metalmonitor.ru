import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue';
import CatalogView from '@/views/CatalogView.vue';
import MainLayout from '@/layouts/MainLayout.vue';
import GOSTsView from '@/views/GOSTsView.vue';
import ArticlesView from '@/views/ArticlesView.vue';
import ContactsView from '@/views/ContactsView.vue';
import AdminLayout from '@/layouts/AdminLayout.vue';
import AdminPanel from '@/views/AdminPanel.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: MainLayout,
      children: [
        {
          path: '',
          name: 'home',
          component: HomeView
        },

        {
          path: 'catalog',
          name: 'catalog',
          component: CatalogView
        },
        {
          path: 'tools/GOSTs',
          name: 'gosts',
          component: GOSTsView
        },
        {
          path: 'articles',
          name: 'articles',
          component: ArticlesView
        },
        {
          path: 'contacts',
          name: 'contacts',
          component: ContactsView
        }
      ]
    },
    {
      path: '/admin',
      component: AdminLayout,
      meta: { requiresAuth: true },
      children: [
        {
          path: '',
          name: 'adminDashboard',
          component: AdminPanel
        },
      ]
    },
  ],
})

export default router
