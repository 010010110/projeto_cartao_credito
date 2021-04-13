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
                <v-list two-line>
                    <v-list-item
                        @click="alert('teste')"
                        v-for="(funcionario, i) in funcionarios"
                        :key="i"
                    >
                        <v-list-item-avatar class="rounded elevation-2" tile>
                            <v-img :src="avatar()"></v-img>
                        </v-list-item-avatar>

                        <v-list-item-content>
                            <v-list-item-title v-text="funcionario.nome"></v-list-item-title>
                            <v-list-item-subtitle v-html="funcionario.email"></v-list-item-subtitle>
                        </v-list-item-content>

                        <v-list-item-action>
                            <v-btn icon>
                                <v-icon color="error">mdi-close</v-icon>
                            </v-btn>
                        </v-list-item-action>
                    </v-list-item>
                </v-list>
            </v-card-text>
        </v-card>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

import { ApiService, Usuario } from '@/services/api-service'

@Component
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