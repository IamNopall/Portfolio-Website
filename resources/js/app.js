import { createApp } from 'vue';

import App from './App.vue';
import ProjectsPage from './ProjectsPage.vue';

const path = window.location.pathname.replace(/\/+$/, '') || '/';
const isProjectsPath = path === '/projects' || path.endsWith('/projects');
const rootComponent = isProjectsPath ? ProjectsPage : App;

createApp(rootComponent).mount('#app');