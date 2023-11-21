<?php
include "../../models/pdo.php";
if (isset($_GET["act"]) && ($_GET["act"] != "")) {
    switch ($_GET["act"]) {
            // case tài khoản
        case 'listtk':
            if (isset($_POST['timkiem'])) {
                $tukhoa = $_POST['tukhoa'];
                $idphanquyen = $_POST['idphanquyen'];
            } else {
                $tukhoa = "";
                $idphanquyen = 0;
            }
            $listphanquyen=loadAllpq();
            $listtaikhoan=loadAll_taikhoan($tukhoa,$idphanquyen);
            include "taikhoan/list.php";
            break;
        case 'addtk':
            if(isset($_POST['themmoi'])){
                $tendangnhap=$_POST['tendangnhap'];
                $matkhau=$_POST['matkhau'];
                $hoten=$_POST['hoten'];
                $hinhanh = $_FILES['hinhanh']['name'];
                $target_dir = "../../upload/";
                $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
                if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                    // echo "Thêm ảnh thành công";
                } else {
                    echo "Không thêm được ảnh";
                }
                $email=$_POST['email'];
                $diachi=$_POST['diachi'];
                $sdt=$_POST['sdt'];
                $trangthai=$_POST['trangthai'];
                $idphanquyen=$_POST['idphanquyen'];
                insert_taikhoan($tendangnhap,$matkhau,$hoten,$hinhanh,$email,$diachi,$sdt,$trangthai,$idphanquyen);
            }
            $listphanquyen = loadAllpq();
            include "taikhoan/add.php";
            break;
        case 'detailtk':
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                $onetk=taikhoan_one_admin($id);
            }
            include "taikhoan/detail.php";
            break;
        case 'xoatk':
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                delete_taikhoan($id);
                }
            $listtaikhoan = loadAll_taikhoan();
            
            include "taikhoan/list.php";
            break;
            
        case 'suatk':
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                $onetk = taikhoan_one_admin($id);
                }
            $listphanquyen = loadAllpq();
            include "taikhoan/update.php";   
                // break;
                
        case 'updatetk':
            if (isset($_POST['capnhat'])) {
                $id = $_POST['id'];
                $tendangnhap=$_POST['tendangnhap'];
                $matkhau=$_POST['matkhau'];
                $hoten=$_POST['hoten'];
                $hinhanh = $_FILES['hinhanh']['name'];
                $target_dir = "../../upload/";
                $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
                if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                    // echo "Thêm ảnh thành công";
                } else {
                    echo "Không thêm được ảnh";
                }
                $email=$_POST['email'];
                $diachi=$_POST['diachi'];
                $sdt=$_POST['sdt'];
                $trangthai=$_POST['trangthai'];
                $idphanquyen=$_POST['idphanquyen'];
                update_taikhoan($id, $tendangnhap, $matkhau, $hoten,$hinhanh,$email,$sdt,$diachi,$trangthai,$idphanquyen);
                $thongbao = "Cập nhật thành công";
                }
        
        $listtaikhoan = loadAll_taikhoan();
        include "taikhoan/list.php";
        break;
        
            // case chức vụ
        case 'listcv':
            $listphanquyen = loadAllpq();
            include "chucvu/list.php";
            break;
        case 'addcv':
            if (isset($_POST['themmoi'])) {
                $chucnang=$_POST['chucnang'];
                $mota=$_POST['mota'];
                insert_phanquyen($chucnang,$mota);
                $thongbao = "Thêm thành công";
            }
            include "chucvu/add.php";
            break;
        case 'xoacv':
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                delete_phanquyen($id);
                }
            $listphanquyen = loadAllpq();
            include "chucvu/list.php";
            break;
        case 'suacv':
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                $pq = loadOnepq($id);
                }
            include "chucvu/update.php";
                // break;
        
        case 'updatecv':
            if (isset($_POST['capnhat'])) {
                $id = $_POST['id'];
                $chucnang = $_POST['chucnang'];
                $mota = $_POST['mota'];
                update_phanquyen($id,$chucnang,$mota);
                $thongbao = "Cập nhật thành công";
                }
        
            $listphanquyen = loadAllpq();
            include "chucvu/list.php";
            break;
       
            // case danh mục
        case 'listdm':
            $listdanhmuc = loadAlldm();
            include "danhmuc/list.php";
            break;
        case 'adddm':
            if (isset($_POST['themmoi'])) {
                $tenloai=$_POST['tenloai'];
                $mota=$_POST['mota'];
                insert_danhmuc($tenloai,$mota);
                $thongbao = "Thêm thành công";
            }
            include "danhmuc/add.php";
            break;
        case 'suadm':
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                $dm = loadOnedm($id);
                }
            include "danhmuc/update.php";
            // break;
    
        case 'updatedm':
            if (isset($_POST['capnhat'])) {
                $id = $_POST['id'];
                $tenloai = $_POST['tenloai'];
                $mota = $_POST['mota'];
                update_danhmuc($id,$tenloai,$mota);
                $thongbao = "Cập nhật thành công";
            }
    
                $listdanhmuc = loadAlldm();
                include "danhmuc/list.php";
                break;
        case 'xoadm':
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                delete_danhmuc($id);
                }
            $listdanhmuc = loadAlldm();
            include "danhmuc/list.php";
            break;

            // case  sản phẩm
        case 'listsp':
            if (isset($_POST['timkiem'])) {
                $tukhoa = $_POST['tukhoa'];
                $iddanhmuc = $_POST['iddanhmuc'];
            } else {
                $tukhoa = "";
                $iddanhmuc = 0;
            }

            $listdanhmuc = loadAlldm();
            $listsanpham = loadAll_sanpham($tukhoa, $iddanhmuc);
            include "sanpham/list.php";
            break;

        case 'addsp';
            if (isset($_POST['themmoi'])) {
                $tensanpham=$_POST['tensanpham'];
                $ngaynhap=$_POST['ngaynhap'];
                $mota=$_POST['mota'];
                $iddanhmuc=$_POST['iddanhmuc'];
                insert_sanpham($tensanpham, $ngaynhap, $mota, $iddanhmuc);
                $thongbao = "Thêm thành công";
            }
            $listdanhmuc = loadAlldm();
            include "sanpham/add.php";
            break;
        case 'suasp':
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                $sp = loadOne_sanpham($id);
            }
            $listdanhmuc=loadAlldm();
            include "sanpham/update.php";

        case 'updatesp':
            if (isset($_POST['capnhat'])){
                $id = $_POST['id'];
                $tensanpham=$_POST['tensanpham'];
                $ngaynhap=$_POST['ngaynhap'];
                $mota=$_POST['mota'];
                $iddanhmuc=$_POST['iddanhmuc'];
                update_sanpham($id, $tensanpham, $ngaynhap, $mota, $iddanhmuc);
                $thongbao = "Thêm thành công";
            }
            $listsanpham=loadAll_sanpham();
            include "sanpham/list.php";
            break;

        case 'xoasp':
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                delete_sanpham($id);
            }
            $listsanpham=loadAll_sanpham();
            include "sanpham/list.php";
            break;



            // case biến thể
        case 'listbt':
            $listbienthe=loadAll_bienthe();
            include "bienthe/list.php";
            break;

        case 'addbt':
            if(isset($_POST['themmoi'])){
                $hinhanh = $_FILES["hinhanh"]['name'];
                $target_dir = "../../upload/";
                $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
                if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                    // echo "Thêm ảnh thành công";
                } else {
                    echo "Không thêm được ảnh";
                }
                $gia=$_POST['gia'];
                $giasale=$_POST['giasale'];
                $mau=$_POST['mau'];
                $dungluong=$_POST['dungluong'];
                $idsanpham=$_POST['idsanpham'];
                
                insert_bienthe($hinhanh, $gia, $giasale, $mau, $dungluong, $idsanpham);
            }
            $listsanpham=loadAll_sanpham();
            include "bienthe/add.php";
            break;
        case 'detailbt':
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                $bt=loadOne_bienthe($id);
            }
            include "bienthe/detail.php";
            break;

        case 'xoabt':
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                delete_bienthe($id);
            }
            $listbienthe=loadAll_bienthe();
            include "bienthe/list.php";
            break;

        case "suabt":
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                $bt =loadOne_bienthe($id);
            }
            $listsanpham=loadAll_sanpham();
            include "bienthe/update.php";

        case 'updatebt':
            if (isset($_POST['capnhat'])){
                $id = $_POST['id'];
                $hinhanh = $_FILES["hinhanh"]['name'];
                $target_dir = "../../upload/";
                $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
                if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                    // echo "Thêm ảnh thành công";
                } else {
                    echo "Không thêm được ảnh";
                }
                $gia=$_POST['gia'];
                $giasale=$_POST['giasale'];
                $mau=$_POST['mau'];
                $dungluong=$_POST['dungluong'];
                $idsanpham=$_POST['idsanpham'];
                update_bienthe($id, $hinhanh, $gia, $giasale,$mau,$dungluong,$idsanpham);
            }
            $listbienthe=loadAll_bienthe();
            include "bienthe/list.php";
            break;

            // case đơn hàng
        case 'listdh':
            include "donhang/list.php";
            break;
        case 'detaildh':
            include "donhang/detail.php";
            break;
        case 'adddh':
            include "donhang/add.php";
            break;
        case 'updatedh':
            include "donhang/update.php";
            break;

            // case bình luận
        case 'listbl':
            include "binhluan/list.php";
            break;
        case 'updatebl':
            include "binhluan/update.php";
            break;

            // case banner
        case 'listbn':
            include "banner/list.php";
            break;
        case 'addbn':
            include "banner/add.php";
            break;
        case 'updatebn':
            include "banner/update.php";
            break;

            // case tin tức
        case 'listtt':
            include "tintuc/list.php";
            break;
        case 'addtt':
            include "tintuc/add.php";
            break;
        case 'updatett':
            include "tintuc/update.php";
            break;

            // case khuyến mại
        case 'listkm':
            include "khuyenmai/list.php";
            break;
        case 'addkm':
            include "khuyenmai/add.php"; 
            break;
        case 'updatekm':
            include "khuyenmai/update.php";
            break;

            // case liên hệ
        case 'listlh':
            include "lienhe/list.php";
            break;
        case 'updatelh':
            include "lienhe/update.php";
    }
} else {
    include "home.php";
}
