<template>
    <div class="fill-height" style="width: 100%">
        <div class="display-1 font-weight-bold text-center pa-4">Seus cartões</div>
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
        <div class="subtitle-1 grey--text text-center" v-else>Não há cartões registrados ainda :(</div>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

import CartaoComponent from '@/components/Cartao.vue'

import { Cartao } from '@/services/api-service'

@Component({ components: { CartaoComponent } })
export default class Cartoes extends Vue {

    private cartoes: Cartao[] = [];

}
</script>