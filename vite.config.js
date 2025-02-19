import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            resolve: {
                alias: {
                    '@': '/resources/ts',
                },
            },
            refresh: true,
        }),
    ],

});
