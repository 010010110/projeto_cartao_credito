<template>
    <v-container fluid>
        <v-row class="align-center justify-center">
            <v-col cols="4">
                <slot></slot>
            </v-col>
        </v-row>
    </v-container>
</template>

<style lang="scss" scoped>
div.container {
    height: 100%;

    div.row {
        height: 100%;
    }
}
</style>