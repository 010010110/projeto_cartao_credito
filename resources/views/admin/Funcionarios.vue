<template>
    <div class="fill-height pa-2" style="width: 100%">
        <v-card>
            <v-card-title>
                <span>Funcionários</span>
                <v-spacer></v-spacer>
                <v-btn color="success" outlined>
                    <v-icon left>mdi-plus</v-icon>
                    <span>Incluir funcionário</span>
                </v-btn>
            </v-card-title>
            <v-card-text class="pa-0">
                <ListaUsuarios v-bind:usuarios="funcionarios" v-slot="{ usuario }">
                    <v-col v-if="usuario.status === 'A'" class="pa-0 px-2" cols="2">
                        <v-btn color="error" outlined block>Inativar</v-btn>
                    </v-col>
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
export default class Funcionarios extends Vue {

    private funcionarios: Usuario[] = [];

    private mounted(): void {
        ApiService.getFuncionarios()
            .then(({ data }) =>
                this.funcionarios = data as Usuario[]
            );
    }

}
</script>