<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['signup'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $urole = 'user';

        if (empty($username)) {
            $_SESSION['error'] = 'กรุณากรอก username';
            header("location: index.php");
        }else if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: index.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: index.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: index.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: index.php");
        } else if (empty($c_password)) {
            $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
            header("location: index.php");
        } else if ($password != $c_password) {
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: index.php");
        } else {
            try {

                $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['email'] == $email) {
                    $_SESSION['error'] = "
                      })";
                    header("location: index.php");
                } else if (!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users(username, email, password, urole) 
                                            VALUES(:username, :email, :password, :urole)");
                    $stmt->bindParam(":username", $username);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":urole", $urole);
                    $stmt->execute();
                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว! <a href='signin.php' class='alert-link'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: index.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: index.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>