<template>
    <div class="col-md-12">
        <div
            class="d-flex justify-content-between align-items-center pb-2 section-title"
        >
            <h5 class="m-0">{{ label || name.replace(/_/g, ' ') }}</h5>
            <button
                class="btn btn-sm btn-outline-success"
                @click.prevent="add_row"
            >
                Add row
            </button>
        </div>

        <div
            class="row align-items-center"
            v-for="(row, index) in rows"
            :key="index"
        >
            <div class="col-md-11">
                <div class="form-group">
                    <input
                        class="form-control form-control-square mb-2"
                        type="text"
                        :name="`${name}[${index}]`"
                        v-model="rows[index]"
                        :placeholder="`Enter ${name.replace(/_/g, ' ')} ${index + 1}`"
                    />
                </div>
            </div>

            <div
                class="col-md-1 d-flex align-items-center justify-content-center"
            >
                <button
                    class="btn btn-sm btn-outline-danger"
                    @click.prevent="delete_row(index)"
                >
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from "pinia";
import { store } from "../../store";

export default {
    props: {
        name: {
            type: String,
            required: true,
        },
        label: {
            type: String,
            default: "",
        },
    },

    data: () => ({
        rows: [""],
    }),

    created() {
        this.$watch(
            "item",
            (newValue) => {
                if (!newValue || !newValue[this.name]) return;

                const raw = newValue[this.name];
                let parsed = raw;

                if (typeof raw === "string") {
                    try {
                        parsed = JSON.parse(raw);
                    } catch {
                        parsed = [raw];
                    }
                }

                this.rows = Array.isArray(parsed) && parsed.length ? [...parsed] : [""];
            },
            { immediate: true }
        );
    },

    methods: {
        add_row() {
            this.rows.push("");
        },
        delete_row(index) {
            if (this.rows.length < 2) return;
            this.rows.splice(index, 1);
        },
    },

    computed: {
        ...mapState(store, ["item"]),
    },
};
</script>

<style scoped>
.section-title {
    border: 1px solid #dddddd78;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    font-weight: 500;
    color: #343a40;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}
</style>
