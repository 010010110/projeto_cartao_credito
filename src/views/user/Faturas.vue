<template>
    <div class="fill-height" style="width: 100%">
        <v-carousel hide-delimiters light>
            <v-carousel-item v-for="(fatura, i) in faturas" :key="'f' + i">
                <v-col class="mx-auto" cols="8">
                    <v-card color="transparent" flat>
                        <v-card-title>Fatura do mês {{ shorten(fatura.data) }}</v-card-title>

                        <v-card-text>
                            <div class="font-weight-bold green--text ml-8 mb-2">Aberta</div>

                            <v-timeline dense clipped>
                                <v-timeline-item
                                    fill-dot
                                    class="d-flex align-center mb-12"
                                    color="green"
                                    large
                                >
                                    <template v-slot:icon>
                                        <v-icon class="white--text">mdi-currency-usd</v-icon>
                                    </template>

                                    <v-row align="center">
                                        <v-col class="pa-0 px-2">
                                            <span
                                                class="title"
                                                v-text="currency(fatura.itens.reduce((a, e) => a += Number(e.valor), 0))"
                                            />
                                        </v-col>
                                        <v-col class="pa-0 px-2" cols="2">
                                            <Simulador
                                                :fatura_id="fatura.id"
                                                @cadastro="getFaturas"
                                            ></Simulador>
                                        </v-col>
                                        <v-col class="pa-0 px-2" cols="2">
                                            <v-btn color="success" block>Pagar</v-btn>
                                        </v-col>
                                    </v-row>
                                </v-timeline-item>

                                <v-timeline-item
                                    v-for="(item, j) in fatura.itens"
                                    :key="'i' + j"
                                    class="mb-4"
                                    color="grey"
                                    icon-color="grey lighten-2"
                                    small
                                >
                                    <v-row align="center" justify="space-between">
                                        <v-col class="pa-0" cols="7">
                                            <span v-text="item.descricao" />
                                        </v-col>
                                        <v-col class="text-right pa-0" cols="5">
                                            <span v-text="currency(item.valor)" />
                                            <span
                                                class="caption grey--text mx-2"
                                                v-text="item.parcela"
                                            />
                                        </v-col>
                                    </v-row>
                                    <v-row>
                                        <v-col class="pa-0">
                                            <span
                                                class="caption grey--text"
                                                v-text="new Date(item.data_compra).toLocaleDateString()"
                                            />
                                        </v-col>
                                    </v-row>
                                </v-timeline-item>
                            </v-timeline>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-carousel-item>
        </v-carousel>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

import Simulador from '@/components/Simulador.vue'
import { ApiService, Fatura } from '@/services/api-service'

@Component({ components: { Simulador } })
export default class Faturas extends Vue {

    private faturas: Fatura[] = [];

    private messages: any[] = [
        {
            from: 'You',
            message: `Sure, I'll see you later.`,
            time: '10:42am',
            color: 'deep-purple lighten-1',
        },
        {
            from: 'John Doe',
            message: 'Yeah, sure. Does 1:00pm work?',
            time: '10:37am',
            color: 'green',
        },
        {
            from: 'You',
            message: 'Did you still want to grab lunch today?',
            time: '9:47am',
            color: 'deep-purple lighten-1',
        },
    ]

    private mounted(): void {
        this.getFaturas();
    }

    private getFaturas(): Promise<Fatura[]> {
        return ApiService.getFaturas()
            .then(({ data }) =>
                this.faturas = data as Fatura[]
            );
    }

}
</script>

<style lang="scss">
.v-window {
    height: inherit !important;

    .v-image {
        height: inherit !important;

        > .v-responsive__content {
            display: flex;
        }
    }
}
</style>