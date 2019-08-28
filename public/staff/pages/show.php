<?php require_once('../../../private/initialize.php'); ?>

<?php
    $id = $_GET['id'] ?? 1;
    $page = find_page_by_id($id);
?>

<?php include(SHARED_PATH . '/staff_header.php')?>

<div id="content">
    <div class="back-link"><a class="action" href="<?php echo url_for('/staff/pages/index.php');?>">&laquo; Back to list</a></div>
    <div class="page show">
        <h1>Page: <?php echo h($page['menu_name']); ?></h1>
        <div class="attributes">
            <dl>
                <dt>Menu Name: </dt>
                <dd><?php echo h($page['menu_name']); ?></dd>
            </dl>
            <dl>
                <dt>Position: </dt>
                <dd><?php echo h($page['position']); ?></dd>
            </dl>
            <dl>
                <dt>Visible: </dt>
                <dd><?php echo $page['visible'] ? 'true' : 'false'; ?></dd>
            </dl>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php')?>