import { createRouter, createWebHistory } from 'vue-router';
import AdminDashboardView from './views/AdminDashboardView.vue';
import AdminProjectEditorView from './views/AdminProjectEditorView.vue';
import PortfolioView from './views/PortfolioView.vue';
import ProjectDetailView from './views/ProjectDetailView.vue';
import NotFoundView from './views/NotFoundView.vue';

const routes = [
    {
        path: '/',
        name: 'portfolio',
        component: PortfolioView,
    },
    {
        path: '/projects/:slug',
        name: 'project-detail',
        component: ProjectDetailView,
        props: true,
    },
    {
        path: '/adminnopal',
        name: 'admin',
        component: AdminDashboardView,
    },
    {
        path: '/adminnopal/projects/create',
        name: 'admin-project-create',
        component: AdminProjectEditorView,
    },
    {
        path: '/adminnopal/projects/:id/edit',
        name: 'admin-project-edit',
        component: AdminProjectEditorView,
        props: true,
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: NotFoundView,
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
