import Vue from 'vue'
import App from './App.vue'

import '@/plugins/vue-cookies'

import router from '@/router'
import vuetify from '@/plugins/vuetify'

Vue.config.productionTip = false

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
        ]
    })
});

new Vue({ router, vuetify, render: h => h(App) }).$mount('#app');
