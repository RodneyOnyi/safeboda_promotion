$("#search-vehicle").select2({
    placeholder: "Select Client Vehicle",
    ajax: {
        url: "/vehicles/search",
        dataType: "json",
        delay: 250,
        crossDomain: true,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        id: item.id,
                        text:
                            item.first_name +
                            " " +
                            item.last_name +
                            " : " +
                            item.plate_number,
                    };
                }),
            };
        },
        cache: true,
    },
});
