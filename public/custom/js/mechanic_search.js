$("#search-mechanic").select2({
    placeholder: "Select Mechanic",
    ajax: {
        url: "/mechanic/search",
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
