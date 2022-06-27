import { createRouter, createWebHistory } from "vue-router";
import SignupPage from "../components/local/SignupPage.vue";
import LoginPage from "../components/local/LoginPage.vue";
import HomePage from "../components/local/HomePage.vue";
import CasePage from "../components/local/CasePage.vue";
import OrganizationProfile from "../components/local/OrganizationProfile.vue";
import UserProfile from "../components/local/UserProfile.vue";
import AdminDashboard from "../components/local/AdminDashboard.vue"
import { useUserStore } from "../store/UserStore";
import CasesDashboard from "../components/local/CasesDashboard.vue"
import AllOrganizations from "../components/local/AllOrganizations.vue"


const routes = [
    {
        path: "/",
        redirect: "/home",
    },
    {
        path: "/home",
        name: "HomePage",
        component: HomePage,
        meta: { requiresAuth: true },
    },
    {
        path: "/login",
        name: "LoginPage",
        meta: {isGuest: true},
        component: LoginPage,
        meta: {isGuest: true},
    },
    {
        path: "/signup",
        name: "SignupPage",
        component: SignupPage,
        meta: {isGuest: true},
    },
    {
        path: "/casepage/:id",
        name: "CasePage",
        component: CasePage,
    },
    {
        path: "/profile",
        name: "UserProfile",
        component: UserProfile,
    },
    {
        path: "/organization/:id",
        name: "OrganizationProfile",
        component: OrganizationProfile,
    },
    {
        path: "/admindashboard",
        name: "AdminDashboard",
        component:AdminDashboard,

    },
    {
        path: "/casesdashboard",
        name: "CasesDashboard",
        component: CasesDashboard
    },
    {
        path: "/allorganizations",
        name: "AllOrganizations",
        component: AllOrganizations,
    }
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const store = useUserStore()
    if (to.meta.requiresAuth && !store.$state.token) {
        next({ name: "LoginPage" })
    } else if(store.$state.token && to.meta.isGuest) {
        next({name:'HomePage'})
    }
    else{
        next()
    }
});


export default router;
