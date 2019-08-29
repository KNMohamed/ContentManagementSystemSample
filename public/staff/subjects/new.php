<?php 

require_once('../../../private/initialize.php');

$subject_count = get_subject_count();
$subject = [];
$subject['menu_name'] = '';
$subject['position'] = $subject_count;
$subject['visible'] = '';

if(is_post_request()){

    // Handle values sent by new.php
    $subject['menu_name'] = $_POST['menu_name'];
    $subject['position'] = $_POST['position'];
    $subject['visible'] = $_POST['visible'];
    
    $result = insert_subject($subject);
    
    if($result === true){
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id));       
    }else{
        var_dump($result);
        echo "Error Creating Subject: " . mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

?>

<?php $page_title = 'Create Subject' ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="back-link"><a class="action" href="<?php echo url_for('/staff/subjects/index.php');?>">&laquo; Back to list</a></div>

    <div class="subject new">
        <h1>Create Subject</h1>

        <form action="<?php echo url_for('/staff/subjects/new.php')?>" method="post">
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
                <input type="submit" name="submit" value="Create Subject" />
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>