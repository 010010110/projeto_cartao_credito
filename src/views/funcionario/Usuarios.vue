<template>
    <div class="fill-height pa-2" style="width: 100%">
        <v-card>
            <v-card-title>
                <span>Usuários</span>
            </v-card-title>
            <v-card-text class="pa-0">
                <ListaUsuarios v-bind:usuarios="usuarios" v-slot="{ usuario }">
                    <v-col v-if="usuario.status === 'A'" class="pa-0 px-2" cols="2">
                        <ConfirmDialog
                            title="Deseja inativar o usuário?"
                            v-slot="{ on, attrs }"
                            v-on:accept="inativar(usuario)"
                        >
                            <v-btn v-on="on" v-bind="attrs" color="error" outlined block>Inativar</v-btn>
                        </ConfirmDialog>
                    </v-col>
                    <template v-if="usuario.status === 'I'">
                        <v-col class="pa-0 px-2" cols="1">
                            <ConfirmDialog
                                title="Deseja recusar o usuário?"
                                v-slot="{ on, attrs }"
                                v-on:accept="recusar(usuario)"
                            >
                                <v-btn
                                    v-on="on"
                                    v-bind="attrs"
                                    color="warning"
                                    outlined
                                    block
                                >Recusar</v-btn>
                            </ConfirmDialog>
                        </v-col>
                        <v-col class="pa-0 px-2" cols="1">
                            <ConfirmDialog
                                title="Deseja ativar o usuário?"
                                v-slot="{ on, attrs }"
                                v-on:accept="ativar(usuario)"
                            >
                                <v-btn
                                    v-on="on"
                                    v-bind="attrs"
                                    color="success"
                                    outlined
                                    block
                                >Ativar</v-btn>
                            </ConfirmDialog>
                        </v-col>
                    </template>
                </ListaUsuarios>
            </v-card-text>
        </v-card>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

import ListaUsuarios from '@/components/ListaUsuarios.vue'
import ConfirmDialog from '@/components/ConfirmDialog.vue'

import { ApiService, Usuario } from '@/services/api-service'

@Component({ components: { ListaUsuarios, ConfirmDialog } })
export default class Usuarios extends Vue {

    private usuarios: Usuario[] = [];

    private mounted(): void {
        this.getUsuarios();
    }

    private inativar(usuario: Usuario): void {
        ApiService.updateUser(usuario.id as string, 'I')
            .then(({ data }) => {
                return this.getUsuarios().then(() =>
                    this.$root.$emit('snackbar', data.message, 3000, 'success')
                );
            })
            .catch((error: Error) =>
                this.$root.$emit('snackbar', error.message, 3000, 'error')
            )
    }

    private recusar(usuario: Usuario): void {
        ApiService.updateUser(usuario.id as string, 'R')
            .then(({ data }) => {
                return this.getUsuarios().then(() =>
                    this.$root.$emit('snackbar', data.message, 3000, 'success')
                );
            })
            .catch((error: Error) =>
                this.$root.$emit('snackbar', error.message, 3000, 'error')
            );
    }

    private ativar(usuario: Usuario): void {
        ApiService.updateUser(usuario.id as string, 'A')
            .then(({ data }) => {
                return this.getUsuarios().then(() =>
                    this.$root.$emit('snackbar', data.message, 3000, 'success')
                );
            })
            .catch((error: Error) =>
                this.$root.$emit('snackbar', error.message, 3000, 'error')
            );
    }

    private getUsuarios(): Promise<Usuario[]> {
        return ApiService.getUsuarios()
            .then(({ data }) =>
                this.usuarios = data as Usuario[]
            );
    }

}
</script>