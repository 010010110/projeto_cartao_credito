<template>
    <v-stepper v-model="step">
        <v-stepper-header class="elevation-0">
            <v-stepper-step :complete="step > 1" step="1" editable>Dados de acesso</v-stepper-step>

            <v-divider></v-divider>

            <v-stepper-step :complete="step > 2" step="2" editable>Dados pessoais</v-stepper-step>

            <v-divider></v-divider>

            <v-stepper-step step="3" editable>Endereço</v-stepper-step>
        </v-stepper-header>

        <v-divider></v-divider>

        <v-stepper-items>
            <v-stepper-content class="pa-6" step="1">
                <v-row>
                    <v-col cols="12" class="pb-0">
                        <v-text-field v-model="cadastro.email" label="E-mail" required></v-text-field>
                    </v-col>
                    <v-col cols="12" class="py-0">
                        <v-text-field
                            v-model="cadastro.password"
                            label="Senha"
                            type="password"
                            required
                        ></v-text-field>
                    </v-col>
                </v-row>
            </v-stepper-content>

            <v-stepper-content class="pa-6" step="2">
                <v-row>
                    <v-col cols="6" class="pb-0">
                        <v-select v-model="cadastro.tipo" :items="d_pessoa" label="Tipo"></v-select>
                    </v-col>
                    <v-col cols="6" class="pb-0">
                        <v-text-field v-model="cadastro.documento" label="Documento" required></v-text-field>
                    </v-col>
                    <v-col cols="12" class="py-0">
                        <v-text-field v-model="cadastro.nome" label="Nome" required></v-text-field>
                    </v-col>
                    <v-col cols="6" class="py-0">
                        <v-text-field v-model="cadastro.telefone" label="Telefone" required></v-text-field>
                    </v-col>
                    <v-col cols="6" class="py-0">
                        <v-text-field v-model="cadastro.renda_mensal" label="Renda Mensal" required></v-text-field>
                    </v-col>
                </v-row>
            </v-stepper-content>

            <v-stepper-content class="pa-6" step="3">
                <v-row>
                    <v-col cols="4" class="pb-0">
                        <v-text-field v-model="cadastro.cep" label="CEP" required></v-text-field>
                    </v-col>
                    <v-col cols="8" class="pb-0">
                        <v-text-field v-model="cadastro.numero" label="Número" required></v-text-field>
                    </v-col>
                </v-row>
            </v-stepper-content>
        </v-stepper-items>

        <v-container>
            <v-row class="pa-3">
                <v-col cols="auto">
                    <v-btn color="primary" v-if="step > 1" @click="step--" outlined>Voltar</v-btn>
                    <v-btn color="error" v-else @click="cancelar" outlined>
                        <span>Cancelar</span>
                    </v-btn>
                </v-col>

                <v-spacer></v-spacer>

                <v-col cols="auto">
                    <v-btn color="primary" v-if="step < 3" @click.stop="step++">Continuar</v-btn>
                    <v-btn color="primary" v-else @click.stop="submit">Criar Conta</v-btn>
                </v-col>
            </v-row>
        </v-container>
    </v-stepper>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

import { ApiService, Cadastro } from '@/services/api-service'

@Component
export default class CadastroComponent extends Vue {

    private step: number = 1;
    private cadastro: Cadastro = new Cadastro();

    private cancelar(): void {
        this.$router.push({ name: 'Login' });
    }

    private submit(): void {
        this.$root.$emit('overlay', true);

        ApiService.cadastrar(this.cadastro)
            .then(({ data }) => {
                this.$root.$emit('snackbar', 'Cadastro realizado com sucesso!', 3000);
                this.$router.push({ name: 'Login' });
            })
            .catch((error: Error) =>
                this.$root.$emit('snackbar', error.message, 3000, 'error')
            )
            .finally(() =>
                this.$root.$emit('overlay', false)
            );
    }

}
</script>