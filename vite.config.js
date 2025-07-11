import { defineConfig } from 'vite';
import { resolve } from 'path'
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import Components from "unplugin-vue-components/vite";
import { PrimeVueResolver } from "@primevue/auto-import-resolver";

export default defineConfig({
    plugins: [
        laravel({
            // input: 'resources/js/app.js',
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        Components({
            resolvers: [PrimeVueResolver()],
        }),
    ],
    resolve: {
        alias: {
            "@": resolve(__dirname, "resources/js"),
        },
    },
});
