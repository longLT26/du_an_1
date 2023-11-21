<?php
function pdo_get_connection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=duan1", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
// Thành công đữ liệu
function pdo_execute($sql)
{
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);

    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}
// truy vấn nhiều dữ liệu
function pdo_query($sql)
{
    $sql_args = array_slice(func_get_args(), 1);

    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $rows = $stmt->fetchAll();
        return $rows;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}
// truy vấn  1 dữ liệu
function pdo_query_one($sql)
{
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // đọc và hiển thị giá trị trong danh sách trả về
        return $row;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}
pdo_get_connection();
// truy vấn danh mục
function insert_danhmuc($tenloai, $mota)
{
    $sql = "INSERT INTO danh_muc(ten_danh_muc, mo_ta) VALUES ('$tenloai', '$mota')";
    pdo_execute($sql);
}

function delete_danhmuc($id)
{
    $sql = "DELETE FROM danh_muc WHERE id_danh_muc= '$id'";
    pdo_query($sql);
}

function loadAlldm()
{
    $sql = "SELECT * FROM danh_muc ORDER BY id_danh_muc DESC";
    $listdm = pdo_query($sql);
    return $listdm;
}

function loadOnedm($id)
{
    $sql = "SELECT * FROM danh_muc WHERE id_danh_muc = '$id'";
    $dm = pdo_query_one($sql);
    return $dm;
}

function update_danhmuc($id, $tenloai, $mota)
{
    $sql = "UPDATE danh_muc SET ten_danh_muc='$tenloai', mo_ta='$mota' WHERE id_danh_muc = '$id'";
    pdo_execute($sql);
}
// truy vấn chức vụ
function insert_phanquyen($chucnang, $mota)
{
    $sql = "INSERT INTO phan_quyen(ten_chuc_nang, mo_ta) VALUES ('$chucnang', '$mota')";
    pdo_execute($sql);
}

function delete_phanquyen($id)
{
    $sql = "DELETE FROM phan_quyen WHERE id_phan_quyen= '$id'";
    pdo_query($sql);
}

function loadAllpq()
{
    $sql = "SELECT * FROM phan_quyen ORDER BY id_phan_quyen DESC";
    $listpq = pdo_query($sql);
    return $listpq;
}

function loadOnepq($id)
{
    $sql = "SELECT * FROM phan_quyen WHERE id_phan_quyen = '$id'";
    $pq = pdo_query_one($sql);
    return $pq;
}

function update_phanquyen($id, $chucnang, $mota)
{
    $sql = "UPDATE phan_quyen SET ten_chuc_nang='$chucnang', mo_ta='$mota' WHERE id_phan_quyen = '$id'";
    pdo_execute($sql);
}

// truy vấn tài khoản
function insert_taikhoan($tendangnhap, $matkhau, $hoten,$hinhanh,$email,$sdt,$diachi, $trangthai, $idphanquyen)
{
$sql = "INSERT INTO tai_khoan(ten_dang_nhap, mat_khau, ho_ten, img, email, sdt, dia_chi, trang_thai,id_phan_quyen) 
VALUES ('$tendangnhap', '$matkhau', '$hoten','$hinhanh','$email','$sdt','$diachi','$trangthai','$idphanquyen')";
    pdo_execute($sql);
}

function delete_taikhoan($id)
{
    $sql = "DELETE FROM tai_khoan WHERE id_tai_khoan= '$id'";
    pdo_query($sql);
}

// function taikhoan_one($tendangnhap, $matkhau)
// {
//     $sql = "SELECT * FROM tai_khoan where ten_dang_nhap = '$tendangnhap' AND mat_khau = '$matkhau'";
//     $listtk = pdo_query_one($sql);
//     return $listtk;
// }

function taikhoan_one_admin($id)
{
    
    $sql = "SELECT id_tai_khoan,ten_dang_nhap, mat_khau, ho_ten, img, email, sdt, dia_chi,trang_thai, ten_chuc_nang FROM tai_khoan 
    INNER JOIN phan_quyen ON tai_khoan.id_phan_quyen = phan_quyen.id_phan_quyen where id_tai_khoan = '$id'";
    $listtk = pdo_query_one($sql);
    return $listtk;
}
// function check_email($email)
// {
//     $sql = "SELECT * FROM tai_khoan where email='$email'";
//     $email = pdo_query_one($sql);
//     return $email;
// }

function update_taikhoan($id, $tendangnhap, $matkhau, $hoten,$hinhanh,$email,$sdt,$diachi,$trangthai,$idphanquyen)
{
    $sql = "UPDATE tai_khoan SET ten_dang_nhap='$tendangnhap',mat_khau='$matkhau',ho_ten='$hoten',img='$hinhanh',email='$email',sdt='$sdt',dia_chi='$diachi',trang_thai='$trangthai',id_phan_quyen='$idphanquyen'
    WHERE id_tai_khoan = '$id'";
    pdo_execute($sql);
}


function loadAll_taikhoan($tukhoa="",$idphanquyen=0)
{
    $sql = "SELECT * FROM tai_khoan WHERE 1";
    if ($tukhoa != "") {
        $sql .= " AND ten_dang_nhap LIKE '%$tukhoa%'";
    }

    if ($idphanquyen > 0) {
        $sql .= " AND id_phan_quyen = '$idphanquyen'";
    }

    $sql .= " ORDER BY id_tai_khoan DESC";

    $listtaikhoan = pdo_query($sql);
    return $listtaikhoan;
}



// truy vấn sản phẩm
function insert_sanpham($tensanpham, $ngaynhap, $mota, $iddanhmuc)
{
    $sql = "INSERT INTO san_pham(ten_san_pham,ngay_nhap, mo_ta_sp, id_danh_muc ) VALUES ('$tensanpham', '$ngaynhap', '$mota', '$iddanhmuc')";
    pdo_execute($sql);
}




function delete_sanpham($id)
{
    $sql = "DELETE FROM san_pham WHERE id_san_pham= '$id'";
    pdo_query($sql);
}

// function loadAll_sanpham_home()
// {
//     $sql = "SELECT * FROM sanpham WHERE 1 ORDER BY id DESC LIMIT 0,9";
//     $listsp = pdo_query($sql);
//     return $listsp;
// }

// function loadAll_sanpham_top10()
// {
//     $sql = "SELECT * FROM sanpham WHERE 1 ORDER BY luotxem DESC LIMIT 0,10";
//     $listsp = pdo_query($sql);
//     return $listsp;
// }


function loadAll_sanpham($tukhoa = "", $iddanhmuc = 0)
{
    $sql = "SELECT * FROM san_pham WHERE 1";

    if ($tukhoa != "") {
        $sql .= " AND ten_san_pham LIKE '%$tukhoa%'";
    }

    if ($iddanhmuc > 0) {
        $sql .= " AND id_danh_muc = '$iddanhmuc'";
    }

    $sql .= " ORDER BY id_san_pham DESC";

    $listsanpham = pdo_query($sql);
    return $listsanpham;
}




function loadOne_sanpham($id)
{
    $sql = "SELECT * FROM san_pham WHERE id_san_pham = '$id'";
    $sp = pdo_query_one($sql);
    return $sp;
}

function load_ten_dm($iddm)
{
    if ($iddm > 0) {
        $sql = "SELECT * FROM danhmuc WHERE id = '$iddm'";
        $dm = pdo_query_one($sql);
        extract($dm);
    } else {
        return "";
    }
}

// function loadOne_sanpham_cungloai($id, $iddm)
// {
//     $sql = "SELECT * FROM sanpham WHERE iddm = '$iddm' AND id <> '$id'"; // where khác <>
//     $listsp = pdo_query($sql);
//     return $listsp;
// }

function update_sanpham($id, $tensanpham, $ngaynhap, $mota, $iddanhmuc)
{
    $sql = "UPDATE san_pham SET ten_san_pham='$tensanpham',ngay_nhap='$ngaynhap',mo_ta_sp='$mota', id_danh_muc='$iddanhmuc' WHERE id_san_pham = '$id'";
    pdo_execute($sql);
}


// truy vấn dữ liệu biến thể

function insert_bienthe($hinhanh, $gia, $giasale, $mau, $dungluong, $idsanpham)
{
    $sql = "INSERT INTO bien_the(img, gia, gia_sale, mau, dung_luong, id_san_pham ) VALUES ('$hinhanh', '$gia', '$giasale', '$mau', '$dungluong', '$idsanpham')";
    pdo_execute($sql);
}

function loadAll_bienthe()
{
    $sql = "select id_bien_the, img, gia, gia_sale, mau, dung_luong, ten_san_pham , ngay_nhap, mo_ta_sp from bien_the b JOIN san_pham s ON b.id_san_pham=s.id_san_pham order by id_bien_the desc";
    
    $listbienthe = pdo_query($sql);
    return $listbienthe;
}

function loadOne_bienthe($id)
{
    $sql = "select id_bien_the, img, gia, gia_sale, mau, dung_luong, ten_san_pham , ngay_nhap, mo_ta_sp from bien_the b JOIN san_pham s ON b.id_san_pham=s.id_san_pham where id_bien_the = '$id'";
    $listonebt = pdo_query_one($sql);
    return $listonebt;
}

function delete_bienthe($id)
{
    $sql = "DELETE FROM bien_the WHERE id_bien_the= '$id'";
    pdo_query($sql);
}

// function loadOne_bienthe($id)
// {
//     $sql = "SELECT * FROM bien_the WHERE id_bien_the = '$id'";
//     $bt = pdo_query_one($sql);
//     return $bt;
// }

function update_bienthe($id, $hinhanh, $gia, $giasale,$mau,$dungluong,$idsanpham)
{
    // $sql = "UPDATE bien_the SET img='$hinhanh',gia='$gia',gia_sale='$giasale',mau='$mau',dung_luong='$dungluong',id_san_pham='$idsanpham'
    // WHERE id_bien_the = '$id'";
    if ($hinhanh != "") {
        $sql = "UPDATE bien_the SET img='$hinhanh',gia='$gia',gia_sale='$giasale',mau='$mau',dung_luong='$dungluong',id_san_pham='$idsanpham'
        WHERE id_bien_the = '$id'";
    } else {
        $sql = "UPDATE bien_the SET gia='$gia',gia_sale='$giasale',mau='$mau',dung_luong='$dungluong',id_san_pham='$idsanpham'
        WHERE id_bien_the = '$id'";
    }
    pdo_execute($sql);

   
}
?>