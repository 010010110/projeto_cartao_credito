import Vue from 'vue'
import App from './App.vue'

import '@/plugins/vue-cookies'

import router from '@/router'
import vuetify from '@/plugins/vuetify'

Vue.config.productionTip = false

const gender = ['men', 'women'];

function random(min: number, max: number): number {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

Vue.mixin({
    data: () => ({
        d_pessoa: [
            { text: 'Física', value: 'F' },
            { text: 'Jurídica', value: 'J' }
        ],
        d_cartao: [
            { text: 'Crédito', value: 'C' },
            { text: 'Débito', value: 'D' }
        ],
        d_cartao_categoria: [
            { text: 'Nacional', value: 'N' },
            { text: 'Internacional', value: 'I' },
        ],
        d_status_cartao: {
            'A': { text: 'Ativado', class: 'success--text' },
            'P': { text: 'Pendente de aprovação', class: 'warning--text' },
            'B': { text: 'Bloqueado', class: 'grey--text' },
            'C': { text: 'Cancelado', class: 'error--text' }
        }
    }),
    methods: {
        shorten(data: string) {
            if (data && data.length) {
                return new Intl.DateTimeFormat(navigator.language, {
                    month: '2-digit', year: '2-digit'
                }).format(new Date(data));
            }

            return '';
        },
        card(number: string) {
            if (number && number.length) {
                return String(number).replace(/(\d{4})/g, '$1 ').trim();
            }

            return '';
        },
        currency(value: string) {
            return new Intl.NumberFormat(navigator.language, {
                style: 'currency', currency: 'BRL'
            }).format(Number(value));
        },
        avatar(): string {
            return `https://randomuser.me/api/portraits/${gender[random(0, 1)]}/${random(0, 99)}.jpg`;
        }
    }
});

new Vue({ router, vuetify, render: h => h(App) }).$mount('#app');
