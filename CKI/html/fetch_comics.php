<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'webbansach');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch comics from the database
function fetch_comics($conn, $brands_filter = null) {
    $query = "SELECT * FROM danhsachtruyen";
    if ($brands_filter) {
        $query .= " WHERE theloai IN ('$brands_filter')";
    }
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $buy_button_disabled = $row["soluongtonkho"] <= 0 ? ' disabled' : '';
            $cart_button_disabled = $row["soluongtonkho"] <= 0 ? ' disabled' : '';
            echo "<a href='chitietsanpham.php?id=" . $row["id"] . "'>";
            echo '<div class="comic">';
            echo "<img src='../$row[hinhanh]'>";
            echo '<div>';
            echo '<h3>' . htmlspecialchars($row["ten"]) . '</h3>';
            echo '<h3>' . htmlspecialchars($row["taptruyen"]) . '</h3>';
            echo '<p>Thể loại: ' . htmlspecialchars($row["theloai"]) . '</p>';
            echo '<p>Giá: ' . number_format($row["gia"], 0, ',', '.') . ' VND</p>';
            echo '<p>Ngày phát hành: ' . htmlspecialchars($row["ngay"]) . '</p>';
            echo '<p>Số lượng: ' . htmlspecialchars($row["soluongtonkho"]) . '</p>';
            echo '<p>Lượt mua: ' . htmlspecialchars($row["soluongdaban"]) . '</p>';
            echo '<button class="buy-button"' . $buy_button_disabled . '>' . ($row["soluongtonkho"] > 0 ? 'Mua hàng' : 'Hết hàng') . '</button>'; // Nút "Mua hàng"
            echo '<button class="cart-button"' . $cart_button_disabled . '>' . ($row["soluongtonkho"] > 0 ? 'Thêm vào giỏ' : 'Hết hàng') . '</button>'; // Nút "Thêm vào giỏ"
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "Không có truyện tranh nào được tìm thấy.";
    }
}

if (isset($_GET['brand'])) {
    $brands_filter = implode("','", $_GET['brand']);
    fetch_comics($conn, $brands_filter);
} else {
    fetch_comics($conn);
}

$conn->close();
?>