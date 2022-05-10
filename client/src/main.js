import "bootstrap/dist/css/bootstrap.css";

import { createApp } from "vue";
import { createPinia } from "pinia";
import { useUserStore } from "./store/UserStore";
import router from "./router";
import App from "./App.vue";

const app = createApp(App)
app.use(createPinia())
app.use(router)
const userStore = useUserStore()
app.mount("#app")


import "bootstrap/dist/js/bootstrap.js";

