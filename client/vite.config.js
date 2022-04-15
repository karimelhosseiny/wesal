import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [vue()],
    server: {
        host: "0.0.0.0",
    },
    proxy: {
        "/api": {
          ws: true,
          changeOrigin: true,
          target: "http://127.0.0.1:8000"
        }
      }
});
