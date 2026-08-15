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
        meta: { title: 'Naufal Tsaqif Portfolio' },
    },
    {
        path: '/projects/:slug',
        name: 'project-detail',
        component: ProjectDetailView,
        props: true,
        meta: { title: 'Case Study - Naufal Tsaqif' },
    },
    {
        path: '/adminnopal',
        name: 'admin',
        component: AdminDashboardView,
        meta: { title: 'System Access - Admin Console' },
    },
    {
        path: '/adminnopal/projects/create',
        name: 'admin-project-create',
        component: AdminProjectEditorView,
        meta: { title: 'New Case Study - Admin Console' },
    },
    {
        path: '/adminnopal/projects/:id/edit',
        name: 'admin-project-edit',
        component: AdminProjectEditorView,
        props: true,
        meta: { title: 'Edit Case Study - Admin Console' },
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: NotFoundView,
        meta: { title: '404 Not Found' },
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

router.afterEach((to) => {
    if (to.meta && to.meta.title) {
        document.title = to.meta.title;
    }
});

export default router;
