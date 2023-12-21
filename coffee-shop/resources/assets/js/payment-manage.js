$(document).ready(function () {
    const documentObj = $(document);
    const detailBtn = ".detail-btn";

    documentObj.off("click", detailBtn).on("click", detailBtn, showDetails);

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

        let columns = [
            `Sản Phẩm (${paymentDetails.length} mục)`,
            "Giá",
            "Số Lượng",
        ];
        columns.forEach((column) => {
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
            let tdName = createTableCell(detail.product.name);
            let tdPrice = createTableCell(
                formatCurrency(detail.product.price),
                "100px"
            );
            let tdQuantity = createTableCell(detail.quantity, "100px");

            tr.appendChild(tdName);
            tr.appendChild(tdPrice);
            tr.appendChild(tdQuantity);

            tbody.appendChild(tr);
        });

        table.appendChild(tbody);

        return table;
    }

    function createTableCell(text, width) {
        let td = document.createElement("td");
        td.textContent = text;
        if (width) {
            td.style.width = width;
        }
        return td;
    }

    function formatCurrency(amount) {
        return new Intl.NumberFormat("vi-VN", {
            style: "currency",
            currency: "VND",
        }).format(amount);
    }
});
