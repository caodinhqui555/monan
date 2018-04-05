<?php 
//hằng bảo vệ project
if (!defined('IN_SITE')) die ('The request not found');
define("IN_SITE",true);
//lấy module và action trên url
$module = isset($_GET['m']) ? $_GET['m']:'';
$action = isset($_GET['a']) ? $_GET['a']:'';
// var_dump($module);
// var_dump($action);

//trường hợp người dùng không truyền module và action thì ta mặc định
//module =common và action là login
if(empty($module) || empty($action)) {
	$module ='common';
	$action ='login';
}
//đường dẫn và lưu biến path
$path = 'modules/'.$module .'/' . $action . '.php';
//trường hợp url chạy đúng
if(file_exists($path)) {
	include_once ('../libs/session.php');
	include_once ('../libs/database.php');
	include_once ('../libs/role.php');
	include_once ('../libs/helper.php');
	include_once ($path);
}
else {
	//truong hợp url không tồn tại
	include_once ('modules/common/404.php');
}

?>