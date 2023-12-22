$(document).ready(function () {
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    generateCharts();

    function generateCharts() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        });

        $.ajax({
            url: "dashboard/data",
            method: "GET",
            success: function (data) {
                // Product Revenue
                var productNames = data.productRevenue.map(({ name }) => name);
                var productRevenue = data.productRevenue.map(
                    ({ revenue }) => revenue
                );

                var ctx = document
                    .getElementById("revenueChart")
                    .getContext("2d");
                var myChart = new Chart(
                    ctx,
                    createChartConfig(
                        productNames,
                        productRevenue,
                        "bar",
                        "Product Revenue",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(75, 192, 192, 1)"
                    )
                );

                // Daily Revenue Chart
                var dailyRevenueLabels = data.dailyRevenue.map(
                    ({ date }) => date
                );
                var dailyRevenueChartData = data.dailyRevenue.map(
                    ({ revenue }) => revenue
                );

                var ctxDailyRevenue = document
                    .getElementById("dailyRevenueChart")
                    .getContext("2d");
                var dailyRevenueChart = new Chart(
                    ctxDailyRevenue,
                    createChartConfig(
                        dailyRevenueLabels,
                        dailyRevenueChartData,
                        "line",
                        "Daily Revenue",
                        "rgba(255, 99, 132, 0.5)",
                        "rgba(255, 99, 132, 1)",
                        true
                    )
                );
            },
        });
    }

    function createChartConfig(
        labels,
        data,
        chartType,
        label,
        backgroundColor,
        borderColor,
        fill = false
    ) {
        return {
            type: chartType,
            data: {
                labels: labels,
                datasets: [
                    {
                        label: label,
                        data: data,
                        backgroundColor: backgroundColor,
                        borderColor: borderColor,
                        borderWidth: 1,
                        fill: fill,
                    },
                ],
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: "category",
                        labels: labels,
                    },
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        };
    }
});
