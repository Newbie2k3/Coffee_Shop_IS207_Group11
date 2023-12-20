$(document).ready(function () {
    $(document)
        .off("click", ".detail-btn")
        .on("click", ".detail-btn", showDetails);

    function showDetails(e) {
        e.preventDefault();

        const paymentDetails = $(this).data("details");
        swal({
            title: "Chi tiết sản phẩm",
            content: formatProductDetails(paymentDetails),
        });
    }

    function formatProductDetails(paymentDetails) {
        let table = document.createElement("table");
        table.classList.add("table", "text-left");

        let thead = document.createElement("thead");
        let theadRow = document.createElement("tr");

        ["Tên Sản Phẩm", "Giá", "Số Lượng"].forEach((column) => {
            let th = document.createElement("th");
            th.textContent = column;
            if (column === "Giá" || column === "Số Lượng") {
                th.style.width = "100px";
            }
            theadRow.appendChild(th);
        });

        thead.appendChild(theadRow);

        table.appendChild(thead);

        let tbody = document.createElement("tbody");

        paymentDetails.forEach((detail) => {
            let tr = document.createElement("tr");
            let tdName = document.createElement("td");
            let tdPrice = document.createElement("td");
            let tdQuantity = document.createElement("td");

            tdPrice.style.width = "100px";
            tdQuantity.style.width = "100px";

            tdName.textContent = detail.product.name;
            tdPrice.textContent = detail.product.price;
            tdQuantity.textContent = detail.quantity;

            tr.appendChild(tdName);
            tr.appendChild(tdPrice);
            tr.appendChild(tdQuantity);

            tbody.appendChild(tr);
        });

        table.appendChild(tbody);

        return table;
    }
});
