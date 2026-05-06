<template>
    <div class="col-md-6">
        <h5 class="m-0">Class Days</h5>
        <div
            class="section-title d-flex justify-content-between align-items-center"
        >
            <div class="d-flex flex-wrap gap-2">
                <label
                    v-for="day in days"
                    :key="day"
                    class="day-chip"
                    :class="{ active: selected.includes(day) }"
                >
                    <input
                        type="checkbox"
                        :name="`class_days[]`"
                        :value="day"
                        v-model="selected"
                        class="d-none"
                    />
                    {{ day }}
                </label>
            </div>
            <div class="d-flex gap-2">
                <button
                    class="btn btn-sm btn-outline-secondary"
                    @click.prevent="select_all"
                >
                    All
                </button>
                <button
                    class="btn btn-sm btn-outline-danger"
                    @click.prevent="clear_all"
                >
                    Clear
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from "pinia";
import { store } from "../../store";

const DAYS = ["Sat", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri"];

export default {
    data: () => ({
        days: DAYS,
        selected: [],
    }),

    created() {
        this.$watch(
            "item",
            (newValue) => {
                if (!newValue?.class_days) return;

                const raw = newValue.class_days;
                if (Array.isArray(raw)) {
                    this.selected = raw.filter((d) => DAYS.includes(d));
                } else if (typeof raw === "string") {
                    this.selected = raw
                        .split(",")
                        .map((d) => d.trim())
                        .filter((d) => DAYS.includes(d));
                }
            },
            { immediate: true },
        );
    },

    methods: {
        select_all() {
            this.selected = [...DAYS];
        },
        clear_all() {
            this.selected = [];
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

.gap-2 {
    gap: 0.5rem;
}

.day-chip {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 56px;
    height: 40px;
    border: 2px solid #dee2e6;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.85rem;
    font-weight: 500;
    color: #6c757d;
    background: #fff;
    transition: all 0.15s ease;
    user-select: none;
}

.day-chip:hover {
    border-color: #0d6efd;
    color: #0d6efd;
}

.day-chip.active {
    background: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
}
</style>
