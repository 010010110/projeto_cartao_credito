<template>
    <v-list three-line>
        <template v-for="(cartao, i) in cartoes">
            <v-divider v-if="i > 0" :key="i" inset></v-divider>

            <v-list-item :key="'c' + i">
                <v-list-item-avatar tile>
                    <v-img :src="require(`@/assets/${cartao.imagem}.png`)"></v-img>
                </v-list-item-avatar>

                <v-list-item-content>
                    <v-list-item-title>
                        <span
                            class="caption"
                            v-text="d_status_cartao[cartao.status].text"
                            v-bind:class="d_status_cartao[cartao.status].class"
                        ></span>
                        <v-spacer></v-spacer>
                        <span v-text="cartao.titular"></span>
                    </v-list-item-title>
                    <v-list-item-subtitle>
                        <span v-text="card(cartao.numero)"></span>
                        <span v-if="cartao.numero" class="mx-2">•</span>
                        <span v-text="d_cartao.find(e => e.value === cartao.tipo).text"></span>
                    </v-list-item-subtitle>
                </v-list-item-content>

                <slot v-bind:cartao="cartao"></slot>
            </v-list-item>
        </template>
    </v-list>
</template>

<script lang="ts">
import Vue from 'vue'
import { Component, Prop } from 'vue-property-decorator'

import { Cartao } from '@/services/api-service'

@Component
export default class ListaCartoes extends Vue {

    @Prop({ required: true })
    private cartoes!: Cartao[];

}
</script>