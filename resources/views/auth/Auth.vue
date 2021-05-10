<template>
    <v-main>
        <v-container class="fill-height" fluid>
            <v-row class="fill-height align-center justify-center">
                <v-spacer></v-spacer>
                <v-col cols="4">
                    <v-img
                        src="https://raw.githubusercontent.com/010010110/ongs/master/frontendreact/src/assets/heroes.png"
                    ></v-img>
                </v-col>
                <v-spacer></v-spacer>
                <v-col cols="4">
                    <router-view />
                </v-col>
                <v-spacer></v-spacer>
            </v-row>
        </v-container>
    </v-main>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

@Component
export default class Auth extends Vue {

    private beforeMount(): void {
        if (this.$route.name !== 'Login') {
            this.$router.push({ name: 'Login' });
        }
    }

}
</script>