import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

import { viteStaticCopy } from 'vite-plugin-static-copy'
export default defineConfig({
    build: {
        manifest: true,
        rtl: true,
        outDir: '../dist',
        emptyOutDir: true, // also necessary
        cssCodeSplit: true,
        rollupOptions: {
            output: {
                assetFileNames: (css) => {
                    if (css.name.split('.').pop() == 'css') {
                        return 'css/' + `[name]` + '.min.' + 'css';
                    } else {
                        return 'icons/' + css.name;
                    }
                },
                entryFileNames: 'js/' + `[name]` + `.js`,
            },
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/style.css', 'resources/js/script.js'],
            refresh: true,
        }),

        viteStaticCopy({
            targets: [
                {
                    src: 'resources/css',
                    dest: ''
                },
                {
                    src: 'resources/scss',
                    dest: ''
                },
                {
                    src: 'resources/fonts',
                    dest: ''
                },
                {
                    src: 'resources/img',
                    dest: ''
                },
                {
                    src: 'resources/js',
                    dest: ''
                },
               
                {
                    src: 'resources/plugins',
                    dest: ''
                },
               
            ]
        }),
    ],
});
