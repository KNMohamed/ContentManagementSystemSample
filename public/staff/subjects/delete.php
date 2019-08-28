<?php 
    require_once('../../../private/initialize.php'); 
    
    if(!isset($_GET['id'])){
        redirect_to(url_for('/staff/subjects/index.php'));
    }
    $id = $_GET['id'];
    
    if(is_post_request()){      
        if(delete_subject($id)){ //Success
            redirect_to(url_for('/staff/subjects/index.php'));
        }else{  //Failure to Delete
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }else{
        $subject = find_subject_by_id($id);
    }
?>

<?php $page_title = 'Delete Subject' ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content">
    <div class="back-link">
        <a class="action" href="<?php echo url_for('/staff/subjects/index.php');?>">&laquo; Back to list</a>
    </div>
    <div class="subject delete">
        <h1>Delete Subject</h1>
        <p>Are you sure you want to delete this subject?</p>
        <p class="item"><?php echo h($subject['menu_name']); ?></p>
        <form action="<?php echo url_for("/staff/subjects/delete.php?id=" . h(u($subject['id']))); ?>" method="post">
            <div class="opertaion">
                <input type="submit" name="commit" value="Delete Subject"/>
            </div>
        </form>
    </div>  
</div>
<?php include(SHARED_PATH . '/staff_footer.php');?>