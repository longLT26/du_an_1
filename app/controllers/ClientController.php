<?php
include "app/models/pdo.php";
if (isset($_GET["act"]) && ($_GET["act"] != "")) {
    switch ($_GET["act"]) {
       case "sanpham":
       include "app/views/Client/sanpham.php";
       break;

       case "tintuc":
       include "app/views/Client/tintuc.php";
       break;

       case "lienhe":
       include "app/views/Client/lienhe.php";
       break;
       case "taikhoan":
       include "app/views/Client/taikhoan.php";
       break;
       case "giohang":
       include "app/views/Client/giohang.php";
       break;
       case "tintucchitiet":
       include "app/views/Client/tintucchitiet.php";
       break;
       case "sanphamchitiet":
       include "app/views/Client/sanphamchitiet.php";
       break;
    }
} else {
    include "app/views/Client/home.php";
}