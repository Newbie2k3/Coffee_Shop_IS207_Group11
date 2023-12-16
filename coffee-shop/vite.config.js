import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/assets/css/pages/home.css',
                'resources/assets/css/pages/product-detail.css',
            ],
            refresh: true,
        }),
    ],
});
