<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    #wrapper {
        display: flex;
        width: 100%;
    }

    #sidebar {
        width: 25%;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #sidebar h3,
    #sidebar h4 {
        margin-bottom: 10px;
        color: #333;
        margin-top: 0;
        background-color: #5d8650;
        color: white;
        padding: 5px;
        font-size: 1.2em;

    }

    #sidebar ul {
        list-style: none;
        margin-bottom: 20px;
    }

    #sidebar ul li {
        margin-bottom: 10px;
        color: #007BFF;
        cursor: pointer;
    }

    #sidebar form div {
        margin-bottom: 10px;
    }

    #sidebar button {
        padding: 10px 15px;
        background-color: #007BFF;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
    }
</style>

<body>
    <div id="wrapper">
        <div id="sidebar">
            <h3>Danh Mục Sản Phẩm</h3>
            <ul>
                <li>Truyện Tranh</li>
            </ul>
            <h3>Thể loại</h3>
            <form id="filterForm" method="GET" action="">
                <?php
                // Connect to the database
                $conn = new mysqli('localhost', 'root', '', 'webbansach');

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch brands (thể loại) from the database
                $brand_result = $conn->query("SELECT DISTINCT theloai FROM theloai");

                if ($brand_result->num_rows > 0) {
                    while ($brand_row = $brand_result->fetch_assoc()) {
                        echo '<div><label><input type="checkbox" name="brand[]" value="' . $brand_row['theloai'] . '"> ' . $brand_row['theloai'] . '</label></div>';
                    }
                } else {
                    echo '<div>Không có thương hiệu nào</div>';
                }
                $conn->close();
                ?>
            </form>
        </div>
</body>