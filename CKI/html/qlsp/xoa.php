<?php
include 'ketnoi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    if (!empty($id)) {
        $sql = "DELETE FROM danhsachtruyen WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Truyện được xóa thành công!";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
header("Location: QLSP.php");
exit();
?>
