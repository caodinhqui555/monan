<?php
$error=array();
if(is_admin()) {
redirect(base_url('?m=common&a=dashboard'));
}
if(is_submit('login')) {
  $username=input_post('username');
  $password=input_post('password');
  if(empty($username)) {
    $error['username']='bạn chưa nhập username';
  }
  if(empty($password)) {
    $error['password']='bạn chưa nhập password';
  }
  //nếu không lỗi
  if(!$error) {
    //trỏ đến trang user
    include_once('database/mon.php');
    //lấy thông tin user theo username
    $user=db_user_get_by_username($username);
    if(empty($user)) {
      $error['username']='tên đăng nhập không đúng';
    }
    else if($user['password'] != md5($password)) {
      $error['password']='mật khẩu không chính xác';
    }

    //nếu mọi thứ thành công thì trỏ vào trang dashboard là trang chủ đó
    if (!$error) {
      //var_dump($user);
      set_logged($user['username'], $user['level']);
      redirect(base_url('?m=common&a=dashboard'));
    }
    //var_dump('expression');
  }
}
?>



<?php include_once('widgets/header.php'); ?>
   <h1>Trang đăng nhập</h1>
   <form action="<?php echo base_url('?m=common&a=login'); ?>" method="post">
  	<table>
  		<tr>
  			<td>Username</td>
  			<td>
          <input type="text" name="username" value=""/>
          <?php show_error($error,'username'); ?>
        </td>
  		</tr>
  		<tr>
  			<td>Password</td>
  			<td>
          <input type="password" name="password" value=""/>
          <?php show_error($error,'password'); ?>
        </td>
  		</tr>
  		<tr>
  			<td>
          <input type="hidden" name="request_name" value="login" />   
        </td>
  			<td><input type="submit" name="login-btn" value="đăng nhập"/></td>
  		</tr>
  	</table>
   </form>
<?php include_once('widgets/footer.php'); ?>