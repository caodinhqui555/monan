<?php
if (!defined('IN_SITE')) die('The request not found'); 
//xóa session login
set_logout();
//chuyển hướng sang trang login
redirect(base_url("?m=common&a=login"));
?>