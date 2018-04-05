<?php
 if (!defined('IN_SITE')) die ('The request not found');
function db_user_get_by_username($username) {
    $username = addslashes($username);
    $sql="SELECT * FROM tb_user where username = '{$username}'";
    return db_get_row($sql);
}




// Hàm validate dữ liệu bảng món
function db_mon_validate($data)
{
    // Biến chứa lỗi
    $error = array();
     
    /* VALIDATE CĂN BẢN */
    // Username
    if (isset($data['ten_mon_an']) && $data['ten_mon_an'] == ''){
        $error['ten_mon_an'] = 'Bạn chưa nhập tên món ăn';
    }
     
    // Email
    if (isset($data['noi_dung']) && $data['noi_dung'] == ''){
        $error['noi_dung'] = 'Bạn chưa nhập nội dung';
    }
    // if (isset($data['ten_mon_an']) && filter_var($data['ten_mon_an'], FILTER_VALIDATE_EMAIL) === false){
    //     $error['ten_mon_an'] = 'tên không hợp lệ';
    // }
     
     
    // Level
    if (isset($data['loai_mon_an']) && !in_array($data['loai_mon_an'], array('canh', 'no bung','trang mieng'))){
        $error['loai_mon_an'] = 'loại món bạn chọn không tồn tại';
    }
     
    if (!($error) && isset($data['ten_mon_an']) && $data['ten_mon_an']){
        $sql = "SELECT count(id) as counter FROM menu_monan WHERE ten_mon_an='".addslashes($data['ten_mon_an'])."'";
        $row = db_get_row($sql);
        if ($row['counter'] > 0){
            $error['ten_mon_an'] = 'Tên đăng nhập này đã tồn tại';
        }
    }
     
     
    return $error;
}