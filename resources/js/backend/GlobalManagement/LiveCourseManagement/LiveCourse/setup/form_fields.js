export default [
    {
        name: "title",
        label: "Enter your title",
        type: "text",
        value: "",
    },

    {
        name: "live_course_type",
        label: "Enter your live course type",
        type: "select",
        label: "Select live course type",
        multiple: false,
        data_list: [
            {
                label: "Residential",
                value: "residential",
            },
            {
                label: "Non_residential",
                value: "non_residential",
            },
            {
                label: "Online",
                value: "online",
            },
        ],
        value: "",
    },

    {
        name: "promo_video_url",
        label: "Enter your promo video url",
        type: "text",
        value: "",
    },

    {
        name: "course_duration",
        label: "Enter your course duration",
        type: "text",
        value: "",
    },

    {
        name: "total_seats",
        label: "Enter your total seats",
        type: "number",
        value: "",
    },

    {
        name: "regular_price",
        label: "Enter your regular price",
        type: "number",
        step: "0.01",
        value: "",
    },

    {
        name: "sale_price",
        label: "Enter your sale price",
        type: "number",
        step: "0.01",
        value: "",
    },
    {
        name: "thumbnail",
        label: "Enter your thumbnail",
        type: "file",
        value: "",
    },

    {
        name: "description",
        label: "Enter your description",
        type: "textarea",
        value: "",
        row_col_class: "col-12",
    },
];
