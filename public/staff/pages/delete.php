<?php

require_once('../../../private/initialize.php');
request_login();
if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'];
$page = [];

$page['menu_name'] = "";
$page['position']  = "";
$page['visible']   = "";

$page = find_page_by_id($id);

if(is_post_request()) {

    $page['id'] = $id;

    delete_page($id);
    redirect_to(url_for('/staff/subjects/show.php?id='.h(u($page['subject_id']))));

}

?>


<?php $page_title = 'Edit Subject' ?>
<?php include(SHARED_PATH.'/staff_header.php') ?>


<div id="content">
    <a class="back-link" href=<?php echo url_for('/staff/subjects/show.php?id='.h(u($page['subject_id']))); ?>>&laquo;Back to List</a>

    <div class="subject delete">
        <h1>Delete Page</h1>
        <form action="<?php echo url_for('/staff/pages/delete.php?id='.h(u($id))); ?>" method="post">
            <p> Are you sure you want to delete this page ? </p>
            <p> <?php echo $page['menu_name']; ?> </p>

            <div id="operations">
                <input type="submit" value="Delete Page" />
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH.'/staff_footer.php') ?>



