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
                        <i class="zmdi zmdi-card fs-5 m-3"></i>
                        <div>
                            <h5 class="mb-0 fw-bold">
                                Payment Gateway Configuration
                            </h5>
                        </div>
                        <span
                            v-if="item.live == 1"
                            class="badge bg-success ms-auto"
                            >LIVE</span
                        >
                        <span
                            v-else-if="item.live == 0 && item.id"
                            class="badge bg-warning text-dark ms-auto"
                            >SANDBOX</span
                        >
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

                            <div class="row g-3">
                                <!-- Provider -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"
                                        >Provider
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <select
                                        class="form-control form-control-square mb-2"
                                        name="provider_name"
                                        v-model="item.provider_name"
                                        required
                                    >
                                        <option value="">
                                            Select provider
                                        </option>
                                        <option value="sslcommerze">
                                            SSL Commerz
                                        </option>
                                        <option value="bkash">Bkash</option>
                                        <option value="nagad">Nagad</option>
                                    </select>
                                </div>

                                <!-- Mode -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"
                                        >Mode
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >

                                    <select
                                        class="form-control form-control-square mb-2"
                                        name="live"
                                        v-model="item.live"
                                    >
                                        <option :value="0">
                                            Sandbox (Test)
                                        </option>
                                        <option :value="1">
                                            Live (Production)
                                        </option>
                                    </select>
                                    <div
                                        class="form-text text-warning"
                                        v-if="item.live == 1"
                                    >
                                        <i class="zmdi zmdi-alert-circle"></i>
                                        Live mode will charge real money.
                                    </div>
                                </div>

                                <!-- API Key -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"
                                        >API Key / Store ID</label
                                    >
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            ><i class="zmdi zmdi-key"></i
                                        ></span>
                                        <input
                                            :type="
                                                show.api_key
                                                    ? 'text'
                                                    : 'password'
                                            "
                                            class="form-control"
                                            name="api_key"
                                            v-model="item.api_key"
                                            placeholder="API Key or Store ID"
                                        />
                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary"
                                            @click="
                                                show.api_key = !show.api_key
                                            "
                                        >
                                            <i
                                                :class="
                                                    show.api_key
                                                        ? 'zmdi zmdi-eye-off'
                                                        : 'zmdi zmdi-eye'
                                                "
                                            ></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Secret Key -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"
                                        >Secret Key / Store Password</label
                                    >
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            ><i class="zmdi zmdi-lock"></i
                                        ></span>
                                        <input
                                            :type="
                                                show.secret_key
                                                    ? 'text'
                                                    : 'password'
                                            "
                                            class="form-control"
                                            name="secret_key"
                                            v-model="item.secret_key"
                                            placeholder="Secret Key"
                                        />
                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary"
                                            @click="
                                                show.secret_key =
                                                    !show.secret_key
                                            "
                                        >
                                            <i
                                                :class="
                                                    show.secret_key
                                                        ? 'zmdi zmdi-eye-off'
                                                        : 'zmdi zmdi-eye'
                                                "
                                            ></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Username -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"
                                        >Username</label
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
                                            placeholder="Username (optional)"
                                        />
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold"
                                        >Password</label
                                    >
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            ><i
                                                class="zmdi zmdi-lock-outline"
                                            ></i
                                        ></span>
                                        <input
                                            :type="
                                                show.password
                                                    ? 'text'
                                                    : 'password'
                                            "
                                            class="form-control"
                                            name="password"
                                            v-model="item.password"
                                            placeholder="Password (optional)"
                                        />
                                        <button
                                            type="button"
                                            class="btn btn-outline-secondary"
                                            @click="
                                                show.password = !show.password
                                            "
                                        >
                                            <i
                                                :class="
                                                    show.password
                                                        ? 'zmdi zmdi-eye-off'
                                                        : 'zmdi zmdi-eye'
                                                "
                                            ></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Info box -->
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
    name: "PaymentGatewayConfig",

    data() {
        return {
            loading: true,
            saving: false,
            item: {
                id: null,
                slug: "",
                provider_name: "",
                api_key: "",
                secret_key: "",
                username: "",
                password: "",
                live: 0,
            },
            show: { api_key: false, secret_key: false, password: false },
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
                    "payment-gateways?get_all=1&limit=1",
                );
                const list = res.data.data;
                if (Array.isArray(list) && list.length > 0) {
                    this.item = list[0];
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
                    "provider_name",
                    "api_key",
                    "secret_key",
                    "username",
                    "password",
                    "live",
                ].forEach((k) => {
                    fd.append(k, this.item[k] ?? "");
                });
                fd.append("id", this.item.id);

                const res = await axios.post(
                    `payment-gateways/update/${this.item.slug}`,
                    fd,
                );
                if ([200, 201].includes(res.status)) {
                    if (res.data.data)
                        this.item = { ...this.item, ...res.data.data };
                    this.showAlert(
                        "success",
                        "Payment gateway configuration saved successfully!",
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

        showAlert(type, message) {
            this.alert = { show: true, type, message };
            if (type === "success")
                setTimeout(() => {
                    this.alert.show = false;
                }, 4000);
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
</style>
