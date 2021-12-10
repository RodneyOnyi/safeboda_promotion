$("#search-brand").select2({
    placeholder: "Select Vehicle Brand",
    ajax: {
        url: "/brand/search",
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
