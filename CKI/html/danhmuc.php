<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">

    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/header_menuLeft.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #main-content {
            width: 75%;
            margin-left: 20px;
        }

        #main-content h2 {
            margin-bottom: 20px;
            color: #333;
            text-decoration: none;
        }

        .comic {
            display: flex;
            background-color: #fff;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .comic img {
            width: 200px;
            height: auto;
            margin-right: 20px;
        }

        .comic h3 {
            margin-bottom: 10px;
            color: #007BFF;
        }

        .comic p {
            margin-bottom: 5px;
            color: #555;
        }

        .comic button {
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .comic button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        /* CSS cho khoảng cách giữa hai nút */
        .comic button.buy-button {
            margin-right: 30px;
            background-color: #007BFF;
        }

        .comic button.buy-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .comic button.cart-button {
            background-color: #28a745;
        }

        .comic button.cart-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php
    include ("form/header.php");
    ?>

    <!-- Body -->
    <!-- Menu left -->
    <?php
    include ("form/menuLeft.php");
    ?>

    <div id="main-content">
        <h2>Truyện Tranh</h2>
        <div id="comics-list">
            <?php
            // Connect to the database
            $conn = new mysqli('localhost', 'root', '', 'webbansach');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch comics from the database
            function fetch_comics($conn, $brands_filter = null)
            {
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
                        echo '</a>'; // Đóng thẻ <a>
                        echo '<button class="buy-button"' . $buy_button_disabled . '>' . ($row["soluongtonkho"] > 0 ? 'Mua hàng' : 'Hết hàng') . '</button>'; // Nút "Mua hàng"
                        echo '<button class="cart-button"' . $cart_button_disabled . '>' . ($row["soluongtonkho"] > 0 ? 'Thêm vào giỏ' : 'Hết hàng') . '</button>'; // Nút "Thêm vào giỏ"
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "Không có truyện tranh nào được tìm thấy.";
                }
            }

            fetch_comics($conn);

            $conn->close();
            ?>
        </div>
    </div>
    </div>
    <!-- Footer -->
    <?php
    include ("form/footer.php");
    ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('input[name="brand[]"]').change(function () {
            var selectedBrands = [];
            $('input[name="brand[]"]:checked').each(function () {
                selectedBrands.push($(this).val());
            });

            $.ajax({
                url: 'fetch_comics.php',
                method: 'GET',
                data: { brand: selectedBrands },
                success: function (response) {
                    $('#comics-list').html(response);
                }
            });
        });
    });
</script>
</html>