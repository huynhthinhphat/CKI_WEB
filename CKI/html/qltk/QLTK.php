<?php
include '../QLSP/ketnoi.php';


$search = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST['search'];
}

$sql = "SELECT * FROM taikhoan WHERE ho LIKE '%$search%' OR ten LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Danh sách tài khoản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1200px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            margin-bottom: 20px;
            text-align: center;
        }
        label {
            font-size: 18px;
            color: #555;
        }
        input[type="text"] {
            padding: 10px;
            width: 60%;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 15px;
            text-align: left;
            word-wrap: break-word;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Danh sách tài khoản</h1>
        
        <form method="post" action="">
            <label for="search">Tìm kiếm :</label>
            <input type="text" id="search" name="search" value="<?php echo $search; ?>">
            <button type="submit">Tìm kiếm</button>
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Họ</th>
                <th>Tên</th>
                <th>Tài khoản</th>
                <th>Loại</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["ho"] . "</td>";
                    echo "<td>" . $row["ten"] . "</td>";
                    echo "<td>" . $row["taikhoan"] . "</td>";
                    echo "<td>" . $row["loai"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Không có tài khoản nào</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
