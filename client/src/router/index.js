import { createRouter, createWebHistory } from "vue-router";
import SignupPage from "../components/local/SignupPage.vue";
import LoginPage from "../components/local/LoginPage.vue";
import HomePage from "../components/local/HomePage.vue";
import CasePage from "../components/local/CasePage.vue"
const routes = [
    {
        path: "/",
        name: "SignupPage",
        component: SignupPage,
    },
    {
        path: "/login",
        name: "LoginPage",
        component: LoginPage,
    },
    {
        path: '/home',
        name: 'HomePage',
        component: HomePage
    },
    {
        path: '/casepage',
        name: 'CasePage',
        component: CasePage
    }
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
