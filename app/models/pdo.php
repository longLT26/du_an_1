<?php
function pdo_get_connection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=duan1", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "thanhcong";
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
// danh muc
function insert_danhmuc($tenloai, $mota)
{
    $sql = "INSERT INTO danh_muc(ten_danh_muc, mo_ta) VALUES ('$tenloai', '$mota')";
    pdo_execute($sql);
}
function delete_danhmuc($id_danh_muc)
{
    $sql = "DELETE FROM danh_muc WHERE id_danh_muc= '$id_danh_muc'";
    pdo_query($sql);
}
function loadAlldm()
{
    $sql = "SELECT * FROM danh_muc ORDER BY id_danh_muc DESC";
    $listdm = pdo_query($sql);
    return $listdm;
}
function loadOnedm($id_danh_muc)
{
    $sql = "SELECT * FROM danh_muc WHERE id_danh_muc = '$id_danh_muc'";
    $dm = pdo_query_one($sql);
    return $dm;
}
function update_danhmuc($id_danh_muc, $tenloai)
{
    $sql = "UPDATE danh_muc SET name='$tenloai' WHERE id_danh_muc = '$id_danh_muc'";
    pdo_execute($sql);
}
// khuyến mại
function insert_khuyenmai($khuyenmai, $giatrikhuyenmai, $ngaybatdau, $ngayketthuc, $mota, $trangthai)
{
    $sql = "INSERT INTO khuyen_mai(ma_khuyen_mai, phan_tram_khuyen_mai, ngay_bat_dau, ngay_ket_thuc, mo_ta, trang_thai ) VALUE ('$khuyenmai','$giatrikhuyenmai','$ngaybatdau','$ngayketthuc','$mota','$trangthai')";
    pdo_execute($sql);
}
function delete_khuyenmai($id)
{
    $sql = "DELETE FROM khuyen_mai WHERE id_khuyen_mai= '$id'";
    pdo_query($sql);
}
function loadAllkm()
{
    $sql = "SELECT * FROM khuyen_mai ORDER BY id_khuyen_mai DESC";
    $listkhuyenmai = pdo_query($sql);
    return $listkhuyenmai;
}
function loadOnekm($idkhuyenmai)
{
    $sql = "SELECT * FROM khuyen_mai WHERE id_khuyen_mai = '$idkhuyenmai'";
    $km = pdo_query_one($sql);
    return $km;
}
function update_khuyenmai($id,$makhuyenmai, $giatri, $ngaybatdau, $ngayketthuc, $mota, $trangthai)
{
    $sql = "UPDATE khuyen_mai SET ma_khuyen_mai='$makhuyenmai',phan_tram_khuyen_mai='$giatri',ngay_bat_dau='$ngaybatdau',ngay_ket_thuc='$ngayketthuc',mo_ta='$mota', trang_thai='$trangthai' WHERE id_khuyen_mai = '$id'";
    pdo_execute($sql);
}
// tin tức
function insert_tintuc($tendanhmuc,$hinhanh,$ngaydang,$noidung)
{
    $sql= "INSERT INTO tin_tuc(tieu_de,img,ngay_dang,noi_dung) VALUE ('$tendanhmuc','$hinhanh','$ngaydang','$noidung')";
    pdo_execute($sql);
}
function delete_tintuc($id)
{
  $sql = "DELETE FROM tin_tuc WHERE id_tin_tuc= '$id'";
  pdo_query($sql);
}
function loadAlltt()
{
    $sql = "SELECT * FROM tin_tuc ORDER BY id_tin_tuc DESC";
    $listtintuc = pdo_query($sql);
    return $listtintuc;
}
function loadOnett($id_tin_tuc)
{
    $sql = "SELECT * FROM tin_tuc WHERE id_tin_tuc = '$id_tin_tuc'";
    $tt = pdo_query_one($sql);
    return $tt;
}
function update_tintuc($id_tin_tuc,$tieude,$ngaydang,$noidung,$hinhanh)
{
    $sql = "UPDATE tin_tuc SET tieu_de='$tieude',ngay_dang='$ngaydang',noi_dung='$noidung',img = '$hinhanh'  WHERE id_tin_tuc = '$id_tin_tuc'";
    pdo_execute($sql);
}
?>
 