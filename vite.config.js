import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import fs from 'node:fs';
import path from 'node:path';

function syncPublicBuildPlugin() {
    return {
        name: 'sync-public-build',
        closeBundle() {
            try {
                const distAssets = path.resolve('dist/assets');
                const publicBuildAssets = path.resolve('public/build/assets');
                if (fs.existsSync(distAssets)) {
                    if (!fs.existsSync(publicBuildAssets)) {
                        fs.mkdirSync(publicBuildAssets, { recursive: true });
                    }
                    const oldFiles = fs.readdirSync(publicBuildAssets);
                    for (const f of oldFiles) {
                        fs.unlinkSync(path.join(publicBuildAssets, f));
                    }
                    const files = fs.readdirSync(distAssets);
                    let cssFile = '';
                    let jsFile = '';
                    let imgFile = '';
                    for (const f of files) {
                        fs.copyFileSync(path.join(distAssets, f), path.join(publicBuildAssets, f));
                        if (f.endsWith('.css')) cssFile = `assets/${f}`;
                        if (f.endsWith('.js')) jsFile = `assets/${f}`;
                        if (f.includes('guwe') || f.endsWith('.jpeg') || f.endsWith('.jpg') || f.endsWith('.png')) {
                            imgFile = `assets/${f}`;
                        }
                    }
                    const manifest = {
                        "resources/css/app.css": {
                            "file": cssFile,
                            "name": "app",
                            "names": ["app.css"],
                            "src": "resources/css/app.css",
                            "isEntry": true
                        },
                        "resources/images/guwe.jpeg": {
                            "file": imgFile || "assets/guwe-Yb9gqzOj.jpeg",
                            "src": "resources/images/guwe.jpeg"
                        },
                        "resources/js/app.js": {
                            "file": jsFile,
                            "name": "app",
                            "src": "resources/js/app.js",
                            "isEntry": true,
                            "css": [cssFile],
                            "assets": imgFile ? [imgFile] : []
                        }
                    };
                    fs.writeFileSync(path.resolve('public/build/manifest.json'), JSON.stringify(manifest, null, 2));
                }
            } catch (err) {
                console.error('Failed to sync public/build:', err);
            }
        }
    };
}

export default defineConfig({
    plugins: [
        vue(),
        tailwindcss(),
        syncPublicBuildPlugin(),
    ],
    publicDir: 'public',
    build: {
        outDir: 'dist',
        emptyOutDir: true,
    },
    server: {
        host: '0.0.0.0',
        cors: true,
    },
});
