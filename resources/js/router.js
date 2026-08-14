import { createRouter, createWebHistory } from 'vue-router';
import AdminDashboardView from './views/AdminDashboardView.vue';
import PortfolioView from './views/PortfolioView.vue';

const routes = [
    {
        path: '/',
        name: 'portfolio',
        component: PortfolioView,
    },
    {
        path: '/adminnopal',
        name: 'admin',
        component: AdminDashboardView,
    },
    {
        path: '/:pathMatch(.*)*',
        redirect: '/',
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { top: 0 };
        }
    },
});

export default router;
