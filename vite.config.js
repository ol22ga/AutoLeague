import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/scss/app.scss', 'resources/css/app.css', 'resources/js/app.js'],
            extract: true,
        }),
    ],
    // build: {
    //     manifest: true,
    //     outDir: 'public/build',
    //     assetsDir: '',
    //     assetsInlineLimit: 0,
    //     cssCodeSplit: true,
    //     minify: true,
    //     sourcemap: false,
    // },
});
