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
        name: "chart_type_title",
        title: "نوع نمودار",
        sortField: "chart_type",
        titleClass: "text-center",
        dataClass: "text-center"
    },
    {
        name: "date_from",
        title: "از تاریخ",
        sortField: "date_from",
        titleClass: "text-center",
        dataClass: "text-center ltr"
    },
    {
        name: "date_to",
        title: "تا تاریخ",
        sortField: "date_to",
        titleClass: "text-center",
        dataClass: "text-center ltr"
    },
    {
        name: "status",
        title: "وضعیت نمودار",
        sortField: "status",
        titleClass: "text-center",
        dataClass: "text-center",
        callback: "report_status"
    },
    {
        name: "created_at_fa",
        title: "تاریخ ایجاد",
        sortField: "created_at",
        titleClass: "text-center",
        dataClass: "text-center ltr"
    },
    {
        name: "__component:report-custom-actions",
        title: "نمایش نمودار",
        titleClass: "text-center",
        dataClass: "text-center"
    },
    {
        name: "file_status",
        title: "وضعیت خروجی",
        sortField: "file_status",
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
        name: "__component:report-file-custom-actions",
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
