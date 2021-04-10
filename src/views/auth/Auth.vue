<template>
    <v-main>
        <router-view />
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