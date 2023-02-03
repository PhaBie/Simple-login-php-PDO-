<?php
session_start();
require_once 'config/db.php';
if (!isset($_SESSION['user_login'])) {
    header('location: signin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market</title>

    <link rel="stylesheet" href="user.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="user.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    
<nav>
    <div class="nav-container">
        <a href="user.php">
            <img src="./imgs/logo.png" class="logonav">
        </a>
        <div class="nav-profile">
            <p class="nav-profile-name" style="color:Black;" >
                <div>
                            <?php

                            if (isset($_SESSION['user_login'])) {
                                $user_id = $_SESSION['user_login'];
                                $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            } 
                            ?>

                        <div onclick="opencart()" style="cursor: pointer;" class="nav-profile-cart">
                            <h3 class="mt-4" style="cursor: pointer;" > Welcome, <?php echo $row['username']?>&nbsp;</h3>
                        </div>
                </div>
        
        
            </p>
        <div onclick="opencart()" style="cursor: pointer;" class="nav-profile-cart">
            <i class="fa-solid fa-circle-user fa-2xl"></i>
            <div id="cartcount" div class="cartcount" style="display: none;"> 
                0
            </div>
                
        </div>
    </div>
</nav>

    <div class="container">

        
        <div class="sidebar">

            <input onkeyup="searchsomething(this)" id="txt_search" type="text" class="sidebar-search" placeholder="ค้นหา">
            
            <a onclick="searchproduct('all')" class="sidebar-item">
                All
            </a>

            <a onclick="searchproduct('Netflix')" class="sidebar-item">
                Netflix
            </a>

            <a onclick="searchproduct('Disney')" class="sidebar-item">
                Disney +
            </a>

            <a onclick="searchproduct('YoutubePremium')" class="sidebar-item">
                Youtube Premium
            </a>

            <a onclick="searchproduct('ValorantID')" class="sidebar-item">
                Valorant ID
            </a>

            <a onclick="searchproduct('SpotifyPremium')" class="sidebar-item">
                Spotify Premium
            </a>

        </div>
        <div id ="productlist" class="product">
            
         </div>
        
    </div>

    <div id ="modalDesc"class="modal" style="display: none;">
        <div onclick="closemodal()"class="modal-bg"></div>
        <div class="modal-page">
            <h2>รายละเอียด</h2>
            <div class="modaldesc-content">
                    <img id="mdd-img"class="modaldesc-img" src="https://digitalagemag.com/wp-content/uploads/2020/11/netflix-logo-n-icon.png" alt="">
                    <div class="modaldesc-detil"> 
                        <p id="mdd-name" style="font-size: 1.5vw;">Product name</p>
                        <p id="mdd-price" style="font-size: 1.2vw;">500 THB</p>
                        <br>
                        <p id="mdd-desc" style="color: #adadad;">Lorem iaudantium harum doloremque alias. Quae, vel ipsum quasi, voluptas, sit optio nemo magni numquam non dicta voluptates porro! Vero eveniet numquam sit aut vel eligendi officiis iste tenetur expedita. Delectus vero quibusdam adipisci in. Esse.</p>
          <br>
                        <div class="btn-control">
                            <button onclick="closemodal()" class="btn">
                                ปิด
                            </button>
                            <button  onclick = "addtocart()" class ="btn btn-buy" style="color:GhostWhite;">
                                สั่งซื้อ
                            </button>
                        </div>
                    </div>
            </div>
        </div> 
    </div>

    <div id="modalcart" class="modal" style="display: none;">
        <div onclick="closemodal()" class="modal-bg"></div>
        <div class="modal-page">
            <?php
                    if (isset($_SESSION['user_login'])) {
                        $user_id = $_SESSION['user_login'];
                        $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    } 
                ?>
        <h3 class="mt-4"><center> Username : <?php echo $row['username']?></center></h3>
            <br>
            <div id="mycart" class="cartlist">

            </div>
            <div class="btn-control">
                <button onclick="closemodal()" class="btn">
                    ย้อนกลับ
                </button>
                <BUtton class="btn btn-buy">
                <a href="logout.php" class="btn btn-danger" style="color:GhostWhite;">Logout</a>
                </BUtton>
            </div>
        </div>
    </div>
    <footer class="bgfooter mt-4">
            <center>
                    <br>
                    <div class="setcenter" ><i class="fa-regular fa-copyright"></i>Copyright 2022 By PhaBie.exe</div>
                    <div class="float-end setright">
                    <a class="social-button bdiscord " href="https://discord.gg/E5vHMZW7pA"><i class="fa-1x fab fa-discord fa-xl"></i></a>
                    <a class="social-button bfacebook" href="https://www.facebook.com/TOSAKUL666"><i class="fa-1x fab fa-facebook fa-xl"></i></a>
                    <a class="social-button bfacebook" href="https://www.facebook.com/TOSAKUL666"><i class="fab fa-dev fa-xl"></i></a>
            </div>
            </center>
    </footer>

</body>
</html>