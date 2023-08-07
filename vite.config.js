import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/landing-page/style.scss',
                // 'resources/js/landing-page/main.js',
                // 'resources/js/landing-page/plugins.js',
            ],
            refresh: true,
        }),
    ],
});
