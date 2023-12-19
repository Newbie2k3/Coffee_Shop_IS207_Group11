$("#myOrderTable").DataTable({
    dom: "lBfrtip",
    buttons: ["copy", "csv", "excel", "pdf", "print"],
    ajax: {
        url: "/bookingAPI",
        dataSrc: "data",
        cache: false,
    },
    columns: [
        {
            data: "id",
        },
        {
            data: "user.name",
        },
        {
            data: "paymentmethod.name",
        },
        {
            data: "status.name",
        },
        {
            data: "total",
        },
    ],
});
