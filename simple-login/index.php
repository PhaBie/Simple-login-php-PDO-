<?php
    session_start();
    require_once 'config/db.php'
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Register Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="jquery-3.3.1.min.js"></script>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='register_login.css'>
    <script src='main.js'></script>
    
</head>
<body>

<div class="container" >

    <div class="box boxbase">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div class="boxbase1"></div>
    </div>
 <h3 class="mt-5">สมัครสมาชิก</h3>
    <hr>
    <form action="signup_db.php" method="post">
        <?php if(isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php } ?>

        <?php if(isset($_SESSION['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </div>
        <?php } ?>
        
        <?php if(isset($_SESSION['warning'])) { ?>
            <div class="alert alert-warning" role="alert">
                <?php
                    echo $_SESSION['warning'];
                    unset($_SESSION['warning']);
                ?>
            </div>
        <?php } ?>

    <div class="mb-3">
    <label for="email" class="form-label">E-mail</label>
    <br>
    <input type="email" class="form-control"  name="email" aria-describedby="email">
  </div>
  <div class="mb-3">
    <label for="username" class="form-label">username</label>
    <input type="text" class="form-control" name="username" aria-describedby="username">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <div class="mb-3">
    <label for="confirm password" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" name="c_password">
  </div>
  <button type="submit" name = "signup" class="btn btn-outline-success position-absolute top-50 start-50 translate-middle " >สมัครสมาชิก</button>
    </form>
    <hr>
    <br></br>
    <br></br>
    <p class="mb-3">เป็นสมาชิกอยู่แล้ว คลิกเพื่อ <a href="signin.php" ><button type="button" class="btn btn-outline-info">เข้าสู่ระบบ</button></a></p>

</div>
    <?php
    echo '
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script> src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js">
        </script>
        <link rel="stysheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    ';
    ?>
</body>
</html>