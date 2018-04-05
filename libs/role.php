<?php
//hàm thiết lập đăng nhập
function set_logged($username,$level) {
	session_set('ss_user_token',array(
		'username' => $username,
		'level' => $level
	));
	//var_dump($username);
}
//hàm thiết lập đăng xuất
function set_logout() {
	session_delete('ss_user_token');
}
//hàm kết nối trạng thái người dùng đã đăng nhập hay chưa
function is_logged() {
	$user=session_get('ss_user_token');
	return $user;
}
//hàm kiểm tra có phải admin không
function is_admin() {
	$user = is_logged();
	if(!empty($user['level']) && $user['level'] =='1') {
		return true;
	}
	return false;
}


///////////
// Lấy username người dùng hiện tại
function get_current_username(){
    $user  = is_logged();
    return isset($user['username']) ? $user['username'] : '';
    // echo 143324;
}
 
// Lấy level người dùng hiện tại
function get_current_level(){
    $user  = is_logged();
    return isset($user['level']) ? $user['level'] : '';
}
//hàm kiểm tra có phải là super admin hay không. 
 function is_super_admin() {
 	$user = is_logged();
 	if(!empty($user['level']) && $user['level'] =='1' && $user['username'] == 'admin') {
 		return true; //echo 1;
 	}
 	false;
 }
?>