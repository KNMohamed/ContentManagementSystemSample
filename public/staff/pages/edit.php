<?php 
    require_once('../../../private/initialize.php'); 
    
    if(!isset($_GET['id'])){
        redirect_to(url_for('/staff/pages/index.php'));
    }
    $id = $_GET['id'];
    $menu_name = '';    
    $position = '';    
    $visible = '0';

    if(is_post_request()){
        $menu_name = $_POST['menu_name'];    
        $position = $_POST['position'];    
        $visible = $_POST['visible'];
        
        echo "Form Parameters <br />";
        echo "Menu Name: " . $menu_name . "<br />";
        echo "Position: " . $position . "<br />";
        echo "Visible: " . $visible . "<br />";
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
                <dt>Menu name</dt>
                <dd><input type='text' name='menu_name' value="<?php 
                    echo h($menu_name); ?>" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <option value="1"<?php if($position == "1"){ echo " selected";}?>>1</option>                           <option value="2"<?php if($position == "2"){ echo " selected";}?>>2</option>    
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input name="visible" type="hidden" value="0"/>
                    <input name="visible" type="checkbox" value="1" <?php if($visible == "1"){ echo "checked"; } ?>/>
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" name="submit" value="Edit Page"/>
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>