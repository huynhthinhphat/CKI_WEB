document.addEventListener('DOMContentLoaded', function () {

    var giohang_canhan = document.getElementById('giohang_canhan');

    giohang_canhan.addEventListener('click', function () {
        window.location.href = '../html/giohang.php'
    })

    function loadlistinweek() {
        $.ajax({
            url: 'api.php?action=loadlistinweek',
            method: 'post',
            success: function (res) {
                if (res) {
                    $("#books").html(res);
                } else {
                    $("#books").html("Không có dữ liệu");
                }
            }
        })
    }
    loadlistinweek();

    //load danh sách sản phẩm sắp phát hành
    function loadlistSPH() {
        $.ajax({
            url: 'api.php?action=loadlistSPH',
            method: 'post',
            success: function (res) {
                $("#books_sph").html(res);
            }
        })
    }
    loadlistSPH();

    // Lắng nghe sự kiện click trên các item_book và các phần tử con của nó
    document.addEventListener("click", function (event) {
        //button thêm vào giỏ hàng
        var btn_themgiohang = event.target.classList.contains("btn_themgiohang")

        // Kiểm tra xem phần tử được click là item_book hoặc con của item_book
        var itemBook = event.target.closest(".item_book");

        //phần tử được click là con của .item-book và ko phải button có class btn_themgiohang
        if (itemBook && !btn_themgiohang) {
            // Lấy id-product từ thuộc tính của item_book
            var productId = itemBook.getAttribute("id-product");

            //chuyển đến trang chitietsanpham.php kèm theo id
            window.location.href = '../html/chitietsp.php?id=' + productId;
        }

        // Kiểm tra sự kiện click trên nút "THÊM VÀO GIỎ"
        if (event.target.classList.contains("btn_themgiohang")) {

            // Lấy id-product từ thuộc tính của nút "THÊM VÀO GIỎ"
            var productId = event.target.getAttribute("id-product");
            alert("Đã thêm sản phẩm có ID =", productId, "vào giỏ hàng.");
        }
    });

    var limit_iw = 5;
    var i_iw = 2;

    $(document).on('click', '.container_btn_loadlistinweek .btn_more_iw', function () {
        $.ajax({
            url: 'api.php?action=loadlistinweek',
            method: 'post',
            data: { limit_iw: limit_iw * i_iw },
            success: function (res) {
                if (res) {
                    $("#books").html(res);
                } else {
                    $("#books").html("Không có dữ liệu");
                }
            }
        })
        i_iw++;
    })

    var limit_sph = 5;
    var i_sph = 2;

    $(document).on('click', '.container_btn_loadlistSPH .btn_more_sph', function () {
        $.ajax({
            url: 'api.php?action=loadlistSPH',
            method: 'post',
            data: { limit_sph: limit_sph * i_sph },
            success: function (res) {
                if (res) {
                    $("#books_sph").html(res);
                } else {
                    $("#books_sph").html("Không có dữ liệu");
                }
            }
        })
        i_sph++;
    })
})
// 3 trang sp, chi tiết sản phẩm, đơn đặt hàng, session là gì