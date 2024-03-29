<?php

require_once('../../../private/initialize.php');
request_login();

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/subjects/index.php'));
}

$id = $_GET['id'];
$subject = [];

$subject['menu_name'] = "";
$subject['position']  = "";
$subject['visible']   = "";

if(is_post_request()) {

    $subject['id'] = $id;
    $subject['menu_name'] = $_POST['menu_name'] ?? '';
    $subject['position'] = $_POST['position'] ?? '';
    $subject['visible'] = $_POST['visible'] ?? '';

    $result = update_subject($subject);
    if($result === true) {
        $_SESSION['message'] = "The subject was successfully updated.";
        redirect_to(url_for('/staff/subjects/show.php?id=' . h(u($id))));
    } else {
        $errors = $result;
    }
} else {
    $subject = find_subject_by_id($id);

}

$result_set = find_all_subjects();
$subject_count = mysqli_num_rows($result_set);
mysqli_free_result($result_set);

?>


<?php $page_title = 'Edit Subject' ?>
<?php include(SHARED_PATH.'/staff_header.php') ?>


<div id="content">
    <a class="back-link" href=<?php echo url_for('/staff/subjects/index.php'); ?>>&laquo;Back to List</a>

    <div class="subject edit">
        <h1>Edit Subject</h1>

        <?php
            echo display_error($errors);
        ?>

        <form action="<?php echo url_for('/staff/subjects/edit.php?id='.h(u($id))); ?>" method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value=<?php echo $subject['menu_name']; ?> /></dd>
            </dl>

            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <?php for($i = 1; $i <= $subject_count; ++$i) {
                            echo "<option value=\"{$i}\"";
                            if($i==$id)
                            {
                                echo "selected";
                            }
                            echo ">{$i}</option>";
                        } ?>
                    </select>
                </dd>

            </dl>

            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type = "checkbox" name="visible" value="1" <?php if($subject['visible']=="1") {echo "checked";} ?> />
                </dd>
            </dl>

            <div id="operations">
                <input type="submit" value="Edit Subject" />
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH.'/staff_footer.php') ?>



