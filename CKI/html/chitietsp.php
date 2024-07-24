<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webbansach";

// Kết nối đến MySQL
$conn = mysqli_connect($servername, $username, $password, $dbname);

$id = isset($_GET['id']) ? $_GET['id'] : '';

$truyvan = "SELECT * FROM danhsachtruyen WHERE id = $id";
$thuchien = mysqli_query($conn, $truyvan);

if ($thuchien) {
    while ($row = mysqli_fetch_assoc($thuchien)) {
        $ten = $row['ten'];
        $taptruyen = $row['taptruyen'];
        $hinhanh = $row['hinhanh'];
        $gia = number_format($row['gia'], 0, '', ',') . "<u>đ</u>";

        echo "<a href='chitietsp.php?id=$row[id]' class='item_book'>";
        echo "<p>$ten $taptruyen</p>";
        echo "<p>$gia</p>";
        echo "<img src='../$hinhanh'>";
    }
}

?>