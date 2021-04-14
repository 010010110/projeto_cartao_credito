<template>
    <div class="lista fill-height pa-4" style="width: 100%">
        <CadastroCartao v-on:sucesso="getCartoes"></CadastroCartao>

        <v-row v-if="cartoes.length">
            <v-col v-for="(cartao, i) in cartoes" :key="i" class="pa-2" cols="6">
                <v-card>
                    <v-card-text>
                        <v-row>
                            <v-col cols="auto">
                                <CartaoComponent v-bind:cartao="cartao"></CartaoComponent>
                            </v-col>

                            <v-col>
                                <v-row>
                                    <v-col class="d-flex flex-column">
                                        <span
                                            class="caption text-center"
                                            v-bind:class="d_status_cartao[cartao.status].class"
                                            v-text="d_status_cartao[cartao.status].text"
                                        />
                                        <span
                                            class="title"
                                        >• Cartão de {{ d_cartao.find(e => e.value === cartao.tipo).text }}</span>
                                        <span
                                            class="title"
                                        >• Cartão {{ d_cartao_categoria.find(e => e.value === cartao.categoria).text }}</span>
                                        <span
                                            class="title"
                                        >• {{ cartao.bandeira }} {{ cartao.variante }}</span>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col v-if="cartao.status === 'B'" class="py-0">
                                        <v-btn color="primary" block>Ativar cartão</v-btn>
                                    </v-col>
                                    <v-col v-if="cartao.status === 'A'" class="py-0">
                                        <v-btn color="error" outlined block>Cancelar cartão</v-btn>
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row v-else>
            <v-col cols="12">
                <div class="subtitle-1 grey--text text-center">Não há cartões registrados ainda :(</div>
            </v-col>
        </v-row>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

import CartaoComponent from '@/components/Cartao.vue'
import CadastroCartao from '@/components/CadastroCartao.vue'

import { ApiService, Cartao } from '@/services/api-service'

@Component({ components: { CartaoComponent, CadastroCartao } })
export default class Cartoes extends Vue {

    private cartoes: Cartao[] = [];

    private mounted(): void {
        this.getCartoes();
    }

    private getCartoes(): void {
        ApiService.getCartoes().then(({ data }) =>
            this.cartoes = data as Cartao[]
        );
    }

}
</script>

<style lang="scss" scoped>
div.lista {
    user-select: none;
}
</style>