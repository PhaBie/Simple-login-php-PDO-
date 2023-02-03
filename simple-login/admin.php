<?php
session_start();
require_once 'config/db.php';
if (!isset($_SESSION['admin_login'])) {
    header('location: signin.php');
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>admin page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='admin.js'></script>
</head>
<body>
    <div class="container">
        <?php

            if (isset($_SESSION['admin_login'])) {
                $admin_id = $_SESSION['admin_login'];
                $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        ?>
    <h3 class="mt-4"> Welcome Admin, <?php echo $row['username']?></h3>
    <a href="logout.php" class="btn btn-danger">Logoutt</a>
</div>
    
</body>
</html>