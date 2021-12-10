$(document).on("click", ".delete-action", function () {
    var id = $(this).data("id");

    if ($(".modal-body #garage_id").length) {
        $(".modal-body #garage_id").val(id);
    } else if ($(".modal-body #user_id").length) {
        $(".modal-body #user_id").val(id);
    } else if ($(".modal-body #employee_id").length) {
        $(".modal-body #employee_id").val(id);
    } else if ($(".modal-body #rights_group_id").length) {
        $(".modal-body #rights_group_id").val(id);
    } else if ($(".modal-body #patient_id").length) {
        $(".modal-body #patient_id").val(id);
    } else if ($(".modal-body #payment_id").length) {
        $(".modal-body #payment_id").val(id);
    } else if ($(".modal-body #service_id").length) {
        $(".modal-body #service_id").val(id);
    } else if ($(".modal-body #stock_id").length) {
        $(".modal-body #stock_id").val(id);
    } else if ($(".modal-body #insurance_id").length) {
        $(".modal-body #insurance_id").val(id);
    } else if ($(".modal-body #service_id").length) {
        $(".modal-body #service_id").val(id);
    }
});
