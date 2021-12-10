$("#rights_group").on("change", function () {
    this.value > 1 ? $("#hidden_garage").show() : $("#hidden_garage").hide();
});
