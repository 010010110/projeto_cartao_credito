<template>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                class="mx-2"
                color="grey lighten-1"
                v-bind="attrs"
                v-on="on"
                outlined
                block
            >Simular</v-btn>
        </template>

        <v-card>
            <v-card-title>
                <span class="headline">Simular novo item</span>
            </v-card-title>

            <v-form @submit.prevent="submit">
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field v-model="descricao" label="Descrição" required></v-text-field>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field v-model="valor" label="Valor" required></v-text-field>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field v-model="parcelas" label="Parcelas" required></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions class="pa-4">
                    <v-btn @click="dialog = false" color="red" outlined>Cancelar</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn type="submit" color="primary">Inserir</v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script lang="ts">
import Vue from 'vue'
import { Component, Prop } from 'vue-property-decorator'

import { ApiService } from '@/services/api-service'

@Component
export default class Simulador extends Vue {

    private dialog: boolean = false;

    @Prop({ required: false })
    private fatura_id!: string;

    private descricao: string = '';

    private valor: string = '';

    private parcelas: string = '';

    private submit(): void {
        ApiService.simular(this.fatura_id, this.valor, this.descricao, this.parcelas)
            .then(({ data }) => {
                this.$emit('sucesso');
                this.$root.$emit('snackbar', data.message, 3000, 'success');
            }).catch((error: Error) =>
                this.$root.$emit('snackbar', error.message, 3000, 'error')
            ).finally(() => this.dialog = false);
    }

}
</script>