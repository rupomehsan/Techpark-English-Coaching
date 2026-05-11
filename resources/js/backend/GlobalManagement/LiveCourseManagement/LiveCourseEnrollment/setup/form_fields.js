export default [
    {
        name: "enrolled_at",
        label: "Enter your enrolled at",
        type: "datetime-local",
        step: "1",
        value: "",
    },

    {
        name: "payment_status",
        label: "Enter your payment status",
        type: "select",
        label: "Select payment status",
        multiple: false,
        data_list: [
            {
                label: "Pending",
                value: "pending",
            },
            {
                label: "Partial",
                value: "partial",
            },
            {
                label: "Paid",
                value: "paid",
            },
            {
                label: "Refunded",
                value: "refunded",
            },
        ],
        value: "",
    },

    {
        name: "amount_paid",
        label: "Enter your amount paid",
        type: "number",
        step: "0.01",
        value: "",
    },

    {
        name: "transaction_id",
        label: "Enter your transaction id",
        type: "text",
        value: "",
    },

    {
        name: "method",
        label: "Enter your payment method",
        type: "select",
        value: "",
        data_list: [
            {
                label: "Cash",
                value: "cash",
            },
            {
                label: "Bank Transfer",
                value: "bank_transfer",
            },
            {
                label: "Bkash",
                value: "bkash",
            },

            {
                label: "Nagad",
                value: "nagad",
            },
            {
                label: "Rocket",
                value: "rocket",
            },
            {
                label: "Card",
                value: "card",
            },
            {
                label: "Other",
                value: "other",
            },
        ],
    },
    {
        name: "payment_photo",
        label: "Upload payment screenshot",
        type: "file",
        accept: "image/*",
        value: "",
    },
    {
        name: "student_info",
        label: "Enter your student info",
        type: "textarea",
        placeholder: "Enter JSON data",
        value: "",
    },

    {
        name: "payment_details",
        label: "Enter your payment details",
        type: "textarea",
        placeholder: "Enter JSON data",
        value: "",
    },
];
