<?php require_once("../../../private/initialize.php");

    $page = [];
    $page['id'] = "";
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

        insert_page($page);

        $id = mysqli_insert_id($db);

        redirect_to(url_for('/staff/pages/show.php?id='.$id));
    } else {
        $subjects = find_all_subjects();
        $subject_count = mysqli_num_rows($subjects);

        $pages = find_all_pages();
        $page_count = mysqli_num_rows($pages)+1;
        $page['id'] = $page_count;

    }

?>


<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH."/staff_header.php"); ?>

<div id="content">
    <a class="back-list" href="<?php echo url_for('/staff/pages/index.php'); ?>"> &laquo; Back to List</a>

    <div class ="pages new">
        <h1>Create Page</h1>
        <form action = <?php echo url_for('/staff/pages/new.php?id='.$page['id']); ?> method="post">
            <dl>
                <dt>Subject</dt>
                <dd>
                    <select name="subject_id">
                        <?php
                            while($subject = mysqli_fetch_assoc($subjects)) {
                                echo "<option value=\"{$subject['id']}\">{$subject['menu_name']}</option>";
                            }
                        ?>
                    </select>
                </dd>
            </dl>

            <dl>
                <dt>Menu Name</dt>
                <dd>
                    <input type="text" name="menu_name" value =<?php echo $page['menu_name']; ?>>
                </dd>
            </dl>

            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <?php
                            for($i=1; $i<=$page_count;++$i) {
                                echo "<option value=\"{$i}\" ";
                                if($i==$page_count) {
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
                    <textarea name="content" rows ="10" cols ="30" style="width:300px; height:100px;">
                        <?php echo $page['content']; ?>
                    </textarea>
                </dd>
            </dl>

            <div id="operations">
                <input type="submit" name="submit" value="Create Pages">
            </div>

        </form>
    </div>

</div>

<?php
    mysqli_free_result($subjects);
    mysqli_free_result($pages);
    ?>

<?php include(SHARED_PATH."/staff_footer.php"); ?>
