import { defineConfig } from "vite";

export default defineConfig({
    build: {
        rollupOptions: {
            input: {
                main: "src/scripts/app.js",
                editor: "src/styles/editor.css",
                app: "src/styles/app.css",
            },
            output: {
                dir: "assets",
                entryFileNames: "scripts/[name].min.js",
                assetFileNames: "styles/[name].min.css",
            },
        },
        emptyOutDir: false,
    },
});
