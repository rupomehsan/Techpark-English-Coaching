<template>
  <template v-for="(row_item, index) in filteredFields" :key="index">
    <tr>
      <th>{{ row_item }}</th>
      <th class="text-center">:</th>
      <th class="text-trim">

        <!-- Image field -->
        <template v-if="row_item === 'image' || isImageFile(item[row_item])">
          <a :href="imgSrc(item[row_item])" data-fancybox="detail-gallery" :data-caption="`${row_item} - Detail View`">
            <img :src="imgSrc(item[row_item])" @error="handleImageError($event)"
              style="width:160px;height:120px;object-fit:cover;border-radius:6px;border:1px solid #dee2e6;" alt="image" />
          </a>
        </template>

        <!-- payment_details → button only -->
        <template v-else-if="row_item === 'payment_details' && is_complex(item[row_item])">
          <button class="pd-btn" @click="openPaymentModal">
            <i class="fa fa-receipt"></i> Show Details
          </button>
        </template>

        <!-- other complex objects (not payment_details) -->
        <template v-else-if="is_html(item[row_item])">
          <span v-html="item[row_item]"></span>
        </template>
        <template v-else-if="is_complex(item[row_item])">
          <div class="nested-table-wrap">
            <table class="nested-table">
              <tbody>
                <tr v-for="(val, key) in flatten(item[row_item])" :key="key">
                  <td class="nested-key">{{ key }}</td>
                  <td class="nested-val">{{ val !== null && val !== undefined && val !== '' ? val : '—' }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </template>
        <template v-else>
          {{ trim_content(item[row_item], row_item) }}
        </template>

      </th>
    </tr>
  </template>

  <!-- Payment Details Modal -->
  <teleport to="body">
    <transition name="pd-fade">
      <div v-if="showPaymentModal" class="pd-overlay" @click.self="showPaymentModal = false">
        <div class="pd-modal">

          <div class="pd-header">
            <div class="pd-header-left">
              <div class="pd-hicon"><i class="fa fa-receipt"></i></div>
              <div>
                <div class="pd-htitle">Payment Details</div>
                <div class="pd-hsub">SSL Gateway Response</div>
              </div>
            </div>
            <button class="pd-close" @click="showPaymentModal = false"><i class="fa fa-xmark"></i></button>
          </div>

          <div class="pd-body">
            <table class="pd-table">
              <tbody>
                <tr v-for="(val, key) in flatten(item.payment_details)" :key="key">
                  <td class="pd-key">{{ key }}</td>
                  <td class="pd-val">{{ val !== null && val !== undefined && val !== '' ? val : '—' }}</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="pd-footer">
            <button class="pd-close-btn" @click="showPaymentModal = false">বন্ধ করুন</button>
          </div>

        </div>
      </div>
    </transition>
  </teleport>
</template>

<script>
import setup from "../../setup";
import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

export default {
  props: ["item"],
  data: () => ({
    setup,
    showPaymentModal: false,
  }),

  mounted()      { this.initFancybox(); },
  updated()      { this.initFancybox(); },
  beforeUnmount(){ Fancybox.destroy(); },

  watch: {
    showPaymentModal(val) {
      document.body.style.overflow = val ? 'hidden' : '';
    },
  },

  computed: {
    filteredFields() {
      return setup.select_fields.filter(field => field !== 'deleted_at');
    },
  },

  methods: {
    openPaymentModal() { this.showPaymentModal = true; },

    isImageFile(content) {
      if (!content || typeof content !== 'string') return false;
      const ext = content.split('.').pop().toLowerCase();
      return ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp'].includes(ext);
    },

    imgSrc(path) {
      if (!path) return '/avatar.png';
      return path.startsWith('/') || path.startsWith('http') ? path : '/' + path;
    },

    handleImageError(event) {
      event.target.src = '/avatar.png';
      const a = event.target.closest('a');
      if (a) a.href = '/avatar.png';
    },

    initFancybox() {
      Fancybox.bind('[data-fancybox="detail-gallery"]', {
        Toolbar: {
          display: {
            left: ["infobar"],
            middle: ["zoomIn","zoomOut","toggle1to1","rotateCCW","rotateCW","flipX","flipY"],
            right: ["download","close"],
          },
        },
        Thumbs: { autoStart: false },
        wheel: "zoom",
      });
    },

    is_html(content) {
      return typeof content === 'string' && /<[a-z][\s\S]*>/i.test(content);
    },

    is_complex(content) {
      if (content === null || content === undefined) return false;
      if (Array.isArray(content)) return true;
      if (typeof content !== 'object') return false;
      if (content.batch_number !== undefined) return false;
      if (content.name !== undefined || content.title !== undefined) return false;
      return true;
    },

    flatten(content, prefix = '') {
      if (!content) return {};
      if (Array.isArray(content)) {
        return content.reduce((acc, val, i) => {
          if (val && typeof val === 'object') Object.assign(acc, this.flatten(val, `[${i}] `));
          else acc[`${prefix}${i}`] = val;
          return acc;
        }, {});
      }
      return Object.entries(content).reduce((acc, [k, v]) => {
        const key = prefix ? `${prefix}${k}` : k;
        if (v && typeof v === 'object' && !Array.isArray(v)) Object.assign(acc, this.flatten(v, `${key}.`));
        else acc[key] = Array.isArray(v) ? v.join(', ') : v;
        return acc;
      }, {});
    },

    trim_content(content, row_item = null) {
      if (typeof content == "string") {
        if (row_item == "created_at" || row_item == "updated_at") {
          return new Intl.DateTimeFormat("en-US", {
            year:"numeric", month:"2-digit", day:"2-digit",
            hour:"2-digit", minute:"2-digit", second:"2-digit",
          }).format(new Date(content));
        }
        return content.length > 50 ? content.substring(0, 50) + "..." : content;
      }
      if (content && typeof content === "object") {
        if (content.batch_number !== undefined) return `${content.batch_number} - ${content.shift_name}`;
        for (const key of Object.keys(content)) {
          if (key === "title" && content.title) return content.title;
          if (key === "name"  && content.name)  return content.name;
        }
      }
      return content || "";
    },
  },
};
</script>

<style scoped>
/* ── Show Details button ── */
.pd-btn {
  display: inline-flex; align-items: center; gap: 7px;
  background: rgba(250,176,5,0.12); color: #fab005;
  border: 1px solid rgba(250,176,5,0.35); border-radius: 8px;
  padding: 7px 16px; font-size: 0.8rem; font-weight: 700;
  cursor: pointer; transition: all .2s;
}
.pd-btn:hover { background: rgba(250,176,5,0.22); border-color: #fab005; }

/* ── Overlay ── */
.pd-overlay {
  position: fixed; inset: 0; z-index: 10000;
  background: rgba(0,0,0,0.78);
  display: flex; align-items: center; justify-content: center; padding: 16px;
}

/* ── Modal ── */
.pd-modal {
  background: linear-gradient(160deg,#1a2540 0%,#0f1c35 100%);
  border: 1px solid rgba(255,255,255,0.1); border-radius: 14px;
  width: 100%; max-width: 640px; max-height: 88vh;
  display: flex; flex-direction: column;
  box-shadow: 0 24px 70px rgba(0,0,0,0.6); overflow: hidden;
}

/* ── Header ── */
.pd-header {
  display: flex; align-items: center; justify-content: space-between;
  padding: 18px 24px; border-bottom: 1px solid rgba(255,255,255,0.08);
  background: rgba(255,255,255,0.03); flex-shrink: 0;
}
.pd-header-left { display: flex; align-items: center; gap: 12px; }
.pd-hicon {
  width: 38px; height: 38px; border-radius: 9px;
  background: linear-gradient(135deg,#fab005,#e09600);
  display: flex; align-items: center; justify-content: center;
  font-size: 1rem; color: #fff;
}
.pd-htitle { font-size: 0.95rem; font-weight: 700; color: #fff; }
.pd-hsub   { font-size: 0.72rem; color: rgba(255,255,255,0.4); margin-top: 2px; }
.pd-close {
  width: 32px; height: 32px; border-radius: 7px;
  border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.06);
  color: rgba(255,255,255,0.65); font-size: 0.95rem; cursor: pointer;
  display: flex; align-items: center; justify-content: center; transition: all .2s;
}
.pd-close:hover { background: rgba(220,38,38,0.25); border-color: rgba(220,38,38,0.5); color: #f87171; }

/* ── Body ── */
.pd-body {
  flex: 1; overflow-y: auto; padding: 0;
}
.pd-body::-webkit-scrollbar { width: 4px; }
.pd-body::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.12); border-radius: 4px; }

/* ── Table ── */
.pd-table { width: 100%; border-collapse: collapse; }
.pd-table tr:nth-child(odd)  { background: rgba(255,255,255,0.04); }
.pd-table tr:nth-child(even) { background: rgba(0,0,0,0.1); }
.pd-table tr:not(:last-child) { border-bottom: 1px solid rgba(255,255,255,0.06); }
.pd-key {
  width: 36%; padding: 9px 16px;
  font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: 0.4px; color: rgba(255,255,255,0.45);
  border-right: 1px solid rgba(255,255,255,0.07);
  white-space: nowrap; vertical-align: top;
}
.pd-val {
  padding: 9px 16px; font-size: 0.83rem;
  color: rgba(255,255,255,0.88); word-break: break-all; vertical-align: top;
}

/* ── Footer ── */
.pd-footer {
  padding: 12px 24px; border-top: 1px solid rgba(255,255,255,0.07);
  background: rgba(0,0,0,0.12); text-align: right; flex-shrink: 0;
}
.pd-close-btn {
  background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.7);
  border: 1px solid rgba(255,255,255,0.12); border-radius: 7px;
  padding: 7px 20px; font-size: 0.84rem; font-weight: 600; cursor: pointer; transition: all .2s;
}
.pd-close-btn:hover { background: rgba(255,255,255,0.14); color: #fff; }

/* ── Transition ── */
.pd-fade-enter-active, .pd-fade-leave-active { transition: opacity .18s ease; }
.pd-fade-enter-from,   .pd-fade-leave-to     { opacity: 0; }

/* ── Other nested tables (non payment_details) ── */
.nested-table-wrap { border-radius: 8px; overflow: hidden; border: 1px solid rgba(255,255,255,0.15); margin: 2px 0; }
.nested-table { width: 100%; border-collapse: collapse; font-size: 12px; }
.nested-table tr:nth-child(odd)  { background: rgba(255,255,255,0.05); }
.nested-table tr:nth-child(even) { background: rgba(0,0,0,0.12); }
.nested-table tr:not(:last-child) { border-bottom: 1px solid rgba(255,255,255,0.08); }
.nested-key { width:38%; padding:6px 12px; font-weight:600; font-size:11px; color:rgba(255,255,255,0.6); letter-spacing:.3px; text-transform:uppercase; white-space:nowrap; border-right:1px solid rgba(255,255,255,0.1); vertical-align:top; }
.nested-val { padding:6px 12px; color:rgba(255,255,255,0.92); font-size:12px; word-break:break-word; vertical-align:top; }
</style>
