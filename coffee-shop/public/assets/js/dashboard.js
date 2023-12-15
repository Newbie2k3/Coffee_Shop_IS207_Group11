$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
$.ajax({
    url: "/admin/chartStatistic",
    method: "GET",
    cache: false,
    success: function (a, b, c) {
        var du_an = ["Đơn hàng online", "Đơn hàng offline"];
        var phan_bo_nguon_luc = [a.don_hang_cod, a.don_hang_online];
        var ctx = document.getElementById("pieChart").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "pie",
            data: {
                labels: du_an,
                datasets: [
                    {
                        data: phan_bo_nguon_luc,
                        backgroundColor: [
                            "rgba(255, 99, 132, 0.8)",
                            "rgba(54, 162, 235, 0.8)",
                        ],
                    },
                ],
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: "Thông kê phương thức đặt hàng",
                },
            },
        });
    },
    error: function (error) {
        console.log(error);
    },
});
