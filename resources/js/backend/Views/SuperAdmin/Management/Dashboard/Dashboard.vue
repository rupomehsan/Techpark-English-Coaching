<template>
  <div class="dash-root">

    <!-- ── Stat Cards ───────────────────────────────────────── -->
    <div class="dash-section">
      <div class="stats-grid">
        <div v-for="card in stat_cards" :key="card.label" class="stat-card">
          <div class="stat-icon-wrap" :style="`background:${card.color}`">
            <i :class="card.icon"></i>
          </div>
          <div class="stat-info">
            <div class="stat-val">{{ card.value }}</div>
            <div class="stat-lbl">{{ card.label }}</div>
          </div>
          <div class="stat-accent" :style="`background:${card.color}`"></div>
        </div>
      </div>
    </div>

    <!-- ── Charts Row ────────────────────────────────────────── -->
    <div class="dash-section">
      <div class="charts-row">

        <!-- Enrollment Bar Chart -->
        <div class="glass-card chart-main">
          <div class="card-head">
            <div class="card-head-icon" style="background:#3b82f6">
              <i class="fa-solid fa-chart-column"></i>
            </div>
            <span class="card-head-title">Monthly Enrollments <span class="card-head-sub">last 6 months</span></span>
          </div>
          <div class="chart-wrap">
            <canvas id="enrollChart"></canvas>
          </div>
        </div>

        <!-- Revenue Line Chart -->
        <div class="glass-card chart-side">
          <div class="card-head">
            <div class="card-head-icon" style="background:#f59e0b">
              <i class="fa-solid fa-bangladeshi-taka-sign"></i>
            </div>
            <span class="card-head-title">Revenue <span class="card-head-sub">last 6 months</span></span>
          </div>
          <div class="chart-wrap">
            <canvas id="revenueChart"></canvas>
          </div>
        </div>

      </div>
    </div>

    <!-- ── Bottom Row ────────────────────────────────────────── -->
    <div class="dash-section">
      <div class="bottom-row">

        <!-- Recent Enrollments -->
        <div class="glass-card enroll-panel">
          <div class="card-head">
            <div class="card-head-icon" style="background:#8b5cf6">
              <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <span class="card-head-title">Recent Live Course Enrollments</span>
            <router-link :to="{ name: 'AllLiveCourseEnrollment' }" class="view-all-link">View All →</router-link>
          </div>
          <div class="table-scroll">
            <table class="dash-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Student</th>
                  <th>Course</th>
                  <th>Batch</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="loading">
                  <td colspan="7" class="empty-row"><span class="loader-dot"></span> Loading…</td>
                </tr>
                <tr v-else-if="!data.recent_enrollments || data.recent_enrollments.length === 0">
                  <td colspan="7" class="empty-row">No enrollments yet</td>
                </tr>
                <tr v-for="(e, i) in data.recent_enrollments" :key="e.id" v-else>
                  <td class="td-num">{{ i + 1 }}</td>
                  <td>
                    <div class="td-name">{{ e.name }}</div>
                    <div class="td-sub">{{ e.phone }}</div>
                  </td>
                  <td class="td-course">{{ e.course }}</td>
                  <td>{{ e.batch }}</td>
                  <td class="td-amt">৳{{ Number(e.amount).toLocaleString() }}</td>
                  <td><span class="status-pill" :class="`sp-${e.payment_status}`">{{ e.payment_status }}</span></td>
                  <td class="td-date">{{ e.enrolled_at }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Right panel -->
        <div class="right-col">

          <!-- Messages -->
          <div class="glass-card msg-panel">
            <div class="card-head">
              <div class="card-head-icon" style="background:#ec4899">
                <i class="fa-solid fa-comments"></i>
              </div>
              <span class="card-head-title">Recent Messages</span>
              <router-link :to="{ name: 'AllContactMessage' }" class="view-all-link">View All →</router-link>
            </div>
            <div class="msg-list">
              <div v-if="!data.recent_messages || data.recent_messages.length === 0" class="msg-empty">No messages yet</div>
              <div v-for="m in data.recent_messages" :key="m.id" class="msg-row">
                <div class="msg-av" :style="`background:${strColor(m.name)}`">{{ initial(m.name) }}</div>
                <div class="msg-body">
                  <div class="msg-name">{{ m.name }}</div>
                  <div class="msg-text">{{ m.message }}</div>
                </div>
                <div class="msg-date">{{ m.created_at }}</div>
              </div>
            </div>
          </div>

          <!-- Google Analytics -->
          <div class="glass-card ga-panel">
            <div class="card-head">
              <div class="card-head-icon" style="background:#f59e0b">
                <svg width="16" height="16" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="4" y="4" width="8" height="36" rx="4" fill="#fff"/>
                  <rect x="20" y="20" width="8" height="20" rx="4" fill="#fff" opacity="0.8"/>
                  <circle cx="40" cy="36" r="6" fill="#fff" opacity="0.9"/>
                </svg>
              </div>
              <span class="card-head-title">Google Analytics</span>
            </div>
            <div class="ga-body">
              <div v-if="data.ga_measurement_id" class="ga-active">
                <div class="ga-label">Measurement ID</div>
                <div class="ga-id">{{ data.ga_measurement_id }}</div>
                <div class="ga-status active"><i class="fa-solid fa-circle-check"></i> Tracking active on frontend</div>
              </div>
              <div v-else class="ga-inactive">
                <i class="fa-solid fa-triangle-exclamation ga-warn-icon"></i>
                <div class="ga-warn-title">Tracking not configured</div>
                <div class="ga-warn-text">Add key <code>ga_measurement_id</code> in Website Settings to activate GA4.</div>
              </div>
              <a href="https://analytics.google.com" target="_blank" class="ga-btn">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Google Analytics
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="overlay"></div>
  </div>
</template>

<script>
const AVATAR_COLORS = ['#3b82f6','#8b5cf6','#ec4899','#f59e0b','#10b981','#ef4444','#06b6d4'];

export default {
  data: () => ({
    data: {},
    loading: true,
    enrollChart: null,
    revenueChart: null,
  }),

  created() {
    this.load_chartjs().then(() => this.get_all_dashboard_data());
  },

  beforeUnmount() {
    if (this.enrollChart) this.enrollChart.destroy();
    if (this.revenueChart) this.revenueChart.destroy();
  },

  methods: {
    load_chartjs() {
      if (window.Chart) return Promise.resolve();
      return new Promise((resolve, reject) => {
        const s = document.createElement('script');
        s.src = 'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js';
        s.onload = resolve;
        s.onerror = reject;
        document.head.appendChild(s);
      });
    },

    async get_all_dashboard_data() {
      this.loading = true;
      try {
        const res = await axios.get('get-all-dashboard-data');
        if (res.status === 200) {
          this.data = res.data.data;
          this.$nextTick(() => this.init_charts());
        }
      } finally {
        this.loading = false;
      }
    },

    init_charts() {
      const d = this.data;
      if (!d.chart_labels || !window.Chart) return;

      if (this.enrollChart) { this.enrollChart.destroy(); this.enrollChart = null; }
      if (this.revenueChart) { this.revenueChart.destroy(); this.revenueChart = null; }

      const enrollCtx = document.getElementById('enrollChart');
      if (enrollCtx) {
        this.enrollChart = new window.Chart(enrollCtx, {
          type: 'bar',
          data: {
            labels: d.chart_labels,
            datasets: [
              {
                label: 'Live',
                data: d.chart_live_enrollments,
                backgroundColor: 'rgba(99,102,241,0.85)',
                borderRadius: 6,
                borderSkipped: false,
              },
              {
                label: 'Recorded',
                data: d.chart_recorded_enrollments,
                backgroundColor: 'rgba(16,185,129,0.85)',
                borderRadius: 6,
                borderSkipped: false,
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                position: 'top',
                labels: { color: '#cbd5e1', font: { size: 12 }, boxWidth: 12 },
              },
            },
            scales: {
              x: { ticks: { color: '#94a3b8' }, grid: { color: 'rgba(255,255,255,0.05)' } },
              y: { beginAtZero: true, ticks: { color: '#94a3b8', precision: 0 }, grid: { color: 'rgba(255,255,255,0.07)' } },
            },
          },
        });
      }

      const revCtx = document.getElementById('revenueChart');
      if (revCtx) {
        this.revenueChart = new window.Chart(revCtx, {
          type: 'line',
          data: {
            labels: d.chart_labels,
            datasets: [
              {
                label: 'Revenue (৳)',
                data: d.chart_revenue,
                borderColor: '#f59e0b',
                backgroundColor: 'rgba(245,158,11,0.12)',
                fill: true,
                tension: 0.45,
                pointBackgroundColor: '#f59e0b',
                pointRadius: 4,
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                labels: { color: '#cbd5e1', font: { size: 12 }, boxWidth: 12 },
              },
            },
            scales: {
              x: { ticks: { color: '#94a3b8' }, grid: { color: 'rgba(255,255,255,0.05)' } },
              y: { beginAtZero: true, ticks: { color: '#94a3b8' }, grid: { color: 'rgba(255,255,255,0.07)' } },
            },
          },
        });
      }
    },

    initial(name) {
      return (name || '?').trim().charAt(0).toUpperCase();
    },
    strColor(name) {
      let h = 0;
      for (let i = 0; i < (name || '').length; i++) h = (name.charCodeAt(i) + h * 31) & 0xffffffff;
      return AVATAR_COLORS[Math.abs(h) % AVATAR_COLORS.length];
    },
  },

  computed: {
    stat_cards() {
      const d = this.data;
      return [
        { label: 'Total Users',          value: d.total_users ?? 0,                                   icon: 'fa-solid fa-users',                    color: '#3b82f6' },
        { label: 'Live Courses',         value: d.total_live_courses ?? 0,                             icon: 'fa-solid fa-chalkboard-user',          color: '#8b5cf6' },
        { label: 'Recorded Courses',     value: d.total_recorded_courses ?? 0,                         icon: 'fa-solid fa-video',                    color: '#10b981' },
        { label: 'Live Enrollments',     value: d.total_live_enrollments ?? 0,                         icon: 'fa-solid fa-user-graduate',            color: '#f97316' },
        { label: 'Recorded Enroll.',     value: d.total_recorded_enrollments ?? 0,                     icon: 'fa-solid fa-circle-play',              color: '#06b6d4' },
        { label: 'Live Revenue (৳)',     value: Number(d.live_revenue ?? 0).toLocaleString(),          icon: 'fa-solid fa-bangladeshi-taka-sign',    color: '#22c55e' },
        { label: 'Pending',              value: d.pending_live_enrollments ?? 0,                       icon: 'fa-solid fa-clock',                    color: '#eab308' },
        { label: 'Messages',             value: d.total_messages ?? 0,                                 icon: 'fa-solid fa-envelope',                 color: '#ec4899' },
      ];
    },
  },
};
</script>

<style scoped>
/* ── Root ──────────────────────────────────────────────────── */
.dash-root {
  min-height: 100vh;
  padding: 20px 20px 40px;
  background: transparent;
}
.dash-section { margin-bottom: 22px; }

/* ── Glassmorphism card ─────────────────────────────────────── */
.glass-card {
  background: rgba(255, 255, 255, 0.10);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  border: 1px solid rgba(255, 255, 255, 0.14);
  border-radius: 16px;
  overflow: hidden;
}

/* ── Card Header ─────────────────────────────────────────────── */
.card-head {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 14px 18px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}
.card-head-icon {
  width: 34px;
  height: 34px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 0.88rem;
  flex-shrink: 0;
}
.card-head-title {
  font-size: 0.88rem;
  font-weight: 700;
  color: #e2e8f0;
  flex: 1;
}
.card-head-sub {
  font-size: 0.72rem;
  font-weight: 400;
  color: #94a3b8;
  margin-left: 6px;
}
.view-all-link {
  font-size: 0.73rem;
  color: #60a5fa;
  text-decoration: none;
  font-weight: 600;
  white-space: nowrap;
}
.view-all-link:hover { text-decoration: underline; color: #93c5fd; }

/* ── Stat Cards Grid ──────────────────────────────────────────── */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
}
@media (max-width: 1100px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 560px)  { .stats-grid { grid-template-columns: 1fr 1fr; } }

.stat-card {
  position: relative;
  display: flex;
  align-items: center;
  gap: 14px;
  background: rgba(255, 255, 255, 0.10);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  border: 1px solid rgba(255, 255, 255, 0.13);
  border-radius: 16px;
  padding: 18px 18px 18px 18px;
  overflow: hidden;
}
.stat-accent {
  position: absolute;
  top: 0; left: 0;
  width: 4px;
  height: 100%;
  border-radius: 16px 0 0 16px;
  opacity: 0.9;
}
.stat-icon-wrap {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.1rem;
  color: #fff;
  flex-shrink: 0;
  opacity: 0.9;
}
.stat-info { min-width: 0; }
.stat-val {
  font-size: 1.55rem;
  font-weight: 800;
  color: #f1f5f9;
  line-height: 1.1;
}
.stat-lbl {
  font-size: 0.72rem;
  color: #94a3b8;
  font-weight: 500;
  margin-top: 3px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

/* ── Charts Row ───────────────────────────────────────────────── */
.charts-row {
  display: grid;
  grid-template-columns: 1fr 380px;
  gap: 16px;
}
@media (max-width: 1100px) { .charts-row { grid-template-columns: 1fr; } }

.chart-main, .chart-side { /* extends .glass-card */ }

.chart-wrap {
  padding: 16px 18px 18px;
  height: 260px;
  position: relative;
}
.chart-side .chart-wrap { height: 240px; }

/* ── Bottom Row ──────────────────────────────────────────────── */
.bottom-row {
  display: grid;
  grid-template-columns: 1fr 360px;
  gap: 16px;
  align-items: start;
}
@media (max-width: 1100px) { .bottom-row { grid-template-columns: 1fr; } }

.right-col {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

/* ── Enrollments Table ───────────────────────────────────────── */
.table-scroll { overflow-x: auto; }
.dash-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 0.81rem;
}
.dash-table th {
  padding: 10px 14px;
  text-align: left;
  text-transform: uppercase;
  font-size: 0.68rem;
  font-weight: 700;
  color: #64748b;
  background: rgba(255,255,255,0.04);
  letter-spacing: 0.5px;
  white-space: nowrap;
}
.dash-table td {
  padding: 10px 14px;
  border-top: 1px solid rgba(255,255,255,0.06);
  vertical-align: middle;
  color: #cbd5e1;
}
.dash-table tbody tr:hover { background: rgba(255,255,255,0.04); }
.td-num { color: #64748b; font-size: 0.75rem; }
.td-name { font-weight: 600; color: #e2e8f0; }
.td-sub { font-size: 0.72rem; color: #64748b; }
.td-course { max-width: 160px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.td-amt { font-weight: 700; color: #e2e8f0; }
.td-date { white-space: nowrap; font-size: 0.75rem; color: #64748b; }
.empty-row { text-align: center; padding: 28px !important; color: #475569; font-size: 0.83rem; }

/* ── Status Pills ─────────────────────────────────────────────── */
.status-pill {
  display: inline-block;
  padding: 3px 10px;
  border-radius: 50px;
  font-size: 0.67rem;
  font-weight: 700;
  text-transform: capitalize;
  letter-spacing: 0.3px;
}
.sp-paid    { background: rgba(34,197,94,0.18);  color: #4ade80; border: 1px solid rgba(34,197,94,0.3); }
.sp-pending { background: rgba(234,179,8,0.18);  color: #facc15; border: 1px solid rgba(234,179,8,0.3); }
.sp-failed  { background: rgba(239,68,68,0.18);  color: #f87171; border: 1px solid rgba(239,68,68,0.3); }

/* ── Messages ─────────────────────────────────────────────────── */
.msg-list { padding: 6px 0; }
.msg-empty { text-align: center; padding: 22px; color: #475569; font-size: 0.82rem; }
.msg-row {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  padding: 10px 16px;
  border-bottom: 1px solid rgba(255,255,255,0.05);
  transition: background 0.15s;
}
.msg-row:last-child { border-bottom: none; }
.msg-row:hover { background: rgba(255,255,255,0.04); }
.msg-av {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.8rem;
  font-weight: 800;
  color: #fff;
  flex-shrink: 0;
}
.msg-body { flex: 1; min-width: 0; }
.msg-name  { font-size: 0.82rem; font-weight: 700; color: #e2e8f0; }
.msg-text  { font-size: 0.74rem; color: #64748b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.msg-date  { font-size: 0.68rem; color: #475569; white-space: nowrap; margin-top: 3px; }

/* ── Google Analytics Card ────────────────────────────────────── */
.ga-body { padding: 16px 18px 18px; }
.ga-active {}
.ga-label  { font-size: 0.72rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
.ga-id     { display: inline-block; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: 6px; padding: 4px 12px; font-size: 0.88rem; font-weight: 700; color: #f1f5f9; font-family: monospace; margin-bottom: 8px; }
.ga-status { font-size: 0.75rem; font-weight: 600; margin-bottom: 14px; }
.ga-status.active { color: #4ade80; }
.ga-inactive { text-align: center; padding: 8px 0 14px; }
.ga-warn-icon  { font-size: 1.8rem; color: #f59e0b; display: block; margin-bottom: 8px; }
.ga-warn-title { font-size: 0.88rem; font-weight: 700; color: #e2e8f0; margin-bottom: 4px; }
.ga-warn-text  { font-size: 0.75rem; color: #64748b; }
.ga-warn-text code { background: rgba(255,255,255,0.08); padding: 1px 5px; border-radius: 3px; color: #f59e0b; }
.ga-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 7px;
  margin-top: 14px;
  background: linear-gradient(135deg, #f59e0b, #d97706);
  color: #fff;
  text-decoration: none;
  font-size: 0.82rem;
  font-weight: 700;
  padding: 10px 18px;
  border-radius: 8px;
  transition: opacity 0.2s;
}
.ga-btn:hover { opacity: 0.85; color: #fff; }

/* ── Loader dot ───────────────────────────────────────────────── */
.loader-dot {
  display: inline-block;
  width: 6px;
  height: 6px;
  background: #60a5fa;
  border-radius: 50%;
  animation: pulse 1s infinite;
}
@keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.3} }
</style>
