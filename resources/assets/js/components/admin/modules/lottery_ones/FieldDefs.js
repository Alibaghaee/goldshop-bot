export default [
    {
        name: "__sequence",
        title: "#",
        titleClass: "",
        dataClass: "right aligned"
    },
    {
        name: "title",
        title: "عنوان",
        sortField: "title",
        titleClass: "text-center",
        dataClass: "text-center"
    },
    {
        name: "date",
        title: "تا تاریخ",
        sortField: "date",
        titleClass: "text-center",
        dataClass: "text-center ltr"
    },
    {
        name: "step",
        title: "مرحله",
        sortField: "step",
        titleClass: "text-center",
        dataClass: "text-center"
    },
    {
        name: "count",
        title: "تعداد",
        sortField: "count",
        titleClass: "text-center",
        dataClass: "text-center",
        callback: "number_format"
    },
    {
        name: "created_at",
        title: "تاریخ ایجاد",
        sortField: "created_at",
        titleClass: "text-center",
        dataClass: "text-center ltr"
    },
    {
        name: "status",
        title: "وضعیت خروجی",
        sortField: "status",
        titleClass: "text-center",
        dataClass: "text-center",
        callback: "file_export_status"
    },
    {
        name: "percent",
        title: "درصد خروجی",
        sortField: "percent",
        titleClass: "text-center",
        dataClass: "text-center",
        callback: "circle_progressbar"
    },
    {
        name: "__component:lottery-one-custom-actions",
        title: "نمایش قرعه کشی",
        titleClass: "text-center",
        dataClass: "text-center"
    },
    {
        name: "__component:lottery-one-file-custom-actions",
        title: "دریافت خروجی",
        titleClass: "text-center",
        dataClass: "text-center"
    },
    {
        name: "__component:global-actions",
        title: "عملیات",
        titleClass: "text-center",
        dataClass: "text-center"
    }
];
