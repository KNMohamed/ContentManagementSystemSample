<?php 
    require_once('../../../private/initialize.php'); 
    
    if(!isset($_GET['id'])){
        redirect_to(url_for('/staff/pages/index.php'));
    }
    $id = $_GET['id'];
    
        
    if(is_post_request()){
        $page = [];
        $page['id'] = $id;
        $page['subject_id'] = $_POST['subject_id'] ?? '';
        $page['menu_name'] = $_POST['menu_name'] ?? '';
        $page['position'] = $_POST['position'] ?? '';
        $page['visible'] = $_POST['visible'] ?? '';
        $page['content'] = $_POST['content'] ?? '';
        
        if(update_page($page)){
            redirect_to(url_for("/staff/pages/show.php?id=" . $id));
        }else{
            echo "Error: " . mysqli_error($db) . "(" . mysqli_errno($db) . ")";
            db_disconnect($db);
            exit;
        }

    }else{
        $page = find_page_by_id($id);
        $page_count = get_page_count();
    }
?>


<?php $page_title = "Edit Page"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id ="content">
    <div class="back-link"><a class="action" href="<?php echo url_for('/staff/pages/index.php');?>">&laquo; Back to list</a></div>
    
    <div class="page new">
        <h1>Edit Page</h1>

        <form action="<?php echo url_for('/staff/pages/edit.php?id=' . $id);?>" method="post">
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
                <input type="submit" name="submit" value="Edit Page"/>
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>