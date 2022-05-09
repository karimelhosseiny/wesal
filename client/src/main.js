import "bootstrap/dist/css/bootstrap.css";

import { createApp } from "vue";
import router from "./router/index";
import { plugin, defaultConfig } from '@formkit/vue'
import App from "./App.vue";


createApp(App).use(router).use(plugin, defaultConfig).mount("#app");

import "bootstrap/dist/js/bootstrap.js";

