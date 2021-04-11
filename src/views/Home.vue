<template>
    <div class="fill-height">
        <v-app-bar color="primary" height="56" flat dark app>
            <v-toolbar-title>Empresinha</v-toolbar-title>
        </v-app-bar>

        <v-navigation-drawer permanent expand-on-hover app>
            <v-list class="pa-0 primary" dense>
                <v-list-item class="px-2" link dark>
                    <v-list-item-avatar class="elevation-1 grey lighten-3">
                        <v-img
                            src="https://img.icons8.com/pastel-glyph/2x/4a90e2/person-male--v2.png"
                        ></v-img>
                    </v-list-item-avatar>

                    <v-list-item-content>
                        <v-list-item-title class="title">{{ usuario.nome }}</v-list-item-title>
                        <v-list-item-subtitle>{{ usuario.email }}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <v-list nav dense>
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
            </v-list>
        </v-navigation-drawer>

        <v-main class="fill-height">
            <v-container class="fill-height" fluid>
                <router-view />
            </v-container>
        </v-main>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { Component } from 'vue-property-decorator'

import { ApiService, Usuario } from '@/services/api-service'

@Component
export default class Home extends Vue {

    private usuario: Usuario = {} as Usuario;

    private beforeMount(): void {
        if (!this.$cookies.isKey('PHPSESSID')) {
            this.$router.push({ name: 'Login' });
        }
    }

    private async mounted(): Promise<void> {
        const { data } = await ApiService.getUser();
        this.usuario = data as Usuario;
    }

}
</script>
