<?php
if(!defined('IN_SITE')) die ('the request not found');
//thiết lập font chữ  UTF8 để khỏi bị lỗi font
header('Content-Type:text/html; charset=utf-8');
//kiểm tra quyền, nếu không có quyền thì chuyển sang trang logout
if(!is_super_admin()) {
	redirect(base_url(),array('m'=>'common','a' => 'logout'));
}
//var_dump('cao dinh qui');
//nếu người dùng submit delete
if(is_submit('delete_mon')) {
	//lấy id và ép kiểu
	$id =(int)input_post('tenmon_id');
	if($id) {
		//var_dump('khong bao gio het bug');
		//$qui = input_post('redirect');
		//echo $qui;
		//var_dump($qui);
		//echo input_post('redirect');
			$sql=db_create_sql('DELETE FROM menu_monan {where}',array('id' =>$id
			));
			if(db_execute($sql)) {
				?>
				<script language="javascript">
					alert('Xóa thành công!');
					window.location = '<?php echo input_post('redirect'); ?>';
				</script>
				<?php
				var_dump('aaa');
			}
			else {
				?>
				<script language="javascript">
					alert('Xóa thất bại!');
					//window.location = '<?php echo input_post('redirect'); ?>';
				</script>
				<?php
			}
		
	}
}
else {
	//nếu không phải submit delete user thì chuyển về trang chủ
	redirect(base_url());
}
?>