<?php if (!defined('IN_SITE')) die ('The request not found'); ?>
 
<?php
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
if (!is_admin()){
    redirect(base_url(), array('m' => 'common', 'a' => 'logout'));
}
?>
 
<?php 
// Biến chứa lỗi
$error = array();

// Nếu người dùng submit form mon an
if (is_submit('add_mon'))
{
    // Lấy danh sách dữ liệu từ form
    $data = array(
        'ten_mon_an'  => input_post('ten_mon_an'),
        'noi_dung'  => input_post('noi_dung'),
        'dongia'  => input_post('dongia'),
        'loai_mon_an'     => input_post('loai_mon_an'),
    );
    // require file xử lý database cho mon
    require_once('database/mon.php');
     
    // Thực hiện validate
    $error = db_mon_validate($data);
    // Nếu validate không có lỗi
    if (!$error)
    {
    
         
        // Nếu insert thành công thì thông báo
        // và chuyển hướng về trang danh sách món
        if (db_insert('menu_monan', $data)){
            ?>
            <script language="javascript">
                alert('Thêm món ăn thành công!');
                window.location = '<?php echo create_link(base_url(), array('m' => 'user', 'a' => 'list')); ?>';
            </script>
            <?php
            die();
        }
    }

    }
    //var_dump('expression');
?>
 
<?php include_once('widgets/header.php'); ?>
 
<h1>Thêm Món Ăn</h1>
 
<div class="controls">
    <a class="button" onclick="$('#main-form').submit()" href="#">Lưu</a>
    <a class="button" href="<?php echo create_link(base_url(), array('m' => 'user', 'a' => 'list')); ?>">Trở về</a>
</div>
 
<form id="main-form" method="post" action="<?php echo create_link(base_url('index.php'), array('m' => 'user', 'a' => 'add')); ?>">
    <input type="hidden" name="request_name" value="add_mon"/>
    <table cellspacing="0" cellpadding="0" class="form">
        <tr>
            <td width="200px">Tên món ăn</td>
            <td>
                <input type="text" name="ten_mon_an" value="<?php echo input_post('ten_mon_an'); ?>" />
                <?php show_error($error, 'ten_mon_an'); ?>
            </td>
        </tr>
        <tr>
            <td width="200px">nội dung</td>
            <td>
                <input type="text" name="noi_dung" value="<?php echo input_post('noi_dung'); ?>" />
                <?php show_error($error, 'noi_dung'); ?>
            </td>
        </tr>
        <tr>
            <td width="200px">đơn giá</td>
            <td>
                <input type="text" name="dongia" value="<?php echo input_post('dongia'); ?>" />
                <?php show_error($error, 'dongia'); ?>
            </td>
        </tr>
        <tr>
            <td>Thể Loại</td>
            <td>
                <select name="loai_mon_an">
                    <option value="">-- Chọn thể loại --</option>
                    <option value="canh" <?php echo (input_post('loai_mon_an') == 'canh') ? 'selected' : ''; ?>>Canh</option>
                    <option value="no bung" <?php echo (input_post('loai_mon_an') == 'No bung') ? 'selected' : ''; ?>>No Bụng</option>
                    <option value="trang mieng" <?php echo (input_post('loai_mon_an') == 'trang mieng') ? 'selected' : ''; ?>>Tráng Miệng</option>
                </select>
                <?php show_error($error, 'loai_mon_an'); ?>
            </td>
        </tr>
    </table>
</form>
 
<?php include_once('widgets/footer.php'); ?>