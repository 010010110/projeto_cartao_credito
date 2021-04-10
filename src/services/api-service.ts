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

export interface Usuario {

    id: string;

    tipo: string;

    status: string;

    email: string;

    senha: string;

    renda_mensal: string;

    limite: string;

    pessoa_id: string;

    nome: string;

    documento: string;

    telefone: string;

    endereco_id: string;

    cep: string;

    numero: string;

}