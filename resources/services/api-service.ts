import Axios from 'axios'

const axios = Axios.create({
    baseURL: '/api',
    withCredentials: true
});

axios.interceptors.request.use((config) => {
    if (localStorage['token']) {
        config.headers['Authorization'] = 'Bearer ' + localStorage['token'];
    }

    return config;
});

axios.interceptors.response.use(response => {
    if (response.data['error']) {
        throw new Error(response.data['message']);
    }

    return response;
}, error => {
    if (error.response && error.response.data.error) {
        throw new Error(error.response.data.error);
    }
});

export class ApiService {

    public static login(email: string, password: string) {
        return axios.post('/login', { email, password, password_confirmation: password });
    }

    public static logout() {
        return axios.post('/logout');
    }

    public static cadastrar(cadastro: Cadastro) {
        return axios.post('/cadastro', { ...cadastro, password_confirmation: cadastro.password });
    }

    public static getUser() {
        return axios.get('/user');
    }

    public static getCartoes() {
        return axios.get('/user/cartoes');
    }

    public static getBandeiras() {
        return axios.get('/user/cartoes/bandeiras');
    }

    public static cadastrarCartao(tipo: TipoCartao, senha: string, categoria: CategoriaCartao, bandeira: string, pessoa?: Pessoa) {
        const payload = { tipo, senha, categoria, bandeira };

        if (pessoa !== undefined) {
            Object.assign(payload, { pessoa });
        }

        return axios.post('/user/cartoes/cadastro', payload);
    }

    public static getFaturas() {
        return axios.get('/user/faturas');
    }

    public static simular(fatura_id: string, valor: string, descricao: string, parcelas: string) {
        return axios.post('/user/faturas', { fatura_id, valor, descricao, parcelas });
    }

    public static pagar(fatura_id: string, valor: string) {
        return axios.put('/user/faturas/pagar', { fatura_id, valor });
    }

    public static getFuncionarios() {
        return axios.get('/admin/funcionarios');
    }

    public static getUsuarios() {
        return axios.get('/funcionario/usuarios');
    }

    public static updateUser(user_id: string, status: string) {
        return axios.put('/funcionario/user', { user_id, status });
    }

    public static updateCartao(cartao_id: string, status: string) {
        return axios.put('/funcionario/cartao', { cartao_id, status });
    }

    public static getPedidos() {
        return axios.get('/funcionario/pedidos');
    }

}

export interface Pessoa {

    nome: string;

    documento: string;

    telefone: string;

    tipo: TipoPessoa;

    endereco: Endereco;

}

export interface Endereco {

    cep: string;

    numero: string;

}

export class Cadastro {

    email: string = '';
    password: string = '';

    tipo: string = 'F';
    documento: string = '';

    nome: string = '';
    telefone: string = '';
    renda: number = 0;

    cep: string = '';
    numero: string = '';

}

export enum TipoUsuario {

    ADMIN = 'A', FUNCIONARIO = 'F', CLIENTE = 'C'

}

export enum TipoPessoa {

    FISICA = 'F', JURIDICA = 'J'

}

export interface Usuario {

    id?: string;

    status?: string;

    tipo: TipoUsuario;

    email: string;

    renda_mensal: string;

    limite: string;

    pessoa: {
        nome: string;
        documento: string;
        telefone: string;
        tipo: TipoPessoa;
    }

    endereco: {
        cep: string;
        numero: string;
    }

}

export enum TipoCartao {

    DEBITO = 'D', CREDITO = 'C'

}

export enum StatusCartao {

    ATIVO = 'A', BLOQUEADO = 'B', CANCELADO = 'C', PENDENTE = 'P'

}

export enum CategoriaCartao {

    NACIONAL = 'N', INTERNACIONAL = 'I'

}

export interface Bandeira {

    id: string;

    nome: string;

    variante?: string;

}

export interface Cartao {

    id: string;

    tipo: TipoCartao;

    status: StatusCartao;

    numero: string;

    data_emissao: string;

    validade: string;

    titular: string;

    documento: string;

    categoria: CategoriaCartao;

    bandeira: Bandeira['id'];

    variante: string;

}

export interface Item {

    id: string;

    valor: string;

    descricao: string;

    parcela: string;

    data_compra: string;

}
export interface Fatura {

    id: string;

    data: string;

    aberto: string;

    itens: Item[];

}
