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

    <!-- Context -->
    <div id="context"></div>

    <!-- Footer -->
    <?php
    include ("form/footer.php");
    ?>
</body>

</html>