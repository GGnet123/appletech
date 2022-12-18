import Home from "@/components/Home";
import Login from "@/components/Login";
import SignUp from "@/components/SignUp";
import {createRouter, createWebHistory} from "vue-router";
import Update from "@/components/Update";

const routes = [
    {
        name: 'Home',
        component: Home,
        path: '/'
    },
    {
        name: 'SignUp',
        component: SignUp,
        path: '/signup'
    },
    {
        name: 'Login',
        component: Login,
        path: '/login'
    },
    {
        name: 'Update',
        component: Update,
        path: '/product/:id'
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;