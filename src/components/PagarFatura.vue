<template>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="success" v-bind="attrs" v-on="on" block>Pagar</v-btn>
        </template>

        <v-card>
            <v-card-title>
                <span class="headline">Pagar fatura</span>
            </v-card-title>

            <v-form @submit.prevent="submit">
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field v-model="valor" label="Valor a ser pago" required></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions class="pa-4">
                    <v-btn @click="dialog = false" color="red" outlined>Cancelar</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn type="submit" color="primary">Pagar</v-btn>
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
export default class PagarFatura extends Vue {

    private dialog: boolean = false;

    @Prop({ required: false })
    private fatura_id!: string;

    private valor: string = '';

    private submit(): void {
        ApiService.pagar(this.fatura_id, this.valor)
            .then(({ data }) => {
                this.$emit('sucesso');
                this.$root.$emit('snackbar', data.message, 3000, 'success');
            }).catch((error: Error) =>
                this.$root.$emit('snackbar', error.message, 3000, 'error')
            ).finally(() => this.dialog = false);
    }

}
</script>