<template>
    <div class="fill-height" style="width: 100%">
        <CadastroCartao></CadastroCartao>

        <v-row v-if="cartoes.length">
            <v-col v-for="(cartao, i) in cartoes" :key="i" class="pa-2" cols="6">
                <v-card>
                    <v-card-text class="d-inline-flex">
                        <CartaoComponent
                            :numero="cartao.numero"
                            :data="cartao.data_emissao"
                            :validade="cartao.validade"
                            :titular="cartao.titular"
                        ></CartaoComponent>
                        <v-col class="pa-0">
                            <v-card-actions>
                                <v-spacer></v-spacer>

                                <v-btn color="red" icon>
                                    <v-icon>mdi-close</v-icon>
                                </v-btn>
                            </v-card-actions>
                        </v-col>
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
        ApiService.getCartoes().then(({ data }) =>
            this.cartoes = data as Cartao[]
        );
    }

}
</script>