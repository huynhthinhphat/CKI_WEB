<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .product-image {
            width: 200px;
            height: auto;
            float: left;
            margin-right: 20px;
        }
        .product-details {
            margin-left: 220px;
        }
        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0px; /* Space between columns */
        }
        .details-grid p {
            margin-bottom: 0px; /* Space between rows */
            color: #555;
        }
        h1 {
            color: #007BFF;
        }
        .btn-container {
            margin-top: 20px;
        }

        .btn {
            padding: 10px 15px;
            background-color: #007BFF; /* Blue color */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 10px;
            display: inline-block;
            text-align: center;
        }

        .btn:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .btn.disabled {
            background-color: #ccc; /* Grey color for disabled */
            cursor: not-allowed;
        }
        .btn.add-to-cart {
            background-color: #28a745;
        }
        .btn.add-to-cart:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Connect to the database
        $conn = new mysqli('localhost', 'root', '', 'webbansach');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get the comic id from URL
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Fetch product details
        $query = "SELECT * FROM chitietsanpham WHERE id = $id";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<img class="product-image" src="../' . $row['hinhanh'] . '" alt="' . htmlspecialchars($row['ten']) . '">';
            echo '<div class="product-details">';
            echo '<h1>' . htmlspecialchars($row['ten']) . '</h1>';
            echo '<h1>' . htmlspecialchars($row["taptruyen"]) . '</h1>';
            echo '<div class="details-grid">';
            echo '<p><strong>Thể loại:</strong> ' . htmlspecialchars($row['theloai']) . '</p>';
            echo '<p><strong>Tác giả:</strong> ' . htmlspecialchars($row['tentacgia']) . '</p>';
            echo '<p><strong>Dịch giả:</strong> ' . htmlspecialchars($row['dichgia']) . '</p>';
            echo '<p><strong>Họa sĩ:</strong> ' . htmlspecialchars($row['hoasi']) . '</p>';
            echo '<p><strong>Xuất xứ:</strong> ' . htmlspecialchars($row['xuatsu']) . '</p>';
            echo '<p><strong>Series:</strong> ' . htmlspecialchars($row['series']) . '</p>';
            echo '<p><strong>Giá:</strong> ' . number_format($row['gia'], 0, ',', '.') . ' VND</p>';
            echo '<p><strong>Ngày phát hành:</strong> ' . htmlspecialchars($row['ngay']) . '</p>';
            echo '<p><strong>Số lượng:</strong> ' . htmlspecialchars($row['soluong']) . '</p>';
            echo '<p><strong>Lượt mua:</strong> ' . htmlspecialchars($row['luotmua']) . '</p>';
            echo '</div>';
            echo '<p><strong>Mô tả:</strong> ' . htmlspecialchars($row['mota']) . '</p>';

            $buy_button_disabled = $row["soluong"] <= 0 ? ' disabled' : '';
            $buy_button_class = $row["soluong"] <= 0 ? 'btn disabled' : 'btn';
            $add_to_cart_button_class = $row["soluong"] <= 0 ? 'btn disabled add-to-cart' : 'btn add-to-cart';

            echo '<div class="btn-container">';
            echo '<a href="#" class="' . $add_to_cart_button_class . '"' . $buy_button_disabled . '>Thêm vào giỏ</a>';
            echo '<a href="#" class="' . $buy_button_class . '"' . $buy_button_disabled . '>Mua hàng</a>';
            echo '</div>';
        } else {
            echo "<p>Không tìm thấy sản phẩm.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
