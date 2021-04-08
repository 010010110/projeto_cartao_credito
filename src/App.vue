<template>
    <v-app>
        <v-snackbar
            v-model="snackbar"
            :timeout="timeout"
            :color="color"
            absolute
            top
        >
            {{ message }}
        </v-snackbar>
        <router-view />
    </v-app>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

@Component
export default class App extends Vue {

    private snackbar: boolean = false;

    private message!: string;
    private timeout: number = 3000;
    private color: string = 'primary';

    private mounted(): void {
        this.$root.$on('snackbar', (message: string, timeout?: number, color?: string) => {
            this.message = message;
            this.timeout = timeout || this.timeout;
            this.color = color || this.color;

            this.snackbar = true;
        });
    }

}
</script>
