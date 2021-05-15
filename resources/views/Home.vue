<template>
    <div class="fill-height">
        <v-app-bar color="primary" height="56" flat dark app>
            <v-toolbar-title>Empresinha</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn @click="logout" icon>
                <v-icon>mdi-exit-to-app</v-icon>
            </v-btn>
        </v-app-bar>

        <v-navigation-drawer permanent expand-on-hover app>
            <v-list class="pa-0 primary" dense>
                <v-list-item class="px-2" link dark>
                    <v-list-item-avatar class="elevation-1 grey lighten-3">
                        <v-img :src="url_avatar"></v-img>
                    </v-list-item-avatar>

                    <v-list-item-content>
                        <v-list-item-title class="title">{{ (usuario.pessoa || {}).nome }}</v-list-item-title>
                        <v-list-item-subtitle>{{ usuario.email }}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <v-list nav dense>
                <template v-if="usuario.tipo === 'C'">
                    <v-list-item link :to="{ name: 'Faturas' }">
                        <v-list-item-icon>
                            <v-icon>mdi-file-document-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Faturas</v-list-item-title>
                    </v-list-item>
                    <v-list-item link :to="{ name: 'Cartoes' }">
                        <v-list-item-icon>
                            <v-icon>mdi-credit-card-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Cartões</v-list-item-title>
                    </v-list-item>
                </template>
                <template v-if="usuario.tipo === 'A'">
                    <v-list-item link :to="{ name: 'Funcionarios' }">
                        <v-list-item-icon>
                            <v-icon>mdi-account-multiple-plus-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Funcionários</v-list-item-title>
                    </v-list-item>
                </template>
                <template v-if="usuario.tipo === 'F'">
                    <v-list-item link :to="{ name: 'Usuarios' }">
                        <v-list-item-icon>
                            <v-icon>mdi-account-check-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Usuários</v-list-item-title>
                    </v-list-item>
                    <v-list-item link :to="{ name: 'Pedidos' }">
                        <v-list-item-icon>
                            <v-icon>mdi-checkbox-marked-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Aguardando aprovação</v-list-item-title>
                    </v-list-item>
                </template>
            </v-list>
        </v-navigation-drawer>

        <v-main class="fill-height">
            <v-container class="fill-height pa-0" fluid>
                <router-view />
            </v-container>
        </v-main>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { Component } from 'vue-property-decorator'

import { ApiService, TipoUsuario, Usuario } from '@/services/api-service'

@Component
export default class Home extends Vue {

    private usuario: Usuario = {} as Usuario;

    private url_avatar: string = this.avatar();

    private beforeMount(): void {
        if (!localStorage['token']) {
            this.$router.push({ name: 'Login' });
        }
    }

    private async mounted(): Promise<void> {
        const { data } = await ApiService.getUser();
        this.usuario = data as Usuario;

        if (!this.$route.name) {
            if (this.usuario.tipo === TipoUsuario.CLIENTE) {
                this.$router.push({ name: 'Faturas' });
            }

            if (this.usuario.tipo === TipoUsuario.ADMIN) {
                this.$router.push({ name: 'Funcionarios' });
            }

            if (this.usuario.tipo === TipoUsuario.FUNCIONARIO) {
                this.$router.push({ name: 'Usuarios' });
            }
        }
    }

    private logout(): void {
        ApiService.logout().then(() => {
            localStorage.removeItem('token');
            this.$router.push({ name: 'auth' });
        });
    }

}
</script>
