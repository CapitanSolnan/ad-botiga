import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/app.css',
            ],
            refresh: true,
          
        })],
     build: { /* … */ },
 base: process.env.NODE_ENV === 'production'
           ? process.env.APP_URL + '/'
           : '/',
});