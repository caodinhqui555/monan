<?php if(!defined('IN_SITE')) die('The request not found');
//kiểm tra quyền , nếu k có quyền thì về trang logout
if(!is_admin()) {
	redirect(base_url(), array('m'=>'common', 'a'=>'logout'));
}
?>
<?php include_once('widgets/header.php'); ?>
<?php //1. xử lý phân trang
//tìm tổng số records
$sql= db_create_sql('SELECT count(id) as counter FROM menu_monan {where}');
$result =db_get_row($sql);
$total_records=$result['counter'];
// lấy trang hiện tại
$current_page = input_get('page');
//lấy limit. giới hạn 1 trang có bao nhiêu record
$limit = 10;
//lấy link
$link=create_link(base_url(),array(
	'm' => 'user',
	'a' => 'list',
	'page' => '{page}'
));
//thực hiện phân trang
$paging = paging($link,$total_records,$current_page,$limit);
//lấy danh sách user từ database
$sql=db_create_sql("SELECT * FROM menu_monan {where}   LIMIT {$paging['start']}, {$paging['limit']}",array('loai_mon_an' => 'canh'));
$users = db_get_list($sql);
?>
<h1>Danh sách món ăn</h1>
<div class="controls">
	<a class="button" href="<?php echo create_link(base_url(),array('m' => 'user','a' => 'add')); ?>">Thêm</a>
</div>
<table cellspacing="0" cellpadding="0" class="form">
	<thead>
		<tr>
			<td>Tên Món Ăn</td>
			<td>Loại</td>
			<?php if(is_super_admin()) { ?>
			<td>action</td>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $item){ ?>
        <tr>
            <td><?php echo $item['ten_mon_an']; ?></td>
            <td><?php echo $item['loai_mon_an']; ?></td>
            <?php if (is_super_admin()){ ?>
            <td>
                <form method="POST" class="form-delete" action="<?php echo create_link(base_url('index.php'), array('m' => 'user', 'a' => 'delete')); ?>">
                    <input type="hidden" name="tenmon_id" value="<?php echo $item['id']; ?>"/>
                    <input type="hidden" name="request_name" value="delete_mon"/>
                    <a href="#" class="btn-submit">Delete</a>
                </form>
            </td>
            <?php } ?>
        </tr>
        <?php } ?>
    </tbody>
</table>

<script language="javascript">
    $(document).ready(function(){
        // Nếu người dùng click vào nút delete
        // Thì submit form
        $('.btn-submit').click(function(){
            $(this).parent().submit();
            return false;
        });
 
        // Nếu sự kiện submit form xảy ra thì hỏi người dùng có chắc không?
        $('.form-delete').submit(function(){
            if (!confirm('Bạn có chắc muốn xóa món ăn này không?')){
                return false;
            }
             
            // Nếu người dùng chắc chắn muốn xóa thì ta thêm vào trong form delete
            // một input hidden có giá trị là URL hiện tại, mục đích là giúp ở 
            // trang delete sẽ lấy url này để chuyển hướng trở lại sau khi xóa xong
            $(this).append('<input type="hidden" name="redirect" value="'+window.location.href+'"/>');
             
            // Thực hiện xóa
            return true;
        });
    });
</script>



<?php include_once('widgets/footer.php'); ?>