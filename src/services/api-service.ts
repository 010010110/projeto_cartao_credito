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
        return axios.post('/model/login.php', { email, senha });
    }

}