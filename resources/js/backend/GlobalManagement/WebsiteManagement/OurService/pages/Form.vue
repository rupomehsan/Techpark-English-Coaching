
<template>
    <div>
        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">
                        {{ param_id ? `${setup.edit_page_title}` : `${setup.create_page_title}` }}
                    </h5>
                    <div>
                        <router-link v-if="item.slug" class="btn btn-outline-info mr-2 btn-sm" :to="{
                            name: `Details${setup.route_prefix}`,
                            params: { id: item.slug },
                        }">
                            {{ setup.details_page_title }}
                        </router-link>
                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All${setup.route_prefix}` }">
                            {{ setup.all_page_title }}
                        </router-link>
                    </div>
                </div>
                <div class="card-body card_body_fixed_height">
                    <div class="row">
                        <template v-for="(form_field, index) in form_fields" v-bind:key="index">
                            <!-- Custom icon picker for the icon field -->
                            <template v-if="form_field.name === 'icon'">
                                <icon-picker
                                    :name="form_field.name"
                                    :label="form_field.label"
                                    :value="form_field.value"
                                    @update:value="val => { form_field.value = val; iconValue = val; }"
                                />
                            </template>
                            <template v-else>
                                <common-input
                                    :label="form_field.label"
                                    :type="form_field.type"
                                    :name="form_field.name"
                                    :multiple="form_field.multiple"
                                    :value="form_field.value"
                                    :data_list="form_field.data_list"
                                    :is_visible="form_field.is_visible"
                                    :row_col_class="form_field.row_col_class"
                                />
                            </template>
                        </template>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-light btn-square px-5">
                        <i class="icon-lock"></i>
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions, mapState } from "pinia";
import { store } from "../store";
import setup from "../setup";
import form_fields from "../setup/form_fields";
import IconPicker from "../components/IconPicker.vue";

export default {
    components: { IconPicker },

    data: () => ({
        setup,
        form_fields,
        param_id: null,
        iconValue: '',
    }),
    created: async function () {
        let id = (this.param_id = this.$route.params.id);
        this.reset_fields();
        if (id) {
            this.set_fields(id);
        }
    },
    methods: {
        ...mapActions(store, {
            create: "create",
            update: "update",
            details: "details",
            get_all: "get_all",
            set_only_latest_data: "set_only_latest_data",
        }),
        reset_fields: function () {
            this.form_fields.forEach((item) => {
                item.value = "";
            });
            this.iconValue = '';
        },
        set_fields: async function (id) {
            this.param_id = id;
            await this.details(id);
            if (this.item) {
                this.form_fields.forEach((field, index) => {
                    Object.entries(this.item).forEach((value) => {
                        if (field.name == value[0]) {
                            this.form_fields[index].value = value[1];
                            if (field.name === 'icon') {
                                this.iconValue = value[1];
                            }
                        }
                        if (field.type === "textarea" && field.name === value[0]) {
                            $(`#${field.name}`).summernote("code", value[1]);
                        }
                    });
                });
            }
        },
        submitHandler: async function ($event) {
            this.set_only_latest_data(true);
            if (this.param_id) {
                this.setSummerEditor();
                let response = await this.update($event);
                if ([200, 201].includes(response.status)) {
                    window.s_alert("Data successfully updated");
                    this.$router.push({ name: `Details${this.setup.route_prefix}` });
                }
            } else {
                this.setSummerEditor();
                let response = await this.create($event);
                if ([200, 201].includes(response.status)) {
                    $event.target.reset();
                    this.form_fields.forEach(field => {
                        if (field.type === 'textarea' && $(`#${field.name}`).length) {
                            $(`#${field.name}`).summernote("code", '');
                        }
                    });
                    this.reset_fields();
                    window.s_alert("Data Successfully Created");
                }
            }
        },
        setSummerEditor() {
            this.form_fields.forEach(field => {
                if (field.type === 'textarea' && $(`#${field.name}`).length) {
                    const markupStr = $(`#${field.name}`).summernote("code");
                    field.value = markupStr;
                    let $input = $(`#${field.name}_hidden`);
                    if ($input.length === 0) {
                        $input = $(`<input type="hidden" id="${field.name}_hidden" name="${field.name}">`);
                        $(`#${field.name}`).parent().append($input);
                    }
                    $input.val(markupStr);
                }
            });
        },
    },

    computed: {
        ...mapState(store, {
            item: "item",
        }),
    },
};
</script>
