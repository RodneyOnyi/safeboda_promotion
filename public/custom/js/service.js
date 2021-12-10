$(document).on("click", ".payment-action", function () {
    var id = $(this).data("id");
    var client_id = $(this).data("client-id");

    $(".modal-body #service_id").val(id);
    $(".modal-body #client_id").val(client_id);
});

$(document).on("click", ".service-action", function () {
    var id = $(this).data("id");
    var stock_total = $(this).data("cost");

    $(".modal-body #service_id").val(id);
    $(".modal-body #stock_total").val(stock_total);
});

$("#type").on("change", function () {
    this.value != "mpesa"
        ? $("#section_reference").hide()
        : $("#section_reference").show();
});
