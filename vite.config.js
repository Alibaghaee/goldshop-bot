import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue2'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/js/app.js',
                'resources/assets/js/app-site.js',
                'resources/assets/sass/app.scss',
                'resources/assets/sass/app-site.scss'
            ],
            refresh: true,
        }),
        vue()
    ],
    resolve: {
        alias: {
            // vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
