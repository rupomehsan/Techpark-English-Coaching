<template>
  <teleport to="body">
    <transition name="modal-fade">
      <div v-if="show_detail_modal" class="dm-overlay" @click.self="close">
        <div class="dm-modal">

          <!-- Header -->
          <div class="dm-header">
            <div class="dm-header-left">
              <div class="dm-icon"><i class="fa fa-file-alt"></i></div>
              <div>
                <div class="dm-title">Enrollment Details</div>
                <div class="dm-sub">ID: {{ item.id }} &nbsp;|&nbsp; {{ item.payment_status }}</div>
              </div>
            </div>
            <button class="dm-close" @click="close"><i class="fa fa-xmark"></i></button>
          </div>

          <!-- Body -->
          <div class="dm-body">
            <div class="dm-grid">

              <!-- Student Info -->
              <section class="dm-section">
                <div class="dm-section-label"><i class="fa fa-user me-1"></i> শিক্ষার্থীর তথ্য</div>
                <div class="dm-info-grid">
                  <template v-if="item.student_info && typeof item.student_info === 'object'">
                    <div class="dm-info-row" v-for="(val, key) in item.student_info" :key="key">
                      <span class="dm-info-key">{{ key }}</span>
                      <span class="dm-info-val">{{ val || '—' }}</span>
                    </div>
                  </template>
                  <div class="dm-info-row" v-else>
                    <span class="dm-info-val text-muted">No student info</span>
                  </div>
                </div>
              </section>

              <!-- Course & Batch -->
              <section class="dm-section">
                <div class="dm-section-label"><i class="fa fa-graduation-cap me-1"></i> কোর্স ও ব্যাচ</div>
                <div class="dm-info-grid">
                  <div class="dm-info-row">
                    <span class="dm-info-key">Live Course ID</span>
                    <span class="dm-info-val">{{ item.live_course_id || '—' }}</span>
                  </div>
                  <div class="dm-info-row">
                    <span class="dm-info-key">Batch ID</span>
                    <span class="dm-info-val">{{ item.batch_id || '—' }}</span>
                  </div>
                  <div class="dm-info-row">
                    <span class="dm-info-key">Enrolled At</span>
                    <span class="dm-info-val">{{ formatDate(item.enrolled_at) }}</span>
                  </div>
                </div>
              </section>

              <!-- Payment Info -->
              <section class="dm-section">
                <div class="dm-section-label"><i class="fa fa-credit-card me-1"></i> পেমেন্ট তথ্য</div>
                <div class="dm-info-grid">
                  <div class="dm-info-row">
                    <span class="dm-info-key">Method</span>
                    <span class="dm-info-val">{{ item.method || '—' }}</span>
                  </div>
                  <div class="dm-info-row">
                    <span class="dm-info-key">Amount</span>
                    <span class="dm-info-val dm-amount">৳ {{ item.amount ? Number(item.amount).toLocaleString() : '—' }}</span>
                  </div>
                  <div class="dm-info-row">
                    <span class="dm-info-key">Amount Paid</span>
                    <span class="dm-info-val dm-amount">৳ {{ item.amount_paid ? Number(item.amount_paid).toLocaleString() : '0' }}</span>
                  </div>
                  <div class="dm-info-row">
                    <span class="dm-info-key">Status</span>
                    <span class="dm-info-val">
                      <span :class="statusClass(item.payment_status)">{{ item.payment_status || '—' }}</span>
                    </span>
                  </div>
                  <div class="dm-info-row">
                    <span class="dm-info-key">Transaction ID</span>
                    <span class="dm-info-val dm-mono">{{ item.transaction_id || '—' }}</span>
                  </div>
                </div>
              </section>

              <!-- Payment Screenshot -->
              <section class="dm-section" v-if="item.payment_photo">
                <div class="dm-section-label"><i class="fa fa-image me-1"></i> পেমেন্ট স্ক্রিনশট</div>
                <a :href="imgSrc(item.payment_photo)" data-fancybox="dm-gallery" data-caption="Payment Screenshot">
                  <img :src="imgSrc(item.payment_photo)" class="dm-screenshot" alt="Payment Screenshot" @error="$event.target.src='/avatar.png'" />
                </a>
              </section>

              <!-- Payment Details JSON -->
              <section class="dm-section dm-full" v-if="item.payment_details && isObject(item.payment_details)">
                <div class="dm-section-label"><i class="fa fa-receipt me-1"></i> Payment Details</div>
                <div class="dm-details-table-wrap">
                  <table class="dm-details-table">
                    <tbody>
                      <tr v-for="(val, key) in flattenObj(item.payment_details)" :key="key">
                        <td class="dm-dt-key">{{ key }}</td>
                        <td class="dm-dt-val">{{ val !== null && val !== undefined && val !== '' ? val : '—' }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </section>

            </div>
          </div>

          <!-- Footer -->
          <div class="dm-footer">
            <span class="dm-slug">Slug: {{ item.slug }}</span>
            <button class="dm-btn-close" @click="close">বন্ধ করুন</button>
          </div>

        </div>
      </div>
    </transition>
  </teleport>
</template>

<script>
import { mapActions, mapWritableState } from 'pinia';
import { store } from '../../store';
import { Fancybox } from '@fancyapps/ui';
import '@fancyapps/ui/dist/fancybox/fancybox.css';

export default {
  computed: {
    ...mapWritableState(store, ['show_detail_modal', 'item']),
  },
  watch: {
    show_detail_modal(val) {
      if (val) {
        document.body.style.overflow = 'hidden';
        this.$nextTick(() => Fancybox.bind('[data-fancybox="dm-gallery"]'));
      } else {
        document.body.style.overflow = '';
        Fancybox.destroy();
      }
    },
  },
  methods: {
    ...mapActions(store, ['set_show_detail_modal']),

    close() { this.set_show_detail_modal(false); },

    imgSrc(path) {
      if (!path) return '/avatar.png';
      return path.startsWith('/') || path.startsWith('http') ? path : '/' + path;
    },

    isObject(val) {
      return val && typeof val === 'object';
    },

    flattenObj(obj, prefix = '') {
      return Object.entries(obj).reduce((acc, [k, v]) => {
        const key = prefix ? `${prefix}.${k}` : k;
        if (v && typeof v === 'object' && !Array.isArray(v)) {
          Object.assign(acc, this.flattenObj(v, key));
        } else {
          acc[key] = Array.isArray(v) ? v.join(', ') : v;
        }
        return acc;
      }, {});
    },

    formatDate(val) {
      if (!val) return '—';
      return new Intl.DateTimeFormat('en-GB', {
        year: 'numeric', month: 'short', day: '2-digit',
        hour: '2-digit', minute: '2-digit',
      }).format(new Date(val));
    },

    statusClass(status) {
      const map = {
        paid: 'dm-badge dm-badge-paid',
        pending: 'dm-badge dm-badge-pending',
        partial: 'dm-badge dm-badge-partial',
        refunded: 'dm-badge dm-badge-refunded',
      };
      return map[status] || 'dm-badge dm-badge-default';
    },
  },
};
</script>

<style scoped>
/* Overlay */
.dm-overlay {
  position: fixed; inset: 0; z-index: 9999;
  background: rgba(0, 0, 0, 0.75);
  display: flex; align-items: center; justify-content: center;
  padding: 16px;
}

/* Modal box */
.dm-modal {
  background: linear-gradient(160deg, #1a2540 0%, #0f1c35 100%);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 16px;
  width: 100%; max-width: 860px;
  max-height: 90vh;
  display: flex; flex-direction: column;
  box-shadow: 0 24px 80px rgba(0,0,0,0.6);
  overflow: hidden;
}

/* Header */
.dm-header {
  display: flex; align-items: center; justify-content: space-between;
  padding: 20px 28px;
  border-bottom: 1px solid rgba(255,255,255,0.08);
  background: rgba(255,255,255,0.03);
  flex-shrink: 0;
}
.dm-header-left { display: flex; align-items: center; gap: 14px; }
.dm-icon {
  width: 42px; height: 42px; border-radius: 10px;
  background: linear-gradient(135deg, #fab005, #e09600);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.1rem; color: #fff; flex-shrink: 0;
}
.dm-title { font-size: 1rem; font-weight: 700; color: #fff; }
.dm-sub  { font-size: 0.75rem; color: rgba(255,255,255,0.45); margin-top: 2px; text-transform: capitalize; }
.dm-close {
  width: 34px; height: 34px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.15);
  background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.7);
  font-size: 1rem; cursor: pointer; transition: all .2s;
  display: flex; align-items: center; justify-content: center;
}
.dm-close:hover { background: rgba(220,38,38,0.25); border-color: rgba(220,38,38,0.5); color: #f87171; }

/* Body */
.dm-body { flex: 1; overflow-y: auto; padding: 24px 28px; }
.dm-body::-webkit-scrollbar { width: 5px; }
.dm-body::-webkit-scrollbar-track { background: transparent; }
.dm-body::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 4px; }

.dm-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}
.dm-full { grid-column: 1 / -1; }

/* Sections */
.dm-section {
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 12px; padding: 16px 18px;
}
.dm-section-label {
  font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: 0.8px; color: #fab005;
  background: rgba(250,176,5,0.1); border: 1px solid rgba(250,176,5,0.2);
  border-radius: 50px; padding: 3px 12px;
  display: inline-block; margin-bottom: 14px;
}

/* Info rows */
.dm-info-grid { display: flex; flex-direction: column; gap: 0; }
.dm-info-row {
  display: flex; align-items: baseline; gap: 8px;
  padding: 7px 0;
  border-bottom: 1px solid rgba(255,255,255,0.05);
}
.dm-info-row:last-child { border-bottom: none; }
.dm-info-key {
  min-width: 110px; font-size: 0.75rem; font-weight: 600;
  color: rgba(255,255,255,0.45); text-transform: capitalize; flex-shrink: 0;
}
.dm-info-val { font-size: 0.84rem; color: rgba(255,255,255,0.88); word-break: break-word; }
.dm-amount  { color: #fab005; font-weight: 700; }
.dm-mono    { font-family: monospace; font-size: 0.8rem; color: #93c5fd; }

/* Status badges */
.dm-badge { padding: 3px 12px; border-radius: 20px; font-size: 0.72rem; font-weight: 700; }
.dm-badge-paid     { background: #dcfce7; color: #16a34a; }
.dm-badge-pending  { background: #fef3c7; color: #d97706; }
.dm-badge-partial  { background: #dbeafe; color: #2563eb; }
.dm-badge-refunded { background: #fee2e2; color: #dc2626; }
.dm-badge-default  { background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.6); }

/* Screenshot */
.dm-screenshot {
  width: 100%; max-height: 200px; object-fit: contain;
  border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);
  cursor: pointer; transition: opacity .2s; background: rgba(0,0,0,0.2);
}
.dm-screenshot:hover { opacity: .85; }

/* Payment details table */
.dm-details-table-wrap { border-radius: 8px; overflow: hidden; border: 1px solid rgba(255,255,255,0.08); }
.dm-details-table { width: 100%; border-collapse: collapse; }
.dm-details-table tr:nth-child(odd)  { background: rgba(255,255,255,0.04); }
.dm-details-table tr:nth-child(even) { background: rgba(0,0,0,0.1); }
.dm-details-table tr:not(:last-child) { border-bottom: 1px solid rgba(255,255,255,0.06); }
.dm-dt-key {
  width: 32%; padding: 7px 14px; font-size: 0.72rem; font-weight: 600;
  color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 0.3px;
  border-right: 1px solid rgba(255,255,255,0.08); vertical-align: top; white-space: nowrap;
}
.dm-dt-val { padding: 7px 14px; font-size: 0.82rem; color: rgba(255,255,255,0.88); word-break: break-word; }

/* Footer */
.dm-footer {
  display: flex; align-items: center; justify-content: space-between;
  padding: 14px 28px;
  border-top: 1px solid rgba(255,255,255,0.08);
  background: rgba(0,0,0,0.15); flex-shrink: 0;
}
.dm-slug { font-size: 0.72rem; color: rgba(255,255,255,0.3); font-family: monospace; }
.dm-btn-close {
  background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.7);
  border: 1px solid rgba(255,255,255,0.12); border-radius: 8px;
  padding: 8px 22px; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all .2s;
}
.dm-btn-close:hover { background: rgba(255,255,255,0.14); color: #fff; }

/* Transition */
.modal-fade-enter-active, .modal-fade-leave-active { transition: opacity .2s ease; }
.modal-fade-enter-from, .modal-fade-leave-to { opacity: 0; }

@media (max-width: 640px) {
  .dm-grid { grid-template-columns: 1fr; }
  .dm-body { padding: 16px; }
  .dm-header { padding: 14px 16px; }
  .dm-footer { padding: 12px 16px; }
}
</style>
