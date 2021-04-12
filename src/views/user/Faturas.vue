<template></template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

import { ApiService, Fatura } from '@/services/api-service'

@Component
export default class Faturas extends Vue {

    private faturas: Fatura[] = [];

    private mounted(): void {
        ApiService.getFaturas()
            .then(({ data }) => {
                this.faturas = data as Fatura[];
            })
    }

}
</script>