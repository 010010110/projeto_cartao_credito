<template>
    <div class="fill-height pa-2" style="width: 100%">
        <v-card>
            <v-card-title>
                <span>Cartões</span>
            </v-card-title>
            <v-card-text class="pa-0">
                <v-text-field class="px-4" label="CPF do titular" v-model="documento"></v-text-field>
                <ListaCartoes
                    v-bind:cartoes="pedidos.filter(({ pessoa }) => pessoa.documento.startsWith(documento))"
                    v-slot="{ cartao }"
                >
                    <template v-if="cartao.status === 'A'">
                        <v-col class="pa-0 px-2" cols="1">
                            <ConfirmDialog
                                title="Deseja cancelar o cartão?"
                                v-slot="{ on, attrs }"
                                v-on:accept="cancelar(cartao)"
                            >
                                <v-btn
                                    v-on="on"
                                    v-bind="attrs"
                                    color="error"
                                    outlined
                                    block
                                >Cancelar</v-btn>
                            </ConfirmDialog>
                        </v-col>
                        <v-col class="pa-0 px-2" cols="1">
                            <ConfirmDialog
                                title="Deseja bloquear o cartão?"
                                v-slot="{ on, attrs }"
                                v-on:accept="bloquear(cartao)"
                            >
                                <v-btn
                                    v-on="on"
                                    v-bind="attrs"
                                    color="primary"
                                    outlined
                                    block
                                >Bloquear</v-btn>
                            </ConfirmDialog>
                        </v-col>
                    </template>
                    <template v-if="['P', 'B'].includes(cartao.status)">
                        <v-col v-if="cartao.status === 'P'" class="pa-0 px-2" cols="1">
                            <ConfirmDialog
                                title="Deseja recusar o cartão?"
                                v-slot="{ on, attrs }"
                                v-on:accept="recusar(cartao)"
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
                                title="Deseja ativar o cartão?"
                                v-slot="{ on, attrs }"
                                v-on:accept="ativar(cartao)"
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
                </ListaCartoes>
            </v-card-text>
        </v-card>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

import ListaCartoes from '@/components/ListaCartoes.vue'
import ConfirmDialog from '@/components/ConfirmDialog.vue'

import { ApiService, Cartao } from '@/services/api-service'

@Component({ components: { ListaCartoes, ConfirmDialog } })
export default class Pedidos extends Vue {

    private pedidos: Cartao[] = [];

    private documento: string = '';

    private mounted(): void {
        this.getPedidos();
    }

    private cancelar(cartao: Cartao) {
        ApiService.updateCartao(cartao.id, 'C')
            .then(({ data }) => {
                return this.getPedidos().then(() =>
                    this.$root.$emit('snackbar', 'Cartão cancelado com sucesso', 3000, 'success')
                );
            })
            .catch((error: Error) =>
                this.$root.$emit('snackbar', error.message, 3000, 'error')
            );
    }

    private bloquear(cartao: Cartao) {
        ApiService.updateCartao(cartao.id, 'B')
            .then(({ data }) => {
                return this.getPedidos().then(() =>
                    this.$root.$emit('snackbar', 'Cartão bloqueado com sucesso', 3000, 'success')
                );
            })
            .catch((error: Error) =>
                this.$root.$emit('snackbar', error.message, 3000, 'error')
            );
    }

    private recusar(cartao: Cartao) {
        ApiService.updateCartao(cartao.id, 'R')
            .then(({ data }) => {
                return this.getPedidos().then(() =>
                    this.$root.$emit('snackbar', 'Cartão recusado com sucesso', 3000, 'success')
                );
            })
            .catch((error: Error) =>
                this.$root.$emit('snackbar', error.message, 3000, 'error')
            );
    }

    private ativar(cartao: Cartao) {
        ApiService.updateCartao(cartao.id, 'A')
            .then(({ data }) => {
                return this.getPedidos().then(() =>
                    this.$root.$emit('snackbar', 'Cartão ativado com sucesso', 3000, 'success')
                );
            })
            .catch((error: Error) =>
                this.$root.$emit('snackbar', error.message, 3000, 'error')
            );
    }

    private getPedidos(): Promise<Cartao[]> {
        return ApiService.getPedidos()
            .then(({ data }) =>
                this.pedidos = data as Cartao[]
            );
    }

}
</script>