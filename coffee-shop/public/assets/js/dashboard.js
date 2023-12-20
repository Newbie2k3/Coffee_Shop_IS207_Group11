$(document).ready(function () {
    const csrfToken = $('meta[name="csrf-token"]').attr("content");

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
            var productNames = data.productRevenue.map(function (item) {
                return item.name;
            });
            var productRevenue = data.productRevenue.map(function (item) {
                return item.revenue;
            });

            var ctx = document.getElementById("revenueChart").getContext("2d");
            var myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: productNames,
                    datasets: [
                        {
                            label: "Product Revenue",
                            data: productRevenue,
                            backgroundColor: "rgba(75, 192, 192, 0.2)",
                            borderColor: "rgba(75, 192, 192, 1)",
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });

            // Daily Revenue Chart
            var dailyRevenueLabels = data.dailyRevenue.map(function (item) {
                return item.date;
            });
            var dailyRevenueData = data.dailyRevenue.map(function (item) {
                return item.revenue;
            });

            var ctxDailyRevenue = document
                .getElementById("dailyRevenueChart")
                .getContext("2d");
            var dailyRevenueChart = new Chart(ctxDailyRevenue, {
                type: "line",
                data: {
                    labels: dailyRevenueLabels,
                    datasets: [
                        {
                            label: "Daily Revenue",
                            data: dailyRevenueData,
                            backgroundColor: "rgba(255, 99, 132, 0.5)",
                            borderColor: "rgba(255, 99, 132, 1)",
                            borderWidth: 1,
                            fill: true,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            type: "category",
                            labels: dailyRevenueLabels,
                        },
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        },
    });
});
