import Vue from 'vue'
import VueRouter, { RouteConfig } from 'vue-router'

import Home from '@/views/Home.vue'

import Faturas from '@/views/user/Faturas.vue'
import Cartoes from '@/views/user/Cartoes.vue'

import Funcionarios from '@/views/admin/Funcionarios.vue'

import Usuarios from '@/views/funcionario/Usuarios.vue'
import Pedidos from '@/views/funcionario/Pedidos.vue'

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
                path: 'faturas',
                name: 'Faturas',
                component: Faturas
            },
            {
                path: 'cartoes',
                name: 'Cartoes',
                component: Cartoes
            },
            {
                path: 'funcionarios',
                name: 'Funcionarios',
                component: Funcionarios
            },
            {
                path: 'usuarios',
                name: 'Usuarios',
                component: Usuarios
            },
            {
                path: 'pedidos',
                name: 'Pedidos',
                component: Pedidos
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
    base: '/',
    routes
});

export default router
