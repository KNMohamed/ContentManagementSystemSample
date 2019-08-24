<?php require_once('../../../private/initialize.php'); ?>

<?php
    $id = $_GET['id'] ?? 1;
?>

<?php include(SHARED_PATH . '/staff_header.php')?>

<div id="content">
    <div class="back-link"><a class="action" href="<?php echo url_for('/staff/subjects/index.php');?>">&laquo; Back to list</a></div>
    <div class="page show">
        Page ID: <?php echo h($id);?>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php')?>