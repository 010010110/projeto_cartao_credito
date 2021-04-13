<template>
    <div class="fill-height pa-2" style="width: 100%">
        <v-card>
            <v-card-title>
                <span>Usuários</span>
            </v-card-title>
            <v-card-text class="pa-0">
                <ListaUsuarios v-bind:usuarios="usuarios" v-slot="{ usuario }">
                    <v-col v-if="usuario.status === 'A'" class="pa-0 px-2" cols="2">
                        <v-btn color="error" outlined block>Inativar</v-btn>
                    </v-col>
                    <template v-else-if="usuario.status === 'I'">
                        <v-col class="pa-0 px-2" cols="1">
                            <v-btn color="warning" outlined block>Recusar</v-btn>
                        </v-col>
                        <v-col class="pa-0 px-2" cols="1">
                            <v-btn color="success" outlined block>Ativar</v-btn>
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
import { ApiService, Usuario } from '@/services/api-service'

@Component({ components: { ListaUsuarios } })
export default class Usuarios extends Vue {

    private usuarios: Usuario[] = [];

    private mounted(): void {
        ApiService.getUsuarios()
            .then(({ data }) =>
                this.usuarios = data as Usuario[]
            );
    }

}
</script>