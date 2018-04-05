<?php if (!defined('IN_SITE')) die ('The request not found'); ?>
<?php include_once('widgets/header.php'); ?>
<div class="jumbotron text-center">
  <h1>Thể Loại Món Ăn</h1>
</div>
  
<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <h3><a href="<?php echo base_url('?m=user&a=canh'); ?>">Canh</a></h3>
    </div>
    <div class="col-sm-4">
      <h3><a href="<?php echo base_url('?m=user&a=nobung'); ?>">No Bụng</a></h3>
    </div>
    <div class="col-sm-4">
      <h3><a href="<?php echo base_url('?m=user&a=trangmieng'); ?>">Tráng Miệng</a></h3>
    </div>
  </div>
</div>
<?php include_once('widgets/footer.php'); ?>