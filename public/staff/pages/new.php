<?php 

require_once('../../../private/initialize.php');

$page = [];
$page_count = get_page_count() + 1;

if(is_post_request()){

    // Handle values sent by new.php
    $page['subject_id'] = $_POST['subject_id'] ?? '';
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';
    

    $result = insert_page($page);
    if($result === true){
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/staff/pages/show.php?id=' . $new_id));
    }else{
        $errors = $result;
    }
}else{

    $page['subject_id'] = '';
    $page['menu_name'] = '';
    $page['position'] = $page_count;
    $page['visible'] = '' ;
    $page['content'] = '' ;
}
?>


<?php $page_title = "Create Page"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="back-link"><a class="action" href="<?php echo url_for('/staff/pages/index.php');?>">&laquo; Back to list</a></div>
    
    <div class="page new">
        <h1>Create Page</h1>

        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('/staff/pages/new.php');?>" method="post">
            <dl>
                <dt>Subject</dt>
                <dd>
                    <select name="subject_id">
                    <?php
                        $subject_set = find_all_subjects();
                        while($subject = mysqli_fetch_assoc($subject_set)){
                            echo "<option value=\"" . h($subject['id']) . "\"";
                            if($page['subject_id'] == $subject['id']){
                                echo " selected";
                            }
                            echo ">" . h($subject['menu_name']) . "</option>";
                        }
                        mysqli_free_result($subject_set);
                    ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Menu name</dt>
                <dd><input type='text' name='menu_name' value="<?php 
                    echo h($page['menu_name']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                       <?php
                        for($i = 1; $i <= $page_count; $i++){
                            echo "<option value=\"{$i}\"";
                            if($i == $page['position']){ echo " selected"; }
                            echo ">{$i}</option> ";
                        }
                        
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input name="visible" type="hidden" value="0"/>
                    <input name="visible" type="checkbox" value="1" <?php if($page['visible'] == "1"){ echo "checked"; } ?>/>
                </dd>
            </dl>
            <dl>
                <dt>Content</dt>
                <dd><input type="text" name="content" value="<?php echo h($page['content']); ?>"/></dd>
            </dl>
            <div id="operations">
                <input type="submit" name="submit" value="Create Page"/>
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>