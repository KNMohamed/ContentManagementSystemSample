<?php 

require_once('../../../private/initialize.php');
    
if(!isset($_GET['id'])){
    redirect_to(url_for('/staff/subjects/index.php'));
}

$id = $_GET['id'];

if(is_post_request()){

    $subject = [];
    // Handle values sent by new.php
    $subject['id'] = $id;
    $subject['menu_name'] = $_POST['menu_name'] ?? '';
    $subject['position'] = $_POST['position'] ?? '';
    $subject['visible'] = $_POST['visible'] ?? '' ;

    if(update_subject($subject)){
        redirect_to(url_for('/staff/subjects/show.php?id=' . $id));
    }else{
        echo "Error: " . mysqli_error() . ' - (' . mysqli_errno() . ")";
        db_disconnect($db);
        exit;
    }
    

}else{
    $subject = find_subject_by_id($id);
    $subject_count = get_subject_count();
}
?>

<?php $page_title = 'Edit Subject' ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content">
    <div class="back-link"><a class="action" href="<?php echo url_for('/staff/subjects/index.php');?>">&laquo; Back to list</a></div>
    
    <div class="subject new">
        <h1>Edit Subject</h1>
        
        <form action="<?php echo url_for('/staff/subjects/edit.php?id=' . h(u($id)))?>" method="post">
            <dl>
                <dt>Menu name</dt>
                <dd><input type='text' name='menu_name' value="<?php 
                    echo h($subject['menu_name']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                    <?php 
                        for($i = 1; $i <= $subject_count; $i++) {
                            echo "<option value=\"{$i}\"";
                            if($subject['position'] == "{$i}"){ echo " selected";}
                            echo ">{$i}</option>";
                        }
                    ?>   
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input name="visible" type="hidden" value="0"/>
                    <input name="visible" type="checkbox" value="1" <?php if($subject['visible'] == "1"){ echo "checked"; } ?>/>
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Subject" />
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>