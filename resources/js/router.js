import { createRouter, createWebHistory } from 'vue-router';
import AdminDashboardView from './views/AdminDashboardView.vue';
import AdminProjectEditorView from './views/AdminProjectEditorView.vue';
import PortfolioView from './views/PortfolioView.vue';
import ProjectDetailView from './views/ProjectDetailView.vue';
import NotFoundView from './views/NotFoundView.vue';
import { updateSeo } from './utils/seo';

const routes = [
    {
        path: '/',
        name: 'portfolio',
        component: PortfolioView,
        meta: {
            title: 'Naufal Tsaqif — Informatics Engineer & Creative Developer',
            description: 'Portfolio of Naufal Tsaqif (IamNopall), an Informatics Engineer and Creative Developer specializing in Unity 3D (C#), spatial computing, Vue 3, Laravel, and high-performance web systems.',
            isNoIndex: false,
        },
    },
    {
        path: '/projects/:slug',
        name: 'project-detail',
        component: ProjectDetailView,
        props: true,
        meta: {
            title: 'Case Study — Naufal Tsaqif',
            description: 'In-depth engineering architectural case study, technical solutions, and interactive breakdown by Naufal Tsaqif.',
            isNoIndex: false,
        },
    },
    {
        path: '/adminnopal',
        name: 'admin',
        component: AdminDashboardView,
        meta: {
            title: 'System Access — Admin Console',
            isNoIndex: true,
        },
    },
    {
        path: '/adminnopal/projects/create',
        name: 'admin-project-create',
        component: AdminProjectEditorView,
        meta: {
            title: 'New Case Study — Admin Console',
            isNoIndex: true,
        },
    },
    {
        path: '/adminnopal/projects/:id/edit',
        name: 'admin-project-edit',
        component: AdminProjectEditorView,
        props: true,
        meta: {
            title: 'Edit Case Study — Admin Console',
            isNoIndex: true,
        },
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: NotFoundView,
        meta: {
            title: '404 Page Not Found — Naufal Tsaqif',
            isNoIndex: true,
        },
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
    updateSeo({
        title: to.meta?.title,
        description: to.meta?.description,
        isNoIndex: !!to.meta?.isNoIndex,
        url: window.location.href,
    });
});

export default router;
