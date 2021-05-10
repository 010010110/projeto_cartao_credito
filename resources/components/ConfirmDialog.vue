<template>
    <v-dialog v-model="dialog" persistent max-width="400">
        <template v-slot:activator="{ on, attrs }">
            <slot v-bind:on="on" v-bind:attrs="attrs"></slot>
        </template>
        <v-card>
            <v-card-title>
                <span class="headline" v-text="title" />
            </v-card-title>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="error" @click="dialog = false" text>Não</v-btn>
                <v-btn color="primary" @click="accept" text>Sim</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop } from 'vue-property-decorator';

@Component
export default class ConfirmDialog extends Vue {

    private dialog: boolean = false;

    @Prop({ required: true })
    private title!: string;

    private accept(): void {
        this.dialog = false;
        this.$emit('accept');
    }

    public show(): void {
        this.dialog = true;
    }

}
</script>