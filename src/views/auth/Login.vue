<template>
    <v-container fluid>
        <v-row class="align-center justify-center">
            <v-col cols="4">
                <v-card class="mx-auto" outlined>
                    <v-card-title>Entrar na sua conta</v-card-title>

                    <v-form
                        ref="form"
                        v-model="valid"
                        @submit.prevent="submit"
                        lazy-validation
                    >
                        <v-card-text>
                            <v-text-field
                                v-model="email"
                                label="E-mail"
                                required
                            ></v-text-field>

                            <v-text-field
                                v-model="senha"
                                label="Senha"
                                type="password"
                                required
                            ></v-text-field>
                        </v-card-text>
                        <v-card-actions>
                            <v-row>
                                <v-col cols="12">
                                    <v-btn type="submit" block color="primary"
                                        >Entrar</v-btn
                                    >
                                </v-col>
                                <v-col cols="12">
                                    <v-btn block color="primary"
                                        >Cadastrar</v-btn
                                    >
                                </v-col>
                            </v-row>
                        </v-card-actions>
                    </v-form>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

import { ApiService } from '@/services/api-service'

@Component
export default class Login extends Vue {

    private email: string = '';
    private senha: string = '';

    private submit(): void {
        ApiService.login(this.email, this.senha)
            .catch((error: Error) =>
                this.$root.$emit('snackbar', error.message, 3000, 'error')
            );
    }

}
</script>

<style lang="scss" scoped>
div.container {
    height: 100%;

    div.row {
        height: 100%;
    }
}
</style>