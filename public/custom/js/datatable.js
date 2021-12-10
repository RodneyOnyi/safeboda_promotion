var date = new Date();

$("#datatable-csv").DataTable({
    lengthChange: !1,
    dom: "Bfrtip",
    buttons: [
        {
            extend: "csv",
            title:
                "payment_" +
                date.getFullYear() +
                "-" +
                date.getMonth() +
                "-" +
                date.getDate() +
                "_" +
                date.getHours() +
                "_" +
                date.getMinutes(),
            className: "btn btn-sm btn-success",
            footer: true,
        },
    ],
    language: {
        paginate: {
            previous: "<i class='fas fa-angle-left'>",
            next: "<i class='fas fa-angle-right'>",
        },
    },
});
