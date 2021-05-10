<template>
    <div class="cartao primary rounded-lg">
        <div class="overlay" />
        <div class="content d-flex flex-column justify-space-between pa-4">
            <span
                class="headline font-weight-bold white--text text-center"
                v-text="card(cartao.numero)"
            />
            <v-avatar size="64" tile>
                <v-img :src="require(`@/assets/${cartao.imagem}.png`)"></v-img>
            </v-avatar>
            <div class="white--text">
                <div class="d-flex justify-space-between">
                    <span v-text="shorten(cartao.data_emissao)" />
                    <span v-text="shorten(cartao.validade)" />
                </div>
                <span class="subtitle-1 text-uppercase" v-text="cartao.titular" />
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { Component, Prop } from 'vue-property-decorator'

import { Cartao } from '@/services/api-service'

@Component
export default class CartaoComponent extends Vue {

    @Prop({ required: true })
    private cartao!: Cartao;

}
</script>

<style lang="scss" scoped>
div.cartao {
    width: 320px;
    height: 200px;
    position: relative;
    user-select: none;

    background-size: cover;
    background-position: center;
    background-image: url("https://image.freepik.com/vetores-gratis/wallpaper-de-paisagem-em-design-plano_74890-34.jpg");

    > div {
        width: 100%;
        height: 100%;
        border-radius: inherit;
        position: absolute;
    }

    > div.overlay {
        backdrop-filter: blur(10px);
        background-color: rgba($color: #fff, $alpha: 0.1);
    }

    > div.content {
        z-index: 1;
        position: absolute;
    }
}
</style>