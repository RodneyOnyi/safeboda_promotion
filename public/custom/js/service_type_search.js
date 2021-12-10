$("#search-service-type").select2({
    placeholder: "Select Service Type",
    ajax: {
        url: "/service_type/search",
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
