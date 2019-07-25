<?php

require_once('../../../private/initialize.php');
request_login();

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'];
$admin = [];

$admin['username'] = "";

if(is_post_request()) {

    $page['id'] = $id;

    delete_admin($id);
    redirect_to(url_for('/staff/admins/index.php?'));

} else {
    $page = find_admin_by_id($id);
}

?>


<?php $page_title = 'delete Subject' ?>
<?php include(SHARED_PATH.'/staff_header.php') ?>


<div id="content">
    <a class="back-link" href=<?php echo url_for('/staff/admins/index.php'); ?>>&laquo;Back to List</a>

    <div class="admin delete">
        <h1>Delete Page</h1>
        <form action="<?php echo url_for('/staff/admins/delete.php?id='.h(u($id))); ?>" method="post">
            <p> Are you sure you want to delete this user ? </p>
            <p> <?php echo $admin['username']; ?> </p>

            <div id="operations">
                <input type="submit" value="Delete Page" />
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH.'/staff_footer.php') ?>



