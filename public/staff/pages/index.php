<?php require_once('../../../private/initialize.php'); ?>

<?php 
    $rs = find_all_pages();
?>

<?php $page_title='Pages' ?>
<?php include(SHARED_PATH . '/staff_header.php' );?>

<div id="content">
    <div id="pages listing">
        <h1>Pages</h1>
        <div id=actions>
            <a class="action" href="<?php echo url_for('/staff/pages/new.php'); ?>">Create New Page</a>
        </div>
        
        <table class="list">
            <tr>
                <th>id</th>
                <th>Positon</th>
                <th>Visible</th>
                <th>Name</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <?php while($page = mysqli_fetch_assoc($rs)) { ?>
                <tr>
                    <td><?php echo h($page['id']);?></td>
                    <td><?php echo h($page['position']);?></td>
                    <td><?php echo $page['visible'] ? 'true' : 'false'; ?></td>
                    <td><?php echo h($page['menu_name']); ?></td>
                    <td><a class="action" href="<?php echo url_for('/staff/pages/show.php?id=' . h(u($page['id'])));?>">View</a></td>
                    <td><a class="action" href="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($page['id'])));?>">Edit</a></td>
                    <td><a class="action" href="">Delete</a></td>
                </tr>
            <?php } ?>
        </table>
        <?php mysqli_free_result($rs); ?>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php' );?>
