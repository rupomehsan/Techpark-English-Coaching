<template>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <div class="cfg-card card shadow-sm border-0">
                    <div
                        class="card-header d-flex align-items-center gap-2"
                        style="
                            background: linear-gradient(
                                135deg,
                                #001e3c,
                                #002d5c
                            );
                            color: #fff;
                            border-radius: 8px 8px 0 0;
                        "
                    >
                        <i class="zmdi zmdi-email fs-5 m-3"></i>
                        <div>
                            <h5 class="mb-0 fw-bold">
                                Email (SMTP) Configuration
                            </h5>
                            <small style="opacity: 0.6"
                                >Outgoing mail server settings</small
                            >
                        </div>
                        <button
                            type="button"
                            class="btn btn-sm ms-auto"
                            style="
                                background: rgba(255, 255, 255, 0.1);
                                color: #fff;
                                border: 1px solid rgba(255, 255, 255, 0.2);
                            "
                            @click="testEmail"
                            :disabled="testing || !item.id"
                        >
                            <span
                                v-if="testing"
                                class="spinner-border spinner-border-sm me-1"
                            ></span>
                            <i v-else class="zmdi zmdi-send me-1"></i>
                            {{ testing ? "Sending..." : "Test Email" }}
                        </button>
                    </div>

                    <div v-if="loading" class="card-body text-center py-5">
                        <div
                            class="spinner-border text-primary"
                            role="status"
                        ></div>
                        <p class="mt-2 text-muted">Loading configuration...</p>
                    </div>

                    <form v-else @submit.prevent="handleSubmit">
                        <div class="card-body">
                            <!-- Alert -->
                            <div
                                v-if="alert.show"
                                :class="`alert alert-${alert.type} alert-dismissible`"
                                role="alert"
                            >
                                {{ alert.message }}
                                <button
                                    type="button"
                                    class="btn-close"
                                    @click="alert.show = false"
                                ></button>
                            </div>

                            <!-- SMTP Server -->
                            <h6 class="section-heading">
                                <i class="zmdi zmdi-dns me-1"></i> Server
                                Settings
                            </h6>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"
                                        >SMTP Host
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            ><i class="zmdi zmdi-globe"></i
                                        ></span>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="host"
                                            v-model="item.host"
                                            placeholder="smtp.gmail.com"
                                            required
                                        />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold"
                                        >Port
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="port"
                                        v-model="item.port"
                                        placeholder="587"
                                        required
                                    />
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold"
                                        >Encryption</label
                                    >
                                    <select
                                        class="form-control form-control-square mb-2"
                                        name="encryption"
                                        v-model="item.encryption"
                                    >
                                        <option value="tls">
                                            TLS (port 587)
                                        </option>
                                        <option value="ssl">
                                            SSL (port 465)
                                        </option>
                                        <option value="">None</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Auth -->
                            <h6 class="section-heading">
                                <i class="zmdi zmdi-lock me-1"></i>
                                Authentication
                            </h6>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"
                                        >Username / Email</label
                                    >
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            ><i class="zmdi zmdi-account"></i
                                        ></span>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="username"
                                            v-model="item.username"
                                            placeholder="you@gmail.com"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"
                                        >Password / App Password</label
                                    >
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            ><i
                                                class="zmdi zmdi-lock-outline"
                                            ></i
                                        ></span>
                                        <input
                                            :type="
                                                showPassword
                                                    ? 'text'
                                                    : 'password'
                                            "
                                            class="form-control"
                                            name="password"
                                            v-model="item.password"
                                            placeholder="Gmail App Password"
                                        />
                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary"
                                            @click="
                                                showPassword = !showPassword
                                            "
                                        >
                                            <i
                                                :class="
                                                    showPassword
                                                        ? 'zmdi zmdi-eye-off'
                                                        : 'zmdi zmdi-eye'
                                                "
                                            ></i>
                                        </button>
                                    </div>
                                    <div class="form-text">
                                        For Gmail, use an
                                        <strong>App Password</strong> (not your
                                        account password).
                                    </div>
                                </div>
                            </div>

                            <!-- Sender -->
                            <h6 class="section-heading">
                                <i class="zmdi zmdi-email-open me-1"></i> Sender
                                Details
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"
                                        >From Name</label
                                    >
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            ><i class="zmdi zmdi-badge"></i
                                        ></span>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="mail_from_name"
                                            v-model="item.mail_from_name"
                                            placeholder="TechPark English"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"
                                        >From Email</label
                                    >
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            ><i class="zmdi zmdi-email"></i
                                        ></span>
                                        <input
                                            type="email"
                                            class="form-control"
                                            name="mail_from_email"
                                            v-model="item.mail_from_email"
                                            placeholder="noreply@techparkenglish.com"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"
                                        >Test Recipient Email</label
                                    >
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            ><i class="zmdi zmdi-email-open"></i
                                        ></span>
                                        <input
                                            type="email"
                                            class="form-control"
                                            v-model="testTo"
                                            placeholder="test@example.com"
                                        />
                                    </div>
                                    <div class="form-text">
                                        Used when clicking "Test Email" button
                                        above.
                                    </div>
                                </div>
                            </div>

                            <!-- Gmail hint -->
                            <div
                                class="mt-4 p-3 rounded"
                                style="
                                    background: #fff8e6;
                                    border: 1px solid #ffe0a3;
                                "
                            >
                                <div
                                    class="fw-bold mb-1"
                                    style="font-size: 0.82rem; color: #92601a"
                                >
                                    <i class="zmdi zmdi-alert-circle me-1"></i
                                    >Gmail App Password Setup
                                </div>
                                <ol
                                    style="
                                        font-size: 0.78rem;
                                        color: #6b7a90;
                                        margin: 0;
                                        padding-left: 16px;
                                        line-height: 1.8;
                                    "
                                >
                                    <li>
                                        Go to
                                        <strong
                                            >myaccount.google.com → Security →
                                            2-Step Verification</strong
                                        >
                                        (must be enabled)
                                    </li>
                                    <li>
                                        Search "App passwords" → select app:
                                        Mail, device: Other → enter "TechPark"
                                    </li>
                                    <li>
                                        Copy the 16-char password and paste it
                                        in the Password field above
                                    </li>
                                </ol>
                            </div>
                        </div>

                        <div
                            class="card-footer d-flex justify-content-between align-items-center"
                            style="background: #fafcff"
                        >
                            <small class="text-muted"
                                >Last updated:
                                {{
                                    item.updated_at
                                        ? new Date(
                                              item.updated_at,
                                          ).toLocaleString()
                                        : "N/A"
                                }}</small
                            >
                            <button
                                type="submit"
                                class="btn btn-primary px-5"
                                :disabled="saving"
                            >
                                <span
                                    v-if="saving"
                                    class="spinner-border spinner-border-sm me-1"
                                ></span>
                                <i v-else class="zmdi zmdi-save me-1"></i>
                                {{
                                    saving ? "Saving..." : "Save Configuration"
                                }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "EmailConfig",

    data() {
        return {
            loading: true,
            saving: false,
            testing: false,
            showPassword: false,
            testTo: "",
            item: {
                id: null,
                slug: "",
                host: "",
                port: 587,
                email: "",
                username: "",
                password: "",
                mail_from_name: "",
                mail_from_email: "",
                encryption: "tls",
            },
            alert: { show: false, type: "success", message: "" },
        };
    },

    created() {
        this.fetchConfig();
    },

    methods: {
        async fetchConfig() {
            try {
                const res = await axios.get(
                    "email-configures?get_all=1&limit=1",
                );
                const list = res.data.data;
                if (Array.isArray(list) && list.length > 0) {
                    this.item = list[0];
                    this.testTo =
                        this.item.email || this.item.mail_from_email || "";
                }
            } catch (e) {
                this.showAlert("danger", "Failed to load configuration.");
            } finally {
                this.loading = false;
            }
        },

        async handleSubmit() {
            this.saving = true;
            try {
                const fd = new FormData();
                [
                    "host",
                    "port",
                    "email",
                    "username",
                    "password",
                    "mail_from_name",
                    "mail_from_email",
                    "encryption",
                ].forEach((k) => {
                    fd.append(k, this.item[k] ?? "");
                });
                fd.append("id", this.item.id);

                const res = await axios.post(
                    `email-configures/update/${this.item.slug}`,
                    fd,
                );
                if ([200, 201].includes(res.status)) {
                    if (res.data.data)
                        this.item = { ...this.item, ...res.data.data };
                    this.showAlert(
                        "success",
                        "Email configuration saved successfully!",
                    );
                }
            } catch (e) {
                this.showAlert(
                    "danger",
                    e?.response?.data?.message ??
                        "Failed to save. Check fields and try again.",
                );
            } finally {
                this.saving = false;
            }
        },

        async testEmail() {
            if (!this.testTo) {
                this.showAlert(
                    "warning",
                    "Enter a test recipient email first.",
                );
                return;
            }
            this.testing = true;
            try {
                const res = await axios.post("email-configures/test", {
                    to: this.testTo,
                });
                this.showAlert(
                    "success",
                    res.data.message ?? "Test email sent! Check your inbox.",
                );
            } catch (e) {
                this.showAlert(
                    "danger",
                    e?.response?.data?.message ??
                        "Test email failed. Check SMTP credentials.",
                );
            } finally {
                this.testing = false;
            }
        },

        showAlert(type, message) {
            this.alert = { show: true, type, message };
            if (type === "success")
                setTimeout(() => {
                    this.alert.show = false;
                }, 5000);
        },
    },
};
</script>

<style scoped>
.cfg-card .card-body {
    background: #fff;
}
.cfg-card .card-footer {
    background: #fafcff !important;
}
.cfg-card .form-control,
.cfg-card .form-select {
    background-color: #fff !important;
    color: #212529 !important;
    border-color: #ced4da !important;
}
.cfg-card .form-control:focus,
.cfg-card .form-select:focus {
    border-color: #86b7fe !important;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
}
.cfg-card .input-group-text {
    background-color: #f8f9fa !important;
    color: #495057 !important;
    border-color: #ced4da !important;
}
.cfg-card .btn-outline-secondary {
    border-color: #ced4da !important;
    color: #495057 !important;
    background: #fff !important;
}
.cfg-card .btn-outline-secondary:hover {
    background: #e9ecef !important;
}
.cfg-card .form-label {
    color: #344054 !important;
    font-size: 0.85rem;
}
.cfg-card .form-text {
    color: #6c757d !important;
}
.section-heading {
    text-transform: uppercase;
    font-weight: 700;
    font-size: 0.72rem;
    letter-spacing: 0.8px;
    color: #6b7a90;
    border-bottom: 1px solid #e4ecf5;
    padding-bottom: 8px;
    margin-bottom: 1rem;
}
</style>
