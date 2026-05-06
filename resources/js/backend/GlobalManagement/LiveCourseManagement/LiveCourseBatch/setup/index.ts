
import app_config from "@config/app_config";
import setup_type from "./setup_type";

const prefix: string = "LiveCourseBatch";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "live-course-batches",

    module_name: "live-course-batch",
    store_prefix: "live_course_batch",
    route_prefix: "LiveCourseBatch",
    route_path: "live-course-batch",

    select_fields: [
        "id",
        "live_course_id",
            "batch_number",
            "shift_name",
            "course_start_date",
            "course_end_date",
            "class_start_time",
            "class_end_time",
            "class_days",
            "seats_remaining",
            "enrolled_count",
        "status",
        "slug",
        "created_at",
        'deleted_at'
    ],

    sort_by_cols: [
        "id",
        "live_course_id",
            "batch_number",
            "shift_name",
            "course_start_date",
            "course_end_date",
            "class_start_time",
            "class_end_time",
            "class_days",
            "seats_remaining",
            "enrolled_count",
        "status",
        "created_at",
    ],
    table_header_data: [
        "id",
        "live_course_id",
            "batch_number",
            "shift_name",
            "course_start_date",
            "course_end_date",
            "class_start_time",
            "class_end_time",
            "class_days",
            "seats_remaining",
            "enrolled_count",
        "status",
        "created_at",
    ],
    table_row_data: [
        "id",
        "live_course_id",
            "batch_number",
            "shift_name",
            "course_start_date",
            "course_end_date",
            "class_start_time",
            "class_end_time",
            "class_days",
            "seats_remaining",
            "enrolled_count",
        "status",
        "created_at",
    ],
    quick_view_data: [
        "id",
        "live_course_id",
            "batch_number",
            "shift_name",
            "course_start_date",
            "course_end_date",
            "class_start_time",
            "class_end_time",
            "class_days",
            "seats_remaining",
            "enrolled_count",
        "status",
        "created_at",
    ],

    layout_title: prefix + " Management",
    page_title: `${prefix} Management`,

    all_page_title: "All " + prefix,
    details_page_title: "Details " + prefix,
    create_page_title: "Create " + prefix,
    edit_page_title: "Edit " + prefix,
};

export default setup;
