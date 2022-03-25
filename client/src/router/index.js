import { createRouter, createWebHistory } from "vue-router";
import SignupPage from "../components/local/SignupPage.vue";
import LoginPage from "../components/local/LoginPage.vue";
import HomePage from "../components/local/HomePage.vue";

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
        path:'/home',
        name:'HomePage',
        component:HomePage
    }
];
const router = createRouter({
    history:createWebHistory(),
    routes,
});

export default router;
