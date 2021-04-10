import Vue from 'vue'
import VueRouter, { RouteConfig } from 'vue-router'

import Home from '../views/Home.vue'
import About from '@/views/About.vue'

import Auth from '@/views/auth/Auth.vue'
import Login from '@/views/auth/Login.vue'
import Cadastro from '@/views/auth/Cadastro.vue'

Vue.use(VueRouter);

const routes: Array<RouteConfig> = [
    {
        path: '/',
        component: Home,
        children: [
            {
                path: 'about',
                name: 'About',
                component: About
            }
        ]
    },
    {
        path: '/auth',
        name: 'auth',
        component: Auth,
        children: [
            {
                path: 'login',
                name: 'Login',
                component: Login
            },
            {
                path: 'cadastro',
                name: 'Cadastro',
                component: Cadastro
            }
        ]
    }
];

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
});

export default router
