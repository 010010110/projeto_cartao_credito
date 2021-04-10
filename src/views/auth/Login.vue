<template>
    <ContainerCenter>
        <v-card class="mx-auto" outlined>
            <v-card-title>Entrar na sua conta</v-card-title>

            <v-form ref="form" @submit.prevent="submit" lazy-validation>
                <v-card-text>
                    <v-text-field v-model="email" label="E-mail" required></v-text-field>

                    <v-text-field v-model="senha" label="Senha" type="password" required></v-text-field>
                </v-card-text>
                <v-card-actions>
                    <v-row>
                        <v-col cols="6" class="pa-5">
                            <v-btn
                                @click="$router.push({ name: 'Cadastro' })"
                                color="primary"
                                block
                                outlined
                            >Cadastrar</v-btn>
                        </v-col>
                        <v-col cols="6" class="pa-5">
                            <v-btn type="submit" color="primary" block>Entrar</v-btn>
                        </v-col>
                    </v-row>
                </v-card-actions>
            </v-form>
        </v-card>
    </ContainerCenter>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

import ContainerCenter from '@/components/ContainerCenter.vue'

import { ApiService } from '@/services/api-service'

@Component({ components: { ContainerCenter } })
export default class Login extends Vue {

    private email: string = '';
    private senha: string = '';

    private beforeMount(): void {
        if (this.$cookies.isKey('PHPSESSID')) {
            this.$router.push('/');
        }
    }

    private submit(): void {
        this.$root.$emit('overlay', true);

        ApiService.login(this.email, this.senha)
            .then(() =>
                this.$router.push('/')
            )
            .catch((error: Error) =>
                this.$root.$emit('snackbar', error.message, 3000, 'error')
            )
            .finally(() =>
                this.$root.$emit('overlay', false)
            );
    }

}
</script>