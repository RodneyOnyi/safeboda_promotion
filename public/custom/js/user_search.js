$("#search-client").select2({
    placeholder: "Select Client",
    ajax: {
        url: "/client/search",
        dataType: "json",
        delay: 250,
        crossDomain: true,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        id: item.id,
                        text: item.first_name + " " + item.last_name,
                    };
                }),
            };
        },
        cache: true,
    },
});
