<?php
include "../../models/pdo.php";
if (isset($_GET["act"]) && ($_GET["act"] != "")) {
    switch ($_GET["act"]) {
            // case tài khoản
        case 'listtk':
            include "taikhoan/list.php";
            break;
        case 'addtk':
            include "taikhoan/add.php";
            break;
        case 'detailtk':
            include "taikhoan/detail.php";
            break;
        case 'updatetk':
            include "taikhoan/update.php";
            break;

            // case chức vụ
        case 'listcv':
            include "chucvu/list.php";
            break;
        case 'addcv':
            include "chucvu/add.php";
            break;
        case 'updatecv':
            include "chucvu/update.php";
            break;

            // case danh mục
        case 'listdm':
            $listdanhmuc = loadAlldm();
            include "danhmuc/list.php";
            break;
        case 'adddm':
            if (isset($_POST['themmoi'])) {
                $tenloai = $_POST['tenloai'];
                $mota = $_POST['mota'];
                insert_danhmuc($tenloai, $mota);
                $thongbao = "Thêm thành công";
            }
            include "danhmuc/add.php";
            break;
        case 'updatedm':
            if (isset($_GET["id_danh_muc"]) && $_GET["id_danh_muc"] > 0) {
                $id_danh_muc = $_GET["id_danh_muc"];
                $dm = loadOnedm($id_danh_muc);
            }
            include "danhmuc/update.php";
            break;
        case 'xoadm':
            if (isset($_GET["id_danh_muc"]) && $_GET["id_danh_muc"] > 0) {
                $id_danh_muc = $_GET["id_danh_muc"];
                delete_danhmuc($id_danh_muc);
            }
            $listdanhmuc = loadAlldm();
            include "danhmuc/list.php";
            break;

            // case  sản phẩm
        case 'listsp':
            include "sanpham/list.php";
            break;
        case 'addsp';
            include "sanpham/add.php";
            break;
        case 'detailsp':
            include "sanpham/detail.php";
            break;
        case 'updatesp':
            include "sanpham/update.php";
            break;

            // case biến thể
        case 'listbt':
            include "bienthe/list.php";
            break;
        case 'addbt':
            include "bienthe/add.php";
            break;
        case 'updatebt':
            include "bienthe/update.php";
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

            // case bannerv   z
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
            $listtintuc = loadAlltt();
            include "tintuc/list.php";
            break;
        case 'addtt':
            if (isset($_POST['themmoi'])) {
                $tieude = $_POST['tieu_de'];
                $ngaydang = $_POST['ngay_dang'];
                $noidung = $_POST['noi_dung'];
                $hinhanh = $_FILES['img']['name'];
                $target_dir = "../../upload/";
                $target_file = $target_dir . basename($_FILES["img"]["name"]);
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                    // echo "Thêm ảnh thành công";
                } else {
                    echo "Không thêm được ảnh";
                }
                insert_tintuc($tieude, $hinhanh, $ngaydang, $noidung);
                $thongbao = "Thêm thành công";
            }
            include "tintuc/add.php";
            break;
        case 'suatt':
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                $tt = loadOnett($id);
            }
            include "tintuc/update.php";
        case 'updatett':
            if (isset($_POST['capnhat'])) {
                $idtintuc = $_POST['id'];
                $tieude = $_POST['tieu_de'];
                $ngaydang = $_POST['ngay_dang'];
                $noidung = $_POST['noi_dung'];
                $hinhanh = $_FILES['img']['name'];
                $target_dir = "../../upload/";
                $target_file = $target_dir . basename($_FILES["img"]["name"]);
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                    // echo "Thêm ảnh thành công";
                } else {
                    echo "Không thêm được ảnh";
                }
                update_tintuc($idtintuc, $tieude, $ngaydang, $noidung, $hinhanh);
                $thongbao = "Cập nhật thành công";
            }
            $listtintuc = loadAlltt();
            include "tintuc/list.php";
            break;

        case 'xoatt':
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                delete_tintuc($id);
            }
            $listtintuc = loadAlltt();
            include "tintuc/list.php";
            break;

            // case khuyến mại
        case 'listkm':
            $listkhuyenmai = loadAllkm();
            include "khuyenmai/list.php";
            break;
        case 'addkm':
            if (isset($_POST['themmoi'])) {
                $khuyenmai = $_POST['ma_khuyen_mai'];
                $giatrikhuyenmai = $_POST['phan_tram_khuyen_mai'];
                $ngaybatdau = $_POST['ngay_bat_dau'];
                $ngayketthuc = $_POST['ngay_ket_thuc'];
                $mota = $_POST['mo_ta'];
                $trangthai = $_POST['trangthai'];
                insert_khuyenmai($khuyenmai, $giatrikhuyenmai, $ngaybatdau, $ngayketthuc, $mota, $trangthai);
                $thongbao = "Thêm thành công";
            }
            include "khuyenmai/add.php";
            break;

        case 'xoakm':
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                delete_khuyenmai($id);
            }
            $listkhuyenmai = loadAllkm();
            include "khuyenmai/list.php";
            break;
        case 'suakm':
            if (isset($_GET["id"]) && $_GET["id"] > 0) {
                $id = $_GET["id"];
                $km = loadOnekm($id);
            }
            include "khuyenmai/update.php";

        case 'updatekm':
            if (isset($_POST['capnhat'])) {
                $id = $_POST['id'];
                $makhuyenmai = $_POST['makhuyenmai'];
                $giatri = $_POST['phantramkhuyenmai'];
                $ngaybatdau = $_POST['ngaybatdau'];
                $ngayketthuc = $_POST['ngayketthuc'];
                $mota = $_POST['mota'];
                $trangthai = $_POST['trangthai'];
                update_khuyenmai($id, $makhuyenmai, $giatri, $ngaybatdau, $ngayketthuc, $mota, $trangthai);
                $thongbao = "Cập nhật thành công";
            }
            $listkhuyenmai = loadAllkm();
            include "khuyenmai/list.php";
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
