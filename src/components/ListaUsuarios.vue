<template>
    <v-list two-line>
        <v-list-item v-for="(usuario, i) in usuarios" :key="i">
            <v-list-item-avatar class="rounded elevation-2" tile>
                <v-img :src="avatar()"></v-img>
            </v-list-item-avatar>

            <v-list-item-content>
                <v-list-item-title v-text="usuario.nome"></v-list-item-title>
                <v-list-item-subtitle v-html="usuario.email"></v-list-item-subtitle>
            </v-list-item-content>

            <slot v-bind:usuario="usuario"></slot>
        </v-list-item>
    </v-list>
</template>

<script lang="ts">
import Vue from 'vue'
import { Component, Prop } from 'vue-property-decorator'

import { Usuario } from '@/services/api-service'

@Component
export default class ListaUsuarios extends Vue {

    @Prop({ required: true })
    private usuarios!: Usuario[];

}
</script>