chartDashboard("monthly/payments", "payments");

$("#payment_tab").click(function () {
    chartDashboard("monthly/payments", "payments");
    return false;
});

$("#client_tab").click(function () {
    chartDashboard("monthly/users", "clients");
    return false;
});

function chartDashboard(url, section) {
    var $chart;
    if (section === "payments") {
        $("#chart-payments-dark").show();
        $("#chart-clients-dark").hide();

        $chart = $("#chart-payments-dark");
    } else {
        $("#chart-payments-dark").hide();
        $("#chart-clients-dark").show();

        $chart = $("#chart-clients-dark");
    }

    // Methods

    if ($chart.length) {
        var labels;
        var payments;

        $.get(url, function (data, status) {
            if (status === "success" && data["months"].length > 0) {
                labels = data["months"];
                payments = data["data"];
            } else {
                labels = [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ];
                payments = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            }

            var paymentsChart = new Chart($chart, {
                type: "line",
                options: {
                    scales: {
                        yAxes: [
                            {
                                gridLines: {
                                    color: Charts.colors.gray[700],
                                    zeroLineColor: Charts.colors.gray[700],
                                },
                                ticks: {},
                            },
                        ],
                    },
                },
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "Value",
                            data: payments,
                        },
                    ],
                },
            });
            // Save to jQuery object
            $chart.data("chart", paymentsChart);
        });
    }

    // Events
}
