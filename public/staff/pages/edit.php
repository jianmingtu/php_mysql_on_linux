<?php
require_once("../../../private/initialize.php");
request_login();
    if(!isset($_GET['id'])) {
        redirect_to(url_for('/staff/subjects/index.php'));
        exit();
    }

    $page = [];
    $page['id'] = $_GET['id'];
    $page['subject_id'] = "";
    $page['menu_name'] = "";
    $page['position'] = "";
    $page['visible'] = "";
    $page['content'] = "";

    if(is_post_request()) {

        $page['subject_id'] = $_POST['subject_id']??"";
        $page['menu_name'] = $_POST['menu_name']??"";
        $page['position'] = $_POST['position']??"";
        $page['visible'] = $_POST['visible']??"";
        $page['content'] = $_POST['content']??"";

        update_page($page);

        redirect_to(url_for('/staff/pages/show.php?id='.$page['id']));
    } else {
        $subjects = find_all_subjects();
        $subject_count = mysqli_num_rows($subjects);


        $page = find_page_by_id($page['id']);
        $pages = find_page_by_subjec_id($page['subject_id']);
        $page_count = mysqli_num_rows($pages);

        $subject = find_subject_by_id($page['subject_id']);

    }
?>


<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH."/staff_header.php"); ?>

<div id="content">
    <a class="back-link" href=<?php echo url_for('/staff/subjects/show.php?id='.h(u($page['subject_id']))); ?>>&laquo;Back to List</a>
    <div class ="pages edit">
        <h1>Edit Page</h1>
        <form action = <?php echo url_for('/staff/pages/edit.php?id='.h($page['id'])); ?> method="post">
            <dl>
                <dt>Subject</dt>
                <dd>
                    <select name="subject_id">
                        <?php
                        while($subject = mysqli_fetch_assoc($subjects)) {
                            echo "<option value=\"{$subject['id']}\"";
                            if($subject['id'] ==$page['subject_id'])
                            {
                                echo "selected";
                            }
                            echo ">{$subject['menu_name']}</option>";
                        }
                        ?>
                    </select>
                </dd>
            </dl>

            <dl>
                <dt>Menu Name</dt>
                <dd>
                    <input type="text" name="menu_name" value =<?php echo h($page['menu_name']); ?>>
                </dd>
            </dl>

            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <?php
                        for($i=1; $i<=$page_count;++$i) {
                            echo "<option value=\"{$i}\" ";
                            if($i==$page['position']) {
                                echo "selected";
                            }
                            echo ">{$i}</option>";
                        }
                        ?>
                    </select>
                </dd>
            </dl>

            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type = "hidden" name="visible" value="0" />
                    <input type = "checkbox" name="visible" value="1" <?php if($page['visible']==1) {echo 'checked';} ?>/>
                </dd>
            </dl>

            <dl>
                <dt>Content</dt>
                <dd>
                    <textarea name="content" cols ="60" rows="10""><?php echo h($page['content']); ?></textarea>
                </dd>
            </dl>


            <div id="operations">
                <input type="submit" name="submit" value="Edit Page">
            </div>

        </form>
    </div>

</div>

<?php
mysqli_free_result($subjects);
mysqli_free_result($pages);
?>

<?php include(SHARED_PATH."/staff_footer.php"); ?>






