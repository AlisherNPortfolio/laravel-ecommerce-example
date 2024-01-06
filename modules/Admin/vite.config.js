const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));
import vue from "@vitejs/plugin-vue";
import { quasar, transformAssetUrls } from '@quasar/vite-plugin'

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        outDir: '../../public/admin',
        emptyOutDir: true,
        manifest: true,
        minify: true
    },
    server: {
        host: process.env.VITE_HOST || "multishop.loc",
        port: process.env.VITE_PORT || 8080,
    },
    plugins: [
        vue({
            version: 3,
            template: {
                compilerOptions: {
                    isCustomElement: (tag) => [].includes(tag)
                }
            }
        }),
        quasar({
            sassVariables: './Resources/assets/sass/quasar-variables.sass'
        }),
        laravel({
            hotFile: "../../storage/admin.hot",
            publicDirectory: '../../public',
            buildDirectory: 'admin',
            input: [
                __dirname + '/Resources/assets/css/app.css',
                __dirname + '/Resources/assets/js/app.ts'
            ],
            refresh: true,
        }),
    ],
});
