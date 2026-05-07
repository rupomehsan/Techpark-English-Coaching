<template>
    <!-- <a href="#" @click.prevent="open" class="border-info" title="Quick Detail">
    <i class="fa fa-eye text-info"></i> Detail
  </a> -->
</template>

<script>
import { mapActions } from "pinia";
import { store } from "../../../store";

export default {
    props: {
        item: { type: Object, default: () => ({}) },
    },
    methods: {
        ...mapActions(store, ["set_item", "set_show_detail_modal"]),
        open() {
            this.set_item(this.item);
            this.set_show_detail_modal(true);
        },
    },
};
</script>
