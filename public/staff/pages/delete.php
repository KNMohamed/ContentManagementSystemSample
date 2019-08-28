<?php 
    require_once('../../../private/initialize.php');
 
    if(!isset($_GET['id'])){
        redirect_to(url_for('/staff/pages/index.php'));
    }    
    $id = $_GET['id'];
        
    if(is_post_request()){
        if(delete_page($id)){
            redirect_to(url_for('/staff/pages/index.php'));
        }else{
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }else{
        $page = find_page_by_id($id);
    }
?>

<?php $page_title = "DELETE PAGE"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div class="content">
    <div class="back-link">
        <a class="action" href="<?php echo url_for('/staff/pages/index.php');?>">&laquo; Back to list</a>
    </div>
    <div class="delete page">
        <h1>Delete Page:</h1>
        <p>Are you sure you want to delete this page?</p>
        <p class="item"><?php echo h($page['menu_name']); ?></p>
        <form action="<?php url_for('staff/pages/delete.php?id=' . h(u($id))); ?>" method="post">
            <div class="operation">
                <input type="submit" name="commit" value="Delete Subject"/>
            </div>
        </form>
    </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>