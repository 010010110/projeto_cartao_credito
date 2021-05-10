import 'vue'

declare module 'vue/types/vue' {

    interface Vue {

        shorten(data: string): string;

        card(number: string): string;

        currency(value: string): string;

        avatar(): string;

    }

}