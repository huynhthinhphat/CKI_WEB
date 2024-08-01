document.addEventListener('DOMContentLoaded', function () {

    //Lắng nghe sự kiện click trên các item_book và các phần tử con của nó
    // document.addEventListener("click", function (event) {
    //     //button thêm vào giỏ hàng
    //     var btn_themgiohang = event.target.classList.contains("btn_themgiohang")

    //     // Kiểm tra xem phần tử được click là item_book hoặc con của item_book
    //     var itemBook = event.target.closest(".item_book");

    //     //phần tử được click là con của .item-book và ko phải button có class btn_themgiohang
    //     if (itemBook && !btn_themgiohang) {

    //         var productId = itemBook.getAttribute("data-id-product");
    //         var productName = itemBook.getAttribute("data-ten-product");
    //         var productChap = itemBook.getAttribute("data-taptruyen-product");

    //         //chuyển đến trang chitietsanpham.php kèm theo id
    //         window.location.href = '../html/chitietsp.php?id=' + productId;
    //     }

    //     // Kiểm tra sự kiện click trên nút "THÊM VÀO GIỎ"
    //     if (event.target.classList.contains("btn_themgiohang")) {

    //         // Lấy id-product từ thuộc tính của nút "THÊM VÀO GIỎ"
    //         var productId = event.target.getAttribute("data-id-product");
    //         var productName = event.target.getAttribute("data-ten-product");
    //         var productChap = event.target.getAttribute("data-taptruyen-product");
    //         console.log(productId + " " + productName + " " + productChap);
    //     }
    // });
})