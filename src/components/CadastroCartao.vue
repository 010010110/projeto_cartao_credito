<template>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on, attrs }">
            <v-row class="pa-2">
                <v-spacer></v-spacer>
                <v-col cols="4">
                    <div class="display-1 font-weight-bold text-center">Seus cartões</div>
                </v-col>
                <v-col class="d-flex align-center justify-end" cols="4">
                    <v-btn v-bind="attrs" v-on="on" color="success" outlined>
                        <v-icon left>mdi-plus</v-icon>
                        <span>Novo cartão</span>
                    </v-btn>
                </v-col>
            </v-row>
        </template>
        <v-card>
            <v-card-title>
                <span class="headline">Incluir novo cartão</span>
            </v-card-title>

            <v-form @submit.prevent="submit">
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="10">
                                <v-select v-model="tipo" :items="d_cartao" label="Tipo"></v-select>
                            </v-col>
                            <v-col cols="2">
                                <v-text-field
                                    type="password"
                                    v-model="senha"
                                    label="Senha"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="6">
                                <v-select
                                    v-model="categoria"
                                    :items="d_cartao_categoria"
                                    label="Categoria"
                                ></v-select>
                            </v-col>
                            <v-col cols="6">
                                <v-select v-model="bandeira" :items="bandeiras" label="Bandeira"></v-select>
                            </v-col>
                            <v-col cols="12">
                                <v-checkbox v-model="terceiro" label="Cartão para outra pessoa"></v-checkbox>
                            </v-col>
                            <template v-if="terceiro">
                                <v-col cols="12">
                                    <v-text-field v-model="pessoa.nome" label="Nome" required></v-text-field>
                                </v-col>
                                <v-col cols="6">
                                    <v-text-field
                                        v-model="pessoa.documento"
                                        label="Documento"
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="6">
                                    <v-text-field
                                        v-model="pessoa.telefone"
                                        label="Telefone"
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="4">
                                    <v-select v-model="pessoa.tipo" :items="d_pessoa" label="Tipo"></v-select>
                                </v-col>
                                <v-col cols="4">
                                    <v-text-field
                                        v-model="pessoa.endereco.cep"
                                        label="CEP"
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="4">
                                    <v-text-field
                                        v-model="pessoa.endereco.numero"
                                        label="Número"
                                        required
                                    ></v-text-field>
                                </v-col>
                            </template>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions class="pa-4">
                    <v-btn @click="dialog = false" color="red" outlined>Cancelar</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn type="submit" color="primary">Cadastrar</v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script lang="ts">
import Vue from 'vue'
import { Component } from 'vue-property-decorator'

import { ApiService, TipoCartao, CategoriaCartao, Bandeira, TipoPessoa, Pessoa, Endereco } from '@/services/api-service'

@Component
export default class CadastroCartao extends Vue {

    private bandeiras: any[] = [];

    private dialog: boolean = false;

    private tipo: TipoCartao = TipoCartao.CREDITO;
    private senha: string = '';
    private categoria: CategoriaCartao = CategoriaCartao.NACIONAL;
    private bandeira: string = '';

    private terceiro: boolean = false;

    private pessoa = {
        nome: '',
        documento: '',
        telefone: '',
        tipo: TipoPessoa.FISICA,
        endereco: {
            cep: '',
            numero: ''
        } as Endereco
    } as Pessoa;

    private mounted() {
        ApiService.getBandeiras().then(({ data }: { data: Bandeira[] }) =>
            this.bandeiras = data.map(({ id, nome, variante }) =>
                ({ text: [nome, variante].filter(e => e).join(' - '), value: id })
            )
        );
    }

    private submit(): void {
        (() => {
            if (this.terceiro) {
                return ApiService.cadastrarCartao(this.tipo, this.senha, this.categoria, this.bandeira, this.pessoa);
            }

            return ApiService.cadastrarCartao(this.tipo, this.senha, this.categoria, this.bandeira);
        })().then(({ data }) =>
            this.$root.$emit('snackbar', data.message, 3000, 'success')
        ).catch((error: Error) =>
            this.$root.$emit('snackbar', error.message, 3000, 'error')
        ).finally(() => this.dialog = false);
    }

}
</script>