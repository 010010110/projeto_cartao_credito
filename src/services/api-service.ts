import Axios from 'axios'

const axios = Axios.create({
    baseURL: process.env['VUE_APP_API_ENDPOINT'],
    withCredentials: true
});

axios.interceptors.response.use(response => {
    if (response.data['error']) {
        throw new Error(response.data['message']);
    }

    return response;
});

export class ApiService {

    public static login(email: string, senha: string) {
        return axios.post('/api/user/login.php', { email, senha });
    }

    public static cadastrar(cadastro: Cadastro) {
        return axios.post('/api/user/cadastro.php', { ...cadastro });
    }

    public static getUser() {
        return axios.get('/api/user/me.php');
    }

}

export class Cadastro {

    private email: string = '';
    private senha: string = '';

    private tipo: string = 'F';
    private documento: string = '';

    private nome: string = '';
    private telefone: string = '';
    private renda: number = 0;

    private cep: string = '';
    private numero: string = '';

}

export enum TipoUsuario {

    ADMIN = 'A', FUNCIONARIO = 'F', CLIENTE = 'C'

}

export enum TipoPessoa {

    FISICA = 'F', JURIDICA = 'J'

}

export interface Usuario {

    tipo_usuario: TipoUsuario;

    email: string;

    renda_mensal: string;

    limite: string;

    nome: string;

    documento: string;

    telefone: string;

    tipo_pessoa: TipoPessoa;

    cep: string;

    numero: string;

}

export enum TipoCartao {

    DEBITO = 'D', CREDITO = 'C'

}

export enum StatusCartao {

    ATIVO = 'A', BLOQUEADO = 'B', CANCELADO = 'C'

}

export enum CategoriaCartao {

    NACIONAL = 'N', INTERNACIONAL = 'I'

}

export interface Cartao {

    id: string;

    tipo: TipoCartao;

    status: StatusCartao;

    numero: string;

    data_emissao: string;

    validade: string;

    titular: string;

    categoria: CategoriaCartao;

    bandeira: string;

    variante: string;

}
