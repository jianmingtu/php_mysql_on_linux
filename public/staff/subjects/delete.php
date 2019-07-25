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

    delete_subject($id);

} else {
    $subject = find_subject_by_id($id);
}

?>


<?php $page_title = 'Edit Subject' ?>
<?php include(SHARED_PATH.'/staff_header.php') ?>


<div id="content">
    <a class="back-link" href=<?php echo url_for('/staff/subjects/index.php'); ?>>&laquo;Back to List</a>

    <div class="subject delete">
        <h1>Delete Subject</h1>
        <form action="<?php echo url_for('/staff/subjects/delete.php?id='.h(u($id))); ?>" method="post">
            <p> Are you sure you want to delete this subject ? </p>
            <p> <?php echo $subject['menu_name']; ?> </p>

            <div id="operations">
                <input type="submit" value="Delete Subject" />
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH.'/staff_footer.php') ?>



