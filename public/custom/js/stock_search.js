$(".search-stock").select2({
    placeholder: "Select Stock",
    ajax: {
        url: "/stock/search",
        dataType: "json",
        delay: 250,
        crossDomain: true,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        id: item.id,
                        text: item.name,
                    };
                }),
            };
        },
        cache: true,
    },
});

var stock = 1;
$("#add").click(function () {
    stock++;

    var newSelect = $(
        '<div class="row mb-2 " id="row' +
            stock +
            '"><div  class="col-lg-4 col-md-12 mt-1"><select name="stock[]" class="search-stock form-control" style="width: 50%;"></select></div><div class="col-lg-4 col-md-12 mt-1"><input type="number" name="quantity[]" class="form-control" style="height:45px;" placeholder="Quantity" required></div><div class="col-lg-4 col-md-12 mt-1"><button type="button" name="remove" id="' +
            stock +
            '" class="btn btn-danger btn_remove offset-md-1" style="margin-top:-2px">Remove</button></div></div>'
    );
    $("#dynamic_field").append(newSelect);
    $(".search-stock:last").select2({
        placeholder: "Select Stock",
        ajax: {
            url: "/stock/search",
            dataType: "json",
            delay: 250,
            crossDomain: true,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id,
                        };
                    }),
                };
            },
            cache: true,
        },
    });
});

$(document).on("click", ".btn_remove", function () {
    var button_id = $(this).attr("id");
    $("#row" + button_id + "").remove();
});
