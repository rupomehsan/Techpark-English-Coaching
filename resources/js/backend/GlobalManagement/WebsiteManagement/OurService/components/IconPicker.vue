<template>
    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">{{ label }}</label>

        <!-- Preview + trigger -->
        <div class="icon-picker-trigger" @click="open = !open">
            <span class="icon-picker-preview">
                <i v-if="selected" :class="selected" style="font-size:1.3rem;"></i>
                <i v-else class="fa-solid fa-icons" style="color:#aaa;font-size:1.3rem;"></i>
            </span>
            <span class="icon-picker-label">{{ selected || 'আইকন বেছে নিন' }}</span>
            <i class="fa-solid fa-chevron-down ms-auto" style="font-size:0.75rem;color:#aaa;"></i>
        </div>

        <!-- Hidden input for form submission -->
        <input type="hidden" :name="name" :value="selected" />

        <!-- Dropdown panel -->
        <div v-if="open" class="icon-picker-panel">
            <div class="icon-picker-search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input v-model="query" type="text" placeholder="আইকন খুঁজুন..." @click.stop />
            </div>
            <div class="icon-picker-grid">
                <button
                    v-for="ic in filtered"
                    :key="ic"
                    type="button"
                    class="icon-btn"
                    :class="{ active: selected === ic }"
                    :title="ic"
                    @click.stop="pick(ic)"
                >
                    <i :class="ic"></i>
                </button>
                <div v-if="filtered.length === 0" class="icon-picker-empty">কোনো আইকন পাওয়া যায়নি</div>
            </div>
            <div v-if="selected" class="icon-picker-footer">
                <span><i :class="selected" class="me-2"></i>{{ selected }}</span>
                <button type="button" class="btn btn-sm btn-outline-secondary" @click.stop="clear">মুছুন</button>
            </div>
        </div>

        <!-- Backdrop -->
        <div v-if="open" class="icon-picker-backdrop" @click="open = false"></div>
    </div>
</template>

<script>
const ICONS = [
    'fa-solid fa-graduation-cap',
    'fa-solid fa-book',
    'fa-solid fa-book-open',
    'fa-solid fa-chalkboard-user',
    'fa-solid fa-user-graduate',
    'fa-solid fa-school',
    'fa-solid fa-pen-to-square',
    'fa-solid fa-pencil',
    'fa-solid fa-certificate',
    'fa-solid fa-award',
    'fa-solid fa-trophy',
    'fa-solid fa-star',
    'fa-solid fa-medal',
    'fa-solid fa-lightbulb',
    'fa-solid fa-brain',
    'fa-solid fa-language',
    'fa-solid fa-spell-check',
    'fa-solid fa-comments',
    'fa-solid fa-message',
    'fa-solid fa-microphone',
    'fa-solid fa-headphones',
    'fa-solid fa-globe',
    'fa-solid fa-earth-asia',
    'fa-solid fa-laptop',
    'fa-solid fa-desktop',
    'fa-solid fa-mobile-screen',
    'fa-solid fa-tablet-screen-button',
    'fa-solid fa-wifi',
    'fa-solid fa-video',
    'fa-solid fa-film',
    'fa-solid fa-play-circle',
    'fa-solid fa-users',
    'fa-solid fa-user-group',
    'fa-solid fa-user',
    'fa-solid fa-person',
    'fa-solid fa-people-group',
    'fa-solid fa-handshake',
    'fa-solid fa-hands-helping',
    'fa-solid fa-heart',
    'fa-solid fa-thumbs-up',
    'fa-solid fa-check-circle',
    'fa-solid fa-circle-check',
    'fa-solid fa-shield-halved',
    'fa-solid fa-lock',
    'fa-solid fa-key',
    'fa-solid fa-chart-line',
    'fa-solid fa-chart-bar',
    'fa-solid fa-chart-pie',
    'fa-solid fa-briefcase',
    'fa-solid fa-building',
    'fa-solid fa-city',
    'fa-solid fa-house',
    'fa-solid fa-map-location-dot',
    'fa-solid fa-location-dot',
    'fa-solid fa-clock',
    'fa-solid fa-calendar-days',
    'fa-solid fa-bell',
    'fa-solid fa-bullhorn',
    'fa-solid fa-rocket',
    'fa-solid fa-bolt',
    'fa-solid fa-fire',
    'fa-solid fa-star-of-life',
    'fa-solid fa-leaf',
    'fa-solid fa-seedling',
    'fa-solid fa-recycle',
    'fa-solid fa-infinity',
    'fa-solid fa-puzzle-piece',
    'fa-solid fa-gears',
    'fa-solid fa-screwdriver-wrench',
    'fa-solid fa-code',
    'fa-solid fa-terminal',
    'fa-solid fa-database',
    'fa-solid fa-server',
    'fa-solid fa-cloud',
    'fa-solid fa-envelope',
    'fa-solid fa-phone',
    'fa-solid fa-headset',
    'fa-solid fa-dollar-sign',
    'fa-solid fa-money-bill',
    'fa-solid fa-credit-card',
    'fa-solid fa-gift',
    'fa-solid fa-tag',
    'fa-solid fa-tags',
    'fa-solid fa-percent',
];

export default {
    name: 'IconPicker',
    props: {
        name:  { type: String, default: 'icon' },
        label: { type: String, default: 'Icon' },
        value: { type: String, default: '' },
    },
    emits: ['update:value'],
    data() {
        return {
            open: false,
            query: '',
            selected: this.value || '',
        };
    },
    watch: {
        value(v) { this.selected = v || ''; },
    },
    computed: {
        filtered() {
            if (!this.query.trim()) return ICONS;
            const q = this.query.toLowerCase();
            return ICONS.filter(ic => ic.toLowerCase().includes(q));
        },
    },
    methods: {
        pick(ic) {
            this.selected = ic;
            this.open = false;
            this.$emit('update:value', ic);
        },
        clear() {
            this.selected = '';
            this.$emit('update:value', '');
        },
    },
};
</script>

<style scoped>
.icon-picker-trigger {
    display: flex; align-items: center; gap: 10px;
    border: 1.5px solid #dee2e6; border-radius: 8px;
    padding: 9px 14px; cursor: pointer; background: #fff;
    transition: border-color 0.2s;
    position: relative;
}
.icon-picker-trigger:hover { border-color: #0d6efd; }
.icon-picker-preview {
    width: 34px; height: 34px; border-radius: 8px;
    background: #f0f4ff; display: flex; align-items: center; justify-content: center;
    color: #0d6efd; flex-shrink: 0;
}
.icon-picker-label { font-size: 0.9rem; color: #495057; flex: 1; }

.icon-picker-panel {
    position: absolute; z-index: 1050;
    background: #fff; border-radius: 14px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.18);
    border: 1px solid #e9ecef;
    width: 340px; max-width: 90vw;
    margin-top: 6px;
}
.icon-picker-search {
    display: flex; align-items: center; gap: 8px;
    padding: 12px 14px; border-bottom: 1px solid #f0f4f8;
}
.icon-picker-search i { color: #adb5bd; }
.icon-picker-search input {
    border: none; outline: none; flex: 1; font-size: 0.88rem;
}
.icon-picker-grid {
    display: flex; flex-wrap: wrap; gap: 4px;
    padding: 12px; max-height: 260px; overflow-y: auto;
}
.icon-btn {
    width: 40px; height: 40px; border-radius: 8px;
    border: 1.5px solid transparent; background: #f8f9fa;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; font-size: 1rem; color: #495057;
    transition: all 0.2s;
}
.icon-btn:hover { background: #e8f0fe; border-color: #0d6efd; color: #0d6efd; }
.icon-btn.active { background: #0d6efd; border-color: #0d6efd; color: #fff; }
.icon-picker-empty { font-size: 0.82rem; color: #adb5bd; padding: 20px; text-align: center; width: 100%; }
.icon-picker-footer {
    border-top: 1px solid #f0f4f8; padding: 10px 14px;
    display: flex; align-items: center; justify-content: space-between;
    font-size: 0.8rem; color: #495057;
}
.icon-picker-backdrop {
    position: fixed; inset: 0; z-index: 1049;
}
</style>
